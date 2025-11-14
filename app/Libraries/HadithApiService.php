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
            return [];
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
            return [];
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
            return null;
        }
    }
}
