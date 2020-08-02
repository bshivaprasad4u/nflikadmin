<?php

namespace App;

class Settings
{
    public const LANGUAGES = [
        'Telugu', 'Tamil', 'Hindi', 'English', 'Panjabi', 'Kannada'
    ];
    public const GENRES = [
        'Comedy', 'Action', 'FAMILY'
    ];

    public const COUNTRIES = [
        'INDIA', 'AFRICA', 'CHINA', 'PAKISTAN', 'SRI LANKA', 'BANGLADESH'
    ];
    public const CURRENCIES = [
        'INR', 'USD', 'GBP', 'JPY', 'CAD'
    ];

    static public function getDuration($full_video_path)
    {
        $getID3 = new \getID3;
        $file = $getID3->analyze($full_video_path);
        $playtime_seconds = $file['playtime_seconds'];
        $duration = date('H:i:s', $playtime_seconds);

        return $duration;
    }
}
