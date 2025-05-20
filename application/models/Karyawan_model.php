<?php

//=============================================================================
//   @Desc
//      Program Absensi Karyawan ini dibuat menggunakan PHP dan CodeIgniter 3.
//   @author 
//      Martin Hidayat Rihwan (Martin-020)
//   First created: 15/01/2025
//   Last update: 20/05/2025
//=============================================================================

defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan_model extends CI_Model
{
    protected $table = 'karyawan';

    public function get_all()
    {
        $this->db->where('role', 'karyawan');
        $query = $this->db->get('karyawan');
        return $query->result();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function delete($id_karyawan)
    {
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->delete($this->table);
    }
}