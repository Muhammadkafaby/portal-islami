<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }

    /**
     * Show login form
     */
    public function login()
    {
        // If already logged in, redirect to home
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Login - Portal Islami',
        ];

        return view('auth/login', $data);
    }

    /**
     * Process login
     */
    public function processLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Verify login
        $user = $this->userModel->verifyLogin($email, $password);

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Email atau password salah');
        }

        // Set session
        $sessionData = [
            'user_id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'isLoggedIn' => true,
        ];

        $this->session->set($sessionData);

        return redirect()->to('/')->with('success', 'Login berhasil! Selamat datang ' . $user['name']);
    }

    /**
     * Show register form
     */
    public function register()
    {
        // If already logged in, redirect to home
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Register - Portal Islami',
        ];

        return view('auth/register', $data);
    }

    /**
     * Process registration
     */
    public function processRegister()
    {
        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
        ], [
            'email' => [
                'is_unique' => 'Email sudah terdaftar',
            ],
            'password_confirm' => [
                'matches' => 'Konfirmasi password tidak cocok',
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Create user
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'user',
        ];

        if ($this->userModel->insert($data)) {
            return redirect()->to('/auth/login')->with('success', 'Registrasi berhasil! Silakan login.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Registrasi gagal. Silakan coba lagi.');
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/auth/login')->with('success', 'Anda telah logout');
    }
}
