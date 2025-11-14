<?php

namespace App\Controllers;

use App\Libraries\PrayerApiService;

class PrayerController extends BaseController
{
    protected $prayerApi;

    public function __construct()
    {
        $this->prayerApi = new PrayerApiService();
    }

    /**
     * Show prayer times and Hijri date
     */
    public function index()
    {
        $city = $this->request->getGet('city') ?? 'Jakarta';
        $country = $this->request->getGet('country') ?? 'Indonesia';

        // Get today's prayer times
        $prayerData = $this->prayerApi->getTodayPrayerTimes($city, $country);

        // Get Hijri date
        $hijriDate = $this->prayerApi->getTodayHijriDate();

        $data = [
            'title' => 'Jadwal Shalat - Portal Islami',
            'page_title' => 'Jadwal Shalat & Kalender Hijriyah',
            'prayer_data' => $prayerData,
            'hijri_date' => $hijriDate,
            'city' => $city,
            'country' => $country,
        ];

        return view('prayer/index', $data);
    }
}
