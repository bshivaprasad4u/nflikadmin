<?php

namespace App;

class Settings
{
    public const VIDEO_FORMATS = 'mp4,mov,ogg,mpeg,webm,3gp,mov,flv,avi,wmv,ts,m3u8';
    public const VIDEO_MIMETYPES = 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi';
    public const IMAGE_FORMATS = [''];
    public const LANGUAGES = [
        'Telugu', 'Tamil', 'Hindi', 'English', 'Panjabi', 'Kannada'
    ];
  

    public const GENRES = [
        'Action', 'Comedy', 'Devotional', 'Drama', 'Education', 'Family', 'Food', 'Health', 'Horror', 'Music', 'Teaser', 'Travel', 'Yoga'
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
    public const PLANS = [
        'Bronze' => [
            'Live TV Channels Access' => 'N',
            'Live conference' => 'N',
            'Virtual Theater' => 'N',
            'Monetize Content' => 'N',
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
            'Monetize Content' => 'Y',
            'Video playlists' => 'N',
            'Subdomain Access' => 'Y',
            'Promotions FB,Instagram and Twitter' => 'N',
            'Device Restriction' => 'Single device access',
            'Setup-box' => '2500 INR',
            'Price' => '500 INR'
        ],
        'Gold' => [
            'Live TV Channels Access' => 'Y',
            'Live conference' => 'Upto 100 people + 1 hr access',
            'Virtual Theater' => 'Y (limited 10members)',
            'Monetize Content' => 'Y',
            'Video playlists' => 'N',
            'Subdomain Access' => 'Y',
            'Promotions FB,Instagram and Twitter' => 'N',
            'Device Restriction' => 'Single device access',
            'Setup-box' => '2500 INR',
            'Price' => '1000 INR'
        ],
        'Platinum' => [
            'Live TV Channels Access' => 'Y(Only free channels)',
            'Live conference' => 'unlimited',
            'Virtual Theater' => 'Y (Upto 25 members)',
            'Monetize Content' => 'Y',
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
            'Monetize Content' => 'Y',
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
            'Monetize Content' => 'Y',
            'Video playlists' => 'Y',
            'Subdomain Access' => 'Y',
            'Promotions FB,Instagram and Twitter' => 'Y',
            'Device Restriction' => '5 Devices at a time',
            'Setup-box' => 'Free Device',
            'Price' => '10000 INR'
        ],
    ];
}
