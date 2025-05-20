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

class Jadwal_model extends CI_Model
{
    protected $table = 'jadwal';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function delete($id_jadwal)
    {
        $this->db->where('id_jadwal', $id_jadwal);
        $this->db->delete($this->table);
    }

    public function get_jadwal_by_jabatan($jabatan)
    {
        $this->db->where('jabatan', $jabatan);
        $query = $this->db->get('jadwal');
        return $query->row();
    }
}