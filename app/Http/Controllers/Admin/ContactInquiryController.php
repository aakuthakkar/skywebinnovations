<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Http\Request;

class ContactInquiryController extends Controller
{
    public function index()
    {
        $inquiries = ContactInquiry::latest()->paginate(20);
        return view('admin.contact-inquiries.index', compact('inquiries'));
    }

    public function show(ContactInquiry $contactInquiry)
    {
        $contactInquiry->update(['status' => 'read']);
        return view('admin.contact-inquiries.show', compact('contactInquiry'));
    }

    public function updateStatus(Request $request, ContactInquiry $contactInquiry)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,read,replied,closed',
        ]);

        $contactInquiry->update(['status' => $validated['status']]);

        return back()->with('success', 'Status updated successfully.');
    }

    public function destroy(ContactInquiry $contactInquiry)
    {
        $contactInquiry->delete();
        return redirect()->route('admin.contact-inquiries.index')->with('success', 'Inquiry deleted successfully.');
    }
}
