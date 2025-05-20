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

class Izin_model extends CI_Model
{
    protected $table = 'izin';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function get_by_karyawan($karyawan_id)
    {
        return $this->db->get_where($this->table, ['karyawan_id' => $karyawan_id])->result();
    }

    public function insert_izin($data)
    {
        return $this->db->insert('izin', $data);
    }

    public function get_izin_by_karyawan($id_karyawan)
    {
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->order_by('tanggal', 'DESC');
        $query = $this->db->get('izin');
        return $query->result();
    }
}
