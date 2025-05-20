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

class Absensi_model extends CI_Model
{
    protected $table = 'absensi';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_by_karyawan($karyawan_id)
    {
        return $this->db->get_where($this->table, ['karyawan_id' => $karyawan_id])->result();
    }

    public function insert_absensi($data)
    {
        $this->db->insert('absensi', $data);
    }

    public function update_absensi($id_karyawan, $tanggal, $data)
    {
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->where('tanggal', $tanggal);
        $this->db->update('absensi', $data);
    }

    public function get_absensi_by_karyawan($id_karyawan)
    {
        $this->db->where('id_karyawan', $id_karyawan);
        $query = $this->db->get('absensi');
        return $query->result();
    }

    public function has_absen_masuk($id_karyawan, $tanggal)
    {
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->where('tanggal', $tanggal);
        $this->db->where('waktu_masuk IS NOT NULL');
        return $this->db->get('absensi')->num_rows() > 0;
    }

    public function has_absen_pulang($id_karyawan, $tanggal)
    {
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->where('tanggal', $tanggal);
        $this->db->where('waktu_keluar IS NOT NULL');
        return $this->db->get('absensi')->num_rows() > 0;
    }


}