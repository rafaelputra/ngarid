<?php
$edit_mode = (isset($mode) && $mode === 'edit');

// Label mappings
$ekspresi_labels = [
    0 => 'Santai',
    1 => 'Tegang',
    2 => 'Menyeringai',
];
$gerakan_labels = [
    0 => 'Tenang',
    1 => 'Melindungi Diri',
    2 => 'Tidak Bisa Diam',
];
$ventilator_labels = [
    0 => 'Toleran',
    1 => 'Sering Batuk',
    2 => 'Melawan',
];
$vokalisasi_labels = [
    0 => 'Nada Bicara',
    1 => 'Merintih',
    2 => 'Mangerang',
];
$otot_labels = [
    0 => 'Rileks',
    1 => 'Agak Kaku)',
    2 => 'Sangat Kaku',
];

function cpot_kategori_class($kategori)
{
    switch ($kategori) {
        case 'Tidak Nyeri':
            return 'skor-tidak-nyeri';
        case 'Nyeri Ringan':
            return 'skor-ringan';
        case 'Nyeri Sedang':
            return 'skor-sedang';
        case 'Nyeri Berat':
            return 'skor-berat';
        case 'Nyeri Berat Sekali':
            return 'skor-berat-sekali';
        default:
            return '';
    }
}
?>

<style>
    .table-cpot th,
    .table-cpot td {
        vertical-align: middle !important;
        font-size: 13px;
    }

    .table-cpot .radio-inline {
        margin-right: 15px;
    }

    .kategori-skor {
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        margin-top: 10px;
    }

    .skor-tidak-nyeri {
        background-color: #cff4fc;
        border-color: #0dcaf0;
    }

    .skor-ringan {
        background-color: #d1e7dd;
        border-color: #198754;
    }

    .skor-sedang {
        background-color: #fff3cd;
        border-color: #ffc107;
    }

    .skor-berat {
        background-color: #f8d7da;
        border-color: #dc3545;
    }

    .skor-berat-sekali {
        background-color: #dc3545;
        color: #fff;
        border-color: #b02a37;
    }

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

    .result-box {
        border: 2px solid #dee2e6;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        margin-top: 20px;
    }

    .result-box.skor-tidak-nyeri {
        background-color: #cff4fc;
        border-color: #0dcaf0;
    }

    .result-box.skor-ringan {
        background-color: #d1e7dd;
        border-color: #198754;
    }

    .result-box.skor-sedang {
        background-color: #fff3cd;
        border-color: #ffc107;
    }

    .result-box.skor-berat {
        background-color: #f8d7da;
        border-color: #dc3545;
    }

    .result-box.skor-berat-sekali {
        background-color: #dc3545;
        border-color: #b02a37;
        color: #fff;
    }
</style>

<h5 class="fw-bold text-primary mb-3 pf-title"><i class="fa fa-heartbeat"></i> Penilaian Tingkat Nyeri CPOT (Critical-Care Pain Observation Tool)</h5>
<hr>

