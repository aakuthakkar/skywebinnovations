<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255', 'min:2'],
            'email'         => ['required', 'email', 'max:255'],
            'project_type'  => ['required', 'string', 'in:Website,Web app,SaaS product,UI/UX,Other'],
            'message'       => ['required', 'string', 'min:10', 'max:5000'],
            // Honeypot field — must be empty for valid submissions
            'website_url'   => ['nullable', 'max:0'],
            // Spam signal fields
            'honeypot_time' => ['required', 'numeric'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your name.',
            'name.min'      => 'Please enter a valid name.',
            'email.required' => 'Please enter your email address.',
            'email.email'   => 'Please enter a valid email address (e.g. name@company.com).',
            'email.dns'     => 'The email domain does not appear to be valid.',
            'project_type.required' => 'Please select a project type.',
            'message.required' => 'Please tell us about your project (at least 10 characters).',
            'message.min'   => 'Please provide more details about your project (at least 10 characters).',
            'message.max'   => 'Your message is too long. Please keep it under 5,000 characters.',
            'website_url.max' => 'Spam detected.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $this->all();

            // Honeypot check — if filled, reject silently
            if (!empty($data['website_url'])) {
                $validator->errors()->add('spam', 'Your submission was flagged as spam.');
                return;
            }

            // Time-based check — must take at least 3 seconds on the page
            $honeypotTime = $data['honeypot_time'] ?? 0;
            if (!is_numeric($honeypotTime) || $honeypotTime < 3) {
                $validator->errors()->add('spam', 'Please take a moment to fill in the form properly.');
                return;
            }

            // Check for spam patterns in the message
            $message = strtolower(trim((string) ($data['message'] ?? '')));
            $spamPatterns = [
                // Common spam phrases
                '/\b(click here|buy now|free money|earn \$\d|work from home|make money fast|crypto trading|bitcoin investment|forex signals|weight loss|viagra|cialis|loan approval|debt relief)\b/i',
                // Repeated characters (aaaaaa, wwwwwww)
                '/(.)\1{10,}/',
                // Excessive links
                '/(https?:\/\/[^\s]{5,})/',
                // All-caps spam
                '/^[A-Z\s!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]{30,}$/',
                // URL-like spam in message
                '/\b(bit\.ly|tinyurl|goo\.gl|t\.co|ow\.ly)\//i',
            ];

            foreach ($spamPatterns as $pattern) {
                if (preg_match($pattern, $message)) {
                    $validator->errors()->add('spam', 'Your message appears to contain spam content. Please revise and try again.');
                    return;
                }
            }

            // Block disposable email domains
            $email = strtolower($data['email'] ?? '');
            $domain = substr(strrchr($email, '@'), 1);
            $disposableDomains = [
                'mailinator.com', 'guerrillamail.com', 'temp-mail.org', 'throwaway.email',
                'yopmail.com', 'trashmail.com', 'sharklasers.com', 'guerrillamailblock.com',
                'grr.la', 'dispostable.com', 'maildrop.cc', 'mailnesia.com',
                'tempail.com', 'mohmal.com', 'emailondeck.com', 'tempmail.net',
            ];

            if (in_array($domain, $disposableDomains)) {
                $validator->errors()->add('spam', 'Please use a permanent email address.');
                return;
            }

            // Rate limiting: check how many submissions from this IP in the last hour
            $ip = $this->ip();
            $recentCount = \App\Models\ContactInquiry::where('ip_address', $ip)
                ->where('created_at', '>', now()->subHours(1))
                ->count();

            if ($recentCount >= 3) {
                $validator->errors()->add('spam', 'Too many submissions from your network. Please try again in an hour.');
                return;
            }
        });
    }
}
