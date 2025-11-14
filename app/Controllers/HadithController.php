<?php

namespace App\Controllers;

use App\Libraries\HadithApiService;

class HadithController extends BaseController
{
    protected $hadithApi;

    public function __construct()
    {
        $this->hadithApi = new HadithApiService();
    }

    /**
     * Show hadith list
     */
    public function index()
    {
        $bookId = $this->request->getGet('book') ?? 'bukhari';
        $page = $this->request->getGet('page') ?? 1;

        // Get available books
        $books = $this->hadithApi->getBooks();

        // Get hadith list
        $hadithData = $this->hadithApi->getHadithList($bookId, $page);

        $data = [
            'title' => 'Hadits - Portal Islami',
            'page_title' => 'Koleksi Hadits',
            'books' => $books,
            'hadith_data' => $hadithData,
            'current_book' => $bookId,
            'current_page' => $page,
        ];

        return view('hadith/index', $data);
    }

    /**
     * Show hadith detail
     */
    public function detail($bookId, $number)
    {
        $hadith = $this->hadithApi->getHadithDetail($bookId, $number);

        if (!$hadith) {
            return redirect()->to('/hadith')->with('error', 'Hadits tidak ditemukan');
        }

        $data = [
            'title' => 'Hadits ' . ucfirst($bookId) . ' #' . $number . ' - Portal Islami',
            'page_title' => 'Detail Hadits',
            'hadith' => $hadith,
            'book_id' => $bookId,
        ];

        return view('hadith/detail', $data);
    }
}
