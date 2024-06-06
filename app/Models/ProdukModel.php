<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'stok', 'deskripsi', 'harga', 'gambar'];

    protected bool $allowEmptyInserts = false;

     // Dates
     protected $useTimestamps = false;
     protected $dateFormat    = 'datetime';
 
     public function getProduk($nama = false) #Jika ga ada parameter maka tampilakn semua dengan findall
     {
         if ($nama == false) {
             return $this->findAll();
         }
 
         return $this->where(['nama' => $nama])->first(); #kalau ada maka tampilakn array pertama
     }
}