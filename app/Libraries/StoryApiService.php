<?php

namespace App\Libraries;

use Config\Services;

class StoryApiService
{
    protected $client;

    // Using a simple JSON placeholder or custom API
    // For demonstration, we'll use a hardcoded structure
    // In production, you'd replace this with a real Islamic stories API
    protected $baseUrl = 'https://jsonplaceholder.typicode.com'; // Placeholder

    public function __construct()
    {
        $this->client = Services::curlrequest([
            'baseURI' => $this->baseUrl,
            'timeout' => 10,
        ]);
    }

    /**
     * Get Islamic stories
     * Since there's no standard Islamic stories API, we'll create a mock structure
     * In production, replace with real API or local JSON file
     * @return array
     */
    public function getStories()
    {
        // Mock data - replace with real API in production
        return [
            [
                'id' => 1,
                'title' => 'Kisah Nabi Ibrahim AS',
                'category' => 'Nabi',
                'excerpt' => 'Ibrahim AS adalah salah satu nabi yang dikenal dengan keimanannya yang kuat...',
                'thumbnail' => null,
            ],
            [
                'id' => 2,
                'title' => 'Kisah Nabi Musa AS',
                'category' => 'Nabi',
                'excerpt' => 'Nabi Musa AS diutus kepada Firaun yang zalim...',
                'thumbnail' => null,
            ],
            [
                'id' => 3,
                'title' => 'Kisah Nabi Yusuf AS',
                'category' => 'Nabi',
                'excerpt' => 'Yusuf AS adalah putra Nabi Yakub yang memiliki mimpi istimewa...',
                'thumbnail' => null,
            ],
            [
                'id' => 4,
                'title' => 'Kisah Abu Bakar As-Siddiq',
                'category' => 'Sahabat',
                'excerpt' => 'Abu Bakar adalah sahabat terdekat Rasulullah SAW...',
                'thumbnail' => null,
            ],
            [
                'id' => 5,
                'title' => 'Kisah Umar bin Khattab',
                'category' => 'Sahabat',
                'excerpt' => 'Umar RA dikenal sebagai khalifah yang adil dan tegas...',
                'thumbnail' => null,
            ],
            [
                'id' => 6,
                'title' => 'Kisah Salman Al-Farisi',
                'category' => 'Sahabat',
                'excerpt' => 'Salman mencari kebenaran hingga menemukan Islam...',
                'thumbnail' => null,
            ],
        ];
    }

