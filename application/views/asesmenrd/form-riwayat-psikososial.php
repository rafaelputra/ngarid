<style>
  #form-assesment-global {
    font-size: 1rem;
  }

  #form-assesment-global .section-heading {
    font-size: 1.1rem;
    margin-bottom: .25rem;
  }

  #form-assesment-global .form-label {
    font-size: 1rem;
    margin-bottom: .25rem;
  }

  #form-assesment-global .form-check-label {
    font-size: 1rem;
  }

  #form-assesment-global .form-control,
  #form-assesment-global .form-select {
    font-size: 1rem;
  }

  #form-assesment-global table td {
    font-size: 1rem;
    vertical-align: middle;
    padding: .35rem .5rem;
  }

  #form-assesment-global table .form-control {
    font-size: 1rem;
    padding: .3rem .5rem;
    height: auto;
  }

  .pf-title {
    font-size: 1.3rem;
  }

  .pf-read-table {
    font-size: 1rem;
  }

  .pf-read-table th {
    width: 230px;
    font-weight: 600;
    background-color: #f8f9fa;
    vertical-align: top;
  }

  .pf-read-table td,
  .pf-read-table th {
    padding: .4rem .75rem;
  }

  .pf-section-row td {
    background-color: #e8f0fe;
    font-weight: 600;
    color: #0d6efd;
    font-size: 1.05rem;
  }
</style>

<h5 class="fw-bold text-primary mb-3 pf-title"><i class="fa fa-file-lines"></i> Riwayat Psikososial</h5>
<hr>

<?php
$has_data  = !empty($pf);
$edit_mode = ($has_data && $mode === 'edit');
$read_mode = ($has_data && $mode !== 'edit');

$kondisi_opsi = [
  'Tidak Semangat',
  'Rasa Tertekan',
  'Sulit Tidur',
  'Cepat Lelah',
  'Sulit Berbicara',
  'Merasa Bersalah',
  'Sedih / Murung',
  'Cemas',
  'Sulit Konsentrasi',
];

$perilaku_opsi = [
  'Perilaku Kekerasan',
  'Waham',
  'Halusinasi',
  'Gangguan Interaksi Sosial',
  'Gangguan Persepsi Diri',
  'Gangguan Mood',
  'Gangguan Afektif',
  'Gangguan Tingkat Konsentrasi dan Berhitung',
  'Gangguan Memori',
  'Gangguan Proses Pikir',
  'Gangguan Tingkat Kesadaran',
];
?>

