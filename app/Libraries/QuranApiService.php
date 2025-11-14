<?php

namespace App\Libraries;

use Config\Services;

class QuranApiService
{
    protected $client;
    protected $baseUrl = 'https://api.quran.com/api/v4';

    public function __construct()
    {
        $this->client = Services::curlrequest([
            'baseURI' => $this->baseUrl,
            'timeout' => 10,
        ]);
    }

    /**
     * Get list of all Surahs (chapters)
     * @return array
     */
    public function getSurahList()
    {
        try {
            $response = $this->client->get('/chapters', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                return $data['chapters'] ?? [];
            }

            return [];
        } catch (\Exception $e) {
            log_message('error', 'QuranAPI Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get specific Surah with verses
     * @param int $surahNumber
     * @return array
     */
    public function getSurah($surahNumber, $language = 'id')
    {
        try {
            // Get surah info
            $surahResponse = $this->client->get("/chapters/{$surahNumber}", [
                'headers' => ['Accept' => 'application/json'],
            ]);

            $surahData = json_decode($surahResponse->getBody(), true);
            $surah = $surahData['chapter'] ?? null;

            if (!$surah) {
                return null;
            }

            // Get verses with Indonesian translation (ID: 134 for Indonesian translation)
            $versesResponse = $this->client->get("/verses/by_chapter/{$surahNumber}", [
                'query' => [
                    'language' => 'id',
                    'words' => 'true',
                    'translations' => '134', // Indonesian translation
                    'per_page' => 300,
                ],
                'headers' => ['Accept' => 'application/json'],
            ]);

            $versesData = json_decode($versesResponse->getBody(), true);
            $verses = $versesData['verses'] ?? [];

            return [
                'surah' => $surah,
                'verses' => $verses,
            ];
        } catch (\Exception $e) {
            log_message('error', 'QuranAPI Error getSurah: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get random verse for quiz
     * @return array
     */
    public function getRandomVerse()
    {
        try {
            // Random surah between 1-114
            $randomSurah = rand(1, 114);

            // Get surah info to know verse count
            $surahResponse = $this->client->get("/chapters/{$randomSurah}", [
                'headers' => ['Accept' => 'application/json'],
            ]);

            $surahData = json_decode($surahResponse->getBody(), true);
            $versesCount = $surahData['chapter']['verses_count'] ?? 1;

            // Random verse
            $randomVerse = rand(1, $versesCount);

            // Get the specific verse
            $verseResponse = $this->client->get("/verses/by_key/{$randomSurah}:{$randomVerse}", [
                'query' => [
                    'language' => 'id',
                    'translations' => '134',
                ],
                'headers' => ['Accept' => 'application/json'],
            ]);

            $verseData = json_decode($verseResponse->getBody(), true);

            return [
                'verse' => $verseData['verse'] ?? null,
                'surah' => $surahData['chapter'] ?? null,
            ];
        } catch (\Exception $e) {
            log_message('error', 'QuranAPI Error getRandomVerse: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get verses for quiz generation
     * @param int $count
     * @return array
     */
    public function getVersesForQuiz($count = 5)
    {
        $verses = [];

        for ($i = 0; $i < $count; $i++) {
            $verseData = $this->getRandomVerse();
            if ($verseData) {
                $verses[] = $verseData;
            }
        }

        return $verses;
    }
}
