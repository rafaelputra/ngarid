<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AsesmenRD extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $no_rawat = $this->input->get('no_rwt');
    if (empty($no_rawat)) {
      redirect(base_url());
      return;
    }

    $pasien = $this->db->get_where('kunjungan', ['no_rawat' => $no_rawat])->row();
    if (!$pasien) {
      show_404();
      return;
    }

    $data['no_rawat'] = $no_rawat;
    $data['pasien'] = $pasien;

    $this->load->view('template/header');
    $this->load->view('asesmenrd/index', $data);
    $this->load->view('template/footer');
  }

  // ==================== FORM LOADERS (AJAX) ====================

  public function form_asesmen_keperawatan()
  {
    $data['no_rawat'] = $this->input->get_post('no_rwt');
    $data['petugas'] = $this->_dummy_petugas();
    $this->load->view('asesmenrd/form-asesmen-keperawatan', $data);
  }

  public function form_skala_nyeri_wong_baker()
  {
    $data['no_rawat'] = $this->input->get_post('no_rwt');
    $data['petugas'] = $this->_dummy_petugas();
    $this->load->view('asesmenrd/form-skala-nyeri-wong-baker', $data);
  }

  public function form_pemeriksaan_fisik()
  {
    $data['no_rawat'] = $this->input->get_post('no_rwt');
    $data['petugas'] = $this->_dummy_petugas();
    $this->load->view('asesmenrd/form-pemeriksaan-fisik', $data);
  }

  public function form_risiko_jatuh()
  {
    $data['no_rawat'] = $this->input->get_post('no_rwt');
    $data['petugas'] = $this->_dummy_petugas();
    $this->load->view('asesmenrd/form-risiko-jatuh', $data);
  }

  public function form_pemeriksaan_penunjang()
  {
    $data['no_rawat'] = $this->input->get_post('no_rwt');
    $data['petugas'] = $this->_dummy_petugas();
    $this->load->view('asesmenrd/form-pemeriksaan-penunjang', $data);
  }

  public function form_status_gizi()
  {
    $data['no_rawat'] = $this->input->get_post('no_rwt');
    $data['petugas'] = $this->_dummy_petugas();
    $this->load->view('asesmenrd/form-status-gizi', $data);
  }

  public function form_psikososial()
  {
    $data['no_rawat'] = $this->input->get_post('no_rwt');
    $data['petugas'] = $this->_dummy_petugas();
    $this->load->view('asesmenrd/form-psikososial', $data);
  }

  public function form_asuhan_keperawatan()
  {
    $data['no_rawat'] = $this->input->get_post('no_rwt');
    $data['petugas'] = $this->_dummy_petugas();
    $this->load->view('asesmenrd/form-asuhan-keperawatan', $data);
  }

  public function form_kebutuhan_komunikasi_dan_edukasi()
  {
    $data['no_rawat'] = $this->input->get_post('no_rwt');
    $data['petugas'] = $this->_dummy_petugas();
    $this->load->view('asesmenrd/form-kebutuhan-komunikasi-dan-edukasi', $data);
  }

  public function form_evaluasi_meninggalkan_ruang()
  {
    $data['no_rawat'] = $this->input->get_post('no_rwt');
    $data['petugas'] = $this->_dummy_petugas();
    $this->load->view('asesmenrd/form-evaluasi-meninggalkan-ruang', $data);
  }

  public function form_tindak_lanjut_dan_pemulangan()
  {
    $data['no_rawat'] = $this->input->get_post('no_rwt');
    $data['petugas'] = $this->_dummy_petugas();
    $this->load->view('asesmenrd/form-tindak-lanjut-dan-pemulangan', $data);
  }

  // ==================== DUMMY DATA ====================

  private function _dummy_petugas()
  {
    $petugas = [];
    $names = [
      ['nip' => 'P001', 'nama' => 'Ns. Siti Aminah, S.Kep'],
      ['nip' => 'P002', 'nama' => 'Ns. Budi Santoso, S.Kep'],
      ['nip' => 'P003', 'nama' => 'Ns. Dewi Rahayu, S.Kep'],
    ];
    foreach ($names as $n) {
      $obj = new stdClass();
      $obj->nip = $n['nip'];
      $obj->nama = $n['nama'];
      $petugas[] = $obj;
    }
    return $petugas;
  }
}
