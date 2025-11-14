<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuranQuizResultsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'total_questions' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'correct_answers' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'score' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0,
            ],
            'quiz_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('quran_quiz_results');
    }

    public function down()
    {
        $this->forge->dropTable('quran_quiz_results');
    }
}
