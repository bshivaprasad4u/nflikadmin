<?php


use App\ApiCode;

return [
    /*
    |-----------------------------------------------------------------------------------------------------------
    | Code range settings
    |-----------------------------------------------------------------------------------------------------------
    */
    'min_code'          => 100,
    'max_code'          => 1024,

    /*
    |-----------------------------------------------------------------------------------------------------------
    | Error code to message mapping
    |-----------------------------------------------------------------------------------------------------------
    |
    */
    'map'               => [
        ApiCode::SOMETHING_WENT_WRONG => 'api.something_went_wrong',
        ApiCode::INVALID_CREDENTIALS => 'api.invalid_credentials',
        ApiCode::VALIDATION_ERROR => 'api.validation_error',
        ApiCode::INVALID_EMAIL_VERIFICATION_URL => 'api.invalid_email_verification_url',
        ApiCode::EMAIL_ALREADY_VERIFIED => 'api.email_already_verified',
        ApiCode::INVALID_RESET_PASSWORD_TOKEN => 'api.invalid_reset_password_token',
        ApiCode::PASSWORD_RESET_LINK => 'passwords.sent',
        ApiCode::INVALID_PASSWORD => 'api.invalid_password',
        ApiCode::SAME_PASSWORD_AS_OLD => 'api.same_password_as_old',
        ApiCode::OTP_EXPIRED => 'api.otp_expired'
    ],

];