    /**
     * Get story detail by ID
     * @param int $id
     * @return array|null
     */
    public function getStoryDetail($id)
    {
        // Mock detailed story data
        $stories = [
            1 => [
                'id' => 1,
                'title' => 'Kisah Nabi Ibrahim AS',
                'category' => 'Nabi',
                'content' => 'Nabi Ibrahim AS adalah bapak para nabi. Beliau dikenal dengan keimanannya yang sangat kuat kepada Allah SWT. Ibrahim AS lahir di tengah masyarakat yang menyembah berhala. Sejak kecil, beliau sudah merasakan kejanggalan dengan kebiasaan kaumnya yang menyembah patung-patung batu.

Suatu hari, Ibrahim AS menghancurkan semua berhala di tempat ibadah kaumnya, kecuali yang terbesar. Ketika ditanya, beliau berkata bahwa berhala besar itulah yang menghancurkan yang lain. Ini membuat kaumnya menyadari kebodohan mereka.

Karena dakwahnya, Ibrahim AS dibakar hidup-hidup oleh Raja Namrud. Namun Allah SWT menjadikan api itu dingin dan penyelamat bagi Ibrahim AS. Ini adalah salah satu mukjizat yang diberikan Allah kepada beliau.

Ibrahim AS juga dikenal karena kesediaannya mengorbankan putranya, Ismail AS, atas perintah Allah. Ketaatan ini menjadi teladan bagi seluruh umat Islam hingga hari ini, yang diperingati dalam ibadah Idul Adha.',
                'thumbnail' => null,
                'lessons' => [
                    'Keimanan yang kuat kepada Allah',
                    'Keteguhan dalam menghadapi ujian',
                    'Ketaatan penuh kepada perintah Allah',
                ],
            ],
            2 => [
                'id' => 2,
                'title' => 'Kisah Nabi Musa AS',
                'category' => 'Nabi',
                'content' => 'Nabi Musa AS adalah salah satu nabi yang kisahnya paling banyak disebutkan dalam Al-Quran. Beliau diutus kepada Firaun yang sangat zalim dan mengaku sebagai tuhan.

Musa AS lahir di masa ketika Firaun memerintahkan pembunuhan semua bayi laki-laki Bani Israil. Ibunda Musa meletakkannya di dalam peti dan menghanyutkannya di sungai Nil. Peti itu ditemukan oleh keluarga Firaun, dan Musa AS tumbuh di istana Firaun sendiri.

Setelah dewasa, Musa AS secara tidak sengaja membunuh seorang Mesir yang sedang menyiksa orang Israel. Beliau melarikan diri ke Madyan dan menjadi penggembala. Di sinilah Allah SWT memanggil beliau dari pohon yang bercahaya di Gunung Sinai.

Musa AS kembali ke Mesir dengan mukjizat tongkat yang bisa berubah menjadi ular, untuk menghadapi Firaun. Setelah mengalami sepuluh tulah, Firaun akhirnya melepaskan Bani Israil. Ketika mereka dikejar tentara Firaun, Allah SWT membelah Laut Merah untuk menyelamatkan Musa AS dan kaumnya.',
                'thumbnail' => null,
                'lessons' => [
                    'Keberanian menghadapi kezaliman',
                    'Kesabaran dalam dakwah',
                    'Kepercayaan penuh kepada pertolongan Allah',
                ],
            ],
            3 => [
                'id' => 3,
                'title' => 'Kisah Nabi Yusuf AS',
                'category' => 'Nabi',
                'content' => 'Yusuf AS adalah putra Nabi Yakub AS yang sangat dicintai ayahnya. Kecemburuan saudara-saudaranya membuat mereka melemparkan Yusuf ke dalam sumur dan mengatakan kepada ayahnya bahwa Yusuf dimakan serigala.

Yusuf AS kemudian dijual sebagai budak di Mesir. Meskipun menjadi budak, kecerdasannya membuat dia dipercaya mengurus rumah tuannya. Namun, istri tuannya jatuh cinta dan mencoba menggodanya. Ketika Yusuf menolak, dia difitnah dan dipenjarakan.

Di penjara, Yusuf AS menafsirkan mimpi para tahanan. Kemampuan ini membawanya keluar dari penjara ketika raja Mesir bermimpi aneh. Yusuf menafsirkan mimpi raja tentang tujuh tahun masa subur dan tujuh tahun kekeringan.

Karena kebijaksanaannya, Yusuf AS diangkat menjadi menteri keuangan Mesir. Ketika kekeringan melanda, saudara-saudaranya datang ke Mesir mencari makanan. Yusuf AS memaafkan mereka dan membawa seluruh keluarganya, termasuk ayahnya, untuk tinggal di Mesir.',
                'thumbnail' => null,
                'lessons' => [
                    'Kesabaran dalam menghadapi ujian',
                    'Menjaga kehormatan diri',
                    'Memaafkan kesalahan orang lain',
                    'Memanfaatkan nikmat dengan bijaksana',
                ],
            ],
            4 => [
                'id' => 4,
                'title' => 'Kisah Abu Bakar As-Siddiq',
                'category' => 'Sahabat',
                'content' => 'Abu Bakar As-Siddiq RA adalah sahabat terdekat Rasulullah SAW dan orang pertama yang beriman dari kalangan laki-laki dewasa. Beliau mendapat gelar As-Siddiq (yang membenarkan) karena langsung membenarkan peristiwa Isra Miraj tanpa keraguan sedikit pun.

Abu Bakar RA dikenal sangat dermawan. Beliau mengeluarkan seluruh hartanya untuk kepentingan Islam. Ketika Rasulullah SAW meminta sumbangan, sahabat lain membawa setengah hartanya, namun Abu Bakar membawa seluruh hartanya.

Beliau menemani Rasulullah SAW dalam hijrah ke Madinah, bersembunyi di Gua Tsur. Ketika Abu Bakar khawatir musuh akan menemukan mereka, Rasulullah SAW menenangkannya dengan berkata, "Jangan bersedih, Allah bersama kita."

Setelah Rasulullah SAW wafat, Abu Bakar RA diangkat sebagai khalifah pertama. Masa kepemimpinannya ditandai dengan konsolidasi kekuatan Islam, menumpas kemurtadan, dan mengumpulkan Al-Quran. Beliau wafat setelah memimpin selama 2 tahun 3 bulan.',
                'thumbnail' => null,
                'lessons' => [
                    'Keimanan yang tanpa keraguan',
                    'Kedermawanan untuk Islam',
                    'Kesetiaan kepada Rasulullah SAW',
                    'Kepemimpinan yang bijaksana',
                ],
            ],
            5 => [
                'id' => 5,
                'title' => 'Kisah Umar bin Khattab',
                'category' => 'Sahabat',
                'content' => 'Umar bin Khattab RA adalah khalifah kedua yang dikenal dengan keadilan dan ketegasannya. Sebelum masuk Islam, Umar adalah musuh berat Islam yang bahkan berniat membunuh Rasulullah SAW.

Namun Allah SWT membuka hatinya ketika dia membaca surat Thaaha yang dimiliki saudara perempuannya. Keislamannya menjadi kekuatan besar bagi kaum muslimin yang sebelumnya selalu bersembunyi.

Sebagai khalifah, Umar RA terkenal sangat sederhana dan dekat dengan rakyatnya. Beliau sering keliling pada malam hari untuk mengecek keadaan rakyat. Ada kisah ketika beliau menggendong karung gandum untuk janda miskin yang tidak tahu bahwa yang menolongnya adalah sang khalifah.

Umar RA juga dikenal sangat tegas dalam menjalankan hukum, bahkan kepada keluarganya sendiri. Beliau memperluas wilayah Islam hingga ke Persia, Syria, dan Mesir. Sistem administrasi pemerintahan yang beliau terapkan menjadi fondasi bagi pemerintahan Islam setelahnya.

Umar RA wafat sebagai syahid, ditikam oleh seorang budak Persia saat sedang mengimami shalat subuh.',
                'thumbnail' => null,
                'lessons' => [
                    'Keadilan tanpa pandang bulu',
                    'Kesederhanaan pemimpin',
                    'Kepedulian terhadap rakyat',
                    'Ketegasan dalam kebenaran',
                ],
            ],
            6 => [
                'id' => 6,
                'title' => 'Kisah Salman Al-Farisi',
                'category' => 'Sahabat',
                'content' => 'Salman Al-Farisi RA adalah sahabat yang berasal dari Persia. Kisah perjalanannya mencari kebenaran sangat menginspirasi. Beliau lahir dalam keluarga Zoroaster (Majusi), namun hatinya selalu mencari kebenaran.

Salman sempat menjadi Kristen dan berpindah dari satu pendeta ke pendeta lain untuk belajar. Pendeta terakhir yang beliau temui memberitahu tentang kedatangan nabi terakhir di tanah Arab. Salman pun bertekad mencarinya.

Dalam perjalanan ke Arab, Salman dikhianati dan dijual sebagai budak kepada seorang Yahudi di Madinah. Ketika mendengar kedatangan Rasulullah SAW di Madinah, Salman mendatangi beliau dan mengujinya dengan ciri-ciri nabi yang pernah diceritakan kepadanya. Setelah yakin, Salman masuk Islam.

Salman memberikan kontribusi besar dalam Perang Khandaq dengan mengusulkan strategi menggali parit (khandaq) untuk melindungi Madinah, strategi yang tidak dikenal bangsa Arab sebelumnya.

Rasulullah SAW menyebut Salman sebagai bagian dari keluarga Ahlul Bait dengan berkata, "Salman adalah dari kami, Ahlul Bait." Ini menunjukkan bahwa Islam tidak memandang suku atau ras, tetapi ketakwaan.',
                'thumbnail' => null,
                'lessons' => [
                    'Kegigihan dalam mencari kebenaran',
                    'Kesabaran dalam ujian',
                    'Kontribusi ilmu untuk umat',
                    'Islam melampaui batas suku dan bangsa',
                ],
            ],
        ];

        return $stories[$id] ?? null;
    }

    /**
     * Get stories by category
     * @param string $category
     * @return array
     */
    public function getStoriesByCategory($category)
    {
        $allStories = $this->getStories();

        return array_filter($allStories, function ($story) use ($category) {
            return strtolower($story['category']) === strtolower($category);
        });
    }

    /**
     * Get featured stories
     * @param int $limit
     * @return array
     */
    public function getFeaturedStories($limit = 3)
    {
        $stories = $this->getStories();
        return array_slice($stories, 0, $limit);
    }
}
