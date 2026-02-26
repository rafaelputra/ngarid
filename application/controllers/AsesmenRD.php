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

  public function form_penilaian_fisik()
  {
    $data['no_rawat'] = $this->input->get_post('no_rwt');
    $data['petugas'] = $this->_dummy_petugas();
    $this->load->view('asesmenrd/form-penilaian-fisik', $data);
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

  // ==================== SIMPAN DATA ====================

  public function simpan_penilaian_fisik()
  {
    $data = [
      'no_rawat'                    => $this->input->post('no_rawat'),
      'kunjungan_umum_gcs'          => $this->input->post('kunjungan_umum_gcs'),
      'kunjungan_umum_e'            => $this->input->post('kunjungan_umum_e'),
      'kunjungan_umum_v'            => $this->input->post('kunjungan_umum_v'),
      'kunjungan_umum_m'            => $this->input->post('kunjungan_umum_m'),
      'kunjungan_umum_total'        => $this->input->post('kunjungan_umum_total'),
      'tekanan_darah_sistolik'      => $this->input->post('tekanan_darah_sistolik'),
      'tekanan_darah_diastolik'     => $this->input->post('tekanan_darah_diastolik'),
      'nadi'                        => $this->input->post('nadi'),
      'spo2'                        => $this->input->post('spo2'),
      'suhu_tubuh'                  => $this->input->post('suhu_tubuh'),
      'respirasi'                   => $this->input->post('respirasi'),
      'gds'                         => $this->input->post('gds'),
      'tinggi_badan'                => $this->input->post('tinggi_badan'),
      'berat_badan'                 => $this->input->post('berat_badan'),
      'informasi_tambahan'          => $this->input->post('informasi_tambahan') ?: 0,
      'informasi_tambahan_jelaskan' => $this->input->post('informasi_tambahan_jelaskan'),
      'pernafasan'                  => $this->input->post('pernafasan'),
      'pernafasan_lainnya'          => $this->input->post('pernafasan_lainnya'),
      'penglihatan'                 => $this->input->post('penglihatan'),
      'penglihatan_alat_bantu'      => $this->input->post('penglihatan_alat_bantu'),
      'pendengaran'                 => $this->input->post('pendengaran'),
      'pendengaran_alat_bantu'      => $this->input->post('pendengaran_alat_bantu'),
      'mulut'                       => $this->input->post('mulut'),
      'mulut_lainnya'               => $this->input->post('mulut_lainnya'),
      'reflek'                      => $this->input->post('reflek'),
      'menelan'                     => $this->input->post('menelan'),
      'bicara'                      => $this->input->post('bicara'),
      'luka'                        => $this->input->post('luka') ?: 0,
      'luka_detail'                 => $this->input->post('luka_detail'),
      'defekasi'                    => $this->input->post('defekasi'),
      'milksi'                      => $this->input->post('milksi'),
      'gastrointestinal'            => $this->input->post('gastrointestinal'),
      'pola_tidur'                  => $this->input->post('pola_tidur') ?: 0,
      'pola_tidur_masalah'          => $this->input->post('pola_tidur_masalah'),
    ];

    if ($this->db->insert('penilaian_fisik', $data)) {
      $response = ['status' => true, 'message' => 'Data penilaian fisik berhasil disimpan'];
    } else {
      $response = ['status' => false, 'message' => 'Gagal menyimpan data'];
    }
    echo json_encode($response);
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
