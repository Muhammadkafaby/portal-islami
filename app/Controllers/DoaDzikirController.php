<?php

namespace App\Controllers;

use App\Libraries\DoaApiService;

class DoaDzikirController extends BaseController
{
    protected $doaApi;

    public function __construct()
    {
        $this->doaApi = new DoaApiService();
    }

    /**
     * List all doa
     */
    public function index()
    {
        $keyword = $this->request->getGet('search');
        $doaList = $keyword ? $this->doaApi->searchDoa($keyword) : $this->doaApi->getAllDoa();

        $data = [
            'title' => 'Doa & Dzikir - Portal Islami',
            'page_title' => 'Doa & Dzikir Harian',
            'doa_list' => $doaList,
            'keyword' => $keyword,
        ];

        return view('doa/index', $data);
    }

    /**
     * Show doa detail
     */
    public function detail($id)
    {
        $doa = $this->doaApi->getDoaById($id);

        if (!$doa) {
            return redirect()->to('/doa')->with('error', 'Doa tidak ditemukan');
        }

        $data = [
            'title' => ($doa['doa'] ?? 'Detail Doa') . ' - Portal Islami',
            'page_title' => 'Detail Doa',
            'doa' => $doa,
        ];

        return view('doa/detail', $data);
    }
}
