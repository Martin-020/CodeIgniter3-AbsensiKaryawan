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

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Karyawan_model'); 
        $this->load->model('Jadwal_model'); 
        $this->load->model('Absensi_model'); 
        $this->load->model('Izin_model');    
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function dashboard()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }
        if ($this->session->userdata('user_role') !== 'admin') {
            redirect('user/home');
        }
        
        $this->db->where('role', 'karyawan');
        $data['karyawan'] = $this->Karyawan_model->get_all(); 

        $data['jadwal'] = $this->Jadwal_model->get_all();
        $data['absensi'] = $this->Absensi_model->get_all();
        $data['izin'] = $this->Izin_model->get_all();

        $this->load->view('dashboard', $data);
    }

    public function buat_karyawan()
    {
        $this->Karyawan_model->insert([
            'nama' => $this->input->post('nama'),
            'jabatan' => $this->input->post('jabatan'),
            'tlp' => $this->input->post('tlp'),
            'alamat' => $this->input->post('alamat'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        ]);

        redirect('admin/dashboard');
    }

    public function delete_karyawan($id_karyawan)
    {
        $this->Karyawan_model->delete($id_karyawan);
        redirect('admin/dashboard');
    }

    public function buat_jadwal()
    {
        $this->Jadwal_model->insert([
            'jabatan' => $this->input->post('jabatan'),
            'tanggal' => $this->input->post('tanggal'),
            'jam_masuk' => $this->input->post('jam_masuk'),
            'jam_keluar' => $this->input->post('jam_keluar')
        ]);

        redirect('admin/dashboard');
    }

    public function delete_jadwal($id_jadwal)
    {
        $this->Jadwal_model->delete($id_jadwal);
        redirect('admin/dashboard');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}