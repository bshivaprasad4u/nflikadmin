<?php

namespace App;

class ApiCode
{
    public const VERIFICATION_CODE_EXPIRY_IN_MINS = 15;
    public const OTP_EXIPRES_IN_MINS = 5;
    public const COUPON_EXIPRES_IN_DAYS = 90;

    public const DATA_NOT_FOUND = 113;
    public const SOMETHING_WENT_WRONG = 250;
    public const INVALID_CREDENTIALS = 251;
    public const VALIDATION_ERROR = 252;
    public const EMAIL_ALREADY_VERIFIED = 253;
    public const INVALID_EMAIL_VERIFICATION_URL = 254;
    public const INVALID_RESET_PASSWORD_TOKEN = 255;
    public const PASSWORD_RESET_LINK = 256;
    public const INVALID_PASSWORD = 257;
    public const SAME_PASSWORD_AS_OLD = 258;
    public const OTP_EXPIRED = 259;
    public const INVALID_CREDENTIALS_OTP = 260;
}
