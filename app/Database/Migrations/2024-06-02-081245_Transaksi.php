<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11, 
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'produk_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'user', 'id'); // Sesuaikan dengan nama tabel user Anda
        $this->forge->addForeignKey('produk_id', 'produk', 'id'); // Sesuaikan dengan nama tabel komik Anda
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        //
    }
}
