<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id', 'produk_id','jumlah'];

    public function getTransaksi()
    {
        return $this->findAll();
    }

    public function getTransaksiByID($user_id)
    {
        return $this->select('transaksi.*, produk.*, transaksi.id')
            ->join('produk', 'produk.id = transaksi.produk_id') //Dari tabel produk, kita ambil idnya dan dijoin ke tabel transaksi field produk_id
            ->where('transaksi.user_id', $user_id)
            ->findAll();
    }

    public function getTransaksiCountAllFindAll()
    {
        return $this->select('transaksi.*, produk.*, transaksi.id')
            ->join('produk', 'produk.id = transaksi.komik_id')
            ->countAllResults();
    }

    public function insertTransaksi($data)
    {
        return $this->insert($data);
    }

    public function updateTransaksi($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteTransaksi($id)
    {
        return $this->delete($id);
    }
}
