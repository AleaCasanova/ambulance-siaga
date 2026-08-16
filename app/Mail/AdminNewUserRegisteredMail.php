<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminNewUserRegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $newUser;
    public string $accountType; // 'Driver' atau 'Mitra Lembaga'
    public array $extraInfo;

    /**
     * Create a new message instance.
     */
    public function __construct(User $newUser, string $accountType = 'Driver', array $extraInfo = [])
    {
        $this->newUser = $newUser;
        $this->accountType = $accountType;
        $this->extraInfo = $extraInfo;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "[Ambulance Siaga] Pendaftaran {$this->accountType} Baru Menunggu Verifikasi: {$this->newUser->name}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-new-user',
            with: [
                'user' => $this->newUser,
                'accountType' => $this->accountType,
                'extraInfo' => $this->extraInfo,
                'verificationUrl' => route('admin.users.index'),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
