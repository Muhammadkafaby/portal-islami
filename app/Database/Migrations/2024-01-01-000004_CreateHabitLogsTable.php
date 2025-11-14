<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHabitLogsTable extends Migration
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
            'habit_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'log_date' => [
                'type' => 'DATE',
            ],
            'status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'comment'    => '0=not done, 1=done',
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
        $this->forge->addForeignKey('habit_id', 'habits', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addUniqueKey(['user_id', 'habit_id', 'log_date']);
        $this->forge->createTable('habit_logs');
    }

    public function down()
    {
        $this->forge->dropTable('habit_logs');
    }
}
