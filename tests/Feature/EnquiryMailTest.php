<?php

namespace Tests\Feature;

use App\Mail\EnquiryNotification;
use App\Models\ContactQuery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EnquiryMailTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that EnquiryNotification mailable renders all enquiry details properly.
     */
    public function test_enquiry_mailable_renders_all_content_correctly(): void
    {
        $payload = [
            'name' => 'Alice Construction Lead',
            'email' => 'alice@example.com',
            'phone' => '+44 7123 456789',
            'subject' => 'Estimate · Rear extension',
            'service' => 'Rear Extension',
            'start_when' => '1–3 months',
            'budget' => '£50k–£150k',
            'call_day' => 'Tuesday',
            'call_time' => 'Morning (9–12)',
            'message' => 'We are planning a ground floor rear extension of approximately 35sqm.',
            'attachments' => [],
            'submitted_at' => '02 Oct 2026, 14:00 (BST)',
        ];

        $mailable = new EnquiryNotification($payload);

        // Verify subject and envelope
        $envelope = $mailable->envelope();
        $this->assertEquals('[Enquiry] Estimate · Rear extension', $envelope->subject);
        $this->assertNotEmpty($envelope->replyTo);
        $this->assertEquals('alice@example.com', $envelope->replyTo[0]->address);
        $this->assertEquals('Alice Construction Lead', $envelope->replyTo[0]->name);

        // Render HTML content and check expected fields
        $renderedHtml = $mailable->render();
        $this->assertStringContainsString('Alice Construction Lead', $renderedHtml);
        $this->assertStringContainsString('alice@example.com', $renderedHtml);
        $this->assertStringContainsString('+44 7123 456789', $renderedHtml);
        $this->assertStringContainsString('Rear Extension', $renderedHtml);
        $this->assertStringContainsString('1–3 months', $renderedHtml);
        $this->assertStringContainsString('£50k–£150k', $renderedHtml);
        $this->assertStringContainsString('Tuesday', $renderedHtml);
        $this->assertStringContainsString('Morning (9–12)', $renderedHtml);
        $this->assertStringContainsString('We are planning a ground floor rear extension of approximately 35sqm.', $renderedHtml);
        $this->assertStringContainsString('info@construction360.co', config('mail.enquiry_recipient'));
    }

    /**
     * Test submitting enquiry triggers email to info@construction360.co.
     */
    public function test_contact_store_dispatches_mail_to_target_address(): void
    {
        Mail::fake();
        config(['services.recaptcha.secret_key' => null]);

        $response = $this->post('/contact', [
            'name' => 'David Miller',
            'email' => 'david@example.com',
            'phone' => '07999888777',
            'subject' => 'New home build quotation',
            'message' => 'Please get in touch regarding our new build plot.',
        ]);

        $response->assertSessionHasNoErrors();

        // Verify Mail was sent to info@construction360.co
        Mail::assertSent(EnquiryNotification::class, function ($mail) {
            return $mail->hasTo(config('mail.enquiry_recipient', 'info@construction360.co')) &&
                   $mail->enquiry['name'] === 'David Miller' &&
                   $mail->enquiry['email'] === 'david@example.com' &&
                   $mail->enquiry['phone'] === '07999888777';
        });
    }

    /**
     * Test submitting full estimate enquiry with all fields and file attachment.
     */
    public function test_full_estimate_enquiry_with_attachment_dispatches_mail(): void
    {
        Mail::fake();
        \Illuminate\Support\Facades\Storage::fake('public');
        config(['services.recaptcha.secret_key' => null]);

        $fakeFile = \Illuminate\Http\UploadedFile::fake()->create('structural-drawing.pdf', 150, 'application/pdf');

        $response = $this->post('/contact', [
            'first_name' => 'Sarah',
            'last_name' => 'Jenkins',
            'email' => 'sarah.jenkins@example.com',
            'phone' => '+44 7700 900123',
            'service' => 'Commercial fit-out',
            'start_when' => 'ASAP',
            'budget' => '£150k–£500k',
            'call_day' => 'Monday',
            'call_time' => 'Afternoon (12–5)',
            'message' => 'Office fit-out across 2 floors in central London.',
            'attachments' => [$fakeFile],
        ]);

        $response->assertSessionHasNoErrors();

        Mail::assertSent(EnquiryNotification::class, function ($mail) {
            $hasRecipient = $mail->hasTo('info@construction360.co');
            $data = $mail->enquiry;

            return $hasRecipient &&
                   $data['name'] === 'Sarah Jenkins' &&
                   $data['email'] === 'sarah.jenkins@example.com' &&
                   $data['phone'] === '+44 7700 900123' &&
                   $data['service'] === 'Commercial fit-out' &&
                   $data['start_when'] === 'ASAP' &&
                   $data['budget'] === '£150k–£500k' &&
                   $data['call_day'] === 'Monday' &&
                   $data['call_time'] === 'Afternoon (12–5)' &&
                   $data['message'] === 'Office fit-out across 2 floors in central London.' &&
                   count($data['attachments']) === 1;
        });
    }

    /**
     * Test submitting enquiry without call_day and call_time succeeds.
     */
    public function test_estimate_enquiry_without_call_day_and_time_succeeds(): void
    {
        Mail::fake();
        config(['services.recaptcha.secret_key' => null]);

        $response = $this->post('/contact', [
            'first_name' => 'James',
            'last_name' => 'Taylor',
            'email' => 'james.taylor@example.com',
            'phone' => '+44 7700 900456',
            'service' => 'Renovation',
            'start_when' => 'ASAP',
            'budget' => '£50k–£150k',
            'message' => 'Complete home renovation enquiry.',
        ]);

        $response->assertSessionHasNoErrors();

        Mail::assertSent(EnquiryNotification::class, function ($mail) {
            $data = $mail->enquiry;
            return $data['name'] === 'James Taylor' &&
                   $data['email'] === 'james.taylor@example.com' &&
                   empty($data['call_day']) &&
                   empty($data['call_time']);
        });
    }
}

