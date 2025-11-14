<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Portal Islami - Beranda',
            'page_title' => 'Selamat Datang di Portal Islami',
        ];

        return view('home', $data);
    }
}
