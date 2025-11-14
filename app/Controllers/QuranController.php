<?php

namespace App\Controllers;

use App\Libraries\QuranApiService;

class QuranController extends BaseController
{
    protected $quranApi;

    public function __construct()
    {
        $this->quranApi = new QuranApiService();
    }

    /**
     * List all surahs
     */
    public function index()
    {
        $surahs = $this->quranApi->getSurahList();

        $data = [
            'title' => 'Al-Quran - Portal Islami',
            'page_title' => 'Al-Quran Digital',
            'surahs' => $surahs,
        ];

        return view('quran/index', $data);
    }

    /**
     * Show specific surah with verses
     */
    public function surah($number)
    {
        $surahData = $this->quranApi->getSurah($number);

        if (!$surahData) {
            return redirect()->to('/quran')->with('error', 'Surah tidak ditemukan');
        }

        $data = [
            'title' => $surahData['surah']['name_simple'] . ' - Al-Quran',
            'page_title' => $surahData['surah']['name_simple'],
            'surah' => $surahData['surah'],
            'verses' => $surahData['verses'],
        ];

        return view('quran/surah', $data);
    }
}