<?php if (!empty($pf) && !$edit_mode): ?>
    <!-- ==================== READ MODE ==================== -->
    <?php
    $v = function ($field, $default = '-') use ($pf) {
        return isset($pf->$field) ? $pf->$field : $default;
    };
    $is_ventilator = (isset($pf->penerimaan_ventilator) && $pf->penerimaan_ventilator !== null);
    $kategori_class = cpot_kategori_class($v('kategori_resiko'));
    ?>

    <table class="table table-bordered pf-read-table">
        <thead>
            <tr class="bg-primary" style="color:#fff;">
                <th class="text-center" style="width:5%;">No</th>
                <th class="text-center" style="width:25%;">Indikator</th>
                <th class="text-center" style="width:50%;">Deskripsi</th>
                <th class="text-center" style="width:10%;">Skor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center"><strong>1</strong></td>
                <td><strong>Ekspresi Wajah</strong></td>
                <td><?= $ekspresi_labels[(int)$v('ekspresi_wajah', 0)] ?? '-' ?></td>
                <td class="text-center fw-bold"><?= $v('ekspresi_wajah') ?></td>
            </tr>
            <tr>
                <td class="text-center"><strong>2</strong></td>
                <td><strong>Gerakan Tubuh</strong></td>
                <td><?= $gerakan_labels[(int)$v('gerakan_tubuh', 0)] ?? '-' ?></td>
                <td class="text-center fw-bold"><?= $v('gerakan_tubuh') ?></td>
            </tr>
            <tr>
                <td class="text-center"><strong>3</strong></td>
                <td><strong>Ketegangan Otot Anggota Gerak</strong></td>
                <td><?= $otot_labels[(int)$v('ketegangan_otot', 0)] ?? '-' ?></td>
                <td class="text-center fw-bold"><?= $v('ketegangan_otot') ?></td>
            </tr>
            <tr>
                <td class="text-center"><strong>4</strong></td>
                <?php if ($is_ventilator): ?>
                    <td><strong>Penerimaan terhadap Ventilator</strong></td>
                    <td><?= $ventilator_labels[(int)$v('penerimaan_ventilator', 0)] ?? '-' ?></td>
                    <td class="text-center fw-bold"><?= $v('penerimaan_ventilator') ?></td>
                <?php else: ?>
                    <td><strong>Tanpa Ventilator</strong></td>
                    <td><?= $vokalisasi_labels[(int)$v('tanpa_ventilator', 0)] ?? '-' ?></td>
                    <td class="text-center fw-bold"><?= $v('tanpa_ventilator') ?></td>
                <?php endif; ?>
            </tr>
            <tr class="table-secondary">
                <th colspan="3" class="text-end">Total Skor</th>
                <td class="text-center fw-bold fs-5"><?= $v('total_skor') ?></td>
            </tr>
        </tbody>
    </table>

    <div class="result-box <?= $kategori_class ?>">
        <h5 class="mb-2">Kategori Nyeri</h5>
        <h3 class="fw-bold mb-0"><?= htmlspecialchars($v('kategori_resiko')) ?></h3>
        <small>(Skor: <?= $v('total_skor') ?>)</small>
    </div>

    <!-- Keterangan Kategori Skor -->
    <div class="row" style="margin-top: 15px;">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><i class="fa fa-info-circle"></i> Keterangan Kategori Skor</strong>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-condensed" style="margin-bottom: 0;">
                        <thead>
                            <tr class="bg-info">
                                <th class="text-center" style="width: 30%;">Skor</th>
                                <th class="text-center" style="width: 70%;">Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"><span class="label">0</span></td>
                                <td>Tidak Nyeri</td>
                            </tr>
                            <tr>
                                <td class="text-center"><span class="label">1 - 2</span></td>
                                <td>Nyeri Ringan</td>
                            </tr>
                            <tr>
                                <td class="text-center"><span class="label">3 - 4</span></td>
                                <td>Nyeri Sedang</td>
                            </tr>
                            <tr>
                                <td class="text-center"><span class="label">5 - 6</span></td>
                                <td>Nyeri Berat</td>
                            </tr>
                            <tr>
                                <td class="text-center"><span class="label">7 - 8</span></td>
                                <td>Nyeri Berat Sekali</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 mb-3">
        <button type="button" class="btn btn-warning btn-sm" id="btn-edit-cpot">
            <i class="fa fa-pen-to-square"></i> Edit
        </button>
        <button type="button" class="btn btn-danger btn-sm" id="btn-hapus-cpot">
            <i class="fa fa-trash"></i> Hapus
        </button>
    </div>

    <script>
        $('#btn-edit-cpot').on('click', function() {
            var url = '<?= base_url() ?>AsesmenRD/form_penilaian_tingkat_nyeri_ccpot?no_rwt=<?= $no_rawat ?>&mode=edit';
            openContent(false, url);
        });

        $('#btn-hapus-cpot').on('click', function() {
            Swal.fire({
                title: 'Hapus Data?',
                text: 'Data penilaian tingkat nyeri CPOT akan dihapus permanen!',
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
                        url: '<?= base_url() ?>AsesmenRD/hapus_penilaian_tingkat_nyeri_ccpot',
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
                                var url = '<?= base_url() ?>AsesmenRD/form_penilaian_tingkat_nyeri_ccpot?no_rwt=<?= $no_rawat ?>';
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
    <!-- ==================== FORM MODE (Create / Edit) ==================== -->
    <?php
    $v = function ($field, $default = '') use ($pf, $edit_mode) {
        return $edit_mode && isset($pf->$field) ? $pf->$field : $default;
    };
    // Determine ventilator type for edit mode
    $is_ventilator_mode = true; // default: penerimaan_ventilator
    if ($edit_mode && isset($pf->tanpa_ventilator) && $pf->tanpa_ventilator !== null && (!isset($pf->penerimaan_ventilator) || $pf->penerimaan_ventilator === null)) {
        $is_ventilator_mode = false;
    }
    ?>

    <form class="row" id="form-assesment-global"
        action="<?= base_url() ?>AsesmenRD/<?= $edit_mode ? 'update_penilaian_tingkat_nyeri_ccpot' : 'simpan_penilaian_tingkat_nyeri_ccpot' ?>"
        data-refresh-url="<?= base_url() ?>AsesmenRD/form_penilaian_tingkat_nyeri_ccpot?no_rwt=<?= $no_rawat ?>"
        method="post">
        <input type="hidden" name="no_rawat" value="<?= $no_rawat; ?>">
        <?php if ($edit_mode): ?>
            <input type="hidden" name="id" value="<?= $pf->id; ?>">
        <?php endif; ?>

        <div class="col-sm-12">
            <!-- Pilihan Ventilator -->
            <div class="form-group">
                <label><strong>Jenis Penilaian Ventilator:</strong></label>
                <div style="margin-bottom: 15px;">
                    <label class="radio-inline">
                        <input type="radio" name="jenis_ventilator" value="penerimaan_ventilator" <?= $is_ventilator_mode ? 'checked' : '' ?> onchange="toggleVentilator()">
                        <strong>Penerimaan Ventilator</strong>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="jenis_ventilator" value="tanpa_ventilator" <?= !$is_ventilator_mode ? 'checked' : '' ?> onchange="toggleVentilator()">
                        <strong>Tanpa Ventilator</strong>
                    </label>
                </div>
            </div>

            <hr>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-cpot">
                    <thead>
                        <tr class="bg-primary">
                            <th style="width: 5%;" class="text-center">No</th>
                            <th style="width: 15%;" class="text-center">Indikator</th>
                            <th style="width: 50%;" class="text-center">Deskripsi</th>
                            <th style="width: 10%;" class="text-center">Skor</th>
                            <th style="width: 20%;" class="text-center">Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 1. Ekspresi Wajah -->
                        <?php $ew = (int)$v('ekspresi_wajah', 0); ?>
                        <tr>
                            <td rowspan="3" class="text-center"><strong>1</strong></td>
                            <td rowspan="3"><strong>Ekspresi Wajah</strong></td>
                            <td>Santai</td>
                            <td class="text-center">0</td>
                            <td class="text-center">
                                <input type="radio" name="ekspresi_wajah" value="0" class="skor-radio" <?= $ew == 0 ? 'checked' : '' ?>>
                            </td>
                        </tr>
                        <tr>
                            <td>Tegang</td>
                            <td class="text-center">1</td>
                            <td class="text-center">
                                <input type="radio" name="ekspresi_wajah" value="1" class="skor-radio" <?= $ew == 1 ? 'checked' : '' ?>>
                            </td>
                        </tr>
                        <tr>
                            <td>Menyeringai</td>
                            <td class="text-center">2</td>
                            <td class="text-center">
                                <input type="radio" name="ekspresi_wajah" value="2" class="skor-radio" <?= $ew == 2 ? 'checked' : '' ?>>
                            </td>
                        </tr>

                        <!-- 2. Gerakan Tubuh -->
                        <?php $gt = (int)$v('gerakan_tubuh', 0); ?>
                        <tr class="active">
                            <td rowspan="3" class="text-center"><strong>2</strong></td>
                            <td rowspan="3"><strong>Gerakan Tubuh</strong></td>
                            <td>Tenang</td>
                            <td class="text-center">0</td>
                            <td class="text-center">
                                <input type="radio" name="gerakan_tubuh" value="0" class="skor-radio" <?= $gt == 0 ? 'checked' : '' ?>>
                            </td>
                        </tr>
                        <tr class="active">
                            <td>Melindungi Diri</td>
                            <td class="text-center">1</td>
                            <td class="text-center">
                                <input type="radio" name="gerakan_tubuh" value="1" class="skor-radio" <?= $gt == 1 ? 'checked' : '' ?>>
                            </td>
                        </tr>
                        <tr class="active">
                            <td>Tidak Bisa Diam</td>
                            <td class="text-center">2</td>
                            <td class="text-center">
                                <input type="radio" name="gerakan_tubuh" value="2" class="skor-radio" <?= $gt == 2 ? 'checked' : '' ?>>
                            </td>
                        </tr>

                        <!-- 3. Ketegangan Otot -->
                        <?php $ko = (int)$v('ketegangan_otot', 0); ?>
                        <tr>
                            <td rowspan="3" class="text-center"><strong>3</strong></td>
                            <td rowspan="3"><strong>Ketegangan Otot Anggota Gerak</strong></td>
                            <td>Rileks</td>
                            <td class="text-center">0</td>
                            <td class="text-center">
                                <input type="radio" name="ketegangan_otot" value="0" class="skor-radio" <?= $ko == 0 ? 'checked' : '' ?>>
                            </td>
                        </tr>
                        <tr>
                            <td>Agak Kaku</td>
                            <td class="text-center">1</td>
                            <td class="text-center">
                                <input type="radio" name="ketegangan_otot" value="1" class="skor-radio" <?= $ko == 1 ? 'checked' : '' ?>>
                            </td>
                        </tr>
                        <tr>
                            <td>Sangat Kaku</td>
                            <td class="text-center">2</td>
                            <td class="text-center">
                                <input type="radio" name="ketegangan_otot" value="2" class="skor-radio" <?= $ko == 2 ? 'checked' : '' ?>>
                            </td>
                        </tr>

                        <!-- 4. Kepatuhan Ventilator (Penerimaan Ventilator) -->
                        <?php $pv = (int)$v('penerimaan_ventilator', 0); ?>
                    <tbody id="section-penerimaan-ventilator" style="<?= !$is_ventilator_mode ? 'display:none;' : '' ?>">
                        <tr class="active">
                            <td rowspan="3" class="text-center"><strong>4</strong></td>
                            <td rowspan="3"><strong>Penerimaan terhadap Ventilator</strong></td>
                            <td>Toleran</td>
                            <td class="text-center">0</td>
                            <td class="text-center">
                                <input type="radio" name="penerimaan_ventilator" value="0" class="skor-radio" <?= $pv == 0 ? 'checked' : '' ?>>
                            </td>
                        </tr>
                        <tr class="active">
                            <td>Sering Batuk</td>
                            <td class="text-center">1</td>
                            <td class="text-center">
                                <input type="radio" name="penerimaan_ventilator" value="1" class="skor-radio" <?= $pv == 1 ? 'checked' : '' ?>>
                            </td>
                        </tr>
                        <tr class="active">
                            <td>Melawan</td>
                            <td class="text-center">2</td>
                            <td class="text-center">
                                <input type="radio" name="penerimaan_ventilator" value="2" class="skor-radio" <?= $pv == 2 ? 'checked' : '' ?>>
                            </td>
                        </tr>
                    </tbody>

                    <!-- 4. Vokalisasi (Tanpa Ventilator) -->
                    <?php $tv = (int)$v('tanpa_ventilator', 0); ?>
                    <tbody id="section-tanpa-ventilator" style="<?= $is_ventilator_mode ? 'display:none;' : '' ?>">
                        <tr class="active">
                            <td rowspan="3" class="text-center"><strong>4</strong></td>
                            <td rowspan="3"><strong>Tanpa Ventilator</strong></td>
                            <td>Nada Bicara</td>
                            <td class="text-center">0</td>
                            <td class="text-center">
                                <input type="radio" name="tanpa_ventilator" value="0" class="skor-radio" <?= $tv == 0 ? 'checked' : '' ?>>
                            </td>
                        </tr>
                        <tr class="active">
                            <td>Merintih</td>
                            <td class="text-center">1</td>
                            <td class="text-center">
                                <input type="radio" name="tanpa_ventilator" value="1" class="skor-radio" <?= $tv == 1 ? 'checked' : '' ?>>
                            </td>
                        </tr>
                        <tr class="active">
                            <td>Mengerang</td>
                            <td class="text-center">2</td>
                            <td class="text-center">
                                <input type="radio" name="tanpa_ventilator" value="2" class="skor-radio" <?= $tv == 2 ? 'checked' : '' ?>>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Total Skor dan Kategori -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Total Skor:</label>
                        <input type="text" id="total_skor" class="form-control input-lg text-center" value="0" readonly style="font-size: 24px; font-weight: bold; max-width: 150px;">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Kategori Nyeri:</label>
                        <div id="kategori_skor" class="kategori-skor skor-tidak-nyeri">
                            Tidak Nyeri
                        </div>
                    </div>
                </div>
            </div>

            <!-- Keterangan Kategori Skor -->
            <div class="row" style="margin-top: 15px;">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong><i class="fa fa-info-circle"></i> Keterangan Kategori Skor</strong>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-condensed" style="margin-bottom: 0;">
                                <thead>
                                    <tr class="bg-info">
                                        <th class="text-center" style="width: 30%;">Skor</th>
                                        <th class="text-center" style="width: 70%;">Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center"><span class="label">0</span></td>
                                        <td>Tidak Nyeri</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><span class="label">1 - 2</span></td>
                                        <td>Nyeri Ringan</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><span class="label">3 - 4</span></td>
                                        <td>Nyeri Sedang</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><span class="label">5 - 6</span></td>
                                        <td>Nyeri Berat</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><span class="label">7 - 8</span></td>
                                        <td>Nyeri Berat Sekali</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> <?= $edit_mode ? 'Update Penilaian' : 'Simpan Penilaian' ?></button>
                <?php if ($edit_mode): ?>
                    <button type="button" class="btn btn-default btn-lg" onclick="openContent(false, '<?= base_url() ?>AsesmenRD/form_penilaian_tingkat_nyeri_ccpot?no_rwt=<?= $no_rawat ?>')">
                        <i class="fa fa-times"></i> Batal
                    </button>
                <?php else: ?>
                    <button type="reset" class="btn btn-default btn-lg" onclick="resetForm()"><i class="fa fa-refresh"></i> Reset</button>
                <?php endif; ?>
            </div>
        </div>
    </form>

    <script>
        // Toggle antara Penerimaan Ventilator dan Tanpa Ventilator
        function toggleVentilator() {
            var jenisVentilator = $('input[name="jenis_ventilator"]:checked').val();

            if (jenisVentilator === 'penerimaan_ventilator') {
                $('#section-penerimaan-ventilator').show();
                $('#section-tanpa-ventilator').hide();
                $('input[name="tanpa_ventilator"]').prop('checked', false);
                $('input[name="tanpa_ventilator"][value="0"]').prop('checked', true);
            } else {
                $('#section-penerimaan-ventilator').hide();
                $('#section-tanpa-ventilator').show();
                $('input[name="penerimaan_ventilator"]').prop('checked', false);
                $('input[name="penerimaan_ventilator"][value="0"]').prop('checked', true);
            }

            hitungTotalSkor();
        }

        // Hitung total skor
        function hitungTotalSkor() {
            var totalSkor = 0;
            var jenisVentilator = $('input[name="jenis_ventilator"]:checked').val();

            totalSkor += parseInt($('input[name="ekspresi_wajah"]:checked').val()) || 0;
            totalSkor += parseInt($('input[name="gerakan_tubuh"]:checked').val()) || 0;

            if (jenisVentilator === 'penerimaan_ventilator') {
                totalSkor += parseInt($('input[name="penerimaan_ventilator"]:checked').val()) || 0;
            } else {
                totalSkor += parseInt($('input[name="tanpa_ventilator"]:checked').val()) || 0;
            }

            totalSkor += parseInt($('input[name="ketegangan_otot"]:checked').val()) || 0;

            $('#total_skor').val(totalSkor);
            updateKategoriSkor(totalSkor);
        }

        // Update kategori berdasarkan skor
        function updateKategoriSkor(skor) {
            var kategori = '';
            var kelasCSS = '';

            if (skor === 0) {
                kategori = 'Tidak Nyeri';
                kelasCSS = 'skor-tidak-nyeri';
            } else if (skor >= 1 && skor <= 2) {
                kategori = 'Nyeri Ringan';
                kelasCSS = 'skor-ringan';
            } else if (skor >= 3 && skor <= 4) {
                kategori = 'Nyeri Sedang';
                kelasCSS = 'skor-sedang';
            } else if (skor >= 5 && skor <= 6) {
                kategori = 'Nyeri Berat';
                kelasCSS = 'skor-berat';
            } else if (skor >= 7 && skor <= 8) {
                kategori = 'Nyeri Berat Sekali';
                kelasCSS = 'skor-berat-sekali';
            }

            $('#kategori_skor')
                .removeClass('skor-tidak-nyeri skor-ringan skor-sedang skor-berat skor-berat-sekali')
                .addClass(kelasCSS)
                .text(kategori + ' (Skor: ' + skor + ')');
        }

        // Reset form
        function resetForm() {
            setTimeout(function() {
                $('input[name="jenis_ventilator"][value="penerimaan_ventilator"]').prop('checked', true);
                toggleVentilator();
                $('input.skor-radio[value="0"]').prop('checked', true);
                hitungTotalSkor();
            }, 100);
        }

        // Event listener untuk semua radio button skor
        $(document).ready(function() {
            $('.skor-radio').on('change', function() {
                hitungTotalSkor();
            });

            // Initial calculation
            hitungTotalSkor();
        });
    </script>
<?php endif; ?>