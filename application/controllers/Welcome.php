<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function index()
    {
        $data['kunjungan'] = $this->db->order_by('tgl_registrasi', 'DESC')->get('kunjungan')->result();
        $this->load->view('template/header');
        $this->load->view('welcome', $data);
        $this->load->view('template/footer');
    }
}
