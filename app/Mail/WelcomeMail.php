<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verificationUrl;

    public function __construct($user)
    {
        $this->user = $user;
        $this->verificationUrl = URL::temporarySignedRoute(
            'verification.verify', // Route default untuk verifikasi email
            now()->addMinutes(60), // Masa berlaku link (60 menit)
            ['id' => $user->id, 'hash' => sha1($user->email)] // Parameter
        );
    }

    public function build()
    {
        $app_name = getSetting('app_name');
        return $this->subject('Selamat datang di '.$app_name)
            ->view('emails.welcome') // Buat file blade di resources/views/emails/welcome.blade.php
            ->with(['user' => $this->user]);
    }
}
