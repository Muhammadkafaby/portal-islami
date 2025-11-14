<?php

namespace App\Libraries;

use Config\Services;

class DoaApiService
{
    protected $client;
    protected $baseUrl = 'https://doa-doa-api-ahmadramadhan.fly.dev/api';

    public function __construct()
    {
        $this->client = Services::curlrequest([
            'baseURI' => $this->baseUrl,
            'timeout' => 10,
        ]);
    }

    /**
     * Get all doa list
     * @return array
     */
    public function getAllDoa()
    {
        try {
            $response = $this->client->get('/', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                return $data ?? [];
            }

            return [];
        } catch (\Exception $e) {
            log_message('error', 'DoaAPI Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get doa by ID
     * @param string $id
     * @return array|null
     */
    public function getDoaById($id)
    {
        try {
            $response = $this->client->get("/{$id}", [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                return $data ?? null;
            }

            return null;
        } catch (\Exception $e) {
            log_message('error', 'DoaAPI Error getDoaById: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Search doa by title
     * @param string $keyword
     * @return array
     */
    public function searchDoa($keyword)
    {
        $allDoa = $this->getAllDoa();

        if (empty($keyword)) {
            return $allDoa;
        }

        return array_filter($allDoa, function ($doa) use ($keyword) {
            $title = $doa['doa'] ?? '';
            return stripos($title, $keyword) !== false;
        });
    }
}