<?php if ($read_mode): ?>
  <?php
  $fmtList = function ($raw) {
    if (!$raw) {
      return '-';
    }
    $parts = array_filter(array_map('trim', explode(',', $raw)));
    return $parts ? htmlspecialchars(implode(', ', $parts)) : '-';
  };
  ?>

  <table class="table table-bordered pf-read-table">
    <tr class="pf-section-row">
      <td colspan="2"><i class="fa fa-user"></i> Kondisi Psikologis</td>
    </tr>
    <tr>
      <th>Ditemukan Kondisi</th>
      <td><?= $fmtList($pf->ditemukan_kondisi) ?></td>
    </tr>
    <tr>
      <th>Riwayat Gangguan Jiwa</th>
      <td><?= $pf->riwayat_gangguan_jiwa ? 'Ada' : 'Tidak' ?><?= $pf->riwayat_gangguan_jiwa && $pf->detail_gangguan_jiwa ? ' &mdash; ' . htmlspecialchars($pf->detail_gangguan_jiwa) : '' ?></td>
    </tr>
    <tr>
      <th>Riwayat Keluarga Gangguan Jiwa</th>
      <td><?= $pf->riwayat_keluarga_gangguan_jiwa ? 'Ada' : 'Tidak' ?><?= $pf->riwayat_keluarga_gangguan_jiwa && $pf->siapa_keluarga_gangguan_jiwa ? ' &mdash; ' . htmlspecialchars($pf->siapa_keluarga_gangguan_jiwa) : '' ?></td>
    </tr>
    <tr>
      <th>Perilaku</th>
      <td><?= $fmtList($pf->adanya_perilaku) ?></td>
    </tr>

    <tr class="pf-section-row">
      <td colspan="2"><i class="fa fa-users"></i> Sosial & Dukungan</td>
    </tr>
    <tr>
      <th>Status Pernikahan</th>
      <td><?= htmlspecialchars($pf->status_pernikahan) ?></td>
    </tr>
    <tr>
      <th>Tinggal Dengan</th>
      <td><?= htmlspecialchars($pf->tinggal_dengan) ?></td>
    </tr>
    <tr>
      <th>Keluarga Terdekat</th>
      <td><?= $pf->keluarga_terdekat ? htmlspecialchars($pf->keluarga_terdekat) : '-' ?></td>
    </tr>
    <tr>
      <th>Hubungan Keluarga</th>
      <td><?= $pf->hubungan_keluarga ? htmlspecialchars($pf->hubungan_keluarga) : '-' ?></td>
    </tr>
    <tr>
      <th>No. Telepon</th>
      <td><?= $pf->no_telp ? htmlspecialchars($pf->no_telp) : '-' ?></td>
    </tr>

    <tr class="pf-section-row">
      <td colspan="2"><i class="fa fa-shield-alt"></i> Keamanan & Perlindungan</td>
    </tr>
    <tr>
      <th>Curiga Penganiayaan / Penelantaran</th>
      <td><?= htmlspecialchars($pf->curiga_penganiayaan_penelantaran ?: 'Tidak') ?></td>
    </tr>

    <tr class="pf-section-row">
      <td colspan="2"><i class="fa fa-praying-hands"></i> Spiritual</td>
    </tr>
    <tr>
      <th>Kegiatan Ibadah</th>
      <td><?= $pf->kegiatan_ibadah ? htmlspecialchars($pf->kegiatan_ibadah) : '-' ?></td>
    </tr>
    <tr>
      <th>Nilai yang Bertentangan dengan Kesehatan</th>
      <td><?= $pf->nilai_bertentangan_kesehatan ? htmlspecialchars($pf->nilai_bertentangan_kesehatan) : '-' ?></td>
    </tr>

    <tr class="pf-section-row">
      <td colspan="2"><i class="fa fa-wallet"></i> Pembiayaan</td>
    </tr>
    <tr>
      <th>Jenis Pembayaran</th>
      <td><?= htmlspecialchars($pf->jenis_pembayaran) ?><?= $pf->jenis_pembayaran === 'Lain-lain' && $pf->pembayaran_lain_lain ? ' &mdash; ' . htmlspecialchars($pf->pembayaran_lain_lain) : '' ?></td>
    </tr>
  </table>

  <div class="mt-3 mb-3">
    <button type="button" class="btn btn-warning btn-sm" id="btn-edit-pf">
      <i class="fa fa-pen-to-square"></i> Edit
    </button>
    <button type="button" class="btn btn-danger btn-sm" id="btn-hapus-pf">
      <i class="fa fa-trash"></i> Hapus
    </button>
  </div>

  <script>
    $('#btn-edit-pf').on('click', function() {
      var url = '<?= base_url() ?>AsesmenRD/form_riwayat_psikososial?no_rwt=<?= $no_rawat ?>&mode=edit';
      openContent(false, url);
    });

    $('#btn-hapus-pf').on('click', function() {
      Swal.fire({
        title: 'Hapus Data?',
        text: 'Data riwayat psikososial akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Ya, Hapus!'
      }).then(function(result) {
        if (!result.isConfirmed) return;

        Swal.fire({
          title: 'Menghapus...',
          didOpen: function() {
            Swal.showLoading();
          }
        });

        $.ajax({
          url: '<?= base_url() ?>AsesmenRD/hapus_riwayat_psikososial',
          type: 'POST',
          data: {
            id: <?= $pf->id ?>
          },
          dataType: 'json'
        }).done(function(res) {
          if (res.status) {
            Swal.fire({
              icon: 'success',
              title: 'Dihapus!',
              text: res.message,
              timer: 1500,
              showConfirmButton: false
            }).then(function() {
              var url = '<?= base_url() ?>AsesmenRD/form_riwayat_psikososial?no_rwt=<?= $no_rawat ?>';
              openContent(false, url);
            });
          } else {
            Swal.fire('Gagal', res.message, 'error');
          }
        }).fail(function() {
          Swal.fire('Error', 'Gagal terhubung ke server.', 'error');
        });
      });
    });
  </script>

