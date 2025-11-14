<?php

namespace App\Models;

use CodeIgniter\Model;

class QuranQuizResultModel extends Model
{
    protected $table            = 'quran_quiz_results';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'total_questions', 'correct_answers', 'score', 'quiz_type'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'user_id'         => 'required|integer',
        'total_questions' => 'required|integer',
        'correct_answers' => 'required|integer',
        'score'           => 'required|decimal',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get user quiz history
     */
    public function getUserQuizHistory($userId, $limit = 10)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll($limit);
    }

    /**
     * Get user statistics
     */
    public function getUserStats($userId)
    {
        $builder = $this->db->table($this->table);
        $builder->selectSum('total_questions', 'total_questions');
        $builder->selectSum('correct_answers', 'total_correct');
        $builder->selectAvg('score', 'average_score');
        $builder->selectCount('id', 'total_quizzes');
        $builder->where('user_id', $userId);

        return $builder->get()->getRowArray();
    }
}
