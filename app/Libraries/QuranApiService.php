<?php

namespace App\Libraries;

use Config\Services;

/**
 * Quran API Service
 * Using equran.id API - Free & Opensource Indonesian Quran API
 */
class QuranApiService
{
    protected $client;
    protected $baseUrl = 'https://equran.id/api';

    public function __construct()
    {
        $this->client = Services::curlrequest([
            'baseURI' => $this->baseUrl,
            'timeout' => 15,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * Get list of all Surahs (chapters)
     * @return array
     */
    public function getSurahList()
    {
        try {
            $response = $this->client->get('/surat');

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                if (!empty($data) && is_array($data)) {
                    return $data;
                }
            }

            // If status is not 200 or data is invalid, use fallback
            log_message('info', 'QuranAPI: Using fallback data (Status: ' . $response->getStatusCode() . ')');
            return $this->getFallbackSurahList();
        } catch (\Exception $e) {
            log_message('error', 'QuranAPI Error getSurahList: ' . $e->getMessage());
            return $this->getFallbackSurahList();
        }
    }

    /**
     * Get specific Surah with verses
     * @param int $surahNumber (1-114)
     * @return array|null
     */
    public function getSurah($surahNumber)
    {
        try {
            $response = $this->client->get("/surat/{$surahNumber}");

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                if (!empty($data) && is_array($data)) {
                    return $data;
                }
            }

            // If status is not 200 or data is invalid, use fallback
            log_message('info', 'QuranAPI: Using fallback surah detail (Status: ' . $response->getStatusCode() . ')');
            return $this->getFallbackSurahDetail($surahNumber);
        } catch (\Exception $e) {
            log_message('error', 'QuranAPI Error getSurah: ' . $e->getMessage());
            return $this->getFallbackSurahDetail($surahNumber);
        }
    }

    /**
     * Get random verse for quiz
     * @return array|null
     */
    public function getRandomVerse()
    {
        try {
            // Random surah between 1-114
            $randomSurah = rand(1, 114);

            $surahData = $this->getSurah($randomSurah);

            if (!$surahData || empty($surahData['ayat'])) {
                return null;
            }

            // Get random verse from this surah
            $verses = $surahData['ayat'];
            $randomIndex = array_rand($verses);
            $verse = $verses[$randomIndex];

            return [
                'surah' => $surahData,
                'verse' => $verse,
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

    /**
     * Fallback surah list if API fails
     * @return array
     */
    private function getFallbackSurahList()
    {
        // Comprehensive fallback data - All 114 Surahs
        return [
            ['nomor' => 1, 'nama' => 'ٱلْفَاتِحَة', 'nama_latin' => 'Al-Fatihah', 'jumlah_ayat' => 7, 'arti' => 'Pembukaan', 'tempat_turun' => 'Mekah'],
            ['nomor' => 2, 'nama' => 'ٱلْبَقَرَة', 'nama_latin' => 'Al-Baqarah', 'jumlah_ayat' => 286, 'arti' => 'Sapi Betina', 'tempat_turun' => 'Madinah'],
            ['nomor' => 3, 'nama' => 'آلِ عِمْرَان', 'nama_latin' => 'Ali \'Imran', 'jumlah_ayat' => 200, 'arti' => 'Keluarga Imran', 'tempat_turun' => 'Madinah'],
            ['nomor' => 4, 'nama' => 'ٱلنِّسَاء', 'nama_latin' => 'An-Nisa\'', 'jumlah_ayat' => 176, 'arti' => 'Wanita', 'tempat_turun' => 'Madinah'],
            ['nomor' => 5, 'nama' => 'ٱلْمَائِدَة', 'nama_latin' => 'Al-Ma\'idah', 'jumlah_ayat' => 120, 'arti' => 'Hidangan', 'tempat_turun' => 'Madinah'],
            ['nomor' => 6, 'nama' => 'ٱلْأَنْعَام', 'nama_latin' => 'Al-An\'am', 'jumlah_ayat' => 165, 'arti' => 'Hewan Ternak', 'tempat_turun' => 'Mekah'],
            ['nomor' => 7, 'nama' => 'ٱلْأَعْرَاف', 'nama_latin' => 'Al-A\'raf', 'jumlah_ayat' => 206, 'arti' => 'Tempat Tertinggi', 'tempat_turun' => 'Mekah'],
            ['nomor' => 8, 'nama' => 'ٱلْأَنْفَال', 'nama_latin' => 'Al-Anfal', 'jumlah_ayat' => 75, 'arti' => 'Harta Rampasan Perang', 'tempat_turun' => 'Madinah'],
            ['nomor' => 9, 'nama' => 'ٱلتَّوْبَة', 'nama_latin' => 'At-Taubah', 'jumlah_ayat' => 129, 'arti' => 'Pengampunan', 'tempat_turun' => 'Madinah'],
            ['nomor' => 10, 'nama' => 'يُونُس', 'nama_latin' => 'Yunus', 'jumlah_ayat' => 109, 'arti' => 'Nabi Yunus', 'tempat_turun' => 'Mekah'],
            ['nomor' => 11, 'nama' => 'هُود', 'nama_latin' => 'Hud', 'jumlah_ayat' => 123, 'arti' => 'Nabi Hud', 'tempat_turun' => 'Mekah'],
            ['nomor' => 12, 'nama' => 'يُوسُف', 'nama_latin' => 'Yusuf', 'jumlah_ayat' => 111, 'arti' => 'Nabi Yusuf', 'tempat_turun' => 'Mekah'],
            ['nomor' => 13, 'nama' => 'ٱلرَّعْد', 'nama_latin' => 'Ar-Ra\'d', 'jumlah_ayat' => 43, 'arti' => 'Guruh', 'tempat_turun' => 'Madinah'],
            ['nomor' => 14, 'nama' => 'إِبْرَاهِيم', 'nama_latin' => 'Ibrahim', 'jumlah_ayat' => 52, 'arti' => 'Nabi Ibrahim', 'tempat_turun' => 'Mekah'],
            ['nomor' => 15, 'nama' => 'ٱلْحِجْر', 'nama_latin' => 'Al-Hijr', 'jumlah_ayat' => 99, 'arti' => 'Gunung Hijr', 'tempat_turun' => 'Mekah'],
            ['nomor' => 16, 'nama' => 'ٱلنَّحْل', 'nama_latin' => 'An-Nahl', 'jumlah_ayat' => 128, 'arti' => 'Lebah', 'tempat_turun' => 'Mekah'],
            ['nomor' => 17, 'nama' => 'ٱلْإِسْرَاء', 'nama_latin' => 'Al-Isra\'', 'jumlah_ayat' => 111, 'arti' => 'Perjalanan Malam', 'tempat_turun' => 'Mekah'],
            ['nomor' => 18, 'nama' => 'ٱلْكَهْف', 'nama_latin' => 'Al-Kahf', 'jumlah_ayat' => 110, 'arti' => 'Gua', 'tempat_turun' => 'Mekah'],
            ['nomor' => 19, 'nama' => 'مَرْيَم', 'nama_latin' => 'Maryam', 'jumlah_ayat' => 98, 'arti' => 'Maryam', 'tempat_turun' => 'Mekah'],
            ['nomor' => 20, 'nama' => 'طه', 'nama_latin' => 'Taha', 'jumlah_ayat' => 135, 'arti' => 'Taha', 'tempat_turun' => 'Mekah'],
            ['nomor' => 21, 'nama' => 'ٱلْأَنْبِيَاء', 'nama_latin' => 'Al-Anbiya\'', 'jumlah_ayat' => 112, 'arti' => 'Para Nabi', 'tempat_turun' => 'Mekah'],
            ['nomor' => 22, 'nama' => 'ٱلْحَجّ', 'nama_latin' => 'Al-Hajj', 'jumlah_ayat' => 78, 'arti' => 'Haji', 'tempat_turun' => 'Madinah'],
            ['nomor' => 23, 'nama' => 'ٱلْمُؤْمِنُون', 'nama_latin' => 'Al-Mu\'minun', 'jumlah_ayat' => 118, 'arti' => 'Orang-orang Mukmin', 'tempat_turun' => 'Mekah'],
            ['nomor' => 24, 'nama' => 'ٱلنُّور', 'nama_latin' => 'An-Nur', 'jumlah_ayat' => 64, 'arti' => 'Cahaya', 'tempat_turun' => 'Madinah'],
            ['nomor' => 25, 'nama' => 'ٱلْفُرْقَان', 'nama_latin' => 'Al-Furqan', 'jumlah_ayat' => 77, 'arti' => 'Pembeda', 'tempat_turun' => 'Mekah'],
            ['nomor' => 26, 'nama' => 'ٱلشُّعَرَاء', 'nama_latin' => 'Ash-Shu\'ara\'', 'jumlah_ayat' => 227, 'arti' => 'Para Penyair', 'tempat_turun' => 'Mekah'],
            ['nomor' => 27, 'nama' => 'ٱلنَّمْل', 'nama_latin' => 'An-Naml', 'jumlah_ayat' => 93, 'arti' => 'Semut', 'tempat_turun' => 'Mekah'],
            ['nomor' => 28, 'nama' => 'ٱلْقَصَص', 'nama_latin' => 'Al-Qasas', 'jumlah_ayat' => 88, 'arti' => 'Kisah-kisah', 'tempat_turun' => 'Mekah'],
            ['nomor' => 29, 'nama' => 'ٱلْعَنْكَبُوت', 'nama_latin' => 'Al-\'Ankabut', 'jumlah_ayat' => 69, 'arti' => 'Laba-laba', 'tempat_turun' => 'Mekah'],
            ['nomor' => 30, 'nama' => 'ٱلرُّوم', 'nama_latin' => 'Ar-Rum', 'jumlah_ayat' => 60, 'arti' => 'Bangsa Romawi', 'tempat_turun' => 'Mekah'],
            ['nomor' => 31, 'nama' => 'لُقْمَان', 'nama_latin' => 'Luqman', 'jumlah_ayat' => 34, 'arti' => 'Luqman', 'tempat_turun' => 'Mekah'],
            ['nomor' => 32, 'nama' => 'ٱلسَّجْدَة', 'nama_latin' => 'As-Sajdah', 'jumlah_ayat' => 30, 'arti' => 'Sajdah', 'tempat_turun' => 'Mekah'],
            ['nomor' => 33, 'nama' => 'ٱلْأَحْزَاب', 'nama_latin' => 'Al-Ahzab', 'jumlah_ayat' => 73, 'arti' => 'Golongan-golongan', 'tempat_turun' => 'Madinah'],
            ['nomor' => 34, 'nama' => 'سَبَأ', 'nama_latin' => 'Saba\'', 'jumlah_ayat' => 54, 'arti' => 'Kaum Saba\'', 'tempat_turun' => 'Mekah'],
            ['nomor' => 35, 'nama' => 'فَاطِر', 'nama_latin' => 'Fatir', 'jumlah_ayat' => 45, 'arti' => 'Pencipta', 'tempat_turun' => 'Mekah'],
            ['nomor' => 36, 'nama' => 'يس', 'nama_latin' => 'Yasin', 'jumlah_ayat' => 83, 'arti' => 'Yasin', 'tempat_turun' => 'Mekah'],
            ['nomor' => 37, 'nama' => 'ٱلصَّافَّات', 'nama_latin' => 'As-Saffat', 'jumlah_ayat' => 182, 'arti' => 'Barisan-barisan', 'tempat_turun' => 'Mekah'],
            ['nomor' => 38, 'nama' => 'ص', 'nama_latin' => 'Sad', 'jumlah_ayat' => 88, 'arti' => 'Sad', 'tempat_turun' => 'Mekah'],
            ['nomor' => 39, 'nama' => 'ٱلزُّمَر', 'nama_latin' => 'Az-Zumar', 'jumlah_ayat' => 75, 'arti' => 'Rombongan', 'tempat_turun' => 'Mekah'],
            ['nomor' => 40, 'nama' => 'غَافِر', 'nama_latin' => 'Ghafir', 'jumlah_ayat' => 85, 'arti' => 'Yang Mengampuni', 'tempat_turun' => 'Mekah'],
            ['nomor' => 41, 'nama' => 'فُصِّلَت', 'nama_latin' => 'Fussilat', 'jumlah_ayat' => 54, 'arti' => 'Yang Dijelaskan', 'tempat_turun' => 'Mekah'],
            ['nomor' => 42, 'nama' => 'ٱلشُّورىٰ', 'nama_latin' => 'Ash-Shura', 'jumlah_ayat' => 53, 'arti' => 'Musyawarah', 'tempat_turun' => 'Mekah'],
            ['nomor' => 43, 'nama' => 'ٱلزُّخْرُف', 'nama_latin' => 'Az-Zukhruf', 'jumlah_ayat' => 89, 'arti' => 'Perhiasan', 'tempat_turun' => 'Mekah'],
            ['nomor' => 44, 'nama' => 'ٱلدُّخَان', 'nama_latin' => 'Ad-Dukhan', 'jumlah_ayat' => 59, 'arti' => 'Kabut', 'tempat_turun' => 'Mekah'],
            ['nomor' => 45, 'nama' => 'ٱلْجَاثِيَة', 'nama_latin' => 'Al-Jathiyah', 'jumlah_ayat' => 37, 'arti' => 'Berlutut', 'tempat_turun' => 'Mekah'],
            ['nomor' => 46, 'nama' => 'ٱلْأَحْقَاف', 'nama_latin' => 'Al-Ahqaf', 'jumlah_ayat' => 35, 'arti' => 'Bukit Pasir', 'tempat_turun' => 'Mekah'],
            ['nomor' => 47, 'nama' => 'مُحَمَّد', 'nama_latin' => 'Muhammad', 'jumlah_ayat' => 38, 'arti' => 'Nabi Muhammad', 'tempat_turun' => 'Madinah'],
            ['nomor' => 48, 'nama' => 'ٱلْفَتْح', 'nama_latin' => 'Al-Fath', 'jumlah_ayat' => 29, 'arti' => 'Kemenangan', 'tempat_turun' => 'Madinah'],
            ['nomor' => 49, 'nama' => 'ٱلْحُجُرَات', 'nama_latin' => 'Al-Hujurat', 'jumlah_ayat' => 18, 'arti' => 'Kamar-kamar', 'tempat_turun' => 'Madinah'],
            ['nomor' => 50, 'nama' => 'ق', 'nama_latin' => 'Qaf', 'jumlah_ayat' => 45, 'arti' => 'Qaf', 'tempat_turun' => 'Mekah'],
            ['nomor' => 51, 'nama' => 'ٱلذَّارِيَات', 'nama_latin' => 'Adh-Dhariyat', 'jumlah_ayat' => 60, 'arti' => 'Angin yang Menerbangkan', 'tempat_turun' => 'Mekah'],
            ['nomor' => 52, 'nama' => 'ٱلطُّور', 'nama_latin' => 'At-Tur', 'jumlah_ayat' => 49, 'arti' => 'Bukit Tursina', 'tempat_turun' => 'Mekah'],
            ['nomor' => 53, 'nama' => 'ٱلنَّجْم', 'nama_latin' => 'An-Najm', 'jumlah_ayat' => 62, 'arti' => 'Bintang', 'tempat_turun' => 'Mekah'],
            ['nomor' => 54, 'nama' => 'ٱلْقَمَر', 'nama_latin' => 'Al-Qamar', 'jumlah_ayat' => 55, 'arti' => 'Bulan', 'tempat_turun' => 'Mekah'],
            ['nomor' => 55, 'nama' => 'ٱلرَّحْمَٰن', 'nama_latin' => 'Ar-Rahman', 'jumlah_ayat' => 78, 'arti' => 'Yang Maha Pengasih', 'tempat_turun' => 'Madinah'],
            ['nomor' => 56, 'nama' => 'ٱلْوَاقِعَة', 'nama_latin' => 'Al-Waqi\'ah', 'jumlah_ayat' => 96, 'arti' => 'Hari Kiamat', 'tempat_turun' => 'Mekah'],
            ['nomor' => 57, 'nama' => 'ٱلْحَدِيد', 'nama_latin' => 'Al-Hadid', 'jumlah_ayat' => 29, 'arti' => 'Besi', 'tempat_turun' => 'Madinah'],
            ['nomor' => 58, 'nama' => 'ٱلْمُجَادِلَة', 'nama_latin' => 'Al-Mujadilah', 'jumlah_ayat' => 22, 'arti' => 'Wanita yang Berdebat', 'tempat_turun' => 'Madinah'],
            ['nomor' => 59, 'nama' => 'ٱلْحَشْر', 'nama_latin' => 'Al-Hashr', 'jumlah_ayat' => 24, 'arti' => 'Pengusiran', 'tempat_turun' => 'Madinah'],
            ['nomor' => 60, 'nama' => 'ٱلْمُمْتَحَنَة', 'nama_latin' => 'Al-Mumtahanah', 'jumlah_ayat' => 13, 'arti' => 'Wanita yang Diuji', 'tempat_turun' => 'Madinah'],
            ['nomor' => 61, 'nama' => 'ٱلصَّفّ', 'nama_latin' => 'As-Saff', 'jumlah_ayat' => 14, 'arti' => 'Barisan', 'tempat_turun' => 'Madinah'],
            ['nomor' => 62, 'nama' => 'ٱلْجُمُعَة', 'nama_latin' => 'Al-Jumu\'ah', 'jumlah_ayat' => 11, 'arti' => 'Jumat', 'tempat_turun' => 'Madinah'],
            ['nomor' => 63, 'nama' => 'ٱلْمُنَافِقُون', 'nama_latin' => 'Al-Munafiqun', 'jumlah_ayat' => 11, 'arti' => 'Orang-orang Munafik', 'tempat_turun' => 'Madinah'],
            ['nomor' => 64, 'nama' => 'ٱلتَّغَابُن', 'nama_latin' => 'At-Taghabun', 'jumlah_ayat' => 18, 'arti' => 'Hari Dinampakkan Kesalahan', 'tempat_turun' => 'Madinah'],
            ['nomor' => 65, 'nama' => 'ٱلطَّلَاق', 'nama_latin' => 'At-Talaq', 'jumlah_ayat' => 12, 'arti' => 'Talak', 'tempat_turun' => 'Madinah'],
            ['nomor' => 66, 'nama' => 'ٱلتَّحْرِيم', 'nama_latin' => 'At-Tahrim', 'jumlah_ayat' => 12, 'arti' => 'Mengharamkan', 'tempat_turun' => 'Madinah'],
            ['nomor' => 67, 'nama' => 'ٱلْمُلْك', 'nama_latin' => 'Al-Mulk', 'jumlah_ayat' => 30, 'arti' => 'Kerajaan', 'tempat_turun' => 'Mekah'],
            ['nomor' => 68, 'nama' => 'ٱلْقَلَم', 'nama_latin' => 'Al-Qalam', 'jumlah_ayat' => 52, 'arti' => 'Pena', 'tempat_turun' => 'Mekah'],
            ['nomor' => 69, 'nama' => 'ٱلْحَاقَّة', 'nama_latin' => 'Al-Haqqah', 'jumlah_ayat' => 52, 'arti' => 'Hari Kiamat', 'tempat_turun' => 'Mekah'],
            ['nomor' => 70, 'nama' => 'ٱلْمَعَارِج', 'nama_latin' => 'Al-Ma\'arij', 'jumlah_ayat' => 44, 'arti' => 'Tempat Naik', 'tempat_turun' => 'Mekah'],
            ['nomor' => 71, 'nama' => 'نُوح', 'nama_latin' => 'Nuh', 'jumlah_ayat' => 28, 'arti' => 'Nabi Nuh', 'tempat_turun' => 'Mekah'],
            ['nomor' => 72, 'nama' => 'ٱلْجِنّ', 'nama_latin' => 'Al-Jinn', 'jumlah_ayat' => 28, 'arti' => 'Jin', 'tempat_turun' => 'Mekah'],
            ['nomor' => 73, 'nama' => 'ٱلْمُزَّمِّل', 'nama_latin' => 'Al-Muzzammil', 'jumlah_ayat' => 20, 'arti' => 'Orang yang Berselimut', 'tempat_turun' => 'Mekah'],
            ['nomor' => 74, 'nama' => 'ٱلْمُدَّثِّر', 'nama_latin' => 'Al-Muddaththir', 'jumlah_ayat' => 56, 'arti' => 'Orang yang Berkemul', 'tempat_turun' => 'Mekah'],
            ['nomor' => 75, 'nama' => 'ٱلْقِيَامَة', 'nama_latin' => 'Al-Qiyamah', 'jumlah_ayat' => 40, 'arti' => 'Hari Kiamat', 'tempat_turun' => 'Mekah'],
            ['nomor' => 76, 'nama' => 'ٱلْإِنْسَان', 'nama_latin' => 'Al-Insan', 'jumlah_ayat' => 31, 'arti' => 'Manusia', 'tempat_turun' => 'Madinah'],
            ['nomor' => 77, 'nama' => 'ٱلْمُرْسَلَات', 'nama_latin' => 'Al-Mursalat', 'jumlah_ayat' => 50, 'arti' => 'Malaikat yang Diutus', 'tempat_turun' => 'Mekah'],
            ['nomor' => 78, 'nama' => 'ٱلنَّبَأ', 'nama_latin' => 'An-Naba\'', 'jumlah_ayat' => 40, 'arti' => 'Berita Besar', 'tempat_turun' => 'Mekah'],
            ['nomor' => 79, 'nama' => 'ٱلنَّازِعَات', 'nama_latin' => 'An-Nazi\'at', 'jumlah_ayat' => 46, 'arti' => 'Malaikat yang Mencabut', 'tempat_turun' => 'Mekah'],
            ['nomor' => 80, 'nama' => 'عَبَسَ', 'nama_latin' => 'Abasa', 'jumlah_ayat' => 42, 'arti' => 'Ia Bermuka Masam', 'tempat_turun' => 'Mekah'],
            ['nomor' => 81, 'nama' => 'ٱلتَّكْوِير', 'nama_latin' => 'At-Takwir', 'jumlah_ayat' => 29, 'arti' => 'Menggulung', 'tempat_turun' => 'Mekah'],
            ['nomor' => 82, 'nama' => 'ٱلْإِنْفِطَار', 'nama_latin' => 'Al-Infitar', 'jumlah_ayat' => 19, 'arti' => 'Terbelah', 'tempat_turun' => 'Mekah'],
            ['nomor' => 83, 'nama' => 'ٱلْمُطَفِّفِين', 'nama_latin' => 'Al-Mutaffifin', 'jumlah_ayat' => 36, 'arti' => 'Orang yang Curang', 'tempat_turun' => 'Mekah'],
            ['nomor' => 84, 'nama' => 'ٱلْإِنْشِقَاق', 'nama_latin' => 'Al-Inshiqaq', 'jumlah_ayat' => 25, 'arti' => 'Terbelah', 'tempat_turun' => 'Mekah'],
            ['nomor' => 85, 'nama' => 'ٱلْبُرُوج', 'nama_latin' => 'Al-Buruj', 'jumlah_ayat' => 22, 'arti' => 'Gugusan Bintang', 'tempat_turun' => 'Mekah'],
            ['nomor' => 86, 'nama' => 'ٱلطَّارِق', 'nama_latin' => 'At-Tariq', 'jumlah_ayat' => 17, 'arti' => 'Yang Datang di Malam Hari', 'tempat_turun' => 'Mekah'],
            ['nomor' => 87, 'nama' => 'ٱلْأَعْلَىٰ', 'nama_latin' => 'Al-A\'la', 'jumlah_ayat' => 19, 'arti' => 'Yang Paling Tinggi', 'tempat_turun' => 'Mekah'],
            ['nomor' => 88, 'nama' => 'ٱلْغَاشِيَة', 'nama_latin' => 'Al-Ghashiyah', 'jumlah_ayat' => 26, 'arti' => 'Hari Pembalasan', 'tempat_turun' => 'Mekah'],
            ['nomor' => 89, 'nama' => 'ٱلْفَجْر', 'nama_latin' => 'Al-Fajr', 'jumlah_ayat' => 30, 'arti' => 'Fajar', 'tempat_turun' => 'Mekah'],
            ['nomor' => 90, 'nama' => 'ٱلْبَلَد', 'nama_latin' => 'Al-Balad', 'jumlah_ayat' => 20, 'arti' => 'Negeri', 'tempat_turun' => 'Mekah'],
            ['nomor' => 91, 'nama' => 'ٱلشَّمْس', 'nama_latin' => 'Ash-Shams', 'jumlah_ayat' => 15, 'arti' => 'Matahari', 'tempat_turun' => 'Mekah'],
            ['nomor' => 92, 'nama' => 'ٱللَّيْل', 'nama_latin' => 'Al-Lail', 'jumlah_ayat' => 21, 'arti' => 'Malam', 'tempat_turun' => 'Mekah'],
            ['nomor' => 93, 'nama' => 'ٱلضُّحَىٰ', 'nama_latin' => 'Ad-Duha', 'jumlah_ayat' => 11, 'arti' => 'Waktu Duha', 'tempat_turun' => 'Mekah'],
            ['nomor' => 94, 'nama' => 'ٱلشَّرْح', 'nama_latin' => 'Ash-Sharh', 'jumlah_ayat' => 8, 'arti' => 'Kelapangan', 'tempat_turun' => 'Mekah'],
            ['nomor' => 95, 'nama' => 'ٱلتِّين', 'nama_latin' => 'At-Tin', 'jumlah_ayat' => 8, 'arti' => 'Buah Tin', 'tempat_turun' => 'Mekah'],
            ['nomor' => 96, 'nama' => 'ٱلْعَلَق', 'nama_latin' => 'Al-Alaq', 'jumlah_ayat' => 19, 'arti' => 'Segumpal Darah', 'tempat_turun' => 'Mekah'],
            ['nomor' => 97, 'nama' => 'ٱلْقَدْر', 'nama_latin' => 'Al-Qadr', 'jumlah_ayat' => 5, 'arti' => 'Kemuliaan', 'tempat_turun' => 'Mekah'],
            ['nomor' => 98, 'nama' => 'ٱلْبَيِّنَة', 'nama_latin' => 'Al-Bayyinah', 'jumlah_ayat' => 8, 'arti' => 'Bukti yang Nyata', 'tempat_turun' => 'Madinah'],
            ['nomor' => 99, 'nama' => 'ٱلزَّلْزَلَة', 'nama_latin' => 'Az-Zalzalah', 'jumlah_ayat' => 8, 'arti' => 'Kegoncangan', 'tempat_turun' => 'Madinah'],
            ['nomor' => 100, 'nama' => 'ٱلْعَادِيَات', 'nama_latin' => 'Al-Adiyat', 'jumlah_ayat' => 11, 'arti' => 'Kuda Perang', 'tempat_turun' => 'Mekah'],
            ['nomor' => 101, 'nama' => 'ٱلْقَارِعَة', 'nama_latin' => 'Al-Qari\'ah', 'jumlah_ayat' => 11, 'arti' => 'Hari Kiamat', 'tempat_turun' => 'Mekah'],
            ['nomor' => 102, 'nama' => 'ٱلتَّكَاثُر', 'nama_latin' => 'At-Takathur', 'jumlah_ayat' => 8, 'arti' => 'Bermegah-megahan', 'tempat_turun' => 'Mekah'],
            ['nomor' => 103, 'nama' => 'ٱلْعَصْر', 'nama_latin' => 'Al-Asr', 'jumlah_ayat' => 3, 'arti' => 'Waktu', 'tempat_turun' => 'Mekah'],
            ['nomor' => 104, 'nama' => 'ٱلْهُمَزَة', 'nama_latin' => 'Al-Humazah', 'jumlah_ayat' => 9, 'arti' => 'Pengumpat', 'tempat_turun' => 'Mekah'],
            ['nomor' => 105, 'nama' => 'ٱلْفِيل', 'nama_latin' => 'Al-Fil', 'jumlah_ayat' => 5, 'arti' => 'Gajah', 'tempat_turun' => 'Mekah'],
            ['nomor' => 106, 'nama' => 'قُرَيْش', 'nama_latin' => 'Quraish', 'jumlah_ayat' => 4, 'arti' => 'Suku Quraisy', 'tempat_turun' => 'Mekah'],
            ['nomor' => 107, 'nama' => 'ٱلْمَاعُون', 'nama_latin' => 'Al-Ma\'un', 'jumlah_ayat' => 7, 'arti' => 'Barang-barang yang Berguna', 'tempat_turun' => 'Mekah'],
            ['nomor' => 108, 'nama' => 'ٱلْكَوْثَر', 'nama_latin' => 'Al-Kautsar', 'jumlah_ayat' => 3, 'arti' => 'Nikmat yang Berlimpah', 'tempat_turun' => 'Mekah'],
            ['nomor' => 109, 'nama' => 'ٱلْكَافِرُون', 'nama_latin' => 'Al-Kafirun', 'jumlah_ayat' => 6, 'arti' => 'Orang-orang Kafir', 'tempat_turun' => 'Mekah'],
            ['nomor' => 110, 'nama' => 'ٱلنَّصْر', 'nama_latin' => 'An-Nasr', 'jumlah_ayat' => 3, 'arti' => 'Pertolongan', 'tempat_turun' => 'Madinah'],
            ['nomor' => 111, 'nama' => 'ٱلْمَسَد', 'nama_latin' => 'Al-Masad', 'jumlah_ayat' => 5, 'arti' => 'Api yang Bergejolak', 'tempat_turun' => 'Mekah'],
            ['nomor' => 112, 'nama' => 'ٱلْإِخْلَاص', 'nama_latin' => 'Al-Ikhlas', 'jumlah_ayat' => 4, 'arti' => 'Ikhlas', 'tempat_turun' => 'Mekah'],
            ['nomor' => 113, 'nama' => 'ٱلْفَلَق', 'nama_latin' => 'Al-Falaq', 'jumlah_ayat' => 5, 'arti' => 'Waktu Subuh', 'tempat_turun' => 'Mekah'],
            ['nomor' => 114, 'nama' => 'ٱلنَّاس', 'nama_latin' => 'An-Nas', 'jumlah_ayat' => 6, 'arti' => 'Manusia', 'tempat_turun' => 'Mekah'],
        ];
    }

    /**
     * Fallback surah detail if API fails
     * @param int $surahNumber
     * @return array|null
     */
    private function getFallbackSurahDetail($surahNumber)
    {
        $surahs = $this->getFallbackSurahList();
        $surah = null;

        foreach ($surahs as $s) {
            if ($s['nomor'] == $surahNumber) {
                $surah = $s;
                break;
            }
        }

        if (!$surah) {
            return null;
        }

        // Add sample verses - For Al-Fatihah (Surah 1) as example
        if ($surahNumber == 1) {
            $surah['ayat'] = [
                [
                    'nomor' => 1,
                    'ar' => 'بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ',
                    'tr' => 'Bismillāhir-raḥmānir-raḥīm',
                    'idn' => 'Dengan nama Allah Yang Maha Pengasih, Maha Penyayang.',
                ],
                [
                    'nomor' => 2,
                    'ar' => 'الْحَمْدُ لِلَّهِ رَبِّ الْعَالَمِينَ',
                    'tr' => 'Al-ḥamdu lillāhi rabbil-\'ālamīn',
                    'idn' => 'Segala puji bagi Allah, Tuhan seluruh alam,',
                ],
                [
                    'nomor' => 3,
                    'ar' => 'الرَّحْمَٰنِ الرَّحِيمِ',
                    'tr' => 'Ar-raḥmānir-raḥīm',
                    'idn' => 'Yang Maha Pengasih, Maha Penyayang,',
                ],
                [
                    'nomor' => 4,
                    'ar' => 'مَالِكِ يَوْمِ الدِّينِ',
                    'tr' => 'Māliki yawmid-dīn',
                    'idn' => 'Pemilik hari pembalasan.',
                ],
                [
                    'nomor' => 5,
                    'ar' => 'إِيَّاكَ نَعْبُدُ وَإِيَّاكَ نَسْتَعِينُ',
                    'tr' => 'Iyyāka na\'budu wa iyyāka nasta\'īn',
                    'idn' => 'Hanya kepada-Mu kami menyembah dan hanya kepada-Mu kami mohon pertolongan.',
                ],
                [
                    'nomor' => 6,
                    'ar' => 'اهْدِنَا الصِّرَاطَ الْمُسْتَقِيمَ',
                    'tr' => 'Ihdinaṣ-ṣirāṭal-mustaqīm',
                    'idn' => 'Tunjukilah kami jalan yang lurus,',
                ],
                [
                    'nomor' => 7,
                    'ar' => 'صِرَاطَ الَّذِينَ أَنْعَمْتَ عَلَيْهِمْ غَيْرِ الْمَغْضُوبِ عَلَيْهِمْ وَلَا الضَّالِّينَ',
                    'tr' => 'Ṣirāṭallażīna an\'amta \'alaihim gairil-magḍūbi \'alaihim wa laḍ-ḍāllīn',
                    'idn' => '(yaitu) jalan orang-orang yang telah Engkau beri nikmat; bukan (jalan) mereka yang dimurkai, dan bukan (pula jalan) mereka yang sesat.',
                ],
            ];
        } else {
            // For other surahs, provide sample structure
            $surah['ayat'] = [
                [
                    'nomor' => 1,
                    'ar' => 'بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ',
                    'tr' => 'Bismillāhir-raḥmānir-raḥīm',
                    'idn' => 'Dengan nama Allah Yang Maha Pengasih, Maha Penyayang.',
                ],
            ];
        }

        return $surah;
    }
}
