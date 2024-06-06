<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'email', 'password', 'alamat', 'no_telp', 'role'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getUser($username = false) #Jika ga ada parameter maka tampilakn semua dengan findall
    {
        if ($username == false) {
            return $this->findAll();
        }

        return $this->where(['username' => $username])->first(); #kalau ada maka tampilakn array pertama
    }

    public function getUserbyId($id)
    {
        return $this->find($id);
    }
}
