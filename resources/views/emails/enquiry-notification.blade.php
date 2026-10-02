<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $enquiry['subject'] ?? 'New Project Enquiry' }}</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f3f6f8; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1f2937; line-height: 1.6;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #f3f6f8; padding: 30px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" max-width="640" cellspacing="0" cellpadding="0" border="0" style="max-width: 640px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.06);">
                    
                    {{-- Header --}}
                    <tr>
                        <td style="background-color: #0f2a3a; padding: 32px 36px; text-align: left; border-bottom: 4px solid #f0d778;">
                            <h1 style="margin: 0; font-size: 22px; font-weight: 700; color: #ffffff; letter-spacing: -0.02em;">
                                Construction 360 Ltd
                            </h1>
                            <p style="margin: 6px 0 0 0; font-size: 13px; color: #f0d778; text-transform: uppercase; letter-spacing: 0.12em; font-weight: 600;">
                                New Project Enquiry Received
                            </p>
                        </td>
                    </tr>

                    {{-- Main Content --}}
                    <tr>
                        <td style="padding: 36px 36px 24px 36px;">
                            <p style="margin: 0 0 20px 0; font-size: 15px; color: #4b5563;">
                                You have received a new customer enquiry from the website. Details are provided below:
                            </p>

                            {{-- Client Information Card --}}
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 24px; border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden;">
                                <tr>
                                    <td colspan="2" style="background-color: #f8fafc; padding: 12px 18px; font-size: 12px; font-weight: 700; color: #0f2a3a; text-transform: uppercase; letter-spacing: 0.08em; border-bottom: 1px solid #e5e7eb;">
                                        Client Contact Details
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%" style="padding: 10px 18px; font-size: 14px; font-weight: 600; color: #6b7280; border-bottom: 1px solid #f1f5f9;">Full Name:</td>
                                    <td width="65%" style="padding: 10px 18px; font-size: 14px; color: #111827; font-weight: 600; border-bottom: 1px solid #f1f5f9;">
                                        {{ $enquiry['name'] ?? 'Not specified' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 18px; font-size: 14px; font-weight: 600; color: #6b7280; border-bottom: 1px solid #f1f5f9;">Email Address:</td>
                                    <td style="padding: 10px 18px; font-size: 14px; color: #0f2a3a; font-weight: 600; border-bottom: 1px solid #f1f5f9;">
                                        <a href="mailto:{{ $enquiry['email'] }}" style="color: #1e40af; text-decoration: none;">{{ $enquiry['email'] }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 18px; font-size: 14px; font-weight: 600; color: #6b7280; border-bottom: 1px solid #f1f5f9;">Phone Number:</td>
                                    <td style="padding: 10px 18px; font-size: 14px; color: #111827; border-bottom: 1px solid #f1f5f9;">
                                        @if(!empty($enquiry['phone']))
                                            <a href="tel:{{ $enquiry['phone'] }}" style="color: #111827; text-decoration: none; font-weight: 600;">{{ $enquiry['phone'] }}</a>
                                        @else
                                            <span style="color: #9ca3af; font-style: italic;">Not provided</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 18px; font-size: 14px; font-weight: 600; color: #6b7280;">Submission Time:</td>
                                    <td style="padding: 10px 18px; font-size: 13px; color: #6b7280;">
                                        {{ $enquiry['submitted_at'] ?? now()->format('d M Y, H:i (e)') }}
                                    </td>
                                </tr>
                            </table>

                            {{-- Project Parameters Card --}}
                            @if(!empty($enquiry['service']) || !empty($enquiry['budget']) || !empty($enquiry['start_when']) || !empty($enquiry['call_day']) || !empty($enquiry['call_time']))
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 24px; border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden;">
                                <tr>
                                    <td colspan="2" style="background-color: #f8fafc; padding: 12px 18px; font-size: 12px; font-weight: 700; color: #0f2a3a; text-transform: uppercase; letter-spacing: 0.08em; border-bottom: 1px solid #e5e7eb;">
                                        Project Scope & Consultation
                                    </td>
                                </tr>
                                @if(!empty($enquiry['service']))
                                <tr>
                                    <td width="35%" style="padding: 10px 18px; font-size: 14px; font-weight: 600; color: #6b7280; border-bottom: 1px solid #f1f5f9;">Requested Service:</td>
                                    <td width="65%" style="padding: 10px 18px; font-size: 14px; color: #111827; font-weight: 600; border-bottom: 1px solid #f1f5f9;">
                                        {{ $enquiry['service'] }}
                                    </td>
                                </tr>
                                @endif
                                @if(!empty($enquiry['budget']))
                                <tr>
                                    <td style="padding: 10px 18px; font-size: 14px; font-weight: 600; color: #6b7280; border-bottom: 1px solid #f1f5f9;">Approx. Budget:</td>
                                    <td style="padding: 10px 18px; font-size: 14px; color: #111827; border-bottom: 1px solid #f1f5f9;">
                                        {{ $enquiry['budget'] }}
                                    </td>
                                </tr>
                                @endif
                                @if(!empty($enquiry['start_when']))
                                <tr>
                                    <td style="padding: 10px 18px; font-size: 14px; font-weight: 600; color: #6b7280; border-bottom: 1px solid #f1f5f9;">When to Start:</td>
                                    <td style="padding: 10px 18px; font-size: 14px; color: #111827; border-bottom: 1px solid #f1f5f9;">
                                        {{ $enquiry['start_when'] }}
                                    </td>
                                </tr>
                                @endif
                                @if(!empty($enquiry['call_day']) || !empty($enquiry['call_time']))
                                <tr>
                                    <td style="padding: 10px 18px; font-size: 14px; font-weight: 600; color: #6b7280;">Best Time to Call:</td>
                                    <td style="padding: 10px 18px; font-size: 14px; color: #111827;">
                                        {{ $enquiry['call_day'] ?? 'Any weekday' }} &middot; {{ $enquiry['call_time'] ?? 'Any time' }}
                                    </td>
                                </tr>
                                @endif
                            </table>
                            @endif

                            {{-- Project Message / Brief --}}
                            <div style="margin-bottom: 24px; border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden;">
                                <div style="background-color: #f8fafc; padding: 12px 18px; font-size: 12px; font-weight: 700; color: #0f2a3a; text-transform: uppercase; letter-spacing: 0.08em; border-bottom: 1px solid #e5e7eb;">
                                    Project Description / Client Message
                                </div>
                                <div style="padding: 18px; font-size: 14px; color: #374151; white-space: pre-wrap; word-break: break-word; background-color: #ffffff; line-height: 1.7;">{{ $enquiry['message'] ?? 'No message provided.' }}</div>
                            </div>

                            {{-- Attachments Notice --}}
                            @if(!empty($enquiry['attachments']) && count($enquiry['attachments']) > 0)
                            <div style="margin-bottom: 24px; padding: 14px 18px; background-color: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; font-size: 13px; color: #1e40af;">
                                <strong>Attached Files ({{ count($enquiry['attachments']) }}):</strong>
                                <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                                    @foreach($enquiry['attachments'] as $att)
                                        <li style="margin-bottom: 4px; word-break: break-all;">{{ basename($att) }}</li>
                                    @endforeach
                                </ul>
                                <span style="display: block; margin-top: 6px; font-size: 11px; color: #3b82f6;">Files are attached directly to this email and archived securely on the server.</span>
                            </div>
                            @endif

                            {{-- Action Button --}}
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 28px;">
                                <tr>
                                    <td align="center">
                                        <a href="mailto:{{ $enquiry['email'] }}?subject=Re:%20{{ rawurlencode($enquiry['subject'] ?? 'Project Enquiry') }}"
                                           style="display: inline-block; background-color: #0f2a3a; color: #ffffff; text-decoration: none; padding: 14px 28px; border-radius: 8px; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em;">
                                            Reply Directly to {{ $enquiry['name'] ?? 'Client' }} &rarr;
                                        </a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color: #f8fafc; padding: 20px 36px; border-top: 1px solid #e5e7eb; text-align: center; font-size: 12px; color: #9ca3af;">
                            This automated enquiry notification was generated from the <a href="{{ config('app.url', 'https://construction360.co') }}" style="color: #6b7280; text-decoration: underline;">Construction 360</a> website.
                            <br>
                            To manage all enquiries, log in to the <a href="{{ url('/admin/queries') }}" style="color: #6b7280; text-decoration: underline;">Admin Dashboard</a>.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
