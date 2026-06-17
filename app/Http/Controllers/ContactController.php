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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        ContactQuery::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? 'Project Inquiry',
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        $message = 'Thank you for your inquiry. Our engineering team will review your project specifications and contact you at the email address provided.';

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }
}