<?php else: ?>
  <?php
  $v = function ($field, $default = '') use ($pf, $edit_mode) {
    return $edit_mode && isset($pf->$field) ? $pf->$field : $default;
  };

  $arr = function ($field) use ($v) {
    $val = $v($field, '');
    if ($val === '' || $val === null) {
      return [];
    }
    if (is_array($val)) {
      return $val;
    }
    return array_filter(array_map('trim', explode(',', $val)));
  };

  $checked = function ($field, $value) use ($arr) {
    return in_array($value, $arr($field), true) ? 'checked' : '';
  };
  ?>

  <form class="row" id="form-assesment-global"
    action="<?= base_url() ?>AsesmenRD/<?= $edit_mode ? 'update_riwayat_psikososial' : 'simpan_riwayat_psikososial' ?>"
    method="post">
    <input type="hidden" name="no_rawat" value="<?= $no_rawat; ?>">
    <?php if ($edit_mode): ?>
      <input type="hidden" name="id" value="<?= $pf->id; ?>">
    <?php endif; ?>

    <div class="col-12 mb-2">
      <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-user"></i> Kondisi Psikologis</label>
    </div>

    <div class="col-md-12 mb-3">
      <label class="form-label fw-bold">Ditemukan Kondisi</label>
      <div class="row g-2">
        <?php foreach ($kondisi_opsi as $idx => $opt): ?>
          <div class="col-md-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="ditemukan_kondisi[]" id="kondisi_<?= $idx ?>" value="<?= $opt ?>" <?= $checked('ditemukan_kondisi', $opt) ?>>
              <label class="form-check-label" for="kondisi_<?= $idx ?>"><?= $opt ?></label>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="col-md-6 mb-3">
      <label class="form-label fw-bold">Riwayat Gangguan Jiwa</label>
      <div class="d-flex gap-3 mb-2">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="riwayat_gangguan_jiwa" value="0" id="rgj_tidak" <?= $v('riwayat_gangguan_jiwa', 0) ? '' : 'checked' ?> onchange="toggleGangguanJiwa()">
          <label class="form-check-label" for="rgj_tidak">Tidak</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="riwayat_gangguan_jiwa" value="1" id="rgj_ada" <?= $v('riwayat_gangguan_jiwa') ? 'checked' : '' ?> onchange="toggleGangguanJiwa()">
          <label class="form-check-label" for="rgj_ada">Ada</label>
        </div>
      </div>
      <textarea class="form-control <?= $v('riwayat_gangguan_jiwa') ? '' : 'd-none' ?>" name="detail_gangguan_jiwa" id="detail_gangguan_jiwa" rows="2" placeholder="Detail gangguan jiwa..."><?= htmlspecialchars($v('detail_gangguan_jiwa')) ?></textarea>
    </div>

    <div class="col-md-6 mb-3">
      <label class="form-label fw-bold">Riwayat Keluarga Gangguan Jiwa</label>
      <div class="d-flex gap-3 mb-2">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="riwayat_keluarga_gangguan_jiwa" value="0" id="rgjk_tidak" <?= $v('riwayat_keluarga_gangguan_jiwa', 0) ? '' : 'checked' ?> onchange="toggleGangguanKeluarga()">
          <label class="form-check-label" for="rgjk_tidak">Tidak</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="riwayat_keluarga_gangguan_jiwa" value="1" id="rgjk_ada" <?= $v('riwayat_keluarga_gangguan_jiwa') ? 'checked' : '' ?> onchange="toggleGangguanKeluarga()">
          <label class="form-check-label" for="rgjk_ada">Ada</label>
        </div>
      </div>
      <input type="text" class="form-control <?= $v('riwayat_keluarga_gangguan_jiwa') ? '' : 'd-none' ?>" name="siapa_keluarga_gangguan_jiwa" id="siapa_keluarga_gangguan_jiwa" placeholder="Sebutkan siapa dan detailnya" value="<?= htmlspecialchars($v('siapa_keluarga_gangguan_jiwa')) ?>">
    </div>

    <div class="col-md-12 mb-3">
      <label class="form-label fw-bold">Perilaku</label>
      <div class="row g-2">
        <?php foreach ($perilaku_opsi as $idx => $opt): ?>
          <div class="col-md-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="adanya_perilaku[]" id="perilaku_<?= $idx ?>" value="<?= $opt ?>" <?= $checked('adanya_perilaku', $opt) ?>>
              <label class="form-check-label" for="perilaku_<?= $idx ?>"><?= $opt ?></label>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="col-12 mb-2">
      <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-users"></i> Sosial & Dukungan</label>
    </div>

    <div class="col-md-4 mb-3">
      <label class="form-label fw-bold">Status Pernikahan</label>
      <select class="form-select" name="status_pernikahan">
        <?php $sp = $v('status_pernikahan', 'Menikah'); ?>
        <option value="Menikah" <?= $sp === 'Menikah' ? 'selected' : '' ?>>Menikah</option>
        <option value="Belum Menikah" <?= $sp === 'Belum Menikah' ? 'selected' : '' ?>>Belum Menikah</option>
        <option value="Duda" <?= $sp === 'Duda' ? 'selected' : '' ?>>Duda</option>
        <option value="Janda" <?= $sp === 'Janda' ? 'selected' : '' ?>>Janda</option>
      </select>
    </div>

    <div class="col-md-4 mb-3">
      <label class="form-label fw-bold">Tinggal Dengan</label>
      <select class="form-select" name="tinggal_dengan">
        <?php $td = $v('tinggal_dengan', 'Orang Tua'); ?>
        <option value="Orang Tua" <?= $td === 'Orang Tua' ? 'selected' : '' ?>>Orang Tua</option>
        <option value="Suami / Istri" <?= $td === 'Suami / Istri' ? 'selected' : '' ?>>Suami / Istri</option>
        <option value="Sendiri" <?= $td === 'Sendiri' ? 'selected' : '' ?>>Sendiri</option>
      </select>
    </div>

    <div class="col-md-4 mb-3">
      <label class="form-label fw-bold">No. Telepon</label>
      <input type="text" class="form-control" name="no_telp" value="<?= htmlspecialchars($v('no_telp')) ?>" placeholder="Nomor yang bisa dihubungi">
    </div>

    <div class="col-md-6 mb-3">
      <label class="form-label fw-bold">Keluarga Terdekat</label>
      <input type="text" class="form-control" name="keluarga_terdekat" value="<?= htmlspecialchars($v('keluarga_terdekat')) ?>" placeholder="Nama keluarga terdekat">
    </div>

    <div class="col-md-6 mb-3">
      <label class="form-label fw-bold">Hubungan Keluarga</label>
      <input type="text" class="form-control" name="hubungan_keluarga" value="<?= htmlspecialchars($v('hubungan_keluarga')) ?>" placeholder="Hubungan dengan pasien">
    </div>

    <div class="col-12 mb-2">
      <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-shield-alt"></i> Keamanan & Perlindungan</label>
    </div>

    <div class="col-md-6 mb-3">
      <label class="form-label fw-bold">Curiga Penganiayaan / Penelantaran</label>
      <div class="d-flex gap-3">
        <?php $cp = $v('curiga_penganiayaan_penelantaran', 'Tidak'); ?>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="curiga_penganiayaan_penelantaran" value="Tidak" id="cp_tidak" <?= $cp === 'Tidak' ? 'checked' : '' ?>>
          <label class="form-check-label" for="cp_tidak">Tidak</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="curiga_penganiayaan_penelantaran" value="Ya" id="cp_ya" <?= $cp === 'Ya' ? 'checked' : '' ?>>
          <label class="form-check-label" for="cp_ya">Ya</label>
        </div>
      </div>
    </div>

    <div class="col-12 mb-2">
      <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-praying-hands"></i> Spiritual</label>
    </div>

    <div class="col-md-6 mb-3">
      <label class="form-label fw-bold">Kegiatan Ibadah</label>
      <input type="text" class="form-control" name="kegiatan_ibadah" value="<?= htmlspecialchars($v('kegiatan_ibadah')) ?>" placeholder="Kegiatan ibadah yang dijalankan">
    </div>

    <div class="col-md-6 mb-3">
      <label class="form-label fw-bold">Nilai yang Bertentangan dengan Kesehatan</label>
      <input type="text" class="form-control" name="nilai_bertentangan_kesehatan" value="<?= htmlspecialchars($v('nilai_bertentangan_kesehatan')) ?>" placeholder="Nilai/kepercayaan yang perlu diperhatikan">
    </div>

    <div class="col-12 mb-2">
      <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-wallet"></i> Pembiayaan</label>
    </div>

    <div class="col-md-12 mb-3">
      <label class="form-label fw-bold">Jenis Pembayaran</label>
      <?php $jp = $v('jenis_pembayaran', 'Umum'); ?>
      <div class="d-flex flex-wrap gap-3 mb-2">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="jenis_pembayaran" value="Umum" id="jp_umum" <?= $jp === 'Umum' ? 'checked' : '' ?> onchange="togglePembayaranLain()">
          <label class="form-check-label" for="jp_umum">Umum</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="jenis_pembayaran" value="BPJS Non PBI" id="jp_nonpbi" <?= $jp === 'BPJS Non PBI' ? 'checked' : '' ?> onchange="togglePembayaranLain()">
          <label class="form-check-label" for="jp_nonpbi">BPJS Non PBI</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="jenis_pembayaran" value="BPJS PBI" id="jp_pbi" <?= $jp === 'BPJS PBI' ? 'checked' : '' ?> onchange="togglePembayaranLain()">
          <label class="form-check-label" for="jp_pbi">BPJS PBI</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="jenis_pembayaran" value="Lain-lain" id="jp_lain" <?= $jp === 'Lain-lain' ? 'checked' : '' ?> onchange="togglePembayaranLain()">
          <label class="form-check-label" for="jp_lain">Lain-lain</label>
        </div>
      </div>
      <input type="text" class="form-control <?= $jp === 'Lain-lain' ? '' : 'd-none' ?>" name="pembayaran_lain_lain" id="pembayaran_lain_lain" placeholder="Sebutkan jenis pembayaran" value="<?= htmlspecialchars($v('pembayaran_lain_lain')) ?>">
    </div>

    <div class="col-12 mt-3">
      <button type="submit" class="btn btn-primary">
        <i class="fa fa-save"></i> <?= $edit_mode ? 'Perbarui' : 'Simpan' ?>
      </button>
      <?php if ($edit_mode): ?>
        <button type="button" class="btn btn-secondary" id="btn-batal-edit">
          <i class="fa fa-xmark"></i> Batal
        </button>
      <?php else: ?>
        <button type="reset" class="btn btn-secondary">
          <i class="fa fa-undo"></i> Reset
        </button>
      <?php endif; ?>
    </div>
  </form>

  <script>
    function toggleGangguanJiwa() {
      var val = $('input[name="riwayat_gangguan_jiwa"]:checked').val();
      if (val === '1') {
        $('#detail_gangguan_jiwa').removeClass('d-none');
      } else {
        $('#detail_gangguan_jiwa').addClass('d-none').val('');
      }
    }

    function toggleGangguanKeluarga() {
      var val = $('input[name="riwayat_keluarga_gangguan_jiwa"]:checked').val();
      if (val === '1') {
        $('#siapa_keluarga_gangguan_jiwa').removeClass('d-none');
      } else {
        $('#siapa_keluarga_gangguan_jiwa').addClass('d-none').val('');
      }
    }

    function togglePembayaranLain() {
      var val = $('input[name="jenis_pembayaran"]:checked').val();
      if (val === 'Lain-lain') {
        $('#pembayaran_lain_lain').removeClass('d-none');
      } else {
        $('#pembayaran_lain_lain').addClass('d-none').val('');
      }
    }

    <?php if ($edit_mode): ?>
      $('#btn-batal-edit').on('click', function() {
        pfAutoSave.clear();
        var url = '<?= base_url() ?>AsesmenRD/form_riwayat_psikososial?no_rwt=<?= $no_rawat ?>';
        openContent(false, url);
      });
    <?php endif; ?>

    // Auto-save untuk mencegah kehilangan data
    var pfAutoSave = (function() {
      var STORAGE_KEY = 'rpsy_draft_<?= $no_rawat ?>_<?= $edit_mode ? 'edit' : 'create' ?>';
      var timer = null;

      function normalizeName(name) {
        if (!name) return null;
        return name.endsWith('[]') ? name.slice(0, -2) : name;
      }

      function getFormData() {
        var data = {};
        $('#form-assesment-global').find('input, textarea, select').each(function() {
          var el = $(this);
          var rawName = el.attr('name');
          var name = normalizeName(rawName);
          if (!name || name === 'no_rawat' || name === 'id') return;

          if (el.is(':checkbox')) {
            if (!Array.isArray(data[name])) {
              data[name] = [];
            }
            if (el.is(':checked')) {
              data[name].push(el.val());
            }
            return;
          }

          if (el.is(':radio')) {
            if (el.is(':checked')) {
              data[name] = el.val();
            }
            return;
          }

          data[name] = el.val();
        });
        return data;
      }

      function save() {
        try {
          var d = getFormData();
          d._timestamp = Date.now();
          localStorage.setItem(STORAGE_KEY, JSON.stringify(d));
        } catch (e) {}
      }

      function scheduleSave() {
        clearTimeout(timer);
        timer = setTimeout(save, 500);
      }

      function applyData(d) {
        $('#form-assesment-global').find('input, textarea, select').each(function() {
          var el = $(this);
          var rawName = el.attr('name');
          var name = normalizeName(rawName);
          if (!name || !(name in d) || name === 'no_rawat' || name === 'id') return;

          if (el.is(':checkbox')) {
            var arr = d[name];
            el.prop('checked', Array.isArray(arr) && arr.indexOf(el.val()) !== -1);
            return;
          }

          if (el.is(':radio')) {
            el.prop('checked', d[name] == el.val());
            return;
          }

          el.val(d[name]);
        });

        toggleGangguanJiwa();
        toggleGangguanKeluarga();
        togglePembayaranLain();
      }

      function restore() {
        try {
          var raw = localStorage.getItem(STORAGE_KEY);
          if (!raw) return;
          var d = JSON.parse(raw);
          if (!d || !d._timestamp) return;

          if (Date.now() - d._timestamp > 86400000) {
            localStorage.removeItem(STORAGE_KEY);
            return;
          }

          Swal.fire({
            title: 'Pulihkan Data?',
            text: 'Ditemukan data yang belum tersimpan. Pulihkan isian terakhir?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Pulihkan',
            cancelButtonText: 'Buang'
          }).then(function(result) {
            if (result.isConfirmed) {
              applyData(d);
            } else {
              localStorage.removeItem(STORAGE_KEY);
            }
          });
        } catch (e) {}
      }

      function clear() {
        try {
          localStorage.removeItem(STORAGE_KEY);
        } catch (e) {}
      }

      return {
        scheduleSave: scheduleSave,
        restore: restore,
        clear: clear
      };
    })();

    $('#form-assesment-global').on('input change', 'input, textarea, select', function() {
      pfAutoSave.scheduleSave();
    });

    $('#form-assesment-global').on('reset', function() {
      pfAutoSave.clear();
    });

    $(function() {
      toggleGangguanJiwa();
      toggleGangguanKeluarga();
      togglePembayaranLain();
    });

    $(document).one('formLoaded', function() {
      pfAutoSave.restore();
    });
  </script>
<?php endif; ?>