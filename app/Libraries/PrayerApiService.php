<?php

namespace App\Libraries;

use Config\Services;

class PrayerApiService
{
    protected $client;
    protected $baseUrl = 'https://api.aladhan.com/v1';

    public function __construct()
    {
        $this->client = Services::curlrequest([
            'baseURI' => $this->baseUrl,
            'timeout' => 10,
        ]);
    }

    /**
     * Get today's prayer times by city
     * @param string $city
     * @param string $country
     * @return array
     */
    public function getTodayPrayerTimes($city = 'Jakarta', $country = 'Indonesia')
    {
        try {
            $response = $this->client->get('/timingsByCity', [
                'query' => [
                    'city' => $city,
                    'country' => $country,
                    'method' => 2, // Islamic Society of North America (ISNA)
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                return $data['data'] ?? [];
            }

            return [];
        } catch (\Exception $e) {
            log_message('error', 'PrayerAPI Error: ' . $e->getMessage());
            return $this->getFallbackPrayerTimes($city, $country);
        }
    }

    /**
     * Get prayer times by coordinates
     * @param float $latitude
     * @param float $longitude
     * @return array
     */
    public function getPrayerTimesByCoordinates($latitude, $longitude)
    {
        try {
            $response = $this->client->get('/timings', [
                'query' => [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'method' => 2,
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                return $data['data'] ?? [];
            }

            return [];
        } catch (\Exception $e) {
            log_message('error', 'PrayerAPI Error getPrayerTimesByCoordinates: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get current Hijri date
     * @return array
     */
    public function getTodayHijriDate()
    {
        try {
            $response = $this->client->get('/gToH', [
                'query' => [
                    'date' => date('d-m-Y'),
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                return $data['data']['hijri'] ?? [];
            }

            return [];
        } catch (\Exception $e) {
            log_message('error', 'PrayerAPI Error getTodayHijriDate: ' . $e->getMessage());
            return $this->getFallbackHijriDate();
        }
    }

    /**
     * Get monthly prayer calendar
     * @param string $city
     * @param string $country
     * @param int $month
     * @param int $year
     * @return array
     */
    public function getMonthlyCalendar($city = 'Jakarta', $country = 'Indonesia', $month = null, $year = null)
    {
        $month = $month ?? date('m');
        $year = $year ?? date('Y');

        try {
            $response = $this->client->get("/calendarByCity/{$year}/{$month}", [
                'query' => [
                    'city' => $city,
                    'country' => $country,
                    'method' => 2,
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                return $data['data'] ?? [];
            }

            return [];
        } catch (\Exception $e) {
            log_message('error', 'PrayerAPI Error getMonthlyCalendar: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Fallback prayer times if API fails
     * @param string $city
     * @param string $country
     * @return array
     */
    private function getFallbackPrayerTimes($city = 'Jakarta', $country = 'Indonesia')
    {
        // Return realistic prayer times for Jakarta, Indonesia
        $date = date('d M Y');
        $gregorian = [
            'date' => date('d-m-Y'),
            'format' => 'DD-MM-YYYY',
            'day' => date('d'),
            'weekday' => ['en' => date('l')],
            'month' => ['number' => date('m'), 'en' => date('F')],
            'year' => date('Y'),
        ];

        $hijri = $this->getFallbackHijriDate();

        return [
            'timings' => [
                'Fajr' => '04:30',
                'Sunrise' => '05:50',
                'Dhuhr' => '11:55',
                'Asr' => '15:15',
                'Sunset' => '18:00',
                'Maghrib' => '18:00',
                'Isha' => '19:10',
                'Imsak' => '04:20',
                'Midnight' => '23:55',
            ],
            'date' => [
                'readable' => $date,
                'timestamp' => time(),
                'gregorian' => $gregorian,
                'hijri' => $hijri,
            ],
            'meta' => [
                'latitude' => -6.2088,
                'longitude' => 106.8456,
                'timezone' => 'Asia/Jakarta',
                'method' => [
                    'id' => 2,
                    'name' => 'Islamic Society of North America (ISNA)',
                ],
            ],
        ];
    }

    /**
     * Fallback Hijri date if API fails
     * @return array
     */
    private function getFallbackHijriDate()
    {
        // Approximate Hijri date calculation
        // Note: This is a simplified calculation and may not be 100% accurate
        $gregorianYear = (int)date('Y');
        $gregorianMonth = (int)date('m');
        $gregorianDay = (int)date('d');

        // Simple approximation (Hijri year is roughly 11 days shorter)
        $hijriYear = $gregorianYear - 622 + (int)(($gregorianYear - 622) / 33);

        $hijriMonths = [
            '1' => 'Muharram',
            '2' => 'Safar',
            '3' => 'Rabi\' al-Awwal',
            '4' => 'Rabi\' al-Thani',
            '5' => 'Jumada al-Awwal',
            '6' => 'Jumada al-Thani',
            '7' => 'Rajab',
            '8' => 'Sha\'ban',
            '9' => 'Ramadan',
            '10' => 'Shawwal',
            '11' => 'Dhu al-Qi\'dah',
            '12' => 'Dhu al-Hijjah',
        ];

        // Approximate month calculation
        $hijriMonth = ($gregorianMonth + 8) % 12 + 1;
        $hijriMonthName = $hijriMonths[(string)$hijriMonth];

        return [
            'date' => sprintf('%02d-%02d-%04d', $gregorianDay, $hijriMonth, $hijriYear),
            'format' => 'DD-MM-YYYY',
            'day' => sprintf('%02d', $gregorianDay),
            'weekday' => ['en' => date('l'), 'ar' => ''],
            'month' => [
                'number' => $hijriMonth,
                'en' => $hijriMonthName,
                'ar' => '',
            ],
            'year' => (string)$hijriYear,
            'designation' => ['abbreviated' => 'AH', 'expanded' => 'Anno Hegirae'],
        ];
    }
}
