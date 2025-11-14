<?php

namespace App\Controllers;

use App\Libraries\QuranApiService;
use App\Models\QuranQuizResultModel;

class QuranQuizController extends BaseController
{
    protected $quranApi;
    protected $quizResultModel;
    protected $session;

    public function __construct()
    {
        $this->quranApi = new QuranApiService();
        $this->quizResultModel = new QuranQuizResultModel();
        $this->session = session();
    }

    /**
     * Quiz landing page
     */
    public function index()
    {
        $data = [
            'title' => 'Quiz Al-Quran - Portal Islami',
            'page_title' => 'Quiz Al-Quran',
        ];

        // Get user history if logged in
        if ($this->session->get('isLoggedIn')) {
            $userId = $this->session->get('user_id');
            $data['history'] = $this->quizResultModel->getUserQuizHistory($userId, 5);
            $data['stats'] = $this->quizResultModel->getUserStats($userId);
        }

        return view('quiz/index', $data);
    }

    /**
     * Start quiz session
     */
    public function start()
    {
        // Generate quiz questions from API
        $questions = $this->generateQuizQuestions(5);

        // Store questions in session
        $this->session->set('quiz_questions', $questions);
        $this->session->set('quiz_start_time', time());

        $data = [
            'title' => 'Quiz Al-Quran - Mulai',
            'page_title' => 'Quiz Al-Quran',
            'questions' => $questions,
        ];

        return view('quiz/start', $data);
    }

    /**
     * Submit quiz answers
     */
    public function submit()
    {
        $questions = $this->session->get('quiz_questions');
        $answers = $this->request->getPost('answers');

        if (!$questions || !$answers) {
            return redirect()->to('/quiz')->with('error', 'Session quiz tidak valid');
        }

        // Calculate score
        $totalQuestions = count($questions);
        $correctAnswers = 0;

        foreach ($questions as $index => $question) {
            $userAnswer = $answers[$index] ?? null;
            if ($userAnswer === $question['correct_answer']) {
                $correctAnswers++;
            }
        }

        $score = ($correctAnswers / $totalQuestions) * 100;

        // Save result if user logged in
        if ($this->session->get('isLoggedIn')) {
            $userId = $this->session->get('user_id');

            $this->quizResultModel->insert([
                'user_id' => $userId,
                'total_questions' => $totalQuestions,
                'correct_answers' => $correctAnswers,
                'score' => $score,
                'quiz_type' => 'daily',
            ]);
        }

        // Clear quiz session
        $this->session->remove('quiz_questions');
        $this->session->remove('quiz_start_time');

        $data = [
            'title' => 'Hasil Quiz - Portal Islami',
            'page_title' => 'Hasil Quiz',
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'score' => $score,
            'questions' => $questions,
            'answers' => $answers,
        ];

        return view('quiz/result', $data);
    }

    /**
     * Generate quiz questions from API data
     */
    private function generateQuizQuestions($count = 5)
    {
        $questions = [];
        $versesData = $this->quranApi->getVersesForQuiz($count);

        foreach ($versesData as $data) {
            if (!$data || !isset($data['verse']) || !isset($data['surah'])) {
                continue;
            }

            $verse = $data['verse'];
            $surah = $data['surah'];

            // Type 1: Guess the surah name
            if (count($questions) < $count) {
                $questions[] = [
                    'type' => 'surah_name',
                    'question' => 'Ayat berikut dari surah apa?',
                    'verse_text' => $verse['text_uthmani'] ?? '',
                    'options' => $this->generateSurahOptions($surah['name_simple']),
                    'correct_answer' => $surah['name_simple'],
                ];
            }

            // Type 2: Translation quiz
            if (count($questions) < $count && !empty($verse['translations'])) {
                $translation = $verse['translations'][0]['text'] ?? '';
                $questions[] = [
                    'type' => 'translation',
                    'question' => 'Apa terjemahan dari ayat berikut?',
                    'verse_text' => $verse['text_uthmani'] ?? '',
                    'options' => $this->generateTranslationOptions($translation),
                    'correct_answer' => $translation,
                ];
            }
        }

        return array_slice($questions, 0, $count);
    }

    /**
     * Generate multiple choice options for surah names
     */
    private function generateSurahOptions($correctAnswer)
    {
        $commonSurahs = [
            'Al-Fatihah', 'Al-Baqarah', 'Ali \'Imran', 'An-Nisa', 'Al-Maidah',
            'Al-An\'am', 'Al-A\'raf', 'Al-Anfal', 'At-Tawbah', 'Yunus',
            'Hud', 'Yusuf', 'Ar-Ra\'d', 'Ibrahim', 'Al-Hijr',
            'An-Nahl', 'Al-Isra', 'Al-Kahf', 'Maryam', 'Ta-Ha',
        ];

        // Remove correct answer from pool
        $pool = array_diff($commonSurahs, [$correctAnswer]);

        // Get 3 random wrong answers
        $wrongAnswers = array_rand(array_flip($pool), min(3, count($pool)));

        // Combine with correct answer
        $options = array_merge([$correctAnswer], (array)$wrongAnswers);

        // Shuffle options
        shuffle($options);

        return $options;
    }

    /**
     * Generate multiple choice options for translations
     */
    private function generateTranslationOptions($correctAnswer)
    {
        // This is a simplified version
        // In production, you'd fetch actual translations from other verses
        $dummyTranslations = [
            'Dan Allah Maha Mengetahui lagi Maha Bijaksana.',
            'Sesungguhnya Allah Maha Pengasih lagi Maha Penyayang.',
            'Dan hanya kepada-Nya kami memohon pertolongan.',
        ];

        // Get 3 random wrong answers
        $wrongAnswers = array_slice($dummyTranslations, 0, 3);

        // Combine with correct answer
        $options = array_merge([$correctAnswer], $wrongAnswers);

        // Shuffle options
        shuffle($options);

        return $options;
    }
}
