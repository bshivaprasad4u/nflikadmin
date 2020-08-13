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
    static public function plans()
    {
        $plans = [
            'bronze' => [
                'Live TV Channels Access' => 'N',
                'Live conference' => 'N',
                'Virtual Theater' => 'N',
                'Monetise Content' => 'N',
                'Video playlists' => 'N',
                'Subdomain Access' => 'N',
                'Promotions FB,Instagram and Twitter' => 'N',
                'Device Restriction' => 'Single device access',
                'Setup-box' => '2500 INR',
                'Price' => 'Free'
            ],
            'Silver' => [
                'Live TV Channels Access' => 'Y',
                'Live conference' => '40 min access + 25 users restriction',
                'Virtual Theater' => 'N',
                'Monetise Content' => 'N',
                'Video playlists' => 'N',
                'Subdomain Access' => 'N',
                'Promotions FB,Instagram and Twitter' => 'N',
                'Device Restriction' => 'Single device access',
                'Setup-box' => '2500 INR',
                'Price' => '500 INR'
            ],
            'Gold' => [
                'Live TV Channels Access' => 'Y',
                'Live conference' => 'Upto 100 people + 1 hr access',
                'Virtual Theater' => 'Y (limited 10members)',
                'Monetise Content' => 'Y',
                'Video playlists' => 'N',
                'Subdomain Access' => 'N',
                'Promotions FB,Instagram and Twitter' => 'N',
                'Device Restriction' => 'Single device access',
                'Setup-box' => '2500 INR',
                'Price' => '1000 INR'
            ],
            'Platinum' => [
                'Live TV Channels Access' => 'Y(Only free channels)',
                'Live conference' => 'unlimited',
                'Virtual Theater' => 'Y (Upto 25 members)',
                'Monetise Content' => 'Y',
                'Video playlists' => 'Y',
                'Subdomain Access' => 'Y',
                'Promotions FB,Instagram and Twitter' => 'Y',
                'Device Restriction' => '3 Devices at a time',
                'Setup-box' => '2500 INR',
                'Price' => '3000 INR'
            ],
            'Diamond' => [
                'Live TV Channels Access' => 'Y(All channels)',
                'Live conference' => 'Unlimited',
                'Virtual Theater' => 'Y (Upto 100 members)',
                'Monetise Content' => 'Y',
                'Video playlists' => 'Y',
                'Subdomain Access' => 'Y',
                'Promotions FB,Instagram and Twitter' => 'Y',
                'Device Restriction' => '5 Devices at a time',
                'Setup-box' => '2500 INR',
                'Price' => '5000 INR'
            ],
            'VVIP' => [
                'Live TV Channels Access' => 'Y(All channels)',
                'Live conference' => 'Unlimited',
                'Virtual Theater' => 'Y (unlimited)',
                'Monetise Content' => 'Y',
                'Video playlists' => 'Y',
                'Subdomain Access' => 'Y',
                'Promotions FB,Instagram and Twitter' => 'Y',
                'Device Restriction' => '5 Devices at a time',
                'Setup-box' => 'Free Device',
                'Price' => '10000 INR'
            ],
        ];
    }
}
