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

  public function form_kebutuhan_komunikasi_edukasi()
  {
    $no_rawat = $this->input->get_post('no_rwt');
    $mode     = $this->input->get_post('mode');

    $data['no_rawat'] = $no_rawat;
    $data['pf']       = $this->db->get_where('kebutuhan_komunikasi_edukasi', ['no_rawat' => $no_rawat])->row();
    $data['mode']     = $mode;

    $this->load->view('asesmenrd/form-kebutuhan-komunikasi-edukasi', $data);
  }

  public function form_daftar_masalah_keperawatan()
  {
    $no_rawat = $this->input->get_post('no_rwt');
    $mode     = $this->input->get_post('mode');

    $data['no_rawat'] = $no_rawat;
    $data['pf']       = $this->db->get_where('daftar_masalah_keperawatan', ['no_rawat' => $no_rawat])->row();
    $data['mode']     = $mode;

    $this->load->view('asesmenrd/form-daftar-masalah-keperawatan', $data);
  }

  public function form_pengkajian_resiko_pasien_jatuh_dewasa()
  {
    $no_rawat = $this->input->get_post('no_rwt');
    $mode     = $this->input->get_post('mode');

    $data['no_rawat'] = $no_rawat;
    $data['pasien']   = $this->db->get_where('kunjungan', ['no_rawat' => $no_rawat])->row();
    $data['mode']     = $mode;
    $data['pf']       = null;
    $data['intervensi'] = [];

    // Query tabel asesmen jika ada
    $this->db->db_debug = false;
    $query = $this->db->get_where('asesmen_resiko_jatuh_dewasa', ['no_rawat' => $no_rawat]);
    if ($query) {
      $data['pf'] = $query->row();
    }

    // Query tabel intervensi jika ada
    if (!empty($data['pf'])) {
      $query2 = $this->db->where('id_pengkajian', $data['pf']->id)
        ->order_by('tgl_tindakan', 'ASC')
        ->order_by('shift', 'ASC')
        ->get('intervensi_jatuh');
      if ($query2) {
        $data['intervensi'] = $query2->result();
      }
    }
    $this->db->db_debug = (ENVIRONMENT !== 'production');

    $this->load->view('asesmenrd/form-pengkajian-resiko-pasien-jatuh-dewasa', $data);
  }

  public function form_penilaian_tingkat_nyeri_ccpot()
  {
    $no_rawat = $this->input->get_post('no_rwt');
    $mode     = $this->input->get_post('mode');

    $data['no_rawat'] = $no_rawat;
    $data['pf']       = $this->db->get_where('tingkat_penilaian_nyeri_cpot', ['no_rawat' => $no_rawat])->row();
    $data['mode']     = $mode;

    $this->load->view('asesmenrd/form-penilaian-tingkat-nyeri-ccpot', $data);
  }

  // ==================== Penilaian Tingkat Nyeri CPOT ====================

  public function simpan_penilaian_tingkat_nyeri_ccpot()
  {
    $this->output->set_content_type('application/json');

    $no_rawat = $this->input->post('no_rawat');
    if (empty($no_rawat)) {
      echo json_encode(['status' => false, 'message' => 'No. Rawat tidak boleh kosong']);
      return;
    }

    $data = $this->_penilaian_nyeri_cpot_data($no_rawat);

    $this->db->db_debug = false;
    if ($this->db->insert('tingkat_penilaian_nyeri_cpot', $data)) {
      $response = ['status' => true, 'message' => 'Data penilaian tingkat nyeri CPOT berhasil disimpan'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menyimpan data: ' . $error['message']];
    }
    $this->db->db_debug = (ENVIRONMENT !== 'production');
    echo json_encode($response);
  }

  public function update_penilaian_tingkat_nyeri_ccpot()
  {
    $this->output->set_content_type('application/json');

    $no_rawat = $this->input->post('no_rawat');
    $id       = $this->input->post('id');

    if (empty($no_rawat) || empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $data = $this->_penilaian_nyeri_cpot_data($no_rawat);

    $this->db->db_debug = false;
    $this->db->where('id', $id);
    if ($this->db->update('tingkat_penilaian_nyeri_cpot', $data)) {
      $response = ['status' => true, 'message' => 'Data penilaian tingkat nyeri CPOT berhasil diperbarui'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal memperbarui data: ' . $error['message']];
    }
    $this->db->db_debug = (ENVIRONMENT !== 'production');
    echo json_encode($response);
  }

  public function hapus_penilaian_tingkat_nyeri_ccpot()
  {
    $this->output->set_content_type('application/json');

    $id = $this->input->post('id');
    if (empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $this->db->db_debug = false;
    $this->db->where('id', $id);
    if ($this->db->delete('tingkat_penilaian_nyeri_cpot')) {
      $response = ['status' => true, 'message' => 'Data penilaian tingkat nyeri CPOT berhasil dihapus'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menghapus data: ' . $error['message']];
    }
    $this->db->db_debug = (ENVIRONMENT !== 'production');
    echo json_encode($response);
  }

  private function _penilaian_nyeri_cpot_data($no_rawat)
  {
    $ekspresi_wajah = (int) $this->input->post('ekspresi_wajah');
    $gerakan_tubuh  = (int) $this->input->post('gerakan_tubuh');
    $ketegangan_otot = (int) $this->input->post('ketegangan_otot');

    $jenis_ventilator = $this->input->post('jenis_ventilator');

    if ($jenis_ventilator === 'penerimaan_ventilator') {
      $penerimaan_ventilator = (int) $this->input->post('penerimaan_ventilator');
      $tanpa_ventilator      = null;
      $skor_ventilator       = $penerimaan_ventilator;
    } else {
      $penerimaan_ventilator = null;
      $tanpa_ventilator      = (int) $this->input->post('tanpa_ventilator');
      $skor_ventilator       = $tanpa_ventilator;
    }

    $total_skor = $ekspresi_wajah + $gerakan_tubuh + $skor_ventilator + $ketegangan_otot;

    // Kategori berdasarkan skor
    if ($total_skor === 0) {
      $kategori = 'Tidak Nyeri';
    } elseif ($total_skor <= 2) {
      $kategori = 'Nyeri Ringan';
    } elseif ($total_skor <= 4) {
      $kategori = 'Nyeri Sedang';
    } elseif ($total_skor <= 6) {
      $kategori = 'Nyeri Berat';
    } else {
      $kategori = 'Nyeri Berat Sekali';
    }

    return [
      'no_rawat'               => $no_rawat,
      'ekspresi_wajah'         => $ekspresi_wajah,
      'gerakan_tubuh'          => $gerakan_tubuh,
      'ketegangan_otot'        => $ketegangan_otot,
      'penerimaan_ventilator'  => $penerimaan_ventilator,
      'tanpa_ventilator'       => $tanpa_ventilator,
      'total_skor'             => $total_skor,
      'kategori_resiko'        => $kategori,
    ];
  }

  // ==================== SIMPAN Asesmen Jatuh Dewasa ====================

  public function simpan_asesmen_jatuh_dewasa()
  {
    $this->output->set_content_type('application/json');

    try {
      $no_rawat = $this->input->post('no_rawat');
      if (empty($no_rawat)) {
        echo json_encode(['status' => false, 'message' => 'No. Rawat tidak boleh kosong']);
        return;
      }

      $data = $this->_asesmen_jatuh_dewasa_data($no_rawat);

      $this->db->db_debug = false;
      if ($this->db->insert('asesmen_resiko_jatuh_dewasa', $data)) {
        $response = ['status' => true, 'message' => 'Data asesmen resiko jatuh berhasil disimpan'];
      } else {
        $error = $this->db->error();
        $response = ['status' => false, 'message' => 'Gagal menyimpan data: ' . $error['message']];
      }
      $this->db->db_debug = (ENVIRONMENT !== 'production');
      echo json_encode($response);
    } catch (\Exception $e) {
      echo json_encode(['status' => false, 'message' => 'Server error: ' . $e->getMessage()]);
    }
  }

  public function update_asesmen_jatuh_dewasa()
  {
    $this->output->set_content_type('application/json');

    try {
      $id       = $this->input->post('id');
      $no_rawat = $this->input->post('no_rawat');

      if (empty($id) || empty($no_rawat)) {
        echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
        return;
      }

      $data = $this->_asesmen_jatuh_dewasa_data($no_rawat);

      $this->db->db_debug = false;
      $this->db->where('id', $id);
      if ($this->db->update('asesmen_resiko_jatuh_dewasa', $data)) {
        $response = ['status' => true, 'message' => 'Data asesmen resiko jatuh berhasil diperbarui'];
      } else {
        $error = $this->db->error();
        $response = ['status' => false, 'message' => 'Gagal memperbarui data: ' . $error['message']];
      }
      $this->db->db_debug = (ENVIRONMENT !== 'production');
      echo json_encode($response);
    } catch (\Exception $e) {
      echo json_encode(['status' => false, 'message' => 'Server error: ' . $e->getMessage()]);
    }
  }

  public function hapus_asesmen_jatuh_dewasa()
  {
    $this->output->set_content_type('application/json');

    $id = $this->input->post('id');
    if (empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $this->db->db_debug = false;
    $this->db->where('id', $id);
    if ($this->db->delete('asesmen_resiko_jatuh_dewasa')) {
      $response = ['status' => true, 'message' => 'Data asesmen resiko jatuh berhasil dihapus'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menghapus data: ' . $error['message']];
    }
    $this->db->db_debug = (ENVIRONMENT !== 'production');
    echo json_encode($response);
  }

  private function _asesmen_jatuh_dewasa_data($no_rawat)
  {
    // Format tanggal_asesmen: datetime-local mengirim 2026-03-03T10:30
    $tgl_asesmen = $this->input->post('tanggal_asesmen');
    if ($tgl_asesmen) {
      $tgl_asesmen = str_replace('T', ' ', $tgl_asesmen);
    } else {
      $tgl_asesmen = date('Y-m-d H:i:s');
    }

    $data = [
      'no_rawat'         => $no_rawat,
      'no_rkm_medis'     => $this->input->post('no_rkm_medis'),
      'tanggal_asesmen'  => $tgl_asesmen,
      'perawat_penilai'  => $this->input->post('perawat_penilai'),
      'paraf_perawat'    => $this->input->post('paraf_perawat'),
    ];

    for ($sn = 1; $sn <= 3; $sn++) {
      $tgl = $this->input->post("tgl_{$sn}");
      $data["tgl_{$sn}"] = !empty($tgl) ? $tgl : null;

      $rj = $this->input->post("skor{$sn}_riwayat_jatuh");
      $ds = $this->input->post("skor{$sn}_diagnosa_sekunder");
      $ab = $this->input->post("skor{$sn}_alat_bantu");
      $ti = $this->input->post("skor{$sn}_terpasang_infus");
      $cb = $this->input->post("skor{$sn}_cara_berjalan");
      $sm = $this->input->post("skor{$sn}_status_mental");

      // Cek apakah ada minimal satu parameter skor yang diisi
      $has_any_value = ($rj !== null && $rj !== false) ||
        ($ds !== null && $ds !== false) ||
        ($ab !== null && $ab !== false) ||
        ($ti !== null && $ti !== false) ||
        ($cb !== null && $cb !== false) ||
        ($sm !== null && $sm !== false);

      // Jika tidak ada data skor sama sekali, set semua null
      if (!$has_any_value && $sn > 1) {
        $data["skor{$sn}_riwayat_jatuh"]     = null;
        $data["skor{$sn}_diagnosa_sekunder"]  = null;
        $data["skor{$sn}_alat_bantu"]         = null;
        $data["skor{$sn}_terpasang_infus"]    = null;
        $data["skor{$sn}_cara_berjalan"]      = null;
        $data["skor{$sn}_status_mental"]      = null;
        $data["skor{$sn}_total"]              = null;
        $data["skor{$sn}_kategori"]           = null;
        $data["pilih_setelah_{$sn}"]          = null;
      } else {
        $rj_val = ($rj !== null && $rj !== false) ? (int) $rj : 0;
        $ds_val = ($ds !== null && $ds !== false) ? (int) $ds : 0;
        $ab_val = ($ab !== null && $ab !== false) ? (int) $ab : 0;
        $ti_val = ($ti !== null && $ti !== false) ? (int) $ti : 0;
        $cb_val = ($cb !== null && $cb !== false) ? (int) $cb : 0;
        $sm_val = ($sm !== null && $sm !== false) ? (int) $sm : 0;

        $total = $rj_val + $ds_val + $ab_val + $ti_val + $cb_val + $sm_val;

        if ($total > 45) {
          $kategori = 'RT';
        } elseif ($total >= 25) {
          $kategori = 'RS';
        } else {
          $kategori = 'RR';
        }

        $data["skor{$sn}_riwayat_jatuh"]     = $rj_val;
        $data["skor{$sn}_diagnosa_sekunder"]  = $ds_val;
        $data["skor{$sn}_alat_bantu"]         = $ab_val;
        $data["skor{$sn}_terpasang_infus"]    = $ti_val;
        $data["skor{$sn}_cara_berjalan"]      = $cb_val;
        $data["skor{$sn}_status_mental"]      = $sm_val;
        $data["skor{$sn}_total"]              = $total;
        $data["skor{$sn}_kategori"]           = $kategori;
        $data["pilih_setelah_{$sn}"]          = $this->input->post("pilih_setelah_{$sn}") ?: $kategori;
      }
    }

    return $data;
  }

  // ==================== Intervensi Jatuh ====================

  public function simpan_intervensi_jatuh()
  {
    $this->output->set_content_type('application/json');

    $id_pengkajian = $this->input->post('id_pengkajian');
    if (empty($id_pengkajian)) {
      echo json_encode(['status' => false, 'message' => 'Data pengkajian tidak valid']);
      return;
    }

    $data = [
      'id_pengkajian'          => (int) $id_pengkajian,
      'tgl_tindakan'           => $this->input->post('tgl_tindakan') ?: date('Y-m-d'),
      'shift'                  => $this->input->post('shift'),
      'nama_perawat_shift'     => $this->input->post('nama_perawat_shift'),
      'paraf_perawat_shift'    => $this->input->post('paraf_perawat_shift'),

      // RT
      'rt_saran_bantuan'       => $this->input->post('rt_saran_bantuan') ? 1 : 0,
      'rt_tempatkan_bel'       => $this->input->post('rt_tempatkan_bel') ? 1 : 0,
      'rt_posisi_tidur_roda'   => $this->input->post('rt_posisi_tidur_roda') ? 1 : 0,
      'rt_gelang_resiko'       => $this->input->post('rt_gelang_resiko') ? 1 : 0,
      'rt_segitiga_kuning'     => $this->input->post('rt_segitiga_kuning') ? 1 : 0,
      'rt_pegangan_tangan'     => $this->input->post('rt_pegangan_tangan') ? 1 : 0,
      'rt_kamar_mandi_pispot'  => $this->input->post('rt_kamar_mandi_pispot') ? 1 : 0,
      'rt_observasi_2_3_jam'   => $this->input->post('rt_observasi_2_3_jam') ? 1 : 0,
      'rt_orientasi_kamar'     => $this->input->post('rt_orientasi_kamar') ? 1 : 0,
      'rt_pantau_efek_obat'    => $this->input->post('rt_pantau_efek_obat') ? 1 : 0,
      'rt_bantu_ambulasi'      => $this->input->post('rt_bantu_ambulasi') ? 1 : 0,
      'rt_benda_dekat_pasien'  => $this->input->post('rt_benda_dekat_pasien') ? 1 : 0,
      'rt_lantai_bersih_kering' => $this->input->post('rt_lantai_bersih_kering') ? 1 : 0,

      // RS
      'rs_saran_bantuan'       => $this->input->post('rs_saran_bantuan') ? 1 : 0,
      'rs_tempatkan_bel'       => $this->input->post('rs_tempatkan_bel') ? 1 : 0,
      'rs_posisi_tidur_roda'   => $this->input->post('rs_posisi_tidur_roda') ? 1 : 0,
      'rs_pegangan_tangan'     => $this->input->post('rs_pegangan_tangan') ? 1 : 0,
      'rs_bantu_ambulasi'      => $this->input->post('rs_bantu_ambulasi') ? 1 : 0,
      'rs_benda_dekat_pasien'  => $this->input->post('rs_benda_dekat_pasien') ? 1 : 0,
      'rs_lantai_bersih_kering' => $this->input->post('rs_lantai_bersih_kering') ? 1 : 0,

      // RR
      'rr_monitor_tanda_vital'   => $this->input->post('rr_monitor_tanda_vital') ? 1 : 0,
      'rr_pengaman_tempat_tidur' => $this->input->post('rr_pengaman_tempat_tidur') ? 1 : 0,
    ];

    if ($this->db->insert('intervensi_jatuh', $data)) {
      $response = ['status' => true, 'message' => 'Intervensi pencegahan jatuh berhasil disimpan'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menyimpan intervensi: ' . $error['message']];
    }
    echo json_encode($response);
  }

  public function hapus_intervensi_jatuh()
  {
    $this->output->set_content_type('application/json');

    $id = $this->input->post('id_intervensi');
    if (empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $this->db->where('id_intervensi', $id);
    if ($this->db->delete('intervensi_jatuh')) {
      $response = ['status' => true, 'message' => 'Intervensi berhasil dihapus'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menghapus intervensi: ' . $error['message']];
    }
    echo json_encode($response);
  }

  // ==================== MASALAH KEPERAWATAN ====================

  public function simpan_masalah_keperawatan()
  {
    $this->output->set_content_type('application/json');

    $no_rawat = $this->input->post('no_rawat');
    if (empty($no_rawat)) {
      echo json_encode(['status' => false, 'message' => 'No. Rawat tidak boleh kosong']);
      return;
    }

    $data = $this->_masalah_keperawatan_data($no_rawat);

    if ($this->db->insert('daftar_masalah_keperawatan', $data)) {
      $response = ['status' => true, 'message' => 'Data masalah keperawatan berhasil disimpan'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menyimpan data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  public function update_masalah_keperawatan()
  {
    $this->output->set_content_type('application/json');

    $no_rawat = $this->input->post('no_rawat');
    $id       = $this->input->post('id');
    if (empty($no_rawat) || empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $data = $this->_masalah_keperawatan_data($no_rawat);

    $this->db->where('id', $id);
    if ($this->db->update('daftar_masalah_keperawatan', $data)) {
      $response = ['status' => true, 'message' => 'Data masalah keperawatan berhasil diperbarui'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal memperbarui data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  public function hapus_masalah_keperawatan()
  {
    $this->output->set_content_type('application/json');

    $id = $this->input->post('id');
    if (empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $this->db->where('id', $id);
    if ($this->db->delete('daftar_masalah_keperawatan')) {
      $response = ['status' => true, 'message' => 'Data masalah keperawatan berhasil dihapus'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menghapus data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  private function _masalah_keperawatan_data($no_rawat)
  {
    $masalah = $this->input->post('masalah_keperawatan');
    $masalah_str = is_array($masalah) ? implode(',', $masalah) : '';

    return [
      'no_rawat'               => $no_rawat,
      'masalah_keperawatan'    => $masalah_str,
      'masalah_keperawatan_a'  => $this->input->post('masalah_keperawatan_a') ?: null,
      'masalah_keperawatan_b'  => $this->input->post('masalah_keperawatan_b') ?: null,
      'masalah_keperawatan_c'  => $this->input->post('masalah_keperawatan_c') ?: null,
      'masalah_keperawatan_d'  => $this->input->post('masalah_keperawatan_d') ?: null,
      'masalah_keperawatan_e'  => $this->input->post('masalah_keperawatan_e') ?: null,
    ];
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

  // ==================== Pengkajian Decubitus ====================

  public function form_pengkajian_decubitus()
  {
    $no_rawat = $this->input->get_post('no_rwt');
    $mode     = $this->input->get_post('mode');

    $data['no_rawat'] = $no_rawat;
    $data['pf']       = $this->db->get_where('pengkajian_decubitus', ['no_rawat' => $no_rawat])->row();
    $data['mode']     = $mode;

    $this->load->view('asesmenrd/form-pengkajian-decubitus', $data);
  }

  public function simpan_pengkajian_decubitus()
  {
    $this->output->set_content_type('application/json');

    $no_rawat = $this->input->post('no_rawat');
    if (empty($no_rawat)) {
      echo json_encode(['status' => false, 'message' => 'No. Rawat tidak boleh kosong']);
      return;
    }

    $data = $this->_pengkajian_decubitus_data($no_rawat);

    if ($this->db->insert('pengkajian_decubitus', $data)) {
      echo json_encode(['status' => true, 'message' => 'Data pengkajian decubitus berhasil disimpan']);
    } else {
      $error = $this->db->error();
      echo json_encode(['status' => false, 'message' => 'Gagal menyimpan data: ' . $error['message']]);
    }
  }

  public function update_pengkajian_decubitus()
  {
    $this->output->set_content_type('application/json');

    $no_rawat = $this->input->post('no_rawat');
    $id       = $this->input->post('id');

    if (empty($no_rawat) || empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $data = $this->_pengkajian_decubitus_data($no_rawat);

    $this->db->where('id', $id);
    if ($this->db->update('pengkajian_decubitus', $data)) {
      echo json_encode(['status' => true, 'message' => 'Data pengkajian decubitus berhasil diperbarui']);
    } else {
      $error = $this->db->error();
      echo json_encode(['status' => false, 'message' => 'Gagal memperbarui data: ' . $error['message']]);
    }
  }

  public function hapus_pengkajian_decubitus()
  {
    $this->output->set_content_type('application/json');

    $id = $this->input->post('id');
    if (empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $this->db->where('id', $id);
    if ($this->db->delete('pengkajian_decubitus')) {
      $response = ['status' => true, 'message' => 'Data pengkajian decubitus berhasil dihapus'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menghapus data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  private function _pengkajian_decubitus_data($no_rawat)
  {
    $persepsi_sensori = (int) $this->input->post('persepsi_sensori');
    $kelembaban       = (int) $this->input->post('kelembaban');
    $aktifitas        = (int) $this->input->post('aktifitas');
    $mobilitas        = (int) $this->input->post('mobilitas');
    $nutrisi          = (int) $this->input->post('nutrisi');
    $gesekan          = (int) $this->input->post('gesekan');

    $total_skor = $persepsi_sensori + $kelembaban + $aktifitas + $mobilitas + $nutrisi + $gesekan;

    // Kategori resiko berdasarkan skor Braden
    if ($total_skor <= 9) {
      $kategori_resiko = 'Resiko Tinggi';
    } elseif ($total_skor <= 12) {
      $kategori_resiko = 'Resiko Sedang';
    } elseif ($total_skor <= 14) {
      $kategori_resiko = 'Resiko Rendah';
    } else {
      $kategori_resiko = 'Tidak Ada Resiko';
    }

    return [
      'no_rawat'        => $no_rawat,
      'persepsi_sensori' => $persepsi_sensori,
      'kelembaban'      => $kelembaban,
      'aktifitas'       => $aktifitas,
      'mobilitas'       => $mobilitas,
      'nutrisi'         => $nutrisi,
      'gesekan'         => $gesekan,
      'total_skor'      => $total_skor,
      'kategori_resiko' => $kategori_resiko,
    ];
  }

  public function simpan_kebutuhan_komunikasi_edukasi()
  {
    $this->output->set_content_type('application/json');

    $no_rawat = $this->input->post('no_rawat');
    if (empty($no_rawat)) {
      echo json_encode(['status' => false, 'message' => 'No. Rawat tidak boleh kosong']);
      return;
    }

    $data = $this->_kebutuhan_komunikasi_edukasi_data($no_rawat);

    if ($this->db->insert('kebutuhan_komunikasi_edukasi', $data)) {
      $response = ['status' => true, 'message' => 'Data kebutuhan komunikasi dan edukasi berhasil disimpan'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menyimpan data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  public function update_kebutuhan_komunikasi_edukasi()
  {
    $this->output->set_content_type('application/json');
    $no_rawat = $this->input->post('no_rawat');
    $id       = $this->input->post('id');
    if (empty($no_rawat) || empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $data = $this->_kebutuhan_komunikasi_edukasi_data($no_rawat);

    $this->db->where('id', $id);
    if ($this->db->update('kebutuhan_komunikasi_edukasi', $data)) {
      $response = ['status' => true, 'message' => 'Data kebutuhan komunikasi dan edukasi berhasil diperbarui'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal memperbarui data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  public function hapus_kebutuhan_komunikasi_edukasi()
  {
    $this->output->set_content_type('application/json');

    $id = $this->input->post('id');
    if (empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $this->db->where('id', $id);
    if ($this->db->delete('kebutuhan_komunikasi_edukasi')) {
      $response = ['status' => true, 'message' => 'Data kebutuhan komunikasi dan edukasi berhasil dihapus'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menghapus data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  private function _kebutuhan_komunikasi_edukasi_data($no_rawat)
  {
    $edukasi = $this->input->post('edukasi_diberikan');
    if (is_array($edukasi)) {
      $edukasi = implode(',', $edukasi);
    }

    $bahasa_sehari = $this->input->post('bahasa_sehari');
    if (is_array($bahasa_sehari)) {
      $bahasa_sehari = implode(',', $bahasa_sehari);
    }

    $hambatan_edukasi = $this->input->post('hambatan_edukasi');
    if (is_array($hambatan_edukasi)) {
      $hambatan_edukasi = implode(',', $hambatan_edukasi);
    }

    $keyakinan          = $this->input->post('keyakinan_penyakit') ?: 'Yakin Sembuh';
    $bicara             = $this->input->post('bicara') ?: 'Normal';
    $perlu_penerjemah   = $this->input->post('perlu_penerjemah') ?: 'Tidak';
    $tingkat_pendidikan = $this->input->post('tingkat_pendidikan') ?: 'SLTA';
    $menerima_info      = $this->input->post('pasien_keluarga_menerima_informasi') ?: 'Ya';

    $bahasa_arr = $bahasa_sehari ? explode(',', $bahasa_sehari) : [];

    return [
      'no_rawat'                                  => $no_rawat,
      'edukasi_diberikan'                         => $edukasi ?: null,
      'edukasi_diberikan_rs'                      => in_array('Perawatan di RS', explode(',', $edukasi ?: '')) ? $this->input->post('edukasi_diberikan_rs') : null,
      'edukasi_diberikan_lain_lain'               => in_array('Lain-lain', explode(',', $edukasi ?: '')) ? $this->input->post('edukasi_diberikan_lain_lain') : null,
      'keyakinan_penyakit'                        => $keyakinan,
      'keyakinan_penyakit_lainnya'                => $keyakinan === 'Lain-lain' ? $this->input->post('keyakinan_penyakit_lainnya') : '',
      'bicara'                                    => $bicara,
      'gangguan_bicara_sejak'                     => $bicara === 'Gangguan Bicara' ? $this->input->post('gangguan_bicara_sejak') : null,
      'bahasa_sehari'                             => $bahasa_sehari ?: 'Indonesia',
      'indonesia_ap'                              => $this->input->post('indonesia_ap') ?: 'aktif',
      'inggris_ap'                                => $this->input->post('inggris_ap') ?: 'aktif',
      'daerah_jelaskan'                           => in_array('Daerah', $bahasa_arr) ? $this->input->post('daerah_jelaskan') : null,
      'lain_jelaskan'                             => in_array('Lain-lain', $bahasa_arr) ? $this->input->post('lain_jelaskan') : null,
      'perlu_penerjemah'                          => $perlu_penerjemah,
      'ya_bahasa'                                 => $perlu_penerjemah === 'Ya' ? $this->input->post('ya_bahasa') : '',
      'bs_ya_tidak'                               => $this->input->post('bs_ya_tidak') ?: 'Tidak',
      'hambatan_edukasi'                          => $hambatan_edukasi ?: null,
      'hambatan_edukasi_lainnya'                  => $this->input->post('hambatan_edukasi_lainnya') ?: '',
      'tingkat_pendidikan'                        => $tingkat_pendidikan,
      'tingkat_pendidikan_lainnya'                => $tingkat_pendidikan === 'Lain-lain' ? $this->input->post('tingkat_pendidikan_lainnya') : '',
      'pasien_keluarga_menerima_informasi'        => $menerima_info,
      'pasien_keluarga_menerima_informasi_lainnya' => $menerima_info === 'Tidak' ? $this->input->post('pasien_keluarga_menerima_informasi_lainnya') : '',
    ];
  }
  // ==================== Penilaian Barthel Index ====================

  public function form_penilaian_barthel()
  {
    $no_rawat = $this->input->get_post('no_rwt');
    $mode     = $this->input->get_post('mode');
    $id       = $this->input->get_post('id');

    $data['no_rawat'] = $no_rawat;
    $data['mode']     = $mode;

    // Get all records for this patient
    $data['list_pf'] = $this->db->where('no_rawat', $no_rawat)
      ->order_by('tgl_pengkajian', 'DESC')
      ->get('penilaian_barthel')
      ->result();

    // Get single record if editing
    $data['pf'] = null;
    if ($id && $mode === 'edit') {
      $data['pf'] = $this->db->get_where('penilaian_barthel', ['id_penilaian' => $id])->row();
    }

    $this->load->view('asesmenrd/form-penilaian-barthel', $data);
  }

  public function simpan_penilaian_barthel()
  {
    $this->output->set_content_type('application/json');

    $no_rawat = $this->input->post('no_rawat');
    if (empty($no_rawat)) {
      echo json_encode(['status' => false, 'message' => 'No. Rawat tidak boleh kosong']);
      return;
    }

    $data = $this->_penilaian_barthel_data($no_rawat);

    if ($this->db->insert('penilaian_barthel', $data)) {
      $response = ['status' => true, 'message' => 'Data penilaian Barthel Index berhasil disimpan'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menyimpan data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  public function update_penilaian_barthel()
  {
    $this->output->set_content_type('application/json');

    $no_rawat = $this->input->post('no_rawat');
    $id       = $this->input->post('id_penilaian');

    if (empty($no_rawat) || empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $data = $this->_penilaian_barthel_data($no_rawat);

    $this->db->where('id_penilaian', $id);
    if ($this->db->update('penilaian_barthel', $data)) {
      $response = ['status' => true, 'message' => 'Data penilaian Barthel Index berhasil diperbarui'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal memperbarui data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  public function hapus_penilaian_barthel()
  {
    $this->output->set_content_type('application/json');

    $id = $this->input->post('id_penilaian');
    if (empty($id)) {
      echo json_encode(['status' => false, 'message' => 'Data tidak valid']);
      return;
    }

    $this->db->where('id_penilaian', $id);
    if ($this->db->delete('penilaian_barthel')) {
      $response = ['status' => true, 'message' => 'Data penilaian Barthel Index berhasil dihapus'];
    } else {
      $error = $this->db->error();
      $response = ['status' => false, 'message' => 'Gagal menghapus data: ' . $error['message']];
    }
    echo json_encode($response);
  }

  private function _penilaian_barthel_data($no_rawat)
  {
    $skor_defekasi     = (int) $this->input->post('skor_defekasi');
    $skor_berkemih     = (int) $this->input->post('skor_berkemih');
    $skor_bersih_diri  = (int) $this->input->post('skor_bersih_diri');
    $skor_toilet       = (int) $this->input->post('skor_toilet');
    $skor_makan        = (int) $this->input->post('skor_makan');
    $skor_pindah_tempat = (int) $this->input->post('skor_pindah_tempat');
    $skor_mobilisasi   = (int) $this->input->post('skor_mobilisasi');
    $skor_berpakaian   = (int) $this->input->post('skor_berpakaian');
    $skor_tangga       = (int) $this->input->post('skor_tangga');
    $skor_mandi        = (int) $this->input->post('skor_mandi');

    $total_skor = $skor_defekasi + $skor_berkemih + $skor_bersih_diri + $skor_toilet +
      $skor_makan + $skor_pindah_tempat + $skor_mobilisasi + $skor_berpakaian +
      $skor_tangga + $skor_mandi;

    return [
      'no_rawat'          => $no_rawat,
      'tgl_pengkajian'    => $this->input->post('tgl_pengkajian') ?: date('Y-m-d'),
      'periode'           => $this->input->post('periode'),
      'skor_defekasi'     => $skor_defekasi,
      'skor_berkemih'     => $skor_berkemih,
      'skor_bersih_diri'  => $skor_bersih_diri,
      'skor_toilet'       => $skor_toilet,
      'skor_makan'        => $skor_makan,
      'skor_pindah_tempat' => $skor_pindah_tempat,
      'skor_mobilisasi'   => $skor_mobilisasi,
      'skor_berpakaian'   => $skor_berpakaian,
      'skor_tangga'       => $skor_tangga,
      'skor_mandi'        => $skor_mandi,
      'total_skor'        => $total_skor,
    ];
  }
}
