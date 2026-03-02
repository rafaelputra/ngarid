<style>
  .section-heading {
    font-size: 1.05rem;
    border-bottom: 2px solid #0d6efd;
    padding-bottom: 4px;
    margin-bottom: 8px;
  }

  .pf-read-table {
    font-size: 1rem;
  }

  .pf-read-table th {
    width: 220px;
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

  .masalah-badge {
    display: inline-block;
    background: #e8f0fe;
    color: #0d6efd;
    border-radius: 4px;
    padding: 2px 10px;
    margin: 2px 4px 2px 0;
    font-size: .95rem;
  }

  .tambahan-input-group {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 6px;
  }

  .tambahan-input-group .btn-remove-tambahan {
    flex-shrink: 0;
  }
</style>

<h5 class="fw-bold text-primary mb-3 pf-title"><i class="fa fa-file-lines"></i> Daftar Masalah Keperawatan</h5>
<hr>

<?php
$has_data  = !empty($pf);
$edit_mode = ($has_data && $mode === 'edit');
$read_mode = ($has_data && $mode !== 'edit');
?>

<?php if ($read_mode): ?>
  <!-- ===================== READ MODE (Tabel) ===================== -->
  <?php
  $fmtList = function ($raw) {
    if (!$raw) return '-';
    $parts = array_filter(array_map('trim', explode(',', $raw)));
    return $parts ? $parts : [];
  };
  ?>

  <table class="table table-bordered pf-read-table">
    <tr class="pf-section-row">
      <td colspan="2"><i class="fa fa-list-check"></i> Masalah Keperawatan</td>
    </tr>
    <tr>
      <th>Masalah Keperawatan</th>
      <td>
        <?php
        $masalah = $fmtList($pf->masalah_keperawatan);
        if (is_array($masalah) && count($masalah) > 0):
          foreach ($masalah as $m): ?>
            <span class="masalah-badge"><?= htmlspecialchars($m) ?></span>
        <?php endforeach;
        else:
          echo '-';
        endif;
        ?>
      </td>
    </tr>

    <tr class="pf-section-row">
      <td colspan="2"><i class="fa fa-plus-circle"></i> Masalah Tambahan</td>
    </tr>
    <?php
    $tambahan_labels = ['A', 'B', 'C', 'D', 'E'];
    $tambahan_fields = ['masalah_keperawatan_a', 'masalah_keperawatan_b', 'masalah_keperawatan_c', 'masalah_keperawatan_d', 'masalah_keperawatan_e'];
    $has_tambahan = false;
    foreach ($tambahan_fields as $i => $field):
      if (!empty($pf->$field)):
        $has_tambahan = true;
    ?>
        <tr>
          <th>Masalah Tambahan <?= $tambahan_labels[$i] ?></th>
          <td><?= htmlspecialchars($pf->$field) ?></td>
        </tr>
      <?php endif;
    endforeach;
    if (!$has_tambahan): ?>
      <tr>
        <th>Masalah Tambahan</th>
        <td>-</td>
      </tr>
    <?php endif; ?>
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
    // Edit button — reload form in edit mode
    $('#btn-edit-pf').on('click', function() {
      var url = '<?= base_url() ?>AsesmenRD/form_daftar_masalah_keperawatan?no_rwt=<?= $no_rawat ?>&mode=edit';
      openContent(false, url);
    });

    // Hapus button
    $('#btn-hapus-pf').on('click', function() {
      Swal.fire({
        title: 'Hapus Data?',
        text: "Data masalah keperawatan akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Ya, Hapus!'
      }).then(function(result) {
        if (result.isConfirmed) {
          Swal.fire({
            title: 'Menghapus...',
            didOpen: function() {
              Swal.showLoading();
            }
          });
          $.ajax({
            url: '<?= base_url() ?>AsesmenRD/hapus_masalah_keperawatan',
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
                var url = '<?= base_url() ?>AsesmenRD/form_daftar_masalah_keperawatan?no_rwt=<?= $no_rawat ?>';
                openContent(false, url);
              });
            } else {
              Swal.fire('Gagal', res.message, 'error');
            }
          }).fail(function() {
            Swal.fire('Error', 'Gagal terhubung ke server.', 'error');
          });
        }
      });
    });
  </script>

