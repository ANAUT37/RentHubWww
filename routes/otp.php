<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use SadiqSalau\LaravelOtp\Facades\Otp;


/** OTP Verification Route */
Route::post('/otp/verify', function (Request $request) {

    $request->validate([
        'email'    => ['required', 'string', 'email', 'max:255'],
        'code'     => ['required', 'string']
    ]);

    $otp = Otp::identifier($request->email)->attempt($request->code);

    if($otp['status'] != Otp::OTP_PROCESSED)
    {
        abort(403, __($otp['status']));
    }

    return $otp['result'];
});


/** OTP Resend Route */
Route::post('/otp/resend', function (Request $request) {

    $request->validate([
        'email'    => ['required', 'string', 'email', 'max:255']
    ]);

    $otp = Otp::identifier($request->email)->update();

    if($otp['status'] != Otp::OTP_SENT)
    {
        abort(403, __($otp['status']));
    }
    return __($otp['status']);
});
