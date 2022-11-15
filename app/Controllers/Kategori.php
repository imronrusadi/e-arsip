<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
    public function __construct()
    {
        $this->kategori = new KategoriModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Kategori',
            'kategori' => $this->kategori->findAll()
        ];

        return view('kategori/index', $data);
    }

    public function simpan()
    {
        $data = [
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ];

        $this->kategori->insert($data);
        // session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('kategori'))->with('pesan', 'Data Berhasil Ditambahkan');
    }

    public function update()
    {
        $id = $this->request->getPost('idkategori');
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ];
        $this->kategori->update($id, $data);

        return redirect()->to(base_url('kategori'))->with('pesan', 'Data Berhasil Diubah');
    }

    public function hapus($id = null)
    {
        // $id = $this->request->getPost('id_dept');
        $this->kategori->where('id_kategori', $id)->delete();
        // session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('kategori'))->with('pesan', 'Data Berhasil Dihapus');
    }
}
