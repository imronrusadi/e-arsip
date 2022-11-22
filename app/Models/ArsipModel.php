<?php

namespace App\Models;

use CodeIgniter\Model;

class ArsipModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'tbl_arsip';
    protected $primaryKey       = 'id_arsip';
    protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    protected $allowedFields    = ['id_arsip', 'id_kategori', 'no_arsip', 'nama_arsip', 'deskripsi', 'id_dept', 'id_user', 'file', 'ukuran_file'];

    // Dates
    protected $useTimestamps = true;

    public function AllData()
    {
        return $this->db->table('tbl_arsip')
            ->select('*')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_arsip.id_kategori', 'left')
            ->join('tbl_dept', 'tbl_dept.id_dept = tbl_arsip.id_dept', 'left')
            ->join('tbl_user', 'tbl_user.id_user = tbl_arsip.id_user', 'left')
            ->get()
            ->getResultArray();
    }
    public function DetailData($id_arsip)
    {
        return $this->db->table('tbl_arsip')
            ->select('*')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_arsip.id_kategori', 'left')
            ->join('tbl_dept', 'tbl_dept.id_dept = tbl_arsip.id_dept', 'left')
            ->join('tbl_user', 'tbl_user.id_user = tbl_arsip.id_user', 'left')
            ->where('id_arsip', $id_arsip)
            ->get()
            ->getResultArray();
    }
}
