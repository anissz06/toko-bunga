<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\UserModel;
#use App\Models\CheckoutModel;
#use App\Models\StatusPembelianModel;

class Admin extends BaseController
{
    protected $produkModel;
    protected $userModel;
    #protected $checkoutModel;
    #protected $statusPembelianModel;
    protected $session;
    protected $validation;

    public function __construct()
    {
        $this->produkModel  = new ProdukModel();
        $this->userModel  = new UserModel();
        #$this->checkoutModel = new CheckoutModel();
        #$this->statusPembelianModel = new StatusPembelianModel();

        helper(['form']);

        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $userID = $this->session->get('userData');
        $data = [
            'title' => 'Dashboard | Toko Bunga',
            //'total_keranjang_client' => $this->checkoutModel->getCheckoutCountAllFindAll(),
            //'total_pembayaran_pending' => $this->statusPembelianModel->getStatusPembelianByIdCountAllResults(1),
            //'total_pembayaran_diterima' => $this->statusPembelianModel->getStatusPembelianByIdCountAllResults(2),
            //'total_pembayaran_ditolak' => $this->statusPembelianModel->getStatusPembelianByIdCountAllResults(3),
            'user' => $userID,
        ];
        // dd($data);
        return view('admin/dashboard', $data);
    }

    public function profile()
    {

        $userID = $this->session->get('userData');
        $data = [
            'title' => 'Profile | TOKO BUNGA',
            'user' => $userID
        ];

        return view('admin/profile', $data);
    }

    public function listbunga()
    {
        $data = [
            'title' => 'Daftar Bunga',
            'produk' => $this->produkModel->getProduk()
        ];
        return view('bunga/index', $data);
    }

    public function listuser()
    {
        $data = [
            'title' => 'Daftar Bunga',
            'user' => $this->userModel->getUser()
        ];
        return view('admin/user', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Bunga',
            'validation' => \Config\Services::validation()->listErrors()  // Fetch validation errors from session
        ];
        return view('bunga/create', $data);
    }

    public function save()
    {

        $gambarFile = $this->request->getFile('gambar');        //Validasi Input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[produk.nama]',
                'errors' => [
                    'required' => '{field} bunga harus diisi',
                    'is_unique' => '{field} bunga sudah tersedia.'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} bunga harus diisi',
                ]
            ],
            'stok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} bunga harus diisi',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} bunga harus diisi',
                ]
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]',
                'errors' => [
                    'uploaded' => '{field} bunga harus diunggah.',
                ]
            ],

        ])) {
            $validation = \Config\Services::validation()->listErrors();
            return redirect()->to('Admin/create')->withInput()->with('validation', $validation);
            //Save ngirim semua input, terus kirim validationnya, teru sdiambil di fucntion create Kita bakal redirect ke create page
        }
        //dd($this->request->getVar());//Ambil semuanya, kalo mau satu, masukin parameternya di dalem tand kurunS

        if ($gambarFile->isValid() && !$gambarFile->hasMoved()) {
            $newGambar = $gambarFile->getRandomName();
            $gambarFile->move('img', $newGambar); // Move to the 'public/img' directory

            $this->produkModel->save([
                'nama' => $this->request->getVar('nama'),
                'stok' => $this->request->getVar('stok'),
                'deskripsi' => $this->request->getVar('deskripsi'),
                'harga' => $this->request->getVar('harga'),
                'gambar' => $newGambar,
            ]);
        }

        session()->setFlashdata('pesan', 'Data berhasill ditambahkan');
        //setelah berhasil kita kembaliin ke halaman index lagi
        return redirect()->to('Admin/listbunga');
    }


    public function detail($nama)
    {
        $produk = $this->produkModel->getProduk($nama);

        //Jika komik tidak ada di tabel
        if (empty($produk)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama Bunga ' . $nama . ' Tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Bunga',
            'produk' => $produk
        ];

        return view('bunga/detail', $data);
    }

    public function edit($nama)
    {
        $data = [
            'title' => 'Form Ubah Data Bunga',
            'validation' => \Config\Services::validation(),
            'produk' => $this->produkModel->getProduk($nama)
        ];
        return view('bunga/edit', $data);
    }

    public function update($id)
    {


        //Cek judul, kalau judul dirubah maka cek is_unique, kalau judul tidak diubah maka tak perlu cek is_unique
        $produk = $this->produkModel->find($id); // Ambil data komik berdasarkan ID

        // // Rules
        // $rule_judul = 'required';
        // if ($komik['judul'] != $this->request->getVar('judul')) {
        //     $rule_judul .= '|is_unique[komik.judul]';
        // }
        //Validasi Input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} bunga harus diisi.',
                    'is_unique' => '{field} komik sudah tersedia.'
                ]
            ],
            'stok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} bunga harus diisi.',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} bunga harus diisi.',
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} bunga harus diisi.',
                ]
            ],

        ])) {
            $validation = \Config\Services::validation()->listErrors();
            //dd($validation);
            return redirect()->to('Admin/edit/' . $this->request->getVar('nama'))->withInput()->with('validation', $validation);
        }


        $this->produkModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'stok' => $this->request->getVar('stok'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'harga' => $this->request->getVar('harga'),
            'gambar' => $this->request->getVar('gambar'),
        ]);


        session()->setFlashdata('pesan', 'Data berhasill ditambahkan');
        //setelah berhasil kita kembaliin ke halaman index lagi
        return redirect()->to('Admin/listbunga');
    }

    public function delete($id)
    {
        $this->produkModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasill dihapus');
        return redirect()->to(base_url('Admin/listbunga'));
    }
}