<?php else: ?>
  <!-- ===================== CREATE / EDIT MODE (Form) ===================== -->
  <?php
  $v = function ($field, $default = '') use ($pf, $edit_mode) {
    return $edit_mode && isset($pf->$field) ? $pf->$field : $default;
  };

  // Checked helper untuk checkbox SET
  $checked = function ($field, $value) use ($v) {
    $raw = $v($field);
    if (!$raw) return '';
    $items = array_map('trim', explode(',', $raw));
    return in_array($value, $items) ? 'checked' : '';
  };

  // Daftar masalah keperawatan (sesuai SET di database)
  $masalah_opsi = [
    'Bersihan Jalan Nafas tidak efektif',
    'Pola Nafas tidak efektif',
    'Gangguan Pertukaran gas',
    'Kurang Pengetahuan',
    'Resiko Aspirasi',
    'Hipertermia',
    'Ketidakseimbangan nutrisi',
    'Defisit Volume Cairan',
    'Kelebihan Volume Cairan',
    'Intoleransi aktifitas',
    'Perfusi jaringan kardiopulmonal tidak efektif',
    'Perfusi jaringan cerebral tidak efektif',
    'Perfusi jaringan renal tidak efektif',
    'Manajemen regimen teraupetik tidak efektif',
    'Penurunan curah jantung',
    'Defisit perawatan diri',
    'Nyeri',
    'Kecemasan',
    'Takut',
    'Gangguan mobilitas fisik',
    'Mual',
    'Diare',
    'Konstipasi',
    'Retensi urin',
    'Kerusakan integritas kulit',
    'Resiko infeksi',
    'Resiko Injury',
    'Gangguan Pola Tidur',
    'Kerusakan integritas jaringan',
    'Gangguan Body Image',
    'Kelelahan',
  ];
  ?>

  <form class="row" id="form-assesment-global"
    action="<?= base_url() ?>AsesmenRD/<?= $edit_mode ? 'update_masalah_keperawatan' : 'simpan_masalah_keperawatan' ?>"
    data-refresh-url="<?= base_url() ?>AsesmenRD/form_daftar_masalah_keperawatan?no_rwt=<?= $no_rawat ?>"
    method="post">
    <input type="hidden" name="no_rawat" value="<?= $no_rawat; ?>">
    <?php if ($edit_mode): ?>
      <input type="hidden" name="id" value="<?= $pf->id; ?>">
    <?php endif; ?>

    <!-- Masalah Keperawatan -->
    <div class="col-12 mb-2">
      <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-list-check"></i> Masalah Keperawatan</label>
      <small class="text-muted d-block mb-2">Pilih satu atau lebih masalah keperawatan yang ditemukan.</small>
    </div>

    <div class="col-12 mb-3">
      <div class="row g-2">
        <?php foreach ($masalah_opsi as $idx => $opt): ?>
          <div class="col-md-6 col-lg-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="masalah_keperawatan[]" id="mk_<?= $idx ?>" value="<?= $opt ?>" <?= $checked('masalah_keperawatan', $opt) ?>>
              <label class="form-check-label" for="mk_<?= $idx ?>"><?= $opt ?></label>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Masalah Tambahan -->
    <div class="col-12 mb-2 mt-2">
      <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-plus-circle"></i> Masalah Tambahan</label>
      <small class="text-muted d-block mb-2">Jika masalah tidak tersedia di atas, tambahkan secara manual (maksimal 5).</small>
    </div>

    <div class="col-12 mb-3" id="tambahan-container">
      <?php
      $tambahan_fields = ['masalah_keperawatan_a', 'masalah_keperawatan_b', 'masalah_keperawatan_c', 'masalah_keperawatan_d', 'masalah_keperawatan_e'];
      $tambahan_labels = ['A', 'B', 'C', 'D', 'E'];
      $show_count = 0;

      if ($edit_mode) {
        foreach ($tambahan_fields as $field) {
          if (!empty($pf->$field)) $show_count++;
        }
      }
      if ($show_count === 0) $show_count = 1;

      foreach ($tambahan_fields as $i => $field):
        $val = $v($field);
        $hidden = ($i >= $show_count) ? 'd-none' : '';
      ?>
        <div class="tambahan-input-group tambahan-row <?= $hidden ?>" data-index="<?= $i ?>">
          <span class="fw-bold text-muted" style="min-width:25px;"><?= $tambahan_labels[$i] ?>.</span>
          <input type="text" class="form-control" name="<?= $field ?>" value="<?= htmlspecialchars($val) ?>" placeholder="Masalah keperawatan tambahan <?= $tambahan_labels[$i] ?>...">
          <?php if ($i > 0): ?>
            <button type="button" class="btn btn-outline-danger btn-sm btn-remove-tambahan" onclick="removeTambahan(<?= $i ?>)" title="Hapus">
              <i class="fa fa-times"></i>
            </button>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="col-12 mb-3">
      <button type="button" class="btn btn-outline-primary btn-sm" id="btn-add-tambahan" onclick="addTambahan()">
        <i class="fa fa-plus"></i> Tambah Masalah Lainnya
      </button>
    </div>

    <!-- Tombol Simpan -->
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
    function addTambahan() {
      var rows = $('.tambahan-row');
      var hiddenRows = rows.filter('.d-none');
      if (hiddenRows.length === 0) {
        Swal.fire('Info', 'Maksimal 5 masalah tambahan.', 'info');
        return;
      }
      hiddenRows.first().removeClass('d-none');
      updateAddButton();
    }

    function removeTambahan(index) {
      var row = $('.tambahan-row[data-index="' + index + '"]');
      row.find('input[type="text"]').val('');
      row.addClass('d-none');
      updateAddButton();
    }

    function updateAddButton() {
      var hiddenRows = $('.tambahan-row.d-none');
      if (hiddenRows.length === 0) {
        $('#btn-add-tambahan').addClass('d-none');
      } else {
        $('#btn-add-tambahan').removeClass('d-none');
      }
    }

    <?php if ($edit_mode): ?>
      $('#btn-batal-edit').on('click', function() {
        mkAutoSave.clear();
        var url = '<?= base_url() ?>AsesmenRD/form_daftar_masalah_keperawatan?no_rwt=<?= $no_rawat ?>';
        openContent(false, url);
      });
    <?php endif; ?>

    // ============ AUTO-SAVE ke localStorage ============
    var mkAutoSave = (function() {
      var STORAGE_KEY = 'mk_draft_<?= $no_rawat ?>_<?= $edit_mode ? 'edit' : 'create' ?>';
      var timer = null;

      function normalizeName(name) {
        if (!name) return null;
        return name.endsWith('[]') ? name.slice(0, -2) : name;
      }

      function getFormData() {
        var data = {};
        $('#form-assesment-global').find('input, textarea, select').each(function() {
          var el = $(this);
          var name = el.attr('name');
          if (!name || name === 'no_rawat' || name === 'id') return;

          if (el.is(':checkbox')) {
            var key = normalizeName(name);
            if (!data[key]) data[key] = [];
            if (el.is(':checked')) data[key].push(el.val());
          } else {
            data[name] = el.val();
          }
        });
        return data;
      }

      function save() {
        try {
          localStorage.setItem(STORAGE_KEY, JSON.stringify(getFormData()));
        } catch (e) {}
      }

      function startTimer() {
        if (timer) clearTimeout(timer);
        timer = setTimeout(save, 1500);
      }

      function clear() {
        localStorage.removeItem(STORAGE_KEY);
      }

      function tryRestore() {
        try {
          var raw = localStorage.getItem(STORAGE_KEY);
          if (!raw) return;
          var d = JSON.parse(raw);
          if (!d || Object.keys(d).length === 0) {
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

      function applyData(d) {
        $('#form-assesment-global').find('input, textarea, select').each(function() {
          var el = $(this);
          var name = el.attr('name');
          if (!name || name === 'no_rawat' || name === 'id') return;

          if (el.is(':checkbox')) {
            var key = normalizeName(name);
            if (d[key] && Array.isArray(d[key])) {
              el.prop('checked', d[key].indexOf(el.val()) !== -1);
            }
          } else {
            if (name in d) el.val(d[name]);
          }
        });

        // Show tambahan rows that have values
        $('.tambahan-row').each(function() {
          var input = $(this).find('input[type="text"]');
          if (input.val()) {
            $(this).removeClass('d-none');
          }
        });
        updateAddButton();
      }

      // Bind events
      $('#form-assesment-global').on('change input', 'input, textarea, select', startTimer);

      // On successful submit, clear draft
      $(document).on('ajaxSuccess', function(e, xhr, settings) {
        if (settings.url && settings.url.indexOf('masalah_keperawatan') !== -1) {
          clear();
        }
      });

      return {
        clear: clear,
        tryRestore: tryRestore
      };
    })();

    // Restore on page load
    mkAutoSave.tryRestore();
    updateAddButton();
  </script>
<?php endif; ?>