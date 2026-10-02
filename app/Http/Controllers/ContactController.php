<?php

namespace App\Http\Controllers;

use App\Mail\EnquiryNotification;
use App\Models\ContactQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Store a newly created contact query.
     */
    public function store(Request $request)
    {
        // Verify Google reCAPTCHA
        $recaptchaSecret = config('services.recaptcha.secret_key');
        if (!empty($recaptchaSecret)) {
            $recaptchaToken = $request->input('g-recaptcha-response');
            if (empty($recaptchaToken)) {
                $errorMsg = 'Please verify that you are not a robot.';
                if ($request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => $errorMsg,
                        'errors' => ['g-recaptcha-response' => [$errorMsg]],
                    ], 422);
                }
                return redirect()->back()->withErrors(['g-recaptcha-response' => $errorMsg])->withInput();
            }

            try {
                $verifyResponse = Http::asForm()->timeout(5)->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => $recaptchaSecret,
                    'response' => $recaptchaToken,
                    'remoteip' => $request->ip(),
                ]);

                if (!$verifyResponse->successful() || !$verifyResponse->json('success')) {
                    $errorMsg = 'reCAPTCHA verification failed. Please try again.';
                    if ($request->wantsJson()) {
                        return response()->json([
                            'success' => false,
                            'message' => $errorMsg,
                            'errors' => ['g-recaptcha-response' => [$errorMsg]],
                        ], 422);
                    }
                    return redirect()->back()->withErrors(['g-recaptcha-response' => $errorMsg])->withInput();
                }
            } catch (\Throwable $e) {
                Log::warning('reCAPTCHA verification error: ' . $e->getMessage());
            }
        }

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

        // Send enquiry notification email
        try {
            $recipient = config('mail.enquiry_recipient', 'info@construction360.co');
            Mail::to($recipient)->send(new EnquiryNotification([
                'name' => $name,
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'subject' => $subject,
                'service' => $validated['service'] ?? null,
                'start_when' => $validated['start_when'] ?? null,
                'budget' => $validated['budget'] ?? null,
                'call_day' => $validated['call_day'] ?? null,
                'call_time' => $validated['call_time'] ?? null,
                'message' => $validated['message'],
                'attachments' => $storedFiles,
                'submitted_at' => now()->format('d M Y, H:i (e)'),
            ]));
        } catch (\Throwable $e) {
            Log::error('Failed to send enquiry notification email: ' . $e->getMessage(), [
                'recipient' => $recipient ?? 'unknown',
                'exception' => $e,
            ]);
        }

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
