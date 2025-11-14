<?php

namespace App\Models;

use CodeIgniter\Model;

class HabitLogModel extends Model
{
    protected $table            = 'habit_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'habit_id', 'log_date', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'user_id'  => 'required|integer',
        'habit_id' => 'required|integer',
        'log_date' => 'required|valid_date',
        'status'   => 'required|in_list[0,1]',
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
     * Get user logs for a specific date
     */
    public function getUserLogsForDate($userId, $date)
    {
        return $this->where('user_id', $userId)
                    ->where('log_date', $date)
                    ->findAll();
    }

    /**
     * Get or create log entry
     */
    public function toggleHabitLog($userId, $habitId, $date, $status)
    {
        $existing = $this->where([
            'user_id'  => $userId,
            'habit_id' => $habitId,
            'log_date' => $date,
        ])->first();

        if ($existing) {
            return $this->update($existing['id'], ['status' => $status]);
        } else {
            return $this->insert([
                'user_id'  => $userId,
                'habit_id' => $habitId,
                'log_date' => $date,
                'status'   => $status,
            ]);
        }
    }

    /**
     * Get user habit statistics
     */
    public function getUserHabitStats($userId, $habitId, $days = 30)
    {
        $startDate = date('Y-m-d', strtotime("-{$days} days"));

        $builder = $this->db->table($this->table);
        $builder->selectSum('status', 'completed_count');
        $builder->selectCount('id', 'total_logs');
        $builder->where('user_id', $userId);
        $builder->where('habit_id', $habitId);
        $builder->where('log_date >=', $startDate);

        return $builder->get()->getRowArray();
    }
}
