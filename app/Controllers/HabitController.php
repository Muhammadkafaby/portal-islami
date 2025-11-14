<?php

namespace App\Controllers;

use App\Models\HabitModel;
use App\Models\HabitLogModel;

class HabitController extends BaseController
{
    protected $habitModel;
    protected $habitLogModel;
    protected $session;

    public function __construct()
    {
        $this->habitModel = new HabitModel();
        $this->habitLogModel = new HabitLogModel();
        $this->session = session();
    }

    /**
     * Show habit tracker
     */
    public function index()
    {
        // Check if user is logged in
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $userId = $this->session->get('user_id');
        $today = date('Y-m-d');

        // Get all active habits
        $habits = $this->habitModel->getActiveHabits();

        // Get today's logs for this user
        $todayLogs = $this->habitLogModel->getUserLogsForDate($userId, $today);

        // Create a map of habit_id => status
        $logMap = [];
        foreach ($todayLogs as $log) {
            $logMap[$log['habit_id']] = $log['status'];
        }

        // Merge habits with their status
        foreach ($habits as &$habit) {
            $habit['status'] = $logMap[$habit['id']] ?? 0;
            $habit['stats'] = $this->habitLogModel->getUserHabitStats($userId, $habit['id'], 30);
        }

        $data = [
            'title' => 'Habit Tracker - Portal Islami',
            'page_title' => 'Tracker Amalan Harian',
            'habits' => $habits,
            'today' => $today,
        ];

        return view('habit/index', $data);
    }

    /**
     * Log habit (toggle status)
     */
    public function log()
    {
        // Check if user is logged in
        if (!$this->session->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu',
            ]);
        }

        $userId = $this->session->get('user_id');
        $habitId = $this->request->getPost('habit_id');
        $status = $this->request->getPost('status') ?? 0;
        $date = $this->request->getPost('date') ?? date('Y-m-d');

        // Validate
        if (!$habitId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Habit ID tidak valid',
            ]);
        }

        // Toggle habit log
        $result = $this->habitLogModel->toggleHabitLog($userId, $habitId, $date, $status);

        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Habit berhasil diupdate',
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal mengupdate habit',
            ]);
        }
    }
}
