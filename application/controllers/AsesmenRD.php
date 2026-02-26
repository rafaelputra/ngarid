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

  public function form_riwayat_psikososial()
  {
    $no_rawat = $this->input->get_post('no_rwt');
    $mode     = $this->input->get_post('mode');

    $data['no_rawat'] = $no_rawat;
    $data['pf']       = $this->db->get_where('riwayat_psikososial', ['no_rawat' => $no_rawat])->row();
    $data['mode']     = $mode;

    $this->load->view('asesmenrd/form-riwayat-psikososial', $data);
  }

  public function form_penilaian_fisik()
  {
    $no_rawat = $this->input->get_post('no_rwt');
    $mode     = $this->input->get_post('mode');

    $data['no_rawat'] = $no_rawat;
    $data['pf']       = $this->db->get_where('penilaian_fisik', ['no_rawat' => $no_rawat])->row();
    $data['mode']     = $mode;

    $this->load->view('asesmenrd/form-penilaian-fisik', $data);
  }

  public function form_pasien_obstetri_gynekologi()
  {
    $no_rawat = $this->input->get_post('no_rwt');
    $mode     = $this->input->get_post('mode');

    $data['no_rawat'] = $no_rawat;
    $data['pf']       = $this->db->get_where('obstetri', ['no_rawat' => $no_rawat])->row();
    $data['mode']     = $mode;

    $this->load->view('asesmenrd/form-pasien-obstetri-gynekologi', $data);
  }

  public function form_pengkajian_status_nutrisi()
  {
    $no_rawat = $this->input->get_post('no_rwt');
    $mode     = $this->input->get_post('mode');

    $data['no_rawat'] = $no_rawat;
    $data['pf']       = $this->db->get_where('status_nutrisi', ['no_rawat' => $no_rawat])->row();
    $data['mode']     = $mode;

    $this->load->view('asesmenrd/form-pengkajian-status-nutrisi', $data);
  }

  // ==================== SIMPAN DATA ====================

  public function simpan_penilaian_fisik()
  {
    $this->output->set_content_type('application/json');

    $no_rawat = $this->input->post('no_rawat');
    if (empty($no_rawat)) {
      echo json_encode(['status' => false, 'message' => 'No. Rawat tidak boleh kosong']);
      return;
    }

    $data = $this->_penilaian_fisik_data($no_rawat);

    if ($this->db->insert('penilaian_fisik', $data)) {
      $response = ['status' => true, 'message' => 'Data penilaian fisik berhasil disimpan'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menyimpan data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  public function update_penilaian_fisik()
  {
    $this->output->set_content_type('application/json');

    $no_rawat = $this->input->post('no_rawat');
    $id       = $this->input->post('id');
    if (empty($no_rawat) || empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $data = $this->_penilaian_fisik_data($no_rawat);

    $this->db->where('id', $id);
    if ($this->db->update('penilaian_fisik', $data)) {
      $response = ['status' => true, 'message' => 'Data penilaian fisik berhasil diperbarui'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal memperbarui data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  public function hapus_penilaian_fisik()
  {
    $this->output->set_content_type('application/json');

    $id = $this->input->post('id');
    if (empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $this->db->where('id', $id);
    if ($this->db->delete('penilaian_fisik')) {
      $response = ['status' => true, 'message' => 'Data penilaian fisik berhasil dihapus'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menghapus data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  private function _penilaian_fisik_data($no_rawat)
  {
    return [
      'no_rawat'                    => $no_rawat,
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
  }
}
