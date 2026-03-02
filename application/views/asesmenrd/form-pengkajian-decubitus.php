<style>
    .pf-read-table {
        font-size: 0.95rem;
    }

    .pf-read-table th {
        background-color: #f8f9fa;
        font-weight: 600;
        width: 200px;
    }

    .pf-section-row {
        background-color: #e8f0fe;
        font-weight: 600;
        color: #0d6efd;
        font-size: 1.05rem;
    }

    .pf-title {
        font-size: 1.3rem;
    }

    .braden-card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .braden-card .card-header {
        background-color: #e8f0fe;
        font-weight: 600;
        color: #0d6efd;
        padding: 10px 15px;
        border-radius: 7px 7px 0 0;
    }

    .braden-card .card-body {
        padding: 15px;
    }

    .braden-option {
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 10px;
        margin-bottom: 8px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .braden-option:hover {
        background-color: #f8f9fa;
    }

    .braden-option.selected {
        background-color: #cfe2ff;
        border-color: #0d6efd;
    }

    .braden-option input[type="radio"] {
        margin-right: 10px;
    }

    .braden-score {
        font-weight: bold;
        color: #0d6efd;
        min-width: 25px;
        display: inline-block;
    }

    .result-box {
        border: 2px solid #dee2e6;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        margin-top: 20px;
    }

    .result-box.resiko-tinggi {
        background-color: #f8d7da;
        border-color: #dc3545;
    }

    .result-box.resiko-sedang {
        background-color: #fff3cd;
        border-color: #ffc107;
    }

    .result-box.resiko-rendah {
        background-color: #d1e7dd;
        border-color: #198754;
    }

    .result-box.tidak-resiko {
        background-color: #cff4fc;
        border-color: #0dcaf0;
    }
</style>

<?php
$has_data  = !empty($pf);
$edit_mode = ($has_data && $mode === 'edit');
$read_mode = ($has_data && $mode !== 'edit');
?>

<h5 class="fw-bold text-primary mb-3 pf-title"><i class="fa fa-file-lines"></i> Pengkajian Risiko Decubitus Braden Scale</h5>
<hr>

<?php if ($read_mode): ?>
    <?php
    $v = function ($field, $default = '') use ($pf, $has_data) {
        if ($has_data && isset($pf->$field)) {
            return $pf->$field;
        }
        return $default;
    };

    $persepsi_labels = [
        1 => 'Sama sekali terbatas',
        2 => 'Sangat terbatas',
        3 => 'Sedikit terbatas',
        4 => 'Tidak terganggu'
    ];

    $kelembaban_labels = [
        1 => 'Lembab terus menerus',
        2 => 'Sering lembab',
        3 => 'Kadang-kadang lembab',
        4 => 'Jarang lembab'
    ];

    $aktifitas_labels = [
        1 => 'Baring total',
        2 => 'Hanya duduk di kursi',
        3 => 'Kadang-kadang jalan',
        4 => 'Sering berjalan'
    ];

    $mobilitas_labels = [
        1 => 'Immobilitas total',
        2 => 'Sangat terbatas',
        3 => 'Sedikit terbatas',
        4 => 'Tidak terbatas'
    ];

    $nutrisi_labels = [
        1 => 'Sangat buruk',
        2 => 'Tidak adekuat',
        3 => 'Adekuat',
        4 => 'Sangat baik'
    ];

    $gesekan_labels = [
        1 => 'Bermasalah',
        2 => 'Potensial bermasalah',
        3 => 'Tidak bermasalah'
    ];

    $kategori = $v('kategori_resiko');
    $kategori_class = '';
    if ($kategori === 'Resiko Tinggi') $kategori_class = 'resiko-tinggi';
    elseif ($kategori === 'Resiko Sedang') $kategori_class = 'resiko-sedang';
    elseif ($kategori === 'Resiko Rendah') $kategori_class = 'resiko-rendah';
    else $kategori_class = 'tidak-resiko';
    ?>

    <table class="table table-bordered pf-read-table">
        <tr class="pf-section-row">
            <td colspan="3"><i class="fa fa-clipboard-list"></i> Penilaian Braden Scale</td>
        </tr>
        <tr>
            <th>Persepsi Sensori</th>
            <td><?= $persepsi_labels[$v('persepsi_sensori')] ?? '-' ?></td>
            <td class="text-center fw-bold" style="width:60px"><?= $v('persepsi_sensori') ?></td>
        </tr>
        <tr>
            <th>Kelembaban</th>
            <td><?= $kelembaban_labels[$v('kelembaban')] ?? '-' ?></td>
            <td class="text-center fw-bold"><?= $v('kelembaban') ?></td>
        </tr>
        <tr>
            <th>Aktifitas</th>
            <td><?= $aktifitas_labels[$v('aktifitas')] ?? '-' ?></td>
            <td class="text-center fw-bold"><?= $v('aktifitas') ?></td>
        </tr>
        <tr>
            <th>Mobilitas</th>
            <td><?= $mobilitas_labels[$v('mobilitas')] ?? '-' ?></td>
            <td class="text-center fw-bold"><?= $v('mobilitas') ?></td>
        </tr>
        <tr>
            <th>Nutrisi</th>
            <td><?= $nutrisi_labels[$v('nutrisi')] ?? '-' ?></td>
            <td class="text-center fw-bold"><?= $v('nutrisi') ?></td>
        </tr>
        <tr>
            <th>Gesekan dan Pergeseran</th>
            <td><?= $gesekan_labels[$v('gesekan')] ?? '-' ?></td>
            <td class="text-center fw-bold"><?= $v('gesekan') ?></td>
        </tr>
        <tr class="table-secondary">
            <th colspan="2" class="text-end">Total Skor</th>
            <td class="text-center fw-bold fs-5"><?= $v('total_skor') ?></td>
        </tr>
    </table>

    <div class="result-box <?= $kategori_class ?>">
        <h5 class="mb-2">Kategori Risiko</h5>
        <h3 class="fw-bold mb-0"><?= htmlspecialchars($v('kategori_resiko')) ?></h3>
        <small class="text-muted">Skor: <?= $v('total_skor') ?> (≤11: Tinggi, 12-14: Sedang, 15-16: Rendah, ≥17: Tidak ada)</small>
    </div>

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
            var url = '<?= base_url() ?>AsesmenRD/form_pengkajian_decubitus?no_rwt=<?= $no_rawat ?>&mode=edit';
            openContent(false, url);
        });

        $('#btn-hapus-pf').on('click', function() {
            Swal.fire({
                title: 'Hapus Data?',
                text: 'Data pengkajian decubitus akan dihapus permanen!',
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
                        url: '<?= base_url() ?>AsesmenRD/hapus_pengkajian_decubitus',
                        type: 'POST',
                        data: {
                            id: <?= $pf->id ?>
                        },
                        dataType: 'json'
                    }).done(function(res) {
                        if (res.status) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: res.message,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                var url = '<?= base_url() ?>AsesmenRD/form_pengkajian_decubitus?no_rwt=<?= $no_rawat ?>';
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
    <?php
    $v = function ($field, $default = '') use ($pf, $edit_mode) {
        return $edit_mode && isset($pf->$field) ? $pf->$field : $default;
    };
    ?>

    <form class="row" id="form-assesment-global"
        action="<?= base_url() ?>AsesmenRD/<?= $edit_mode ? 'update_pengkajian_decubitus' : 'simpan_pengkajian_decubitus' ?>"
        method="post">
        <input type="hidden" name="no_rawat" value="<?= $no_rawat; ?>">
        <?php if ($edit_mode): ?>
            <input type="hidden" name="id" value="<?= $pf->id; ?>">
        <?php endif; ?>

        <!-- Persepsi Sensori -->
        <div class="col-md-6">
            <div class="braden-card">
                <div class="card-header">
                    <i class="fa fa-hand-point-up"></i> 1. Persepsi Sensori
                </div>
                <div class="card-body">
                    <?php $ps = $v('persepsi_sensori', 4); ?>
                    <label class="braden-option d-block <?= $ps == 1 ? 'selected' : '' ?>">
                        <input type="radio" name="persepsi_sensori" value="1" <?= $ps == 1 ? 'checked' : '' ?>>
                        <span class="braden-score">1</span> Sama sekali terbatas
                        <small class="d-block text-muted ms-4">Tidak ada respon terhadap nyeri</small>
                    </label>
                    <label class="braden-option d-block <?= $ps == 2 ? 'selected' : '' ?>">
                        <input type="radio" name="persepsi_sensori" value="2" <?= $ps == 2 ? 'checked' : '' ?>>
                        <span class="braden-score">2</span> Sangat terbatas
                        <small class="d-block text-muted ms-4">Hanya respon terhadap nyeri</small>
                    </label>
                    <label class="braden-option d-block <?= $ps == 3 ? 'selected' : '' ?>">
                        <input type="radio" name="persepsi_sensori" value="3" <?= $ps == 3 ? 'checked' : '' ?>>
                        <span class="braden-score">3</span> Sedikit terbatas
                        <small class="d-block text-muted ms-4">Respon terhadap perintah verbal</small>
                    </label>
                    <label class="braden-option d-block <?= $ps == 4 ? 'selected' : '' ?>">
                        <input type="radio" name="persepsi_sensori" value="4" <?= $ps == 4 ? 'checked' : '' ?>>
                        <span class="braden-score">4</span> Tidak terganggu
                        <small class="d-block text-muted ms-4">Respon baik terhadap sensasi</small>
                    </label>
                </div>
            </div>
        </div>

        <!-- Kelembaban -->
        <div class="col-md-6">
            <div class="braden-card">
                <div class="card-header">
                    <i class="fa fa-droplet"></i> 2. Kelembaban
                </div>
                <div class="card-body">
                    <?php $kl = $v('kelembaban', 4); ?>
                    <label class="braden-option d-block <?= $kl == 1 ? 'selected' : '' ?>">
                        <input type="radio" name="kelembaban" value="1" <?= $kl == 1 ? 'checked' : '' ?>>
                        <span class="braden-score">1</span> Lembab terus menerus
                        <small class="d-block text-muted ms-4">Kulit selalu basah oleh keringat/urine</small>
                    </label>
                    <label class="braden-option d-block <?= $kl == 2 ? 'selected' : '' ?>">
                        <input type="radio" name="kelembaban" value="2" <?= $kl == 2 ? 'checked' : '' ?>>
                        <span class="braden-score">2</span> Sering lembab
                        <small class="d-block text-muted ms-4">Kulit sering basah, ganti linen ≥1x/shift</small>
                    </label>
                    <label class="braden-option d-block <?= $kl == 3 ? 'selected' : '' ?>">
                        <input type="radio" name="kelembaban" value="3" <?= $kl == 3 ? 'checked' : '' ?>>
                        <span class="braden-score">3</span> Kadang-kadang lembab
                        <small class="d-block text-muted ms-4">Kulit kadang lembab, ganti linen 1x/hari</small>
                    </label>
                    <label class="braden-option d-block <?= $kl == 4 ? 'selected' : '' ?>">
                        <input type="radio" name="kelembaban" value="4" <?= $kl == 4 ? 'checked' : '' ?>>
                        <span class="braden-score">4</span> Jarang lembab
                        <small class="d-block text-muted ms-4">Kulit biasanya kering</small>
                    </label>
                </div>
            </div>
        </div>

        <!-- Aktifitas -->
        <div class="col-md-6">
            <div class="braden-card">
                <div class="card-header">
                    <i class="fa fa-person-walking"></i> 3. Aktifitas
                </div>
                <div class="card-body">
                    <?php $ak = $v('aktifitas', 4); ?>
                    <label class="braden-option d-block <?= $ak == 1 ? 'selected' : '' ?>">
                        <input type="radio" name="aktifitas" value="1" <?= $ak == 1 ? 'checked' : '' ?>>
                        <span class="braden-score">1</span> Baring total
                        <small class="d-block text-muted ms-4">Terbatas di tempat tidur</small>
                    </label>
                    <label class="braden-option d-block <?= $ak == 2 ? 'selected' : '' ?>">
                        <input type="radio" name="aktifitas" value="2" <?= $ak == 2 ? 'checked' : '' ?>>
                        <span class="braden-score">2</span> Hanya duduk di kursi
                        <small class="d-block text-muted ms-4">Tidak mampu menopang berat badan</small>
                    </label>
                    <label class="braden-option d-block <?= $ak == 3 ? 'selected' : '' ?>">
                        <input type="radio" name="aktifitas" value="3" <?= $ak == 3 ? 'checked' : '' ?>>
                        <span class="braden-score">3</span> Kadang-kadang jalan
                        <small class="d-block text-muted ms-4">Jalan jarak pendek dengan/tanpa bantuan</small>
                    </label>
                    <label class="braden-option d-block <?= $ak == 4 ? 'selected' : '' ?>">
                        <input type="radio" name="aktifitas" value="4" <?= $ak == 4 ? 'checked' : '' ?>>
                        <span class="braden-score">4</span> Sering berjalan
                        <small class="d-block text-muted ms-4">Jalan di luar kamar ≥2x/hari</small>
                    </label>
                </div>
            </div>
        </div>

        <!-- Mobilitas -->
        <div class="col-md-6">
            <div class="braden-card">
                <div class="card-header">
                    <i class="fa fa-arrows-up-down-left-right"></i> 4. Mobilitas
                </div>
                <div class="card-body">
                    <?php $mb = $v('mobilitas', 4); ?>
                    <label class="braden-option d-block <?= $mb == 1 ? 'selected' : '' ?>">
                        <input type="radio" name="mobilitas" value="1" <?= $mb == 1 ? 'checked' : '' ?>>
                        <span class="braden-score">1</span> Immobilitas total
                        <small class="d-block text-muted ms-4">Tidak dapat bergerak sama sekali</small>
                    </label>
                    <label class="braden-option d-block <?= $mb == 2 ? 'selected' : '' ?>">
                        <input type="radio" name="mobilitas" value="2" <?= $mb == 2 ? 'checked' : '' ?>>
                        <span class="braden-score">2</span> Sangat terbatas
                        <small class="d-block text-muted ms-4">Kadang berubah posisi sedikit</small>
                    </label>
                    <label class="braden-option d-block <?= $mb == 3 ? 'selected' : '' ?>">
                        <input type="radio" name="mobilitas" value="3" <?= $mb == 3 ? 'checked' : '' ?>>
                        <span class="braden-score">3</span> Sedikit terbatas
                        <small class="d-block text-muted ms-4">Sering berubah posisi dengan sedikit kesulitan</small>
                    </label>
                    <label class="braden-option d-block <?= $mb == 4 ? 'selected' : '' ?>">
                        <input type="radio" name="mobilitas" value="4" <?= $mb == 4 ? 'checked' : '' ?>>
                        <span class="braden-score">4</span> Tidak terbatas
                        <small class="d-block text-muted ms-4">Sering berubah posisi tanpa bantuan</small>
                    </label>
                </div>
            </div>
        </div>

        <!-- Nutrisi -->
        <div class="col-md-6">
            <div class="braden-card">
                <div class="card-header">
                    <i class="fa fa-utensils"></i> 5. Nutrisi
                </div>
                <div class="card-body">
                    <?php $nt = $v('nutrisi', 4); ?>
                    <label class="braden-option d-block <?= $nt == 1 ? 'selected' : '' ?>">
                        <input type="radio" name="nutrisi" value="1" <?= $nt == 1 ? 'checked' : '' ?>>
                        <span class="braden-score">1</span> Sangat buruk
                        <small class="d-block text-muted ms-4">Tidak pernah makan lengkap, jarang makan</small>
                    </label>
                    <label class="braden-option d-block <?= $nt == 2 ? 'selected' : '' ?>">
                        <input type="radio" name="nutrisi" value="2" <?= $nt == 2 ? 'checked' : '' ?>>
                        <span class="braden-score">2</span> Tidak adekuat
                        <small class="d-block text-muted ms-4">Jarang makan lengkap, protein kurang</small>
                    </label>
                    <label class="braden-option d-block <?= $nt == 3 ? 'selected' : '' ?>">
                        <input type="radio" name="nutrisi" value="3" <?= $nt == 3 ? 'checked' : '' ?>>
                        <span class="braden-score">3</span> Adekuat
                        <small class="d-block text-muted ms-4">Makan >½ porsi, protein cukup</small>
                    </label>
                    <label class="braden-option d-block <?= $nt == 4 ? 'selected' : '' ?>">
                        <input type="radio" name="nutrisi" value="4" <?= $nt == 4 ? 'checked' : '' ?>>
                        <span class="braden-score">4</span> Sangat baik
                        <small class="d-block text-muted ms-4">Makan hampir seluruh porsi, protein baik</small>
                    </label>
                </div>
            </div>
        </div>

        <!-- Gesekan -->
        <div class="col-md-6">
            <div class="braden-card">
                <div class="card-header">
                    <i class="fa fa-hand-back-fist"></i> 6. Gesekan dan Pergeseran
                </div>
                <div class="card-body">
                    <?php $gs = $v('gesekan', 3); ?>
                    <label class="braden-option d-block <?= $gs == 1 ? 'selected' : '' ?>">
                        <input type="radio" name="gesekan" value="1" <?= $gs == 1 ? 'checked' : '' ?>>
                        <span class="braden-score">1</span> Bermasalah
                        <small class="d-block text-muted ms-4">Memerlukan bantuan penuh untuk bergerak, sering merosot</small>
                    </label>
                    <label class="braden-option d-block <?= $gs == 2 ? 'selected' : '' ?>">
                        <input type="radio" name="gesekan" value="2" <?= $gs == 2 ? 'checked' : '' ?>>
                        <span class="braden-score">2</span> Potensial bermasalah
                        <small class="d-block text-muted ms-4">Bergerak dengan bantuan minimal, sedikit merosot</small>
                    </label>
                    <label class="braden-option d-block <?= $gs == 3 ? 'selected' : '' ?>">
                        <input type="radio" name="gesekan" value="3" <?= $gs == 3 ? 'checked' : '' ?>>
                        <span class="braden-score">3</span> Tidak bermasalah
                        <small class="d-block text-muted ms-4">Bergerak mandiri, posisi baik</small>
                    </label>
                </div>
            </div>
        </div>

        <!-- Result Preview -->
        <div class="col-12">
            <div class="result-box" id="result-preview">
                <h5 class="mb-2">Total Skor: <span id="total-skor">0</span></h5>
                <h4 class="fw-bold mb-0" id="kategori-text">-</h4>
                <small class="text-muted">≤11: Risiko Tinggi | 12-14: Risiko Sedang | 15-16: Risiko Rendah | ≥17: Tidak Ada Risiko</small>
            </div>
        </div>

        <!-- Tombol -->
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> <?= $edit_mode ? 'Perbarui' : 'Simpan' ?>
            </button>
            <?php if ($edit_mode): ?>
                <button type="button" class="btn btn-secondary" id="btn-batal-edit">
                    <i class="fa fa-times"></i> Batal
                </button>
            <?php endif; ?>
        </div>
    </form>

    <script>
        function calculateBraden() {
            var ps = parseInt($('input[name="persepsi_sensori"]:checked').val()) || 0;
            var kl = parseInt($('input[name="kelembaban"]:checked').val()) || 0;
            var ak = parseInt($('input[name="aktifitas"]:checked').val()) || 0;
            var mb = parseInt($('input[name="mobilitas"]:checked').val()) || 0;
            var nt = parseInt($('input[name="nutrisi"]:checked').val()) || 0;
            var gs = parseInt($('input[name="gesekan"]:checked').val()) || 0;

            var total = ps + kl + ak + mb + nt + gs;
            $('#total-skor').text(total);

            var kategori = '';
            var resultBox = $('#result-preview');
            resultBox.removeClass('resiko-tinggi resiko-sedang resiko-rendah tidak-resiko');

            if (total <= 11) {
                kategori = 'Risiko Tinggi';
                resultBox.addClass('resiko-tinggi');
            } else if (total <= 14) {
                kategori = 'Risiko Sedang';
                resultBox.addClass('resiko-sedang');
            } else if (total <= 16) {
                kategori = 'Risiko Rendah';
                resultBox.addClass('resiko-rendah');
            } else {
                kategori = 'Tidak Ada Risiko';
                resultBox.addClass('tidak-resiko');
            }

            $('#kategori-text').text(kategori);
        }

        // Update selected style
        $('input[type="radio"]').on('change', function() {
            var name = $(this).attr('name');
            $('input[name="' + name + '"]').closest('.braden-option').removeClass('selected');
            $(this).closest('.braden-option').addClass('selected');
            calculateBraden();
        });

        // Initial calculation
        calculateBraden();

        $('#form-assesment-global').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);

            Swal.fire({
                title: 'Simpan Data?',
                text: 'Pastikan data sudah benar',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Cancel'
            }).then(function(result) {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menyimpan...',
                        didOpen: function() {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: form.serialize(),
                        dataType: 'json'
                    }).done(function(res) {
                        if (res.status) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: res.message,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                var url = '<?= base_url() ?>AsesmenRD/form_pengkajian_decubitus?no_rwt=<?= $no_rawat ?>';
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

        <?php if ($edit_mode): ?>
            $('#btn-batal-edit').on('click', function() {
                var url = '<?= base_url() ?>AsesmenRD/form_pengkajian_decubitus?no_rwt=<?= $no_rawat ?>';
                openContent(false, url);
            });
        <?php endif; ?>
    </script>

<?php endif; ?>