<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArsipModel;
use App\Models\KategoriModel;
use App\Models\DepartementModel;
use App\Models\AuthModel;

class Arsip extends BaseController
{
    public function __construct()
    {
        $this->ArsipModel = new ArsipModel();
        $this->Kategori = new KategoriModel();
        $this->Dept = new DepartementModel();
        $this->auth = new AuthModel();
    }
    public function index()
    {

        $data = [
            'title' => 'Arsip',
            'arsip' => $this->ArsipModel->AllData(),
            'Kat' => $this->Kategori->findAll(),
            'Dept'  => $this->Dept->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('arsip/index', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'id_arsip' => [
                'rules' => 'required|is_unique[tbl_arsip.id_arsip]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong !!',
                    'is_unique' => '{field} sudah ada !!'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong !!'
                ]
            ],
            'no_arsip' => [
                'rules' => 'required|is_unique[tbl_arsip.id_arsip]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong !!',
                    'is_unique' => '{field} sudah ada !!'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong !!'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong !!'
                ]
            ],
            'departemen' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong !!'
                ]
            ],
            'file' => [
                // 'rules' => 'required|uploaded[file]|max_size[file,2048]|ext_in[file,pdf]',
                'rules' => 'max_size[file,2048]|ext_in[file,pdf]|uploaded[file]',
                'errors' => [

                    'max_size' => 'Ukuran {field} Max 2048 Kb',
                    'ext_in'   => 'Format {field} wajib .PDF',
                    // 'required' => '{field} tidak boleh kosong',
                    'uploaded' => '{field} tidak boleh kosong !!',
                ]
            ]


        ])) {
            // session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('arsip'))->with('errors', \Config\Services::validation()->getErrors());
        }

        // mengambil file yang akan di upload
        $fileArsip = $this->request->getFile('file');
        // mengubah nama menjadi rando
        $nama_file = $fileArsip->getRandomName();
        // ukuran file
        $ukuran_file = $fileArsip->getSizeByUnit('kb');


        $data = [
            'id_arsip'      => $this->request->getVar('id_arsip'),
            'id_kategori'   => $this->request->getVar('kategori'),
            'no_arsip'      => $this->request->getVar('no_arsip'),
            'nama_arsip'    => $this->request->getVar('nama'),
            'deskripsi'     => $this->request->getVar('deskripsi'),
            'id_dept'       => $this->request->getVar('departemen'),
            'id_user'       => userLogin()->id_user,
            'file'          => $nama_file,
            'ukuran_file'   => $ukuran_file
        ];
        $fileArsip->move('file_arsip', $nama_file); //direktori upload file
        $this->ArsipModel->insert($data);
        return redirect()->to(base_url('arsip'))->with('pesan', 'Data Berhasil di Tambahkan');
    }

    public function update()
    {
        if (!$this->validate([
            'id_arsip' => [
                'rules' => 'required|is_unique[tbl_arsip.id_arsip]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong !!',
                    'is_unique' => '{field} sudah ada !!'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong !!'
                ]
            ],
            'no_arsip' => [
                'rules' => 'required|is_unique[tbl_arsip.id_arsip]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong !!',
                    'is_unique' => '{field} sudah ada !!'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong !!'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong !!'
                ]
            ],
            'departemen' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong !!'
                ]
            ],
            'file' => [
                // 'rules' => 'required|uploaded[file]|max_size[file,2048]|ext_in[file,pdf]',
                'rules' => 'max_size[file,2048]|ext_in[file,pdf]|uploaded[file]',
                'errors' => [

                    'max_size' => 'Ukuran {field} Max 2048 Kb',
                    'ext_in'   => 'Format {field} wajib .PDF',
                    // 'required' => '{field} tidak boleh kosong',
                    'uploaded' => '{field} tidak boleh kosong !!',
                ]
            ]


        ])) {
            // session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('arsip'))->with('errors', \Config\Services::validation()->getErrors());
        }

        // mengambil file yang akan di upload
        $fileArsip = $this->request->getFile('file');
        // mengubah nama menjadi rando
        if ($fileArsip->getError() == 4) {
            $nama_file = $this->request->getVar('fileLama');
        } else {
            $nama_file = $fileArsip->getRandomName();
            $ukuran_file = $fileArsip->getSizeByUnit('kb');
            unlink('file_arsip/' . $this->request->getVar('fileLama'));
        }

        $data = [
            'id_arsip'      => $this->request->getVar('id_arsip'),
            'id_kategori'   => $this->request->getVar('kategori'),
            'no_arsip'      => $this->request->getVar('no_arsip'),
            'nama_arsip'    => $this->request->getVar('nama'),
            'deskripsi'     => $this->request->getVar('deskripsi'),
            'id_dept'       => $this->request->getVar('departemen'),
            'id_user'       => userLogin()->id_user,
            'file'          => $nama_file,
            'ukuran_file'   => $ukuran_file
        ];
        $fileArsip->move('file_arsip', $nama_file); //direktori upload file
        $this->ArsipModel->update($data);
        return redirect()->to(base_url('arsip'))->with('pesan', 'Data Berhasil di Update');
    }
}
