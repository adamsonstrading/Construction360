<?php

namespace App\Http\Controllers;

use App\Models\ContactQuery;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store a newly created contact query.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:120',
            'last_name' => 'nullable|string|max:120',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'service' => 'nullable|string|max:255',
            'start_when' => 'nullable|string|max:100',
            'budget' => 'nullable|string|max:100',
            'call_day' => 'nullable|string|max:50',
            'call_time' => 'nullable|string|max:50',
            'message' => 'required|string|max:5000',
            'attachments' => 'nullable|array|max:5',
            'attachments.*' => 'file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx,webp',
        ]);

        $name = trim($validated['name'] ?? '');
        if ($name === '') {
            $name = trim(($validated['first_name'] ?? '') . ' ' . ($validated['last_name'] ?? ''));
        }
        if ($name === '') {
            return redirect()->back()->withErrors(['first_name' => 'Please enter your name.'])->withInput();
        }

        $subject = $validated['subject'] ?? null;
        if (empty($subject) && ! empty($validated['service'])) {
            $subject = 'Estimate · ' . $validated['service'];
        }
        $subject = $subject ?: 'Project estimate enquiry';

        $metaLines = [];
        if (! empty($validated['phone'])) {
            $metaLines[] = 'Phone: ' . $validated['phone'];
        }
        if (! empty($validated['service'])) {
            $metaLines[] = 'Service: ' . $validated['service'];
        }
        if (! empty($validated['start_when'])) {
            $metaLines[] = 'When to start: ' . $validated['start_when'];
        }
        if (! empty($validated['budget'])) {
            $metaLines[] = 'Approx. budget: ' . $validated['budget'];
        }
        if (! empty($validated['call_day'])) {
            $metaLines[] = 'Best day to call: ' . $validated['call_day'];
        }
        if (! empty($validated['call_time'])) {
            $metaLines[] = 'Best time to call: ' . $validated['call_time'];
        }

        $storedFiles = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $storedFiles[] = $file->store('enquiry-attachments', 'public');
            }
        }
        if ($storedFiles) {
            $metaLines[] = 'Attachments: ' . implode(', ', $storedFiles);
        }

        $fullMessage = $validated['message'];
        if ($metaLines) {
            $fullMessage .= "\n\n—\n" . implode("\n", $metaLines);
        }

        ContactQuery::create([
            'name' => $name,
            'email' => $validated['email'],
            'subject' => $subject,
            'message' => $fullMessage,
            'status' => 'new',
        ]);

        $message = 'Thank you for your enquiry. Our team will review your project details and contact you shortly.';

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }
}
