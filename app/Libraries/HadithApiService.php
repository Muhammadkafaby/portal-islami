<?php

namespace App\Libraries;

use Config\Services;

class HadithApiService
{
    protected $client;
    protected $baseUrl = 'https://api.hadith.gading.dev';

    public function __construct()
    {
        $this->client = Services::curlrequest([
            'baseURI' => $this->baseUrl,
            'timeout' => 10,
        ]);
    }

    /**
     * Get available hadith books
     * @return array
     */
    public function getBooks()
    {
        try {
            $response = $this->client->get('/books', [
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
            log_message('error', 'HadithAPI Error getBooks: ' . $e->getMessage());
            return $this->getFallbackBooks();
        }
    }

    /**
     * Get hadith list from a book
     * @param string $bookId (e.g., 'bukhari', 'muslim', 'abu-dawud')
     * @param int $page
     * @return array
     */
    public function getHadithList($bookId = 'bukhari', $page = 1)
    {
        try {
            $response = $this->client->get("/books/{$bookId}", [
                'query' => [
                    'page' => $page,
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
            log_message('error', 'HadithAPI Error getHadithList: ' . $e->getMessage());
            return $this->getFallbackHadithList($bookId);
        }
    }

    /**
     * Get specific hadith by ID
     * @param string $bookId
     * @param int $number
     * @return array|null
     */
    public function getHadithDetail($bookId, $number)
    {
        try {
            $response = $this->client->get("/books/{$bookId}/{$number}", [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                return $data['data'] ?? null;
            }

            return null;
        } catch (\Exception $e) {
            log_message('error', 'HadithAPI Error getHadithDetail: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get random hadith
     * @return array|null
     */
    public function getRandomHadith()
    {
        $books = ['bukhari', 'muslim', 'tirmidzi', 'abu-dawud'];
        $randomBook = $books[array_rand($books)];

        try {
            $listData = $this->getHadithList($randomBook, 1);

            if (!empty($listData['hadiths'])) {
                $randomHadith = $listData['hadiths'][array_rand($listData['hadiths'])];
                return $randomHadith;
            }

            return null;
        } catch (\Exception $e) {
            log_message('error', 'HadithAPI Error getRandomHadith: ' . $e->getMessage());
            $fallbackList = $this->getFallbackHadithList($randomBook);
            if (!empty($fallbackList['hadiths'])) {
                return $fallbackList['hadiths'][array_rand($fallbackList['hadiths'])];
            }
            return null;
        }
    }

    /**
     * Fallback hadith books if API fails
     * @return array
     */
    private function getFallbackBooks()
    {
        return [
            [
                'id' => 'bukhari',
                'name' => 'Sahih Bukhari',
                'available' => 7563,
            ],
            [
                'id' => 'muslim',
                'name' => 'Sahih Muslim',
                'available' => 7563,
            ],
            [
                'id' => 'tirmidzi',
                'name' => 'Jami` at-Tirmidhi',
                'available' => 3956,
            ],
            [
                'id' => 'abu-dawud',
                'name' => 'Sunan Abu Dawud',
                'available' => 5274,
            ],
        ];
    }

    /**
     * Fallback hadith list if API fails
     * @param string $bookId
     * @return array
     */
    private function getFallbackHadithList($bookId = 'bukhari')
    {
        $hadiths = [
            'bukhari' => [
                [
                    'number' => 1,
                    'arab' => 'إِنَّمَا الأَعْمَالُ بِالنِّيَّاتِ، وَإِنَّمَا لِكُلِّ امْرِئٍ مَا نَوَى',
                    'id' => 'Sesungguhnya setiap amal perbuatan tergantung niatnya. Dan sesungguhnya setiap orang akan mendapatkan apa yang diniatkannya.',
                ],
                [
                    'number' => 6,
                    'arab' => 'الدِّينُ النَّصِيحَةُ',
                    'id' => 'Agama adalah nasihat.',
                ],
                [
                    'number' => 50,
                    'arab' => 'الْمُسْلِمُ مَنْ سَلِمَ الْمُسْلِمُونَ مِنْ لِسَانِهِ وَيَدِهِ',
                    'id' => 'Seorang muslim adalah orang yang muslim lainnya selamat dari gangguan lisan dan tangannya.',
                ],
            ],
            'muslim' => [
                [
                    'number' => 1,
                    'arab' => 'بُنِيَ الإِسْلاَمُ عَلَى خَمْسٍ',
                    'id' => 'Islam dibangun atas lima perkara.',
                ],
                [
                    'number' => 45,
                    'arab' => 'مَنْ كَانَ يُؤْمِنُ بِاللَّهِ وَالْيَوْمِ الآخِرِ فَلْيَقُلْ خَيْرًا أَوْ لِيَصْمُتْ',
                    'id' => 'Barangsiapa beriman kepada Allah dan hari akhir, hendaklah ia berkata baik atau diam.',
                ],
            ],
            'tirmidzi' => [
                [
                    'number' => 1,
                    'arab' => 'مَنْ حُسْنِ إِسْلاَمِ الْمَرْءِ تَرْكُهُ مَا لاَ يَعْنِيهِ',
                    'id' => 'Termasuk kebaikan Islam seseorang adalah meninggalkan apa yang tidak bermanfaat baginya.',
                ],
            ],
            'abu-dawud' => [
                [
                    'number' => 1,
                    'arab' => 'لاَ ضَرَرَ وَلاَ ضِرَارَ',
                    'id' => 'Tidak boleh membahayakan (diri sendiri) dan tidak boleh pula membahayakan orang lain.',
                ],
            ],
        ];

        $bookHadiths = $hadiths[$bookId] ?? $hadiths['bukhari'];

        return [
            'name' => $this->getBookNameById($bookId),
            'id' => $bookId,
            'hadiths' => $bookHadiths,
            'total' => count($bookHadiths),
            'page' => 1,
            'totalPages' => 1,
        ];
    }

    /**
     * Get book name by ID
     * @param string $bookId
     * @return string
     */
    private function getBookNameById($bookId)
    {
        $books = [
            'bukhari' => 'Sahih Bukhari',
            'muslim' => 'Sahih Muslim',
            'tirmidzi' => 'Jami` at-Tirmidhi',
            'abu-dawud' => 'Sunan Abu Dawud',
        ];

        return $books[$bookId] ?? 'Sahih Bukhari';
    }
}
