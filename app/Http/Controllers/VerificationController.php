<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    // public function notice()
    // {
    //     return response()->json([
    //         'message' => 'Mohon untuk melakukan verifikasi email terlebih dahulu',
    //     ]);
    // }

    // public function verify(EmailVerificationRequest $request)
    // {
    //     $request->fulfill();
    //     return response()->json([
    //         'message' => 'Akun berhasil diverifikasi, Selamat Datang',
    //     ]);
    // }


    public function sendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return [
                'message' => 'Already Verified'
            ];
        }

        $request->user()->sendEmailVerificationNotification();

        return ['status' => 'verification-link-sent'];
    }

    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return [
                'message' => 'Email already verified'
            ];
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return [
            'message' => 'Email has been verified'
        ];
    }
}