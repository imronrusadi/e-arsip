<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartementModel;

class Departement extends BaseController
{
    public function __construct()
    {
        $this->departement = new DepartementModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Departement',
            'dept' => $this->departement->findAll()
        ];
        return view('dept/index', $data);
    }

    public function simpan()
    {
        $data = [
            'nama_dep' => $this->request->getVar('nama_dep')
        ];

        $this->departement->insert($data);
        // session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to(base_url('departement'))->with('pesan', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {

        $data = $this->departement->find($id);

        // $this->departement->insert($data);
        // return redirect()->to('/departement');
    }

    public function update()
    {
        $id = $this->request->getPost('idDept');
        $data = [
            'nama_dep' => $this->request->getPost('nama_dep')
        ];
        $this->departement->update($id, $data);

        return redirect()->to(base_url('departement'))->with('pesan', 'Data Berhasil Diubah');
    }

    public function hapus($id = null)
    {
        // $id = $this->request->getPost('id_dept');
        $this->departement->where('id_dept', $id)->delete();
        // session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to(base_url('departement'))->with('pesan', 'Data Berhasil Dihapus');
    }
}
