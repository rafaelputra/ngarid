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

  // ==================== PENILAIAN FISIK ====================

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

  // ==================== Obstetri ====================
  public function simpan_pasien_obstetri_gynekologi()
  {
    $this->output->set_content_type('application/json');

    $no_rawat = $this->input->post('no_rawat');
    if (empty($no_rawat)) {
      echo json_encode(['status' => false, 'message' => 'No. Rawat tidak boleh kosong']);
      return;
    }

    $data = $this->_obstetri_data($no_rawat);

    if ($this->db->insert('obstetri', $data)) {
      $response = ['status' => true, 'message' => 'Data obstetri berhasil disimpan'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menyimpan data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  public function update_pasien_obstetri_gynekologi()
  {
    $this->output->set_content_type('application/json');

    $no_rawat = $this->input->post('no_rawat');
    $id       = $this->input->post('id');
    if (empty($no_rawat) || empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $data = $this->_obstetri_data($no_rawat);

    $this->db->where('id', $id);
    if ($this->db->update('obstetri', $data)) {
      $response = ['status' => true, 'message' => 'Data obstetri berhasil diperbarui'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal memperbarui data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  public function hapus_obstetri()
  {
    $this->output->set_content_type('application/json');

    $id = $this->input->post('id');
    if (empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $this->db->where('id', $id);
    if ($this->db->delete('obstetri')) {
      $response = ['status' => true, 'message' => 'Data obstetri berhasil dihapus'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menghapus data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  private function _obstetri_data($no_rawat)
  {
    return [
      'no_rawat'                 => $no_rawat,
      'is_hamil'                 => $this->input->post('is_hamil') ?: 'Tidak',
      'hpht'                     => $this->input->post('hpht') ?: null,
      'hpl'                      => $this->input->post('hpl') ?: null,
      'usia_hamil'               => $this->input->post('usia_hamil') ?: null,
      'status_g'                 => $this->input->post('status_g'),
      'status_p'                 => $this->input->post('status_p'),
      'status_a'                 => $this->input->post('status_a'),
      'penyulit_kehamilan'       => $this->input->post('penyulit_kehamilan'),
      'detail_penyulit'          => $this->input->post('detail_penyulit'),
      'riwayat_mens'             => $this->input->post('riwayat_mens'),
      'post_partum'              => $this->input->post('post_partum') ?: 'Tidak',
      'post_partum_hari'         => $this->input->post('post_partum_hari') ?: null,
      'riwayat_persalinan'       => $this->input->post('riwayat_persalinan'),
      'partus_spontan_jelaskan'  => $this->input->post('partus_spontan_jelaskan'),
      'partus_tindakan_jelaskan' => $this->input->post('partus_tindakan_jelaskan'),
      'lochea'                   => $this->input->post('lochea'),
      'lochea_jumlah'            => $this->input->post('lochea_jumlah'),
      'payudara'                 => $this->input->post('payudara'),
      'pengeluaran_asi'          => $this->input->post('pengeluaran_asi'),
      'kontraksi'                => $this->input->post('kontraksi'),
      'riwayat_papsmear'         => $this->input->post('riwayat_papsmear'),
      'papsmear_tanggal'         => $this->input->post('papsmear_tanggal') ?: null,
      'papsmear_hasil'           => $this->input->post('papsmear_hasil'),
      'mammografi'               => $this->input->post('mammografi'),
      'mammografi_tanggal'       => $this->input->post('mammografi_tanggal') ?: null,
      'mammografi_hasil'         => $this->input->post('mammografi_hasil'),
      'sadari'                   => $this->input->post('sadari'),
      'sadari_tanggal'           => $this->input->post('sadari_tanggal') ?: null,
      'sadari_hasil'             => $this->input->post('sadari_hasil'),
      'informasi_tambahan'       => $this->input->post('informasi_tambahan'),
      'informasi_tambahan_ada'   => $this->input->post('informasi_tambahan_ada'),
    ];
  }


  // ==================== Riwayat Psikososial ====================
  private function _riwayat_psikososial_data($no_rawat)
  {
    $ditemukan = $this->input->post('ditemukan_kondisi');
    if (is_array($ditemukan)) {
      $ditemukan = implode(',', $ditemukan);
    }

    $perilaku = $this->input->post('adanya_perilaku');
    if (is_array($perilaku)) {
      $perilaku = implode(',', $perilaku);
    }

    $riwayat_gangguan_jiwa            = $this->input->post('riwayat_gangguan_jiwa') ? 1 : 0;
    $riwayat_keluarga_gangguan_jiwa   = $this->input->post('riwayat_keluarga_gangguan_jiwa') ? 1 : 0;
    $jenis_pembayaran                 = $this->input->post('jenis_pembayaran') ?: 'Umum';

    return [
      'no_rawat'                           => $no_rawat,
      'ditemukan_kondisi'                  => $ditemukan ?: null,
      'riwayat_gangguan_jiwa'              => $riwayat_gangguan_jiwa,
      'detail_gangguan_jiwa'               => $riwayat_gangguan_jiwa ? $this->input->post('detail_gangguan_jiwa') : null,
      'riwayat_keluarga_gangguan_jiwa'     => $riwayat_keluarga_gangguan_jiwa,
      'siapa_keluarga_gangguan_jiwa'       => $riwayat_keluarga_gangguan_jiwa ? $this->input->post('siapa_keluarga_gangguan_jiwa') : null,
      'adanya_perilaku'                    => $perilaku ?: null,
      'status_pernikahan'                  => $this->input->post('status_pernikahan') ?: 'Menikah',
      'tinggal_dengan'                     => $this->input->post('tinggal_dengan') ?: 'Orang Tua',
      'keluarga_terdekat'                  => $this->input->post('keluarga_terdekat'),
      'hubungan_keluarga'                  => $this->input->post('hubungan_keluarga'),
      'no_telp'                            => $this->input->post('no_telp'),
      'curiga_penganiayaan_penelantaran'   => $this->input->post('curiga_penganiayaan_penelantaran') ?: 'Tidak',
      'kegiatan_ibadah'                    => $this->input->post('kegiatan_ibadah'),
      'nilai_bertentangan_kesehatan'       => $this->input->post('nilai_bertentangan_kesehatan'),
      'jenis_pembayaran'                   => $jenis_pembayaran,
      'pembayaran_lain_lain'               => $jenis_pembayaran === 'Lain-lain' ? $this->input->post('pembayaran_lain_lain') : null,
    ];
  }

  public function simpan_riwayat_psikososial()
  {
    $this->output->set_content_type('application/json');
    $no_rawat = $this->input->post('no_rawat');
    if (empty($no_rawat)) {
      echo json_encode(['status' => false, 'message' => 'No. Rawat tidak boleh kosong']);
      return;
    }

    $data = $this->_riwayat_psikososial_data($no_rawat);
    if ($this->db->insert('riwayat_psikososial', $data)) {
      $response = ['status' => true, 'message' => 'Data riwayat psikososial berhasil disimpan'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menyimpan data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  public function hapus_riwayat_psikososial()
  {
    $this->output->set_content_type('application/json');

    $id = $this->input->post('id');
    if (empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $this->db->where('id', $id);
    if ($this->db->delete('riwayat_psikososial')) {
      $response = ['status' => true, 'message' => 'Data riwayat psikososial berhasil dihapus'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menghapus data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  public function update_riwayat_psikososial()
  {
    $this->output->set_content_type('application/json');
    $no_rawat = $this->input->post('no_rawat');
    $id       = $this->input->post('id');
    if (empty($no_rawat) || empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $data = $this->_riwayat_psikososial_data($no_rawat);
    $this->db->where('id', $id);
    if ($this->db->update('riwayat_psikososial', $data)) {
      $response = ['status' => true, 'message' => 'Data riwayat psikososial berhasil diperbarui'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal memperbarui data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  // ==================== Status Nutrisi ===================
  public function simpan_status_nutrisi()
  {
    $this->output->set_content_type('application/json');

    $no_rawat = $this->input->post('no_rawat');
    if (empty($no_rawat)) {
      echo json_encode(['status' => false, 'message' => 'No. Rawat tidak boleh kosong']);
      return;
    }

    $data = $this->_status_nutrisi_data($no_rawat);

    if ($this->db->insert('status_nutrisi', $data)) {
      $response = ['status' => true, 'message' => 'Data status nutrisi berhasil disimpan'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menyimpan data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  public function update_status_nutrisi()
  {
    $this->output->set_content_type('application/json');

    $no_rawat = $this->input->post('no_rawat');
    $id       = $this->input->post('id');
    if (empty($no_rawat) || empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $data = $this->_status_nutrisi_data($no_rawat);

    $this->db->where('id', $id);
    if ($this->db->update('status_nutrisi', $data)) {
      $response = ['status' => true, 'message' => 'Data status nutrisi berhasil diperbarui'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal memperbarui data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  private function _status_nutrisi_data($no_rawat)
  {
    $kondisi_khusus     = $this->input->post('kondisi_khusus') ?: 'Tidak';
    $kondisi_khusus_ya  = $kondisi_khusus === 'Ya' ? ($this->input->post('kondisi_khusus_ya') ?: 'DM') : 'DM';
    $diagnosa_khusus    = $this->input->post('diagnosa_khusus') ?: 'DM';
    $bb_skor            = (int) $this->input->post('penurunan_bb_skor');
    $bb_kesimpulan      = $bb_skor >= 2 ? 'Beresiko Malnutrisi' : 'Tidak Beresiko Malnutrisi';

    return [
      'no_rawat'                => $no_rawat,
      'penurunan_bb_opsi'       => $this->input->post('penurunan_bb_opsi'),
      'penurunan_bb_skor'       => $bb_skor,
      'penurunan_bb_kesimpulan' => $bb_kesimpulan,
      'asupan_makanan_dlo'      => $this->input->post('asupan_makanan_dlo'),
      'diagnosa_khusus'         => $diagnosa_khusus,
      'diagnosa_khusus_lainnya' => $diagnosa_khusus === 'Lain-lain' ? $this->input->post('diagnosa_khusus_lainnya') : null,
      'asupan_makanan_og'       => $this->input->post('asupan_makanan_og'),
      'ada_pertambahan'         => $this->input->post('ada_pertambahan'),
      'nilai_hb_hct'            => $this->input->post('nilai_hb_hct'),
      'kondisi_khusus'          => $kondisi_khusus,
      'kondisi_khusus_ya'       => $kondisi_khusus_ya,
      'kondisi_khusus_lainnya'  => ($kondisi_khusus === 'Ya' && $kondisi_khusus_ya === 'Lainnya') ? $this->input->post('kondisi_khusus_lainnya') : null,
      'kesimpulan_og'           => $this->input->post('kesimpulan_og'),
    ];
  }

  public function hapus_status_nutrisi()
  {
    $this->output->set_content_type('application/json');

    $id = $this->input->post('id');
    if (empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $this->db->where('id', $id);
    if ($this->db->delete('status_nutrisi')) {
      $response = ['status' => true, 'message' => 'Data status nutrisi berhasil dihapus'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menghapus data: ' . $error['message']];
    }
    echo json_encode($response);
  }
}
