<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Home extends BaseController
{
    protected $produkModel;
    protected $session;
    public function __construct()
    {
        $this->produkModel  = new ProdukModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $data = [
            'title' => 'Home | TOKO BUNGA',
            'produk' => $this->produkModel->getProduk(),

        ];
        return view('home', $data);
    }
}

