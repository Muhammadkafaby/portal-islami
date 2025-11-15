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
                if (!empty($data) && is_array($data)) {
                    return $data;
                }
            }

            // If status is not 200 or data is invalid, use fallback
            log_message('info', 'DoaAPI: Using fallback data');
            return $this->getFallbackDoaList();
        } catch (\Exception $e) {
            log_message('error', 'DoaAPI Error: ' . $e->getMessage());
            return $this->getFallbackDoaList();
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
                if (!empty($data)) {
                    return $data;
                }
            }

            // Use fallback
            log_message('info', 'DoaAPI: Using fallback for doa ID ' . $id);
            $allDoa = $this->getFallbackDoaList();
            foreach ($allDoa as $doa) {
                if ($doa['id'] == $id) {
                    return $doa;
                }
            }
            return null;
        } catch (\Exception $e) {
            log_message('error', 'DoaAPI Error getDoaById: ' . $e->getMessage());
            $allDoa = $this->getFallbackDoaList();
            foreach ($allDoa as $doa) {
                if ($doa['id'] == $id) {
                    return $doa;
                }
            }
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

    /**
     * Fallback doa list if API fails
     * @return array
     */
    private function getFallbackDoaList()
    {
        return [
            [
                'id' => '1',
                'doa' => 'Doa Sebelum Tidur',
                'ayat' => 'بِاسْمِكَ اللّٰهُمَّ اَمُوْتُ وَاَحْيَا',
                'latin' => 'Bismika Allahumma amuutu wa ahyaa',
                'artinya' => 'Dengan nama-Mu ya Allah, aku mati dan aku hidup.',
            ],
            [
                'id' => '2',
                'doa' => 'Doa Bangun Tidur',
                'ayat' => 'اَلْحَمْدُ ِللهِ الَّذِىْ أَحْيَانَا بَعْدَ مَا أَمَاتَنَا وَإِلَيْهِ النُّشُوْرُ',
                'latin' => 'Alhamdu lillahil-ladzi ahyana ba\'da maa amaatanaa wa ilaihin-nusyuuru',
                'artinya' => 'Segala puji bagi Allah yang telah menghidupkan kami sesudah kami mati (membangunkan dari tidur) dan hanya kepada-Nya kami dikembalikan.',
            ],
            [
                'id' => '3',
                'doa' => 'Doa Masuk Kamar Mandi',
                'ayat' => 'اَللّٰهُمَّ إِنِّيْ أَعُوْذُ بِكَ مِنَ الْخُبُثِ وَالْخَبَائِثِ',
                'latin' => 'Allahumma inni a\'uudzu bika minal khubutsi wal khabaaitsi',
                'artinya' => 'Ya Allah, sesungguhnya aku berlindung kepada-Mu dari godaan setan laki-laki dan setan perempuan.',
            ],
            [
                'id' => '4',
                'doa' => 'Doa Keluar Kamar Mandi',
                'ayat' => 'غُفْرَانَكَ، اَلْحَمْدُ ِللهِ الَّذِيْ أَذْهَبَ عَنِّي اْلأَذَى وَعَافَانِيْ',
                'latin' => 'Ghufraanaka, alhamdulillahil-ladzi adzhaba \'annil adzaa wa \'aafaanii',
                'artinya' => 'Ampunilah aku ya Allah. Segala puji bagi Allah yang telah menghilangkan kotoran dariku dan menyehatkan badanku.',
            ],
            [
                'id' => '5',
                'doa' => 'Doa Sebelum Makan',
                'ayat' => 'اَللّٰهُمَّ بَارِكْ لَنَا فِيْمَا رَزَقْتَنَا وَقِنَا عَذَابَ النَّارِ',
                'latin' => 'Allahumma baarik lanaa fiimaa rozaqtanaa wa qinaa \'adzaa bannaar',
                'artinya' => 'Ya Allah, berkahilah kami dalam rezeki yang telah Engkau berikan kepada kami dan peliharalah kami dari siksa api neraka.',
            ],
            [
                'id' => '6',
                'doa' => 'Doa Sesudah Makan',
                'ayat' => 'اَلْحَمْدُ ِللهِ الَّذِيْ أَطْعَمَنَا وَسَقَانَا وَجَعَلَنَا مُسْلِمِيْنَ',
                'latin' => 'Alhamdulillahil-ladzi ath\'amanaa wa saqoonaa wa ja\'alanaa muslimiin',
                'artinya' => 'Segala puji bagi Allah yang telah memberi kami makan dan minum serta menjadikan kami orang-orang yang muslim.',
            ],
            [
                'id' => '7',
                'doa' => 'Doa Sebelum Belajar',
                'ayat' => 'رَبِّ زِدْنِيْ عِلْمًا وَارْزُقْنِيْ فَهْمًا',
                'latin' => 'Rabbi zidnii \'ilman warzuqnii fahmaa',
                'artinya' => 'Ya Allah, tambahkanlah kepadaku ilmu dan berikanlah aku pengertian yang baik.',
            ],
            [
                'id' => '8',
                'doa' => 'Doa Sesudah Belajar',
                'ayat' => 'اَللّٰهُمَّ إِنِّيْ أَسْتَوْدِعُكَ مَا قَرَأْتُ وَمَا حَفِظْتُ فَرُدَّهُ إِلَيَّ عِنْدَ حَاجَتِيْ إِلَيْهِ',
                'latin' => 'Allahumma inni astaudi\'uka maa qoro\'tu wa maa hafiztu farudduhu ilayya \'inda haajatii ilayhi',
                'artinya' => 'Ya Allah, sesungguhnya aku menitipkan kepada-Mu apa yang telah aku baca dan apa yang aku hafalkan. Kembalikanlah kepadaku ketika aku membutuhkannya.',
            ],
            [
                'id' => '9',
                'doa' => 'Doa Masuk Masjid',
                'ayat' => 'اَللّٰهُمَّ افْتَحْ لِيْ أَبْوَابَ رَحْمَتِكَ',
                'latin' => 'Allahummaftah lii abwaaba rohmatika',
                'artinya' => 'Ya Allah, bukakanlah untukku pintu-pintu rahmat-Mu.',
            ],
            [
                'id' => '10',
                'doa' => 'Doa Keluar Masjid',
                'ayat' => 'اَللّٰهُمَّ إِنِّيْ أَسْأَلُكَ مِنْ فَضْلِكَ',
                'latin' => 'Allahumma innii as-aluka min fadhlika',
                'artinya' => 'Ya Allah, sesungguhnya aku memohon kepada-Mu dari karunia-Mu.',
            ],
            [
                'id' => '11',
                'doa' => 'Doa Naik Kendaraan',
                'ayat' => 'سُبْحَانَ الَّذِيْ سَخَّرَ لَنَا هٰذَا وَمَا كُنَّا لَهُ مُقْرِنِيْنَ وَإِنَّا إِلٰى رَبِّنَا لَمُنْقَلِبُوْنَ',
                'latin' => 'Subhaanalladzi sakhkhoro lanaa haadzaa wa maa kunnaa lahu muqriniin. Wa innaa ilaa robbinaa lamunqolibuun',
                'artinya' => 'Maha Suci (Allah) yang telah menundukkan kendaraan ini bagi kami, padahal kami sebelumnya tidak mampu menguasainya. Dan sesungguhnya kami akan kembali kepada Tuhan kami.',
            ],
            [
                'id' => '12',
                'doa' => 'Doa Sebelum Wudhu',
                'ayat' => 'نَوَيْتُ الْوُضُوْءَ لِرَفْعِ الْحَدَثِ اْلاَصْغَرِ فَرْضًا ِللهِ تَعَالَى',
                'latin' => 'Nawaitul whudu-a lirof\'il hadatsii ashghori fardhon lillahi ta\'aalaa',
                'artinya' => 'Saya niat berwudhu untuk menghilangkan hadast kecil, fardu karena Allah Ta\'ala.',
            ],
            [
                'id' => '13',
                'doa' => 'Doa Sesudah Wudhu',
                'ayat' => 'أَشْهَدُ أَنْ لاَ إِلَهَ إِلاَّ اللهُ وَحْدَهُ لاَ شَرِيْكَ لَهُ وَأَشْهَدُ أَنَّ مُحَمَّدًا عَبْدُهُ وَرَسُوْلُهُ',
                'latin' => 'Asyhadu an laa ilaaha illallaahu wahdahu laa syariikalahu wa asyhadu anna Muhammadan \'abduhu wa rosuuluh',
                'artinya' => 'Aku bersaksi bahwa tiada Tuhan selain Allah Yang Maha Esa, tidak ada sekutu bagi-Nya, dan aku bersaksi bahwa Nabi Muhammad adalah hamba dan utusan-Nya.',
            ],
            [
                'id' => '14',
                'doa' => 'Doa Ketika Hujan',
                'ayat' => 'اَللّٰهُمَّ صَيِّبًا نَافِعًا',
                'latin' => 'Allahumma shoyyiban naafi\'aa',
                'artinya' => 'Ya Allah, curahkanlah air hujan yang bermanfaat.',
            ],
            [
                'id' => '15',
                'doa' => 'Doa Ketika Mendengar Petir',
                'ayat' => 'سُبْحَانَ الَّذِيْ يُسَبِّحُ الرَّعْدُ بِحَمْدِهِ وَالْمَلاَئِكَةُ مِنْ خِيْفَتِهِ',
                'latin' => 'Subhaanalladzi yusabbihur ro\'du bihamdihi wal malaa-ikatu min khiifatihi',
                'artinya' => 'Maha Suci (Allah) yang mengagungkan petir dengan memuji-Nya dan malaikat karena takut kepada-Nya.',
            ],
            [
                'id' => '16',
                'doa' => 'Doa Berbuka Puasa',
                'ayat' => 'اَللّٰهُمَّ لَكَ صُمْتُ وَبِكَ آمَنْتُ وَعَلَى رِزْقِكَ أَفْطَرْتُ',
                'latin' => 'Allahumma laka shumtu wa bika aamantu wa \'alaa rizqika afthortu',
                'artinya' => 'Ya Allah, untuk-Mu aku berpuasa, kepada-Mu aku beriman, dan dengan rezeki dari-Mu aku berbuka.',
            ],
            [
                'id' => '17',
                'doa' => 'Doa Untuk Kedua Orang Tua',
                'ayat' => 'رَبِّ اغْفِرْ لِيْ وَلِوَالِدَيَّ وَارْحَمْهُمَا كَمَا رَبَّيَانِيْ صَغِيْرًا',
                'latin' => 'Rabbighfir lii wa liwalidayya warhhamhumaa kamaa robbayaanii shoghiiroo',
                'artinya' => 'Ya Tuhanku, ampunilah aku dan kedua orang tuaku, sayangilah mereka keduanya, sebagaimana mereka berdua telah mendidik aku waktu kecil.',
            ],
            [
                'id' => '18',
                'doa' => 'Doa Mohon Ampun',
                'ayat' => 'أَسْتَغْفِرُ اللهَ الْعَظِيْمَ الَّذِيْ لاَ إِلَهَ إِلاَّ هُوَ الْحَيُّ الْقَيُّوْمُ وَأَتُوْبُ إِلَيْهِ',
                'latin' => 'Astaghfirullahal-\'azhiimalladzi laa ilaaha illaa huwal hayyul qoyyuumu wa atuubu ilayh',
                'artinya' => 'Aku mohon ampun kepada Allah Yang Maha Agung, yang tiada Tuhan selain Dia, Yang Maha Hidup lagi Maha Berdiri Sendiri, dan aku bertaubat kepada-Nya.',
            ],
            [
                'id' => '19',
                'doa' => 'Doa Ketika Melihat Orang Sakit',
                'ayat' => 'اَلْحَمْدُ ِللهِ الَّذِيْ عَافَانِيْ مِمَّا ابْتَلاَكَ بِهِ وَفَضَّلَنِيْ عَلَى كَثِيْرٍ مِمَّنْ خَلَقَ تَفْضِيْلاً',
                'latin' => 'Alhamdulillahil-ladzi \'aafaanii mimmabtalaka bihi wa fadhdhonii \'alaa katsiirin mimman kholaqa tafdilaa',
                'artinya' => 'Segala puji bagi Allah yang telah menyelamatkan aku dari penyakit yang menimpamu dan memberi kelebihan kepadaku dari kebanyakan makhluk-Nya.',
            ],
            [
                'id' => '20',
                'doa' => 'Doa Memohon Keselamatan Dunia dan Akhirat',
                'ayat' => 'رَبَّنَا آتِنَا فِي الدُّنْيَا حَسَنَةً وَفِي الآخِرَةِ حَسَنَةً وَقِنَا عَذَابَ النَّارِ',
                'latin' => 'Robbanaa aatinaa fid-dunyaa hasanah, wa fil aakhiroti hasanah, wa qinaa adzaa bannaar',
                'artinya' => 'Ya Tuhan kami, berilah kami kebaikan di dunia dan kebaikan di akhirat, dan peliharalah kami dari siksa neraka.',
            ],
        ];
    }
}
