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

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('login_model');
        $this->load->model('Karyawan_model'); 
        $this->load->model('Jadwal_model'); 
        $this->load->model('Absensi_model'); 
        $this->load->model('Izin_model');    
    }

    public function login(){
        $this->load->view('login');
    }

    public function authenticate(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->login_model->validate_user($username, $password);

        if ($user) {
            $this->session->set_userdata('logged_in', true);
            $this->session->set_userdata('user_role', $user->role);
            $this->session->set_userdata('id_karyawan', $user->id_karyawan);
            $this->session->set_userdata('jabatan', $user->jabatan);
            $this->session->set_userdata('username', $user->username);
            $this->session->set_userdata('nama', $user->nama);        

            if ($user->role === 'admin') {
                redirect('admin/dashboard');
            } elseif ($user->role === 'karyawan') {
                redirect('user/home');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect('user/login');
        }
    }


    public function home(){
        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }
        if ($this->session->userdata('user_role') !== 'karyawan') {
            redirect('user/dashboard');
        }

        $id_karyawan = $this->session->userdata('id_karyawan');
        $jabatan = $this->session->userdata('jabatan');
        $nama = $this->session->userdata('nama');        

        $data['absensi'] = $this->Absensi_model->get_absensi_by_karyawan($id_karyawan);
        $data['izin'] = $this->Izin_model->get_izin_by_karyawan($id_karyawan);

        $this->load->view('home', $data);
    }

    public function izin(){
        if (!$this->session->userdata('logged_in')) {
            redirect('user/login');
        }
        if ($this->session->userdata('user_role') !== 'karyawan') {
            redirect('user/dashboard');
        }

        $id_karyawan = $this->session->userdata('id_karyawan');

        $data['absensi'] = $this->Absensi_model->get_absensi_by_karyawan($id_karyawan);

        $this->load->view('izin', $data);
        
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('user/login');
    }
}