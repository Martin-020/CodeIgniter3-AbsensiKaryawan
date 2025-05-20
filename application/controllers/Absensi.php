<?php

//=============================================================================
//   @Desc
//      Program Absensi Karyawan ini dibuat menggunakan PHP dan CodeIgniter 3.
//   @author 
//      Martin Hidayat Rihwan (Martin-020)
//   First created: 15/01/2025
//   Last update: 20/05/2025
//=============================================================================

class Absensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Absensi_model');
        $this->load->model('Izin_model');
        $this->load->model('Jadwal_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function absen_masuk()
    {
        $id_karyawan = $this->session->userdata('id_karyawan');
        $jabatan = $this->session->userdata('jabatan');
        $current_date = date('Y-m-d');
        $current_time = date('H:i:s');

        $jadwal = $this->Jadwal_model->get_jadwal_by_jabatan($jabatan);

        if (!$jadwal) {
            $this->session->set_flashdata('error', 'Jadwal tidak ditemukan!');
            redirect('user/home');
        }

        if ($this->Absensi_model->has_absen_masuk($id_karyawan, $current_date)) {
            $this->session->set_flashdata('error', 'Anda sudah absen masuk hari ini!');
            redirect('user/home');
        }

        $scheduled_time = $jadwal->jam_masuk;
        if (!$this->is_within_time($current_time, $scheduled_time)) {
            $time_diff = strtotime($current_time) - strtotime($scheduled_time);
            if ($time_diff < 0) {
                $this->session->set_flashdata('error', 'Belum waktunya absen masuk!');
            } else {
                $this->session->set_flashdata('error', 'Anda terlambat absen masuk!');
            }
            redirect('user/home');
        }

        $data = [
            'id_karyawan' => $id_karyawan,
            'tanggal' => $current_date,
            'waktu_masuk' => $current_time,
            'waktu_keluar' => null,
            'status' => 'Sudah Hadir'
        ];
        $this->Absensi_model->insert_absensi($data);

        $this->session->set_flashdata('success', 'Absen masuk berhasil!');
        redirect('user/home');
    }

    public function absen_pulang()
    {
        $id_karyawan = $this->session->userdata('id_karyawan');
        $jabatan = $this->session->userdata('jabatan');
        $current_date = date('Y-m-d');
        $current_time = date('H:i:s');

        $jadwal = $this->Jadwal_model->get_jadwal_by_jabatan($jabatan);

        if (!$jadwal) {
            $this->session->set_flashdata('error', 'Jadwal tidak ditemukan!');
            redirect('user/home');
        }

        if ($this->Absensi_model->has_absen_pulang($id_karyawan, $current_date)) {
            $this->session->set_flashdata('error', 'Anda sudah absen pulang hari ini!');
            redirect('user/home');
        }

        $scheduled_time = $jadwal->jam_keluar;
        if (!$this->is_within_time($current_time, $scheduled_time)) {
            $time_diff = strtotime($current_time) - strtotime($scheduled_time);
            if ($time_diff < 0) {
                $this->session->set_flashdata('error', 'Belum waktunya absen pulang!');
            } else {
                $this->session->set_flashdata('error', 'Anda terlambat absen pulang!');
            }
            redirect('user/home');
        }

        $data = [
            'waktu_keluar' => $current_time,
            'status' => 'Sudah Pulang'
        ];
        $this->Absensi_model->update_absensi($id_karyawan, $current_date, $data);

        $this->session->set_flashdata('success', 'Absen pulang berhasil!');
        redirect('user/home');
    }

    private function is_within_time($current_time, $scheduled_time)
    {
        $scheduled_time = strtotime($scheduled_time);
        $start_time = date('H:i:s', strtotime('-30 minutes', $scheduled_time));
        $end_time = date('H:i:s', strtotime('+30 minutes', $scheduled_time));
        return $current_time >= $start_time && $current_time <= $end_time;
    }

    public function submit_izin()
    {
        $id_karyawan = $this->session->userdata('id_karyawan');
        $nama = $this->session->userdata('nama');
        $tipe_izin = $this->input->post('tipe_izin');
        $keterangan = $this->input->post('keterangan');
        $tanggal = date('Y-m-d');

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
        $config['max_size'] = 5048;
        $this->load->library('upload', $config);

        $bukti = null;
        if ($this->upload->do_upload('bukti')) {
            $upload_data = $this->upload->data();
            $bukti = $upload_data['file_name'];
        } else {
            if (!empty($_FILES['bukti']['name'])) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('absensi/izin');
            }
        }

        $data = [
            'id_karyawan' => $id_karyawan,
            'tanggal' => $tanggal,
            'tipe_izin' => $tipe_izin,
            'keterangan' => $keterangan,
            'bukti' => $bukti
        ];

        $this->Izin_model->insert_izin($data);

        $this->session->set_flashdata('success', 'Izin berhasil diajukan!');
        redirect('user/home');
    }

    public function izin()
    {
        if (!$this->session->userdata('id_karyawan')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('auth/login');
        }

        $data['nama'] = $this->session->userdata('nama');
        $this->load->view('izin', $data);
    }

    public function home()
    {
        if (!$this->session->userdata('id_karyawan')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('auth/login');
        }

        $id_karyawan = $this->session->userdata('id_karyawan');

        $data['absensi'] = $this->Absensi_model->get_absensi_by_karyawan($id_karyawan);
        $data['izin'] = $this->Izin_model->get_izin_by_karyawan($id_karyawan);

        $this->load->view('home', $data);
    }
}

