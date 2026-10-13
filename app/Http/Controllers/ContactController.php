<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\NewContactInquiry;
use App\Models\ContactInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class ContactController extends Controller
{
    public function submit(ContactRequest $request)
    {
        // Server-side rate limit: max 3 submissions per IP per hour
        $key = 'contact:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Too many submissions from your network. Please try again in an hour.',
                ], 429);
            }
            return back()->withErrors(['spam' => 'Too many submissions from your network. Please try again in an hour.'])->withInput();
        }

        $data = $request->validated();
        unset($data['website_url'], $data['honeypot_time']); // remove non-persistent fields

        $inquiry = ContactInquiry::create(array_merge($data, [
            'ip_address' => $request->ip(),
            'status' => 'new',
        ]));

        RateLimiter::hit($key, 3600); // 1 hour window

        try {
            Mail::to(config('mail.from.address'))->send(new NewContactInquiry($inquiry));
        } catch (\Throwable $e) {
            \Log::error('Contact email failed: ' . $e->getMessage());
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Brief received. We\'ll review your ' . strtolower($inquiry->project_type) . ' brief and reply within one business day.',
            ]);
        }

        return back()->with('success', true);
    }
}
