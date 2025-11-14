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
            return [];
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
            return [];
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
}
