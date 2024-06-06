<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\ProdukModel;
use App\Models\DaftarStatusModel;

class Transaksi extends BaseController
{

    protected $modelTransaksi;
    protected $modelProduk;
    protected $modelDaftarStatus;
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->modelProduk = new ProdukModel();
        $this->modelTransaksi = new TransaksiModel();
        $this->modelDaftarStatus = new DaftarStatusModel();
    }

    public function index()
    {
        
        $userId = $this->session->get('userData.id');
        $transaksi = $this->modelTransaksi->getTransaksiByID($userId);

        if ($transaksi == null) {
            return redirect()->to(base_url('Home/'))->with('error', 'Keranjang kosong, silahkan pilih komik terlebih dahulu');
        }

        // Menghitung total harga komik
        $totalHarga = 0;
        foreach ($transaksi as $t) {
            // Ambil harga komik dari database berdasarkan ID komik
            $hargaProduk = $this->modelProduk->find($t['produk_id'])['harga'];

            // Hitung total harga dengan mengakumulasikan harga setiap Produk
            $totalHarga += $hargaProduk * $t['jumlah'];
        }
        $data = [
            'title' => 'Keranjang | Komikin',
            'transaksi' => $transaksi,
            'user' => $userId,
            'totalHarga' => $totalHarga
        ];
        return view('client/transaksi', $data);
    }


    public function add($id)
    {
        // Periksa apakah pengguna sudah login
        if ($this->session->has('userData')) {
            // Ambil ID komik dari parameter
            $produkID = $id;

            // Ambil ID user dari session
            $userID = $this->session->get('userData')['id'];

            // Hitung jumlah komik yang sudah ada dalam keranjang
            $existingCheckout = $this->modelTransaksi->getTransaksiByID($userID);
            $jumlahKomik = count($existingCheckout);

            foreach ($existingCheckout as $checkoutItem) {
                if ($checkoutItem['produk_id'] == $produkID) {
                    return redirect()->to(base_url('Home/'))->with('error', 'Waduh, komik ini sudah ada dalam keranjang tuh 👀');
                }
            }
            // Jika pengguna sudah memiliki 5 komik dalam keranjang, tampilkan pesan alert
            if ($jumlahKomik >= 1) {
                return redirect()->to(base_url('Home/'))->with('error', 'Eitss, Anda sudah memiliki 1 komik dalam keranjang, cek dulu yuk!');
            }

            // Jika tidak ada komik dalam keranjang, tambahkan komik yang dipilih ke keranjang
            $checkoutData = [
                'user_id' => $userID,
                'produk_id' => $produkID,
                'jumlah' => 1, // Default jumlah 1 jika tidak ditentukan
            ];

            $this->modelTransaksi->insertTransaksi($checkoutData);

            // Setelah menambahkan komik ke keranjang, tampilkan pesan alert bahwa produk berhasil ditambahkan
            return redirect()->to(base_url('Home/'))->with('success', 'Komik berhasil ditambahkan ke keranjang');
        } else {
            // Jika pengguna belum login, arahkan ke halaman login
            return redirect()->to(base_url('Auth/loginpage'))->with('error', 'Silakan login terlebih dahulu');
        }
    }

    public function bayar()
    {
        if ($this->session->has('userData')) {
            $userID = $this->session->get('userData')['id'];
            $username = $this->session->get('userData')['username'];
            $checkout = $this->modelTransaksi->getTransaksiByID($userID);
            $bukti_pembayaran = $this->request->getFile('buktiPembayaran');


            $bayarKeberapasiClient = $this->modelStatusPembelian
                ->select('status_pembelian.*')
                ->where('user_id', $userID)
                ->orderBy('transaksi', 'DESC')
                ->first();

            $bayarKeberapa = 0;
            if ($bayarKeberapasiClient == null) {
                $bayarKeberapa = 1;
            } else {
                $bayarKeberapa = $bayarKeberapasiClient['transaksi'] + 1;
            }


            if ($bukti_pembayaran->isValid() && !$bukti_pembayaran->hasMoved()) {
                $bukti = $bukti_pembayaran->getRandomName();
                $bukti_pembayaran->move('img', $bukti);
            }
            // Mengambil informasi waktu sekarang
            $dataPembelian = [];


            foreach ($transaksi as $item) {
                $dataPembelian[] = [
                    'komik_id' => $item['komik_id'],
                    'user_id' => $userID,
                    'jumlah' => $item['jumlah'],
                    'status_id' => 1,
                    'transaksi' => $bayarKeberapa,
                    'bukti_pembayaran' => $bukti,
                ];
            }

            // Simpan setiap data pembelian ke dalam tabel
            foreach ($dataPembelian as $data) {
                $this->modelDaftarStatus->insert($data);
            }

            $this->modelTransaksi->where('user_id', $userID)->delete();
            // var_dump($checkout);
            return redirect()->to('/Home')->with('success', 'Pembayaran berhasil dilakukan. Silahkan Menunggu konfirmasi dari admin');
        }
    }


    public function delete($checkoutId)
    {

        // Lakukan penghapusan checkout berdasarkan ID checkout
        $deleted = $this->modelTransaksi->deleteTransaksi($checkoutId);

        if ($deleted) {
            return redirect()->to(base_url('Transaksi'))->with('success', 'Produk berhasil dihapus dari keranjang');
        } else {
            return redirect()->to(base_url('Transaksi'))->with('error', 'Gagal menghapus produk dari keranjang');
        }
    }
}
