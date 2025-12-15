<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignedEmailVerificationRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(SignedEmailVerificationRequest $request)
    {

        if ($request->user()->hasVerifiedEmail()) {


            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $message['title'] = 'Telah Diverifikasi';
            $message['message'] = 'Akun anda sudah diverifikasi sebelumnya.';
            Session::put('message', $message);
            return view('auth.verified');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $message['title'] = 'Berhasil Diverifikasi';
        $message['message'] = 'Akun anda telah berhasil diverifikasi.';
        Session::put('message', $message);
        return view('auth.verified');
    }
}
