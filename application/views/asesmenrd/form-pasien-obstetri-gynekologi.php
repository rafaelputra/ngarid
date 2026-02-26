<style>
    #form-assesment-global {
        font-size: 0.9rem;
    }

    #form-assesment-global .section-heading {
        font-size: 1rem;
        margin-bottom: .25rem;
    }

    #form-assesment-global .form-label {
        font-size: 0.9rem;
        margin-bottom: .25rem;
    }

    #form-assesment-global .form-check-label {
        font-size: 0.9rem;
    }

    #form-assesment-global .form-control,
    #form-assesment-global .form-select {
        font-size: 0.9rem;
    }

    #form-assesment-global table td {
        font-size: 0.9rem;
        vertical-align: middle;
        padding: .35rem .5rem;
    }

    #form-assesment-global table .form-control {
        font-size: 0.9rem;
        padding: .3rem .5rem;
        height: auto;
    }

    .pf-title {
        font-size: 1.15rem;
    }

    /* Read-mode table */
    .pf-read-table {
        font-size: 0.9rem;
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
        font-size: 0.95rem;
    }
</style>

<h5 class="fw-bold text-primary mb-3 pf-title"><i class="fa fa-file-lines"></i> Penilaian Fisik</h5>
<hr>

<?php
$has_data  = !empty($pf);
$edit_mode = ($has_data && $mode === 'edit');
$read_mode = ($has_data && $mode !== 'edit');
?>

<?php if ($read_mode): ?>
    <!-- ===================== READ MODE (Tabel) ===================== -->
    <div class="mb-3">
        <button type="button" class="btn btn-warning btn-sm" id="btn-edit-pf">
            <i class="fa fa-pen-to-square"></i> Edit
        </button>
        <button type="button" class="btn btn-danger btn-sm" id="btn-hapus-pf">
            <i class="fa fa-trash"></i> Hapus
        </button>
    </div>

    <table class="table table-bordered pf-read-table">
        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-stethoscope"></i> Keadaan Umum & GCS</td>
        </tr>
        <tr>
            <th>Keadaan Umum</th>
            <td><?= htmlspecialchars($pf->kunjungan_umum_gcs) ?></td>
        </tr>
        <tr>
            <th>GCS E / V / M</th>
            <td><?= $pf->kunjungan_umum_e ?> / <?= $pf->kunjungan_umum_v ?> / <?= $pf->kunjungan_umum_m ?></td>
        </tr>
        <tr>
            <th>GCS Total</th>
            <td><?= $pf->kunjungan_umum_total ?></td>
        </tr>

        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-stethoscope"></i> Tanda-tanda Vital</td>
        </tr>
        <tr>
            <th>Tekanan Darah</th>
            <td><?= $pf->tekanan_darah_sistolik ?> / <?= $pf->tekanan_darah_diastolik ?> mmHg</td>
        </tr>
        <tr>
            <th>Nadi</th>
            <td><?= $pf->nadi ?> x/menit</td>
        </tr>
        <tr>
            <th>SpO2</th>
            <td><?= htmlspecialchars($pf->spo2) ?> %</td>
        </tr>
        <tr>
            <th>Suhu Tubuh</th>
            <td><?= $pf->suhu_tubuh ?> &deg;C</td>
        </tr>
        <tr>
            <th>Respirasi</th>
            <td><?= $pf->respirasi ?> x/menit</td>
        </tr>
        <tr>
            <th>GDS</th>
            <td><?= htmlspecialchars($pf->gds) ?></td>
        </tr>

        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-stethoscope"></i> Tinggi Badan / Berat Badan</td>
        </tr>
        <tr>
            <th>Tinggi Badan</th>
            <td><?= $pf->tinggi_badan ?> cm</td>
        </tr>
        <tr>
            <th>Berat Badan</th>
            <td><?= $pf->berat_badan ?> kg</td>
        </tr>

        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-clipboard-list"></i> Informasi Tambahan</td>
        </tr>
        <tr>
            <th>Informasi Tambahan</th>
            <td><?= $pf->informasi_tambahan ? 'Ada' : 'Tidak ada' ?><?= $pf->informasi_tambahan && $pf->informasi_tambahan_jelaskan ? ' &mdash; ' . htmlspecialchars($pf->informasi_tambahan_jelaskan) : '' ?></td>
        </tr>

        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-stethoscope"></i> Pemeriksaan Fisik</td>
        </tr>
        <tr>
            <th>Pernafasan</th>
            <td><?= htmlspecialchars($pf->pernafasan) ?><?= $pf->pernafasan === 'Lain-lain' && $pf->pernafasan_lainnya ? ' &mdash; ' . htmlspecialchars($pf->pernafasan_lainnya) : '' ?></td>
        </tr>
        <tr>
            <th>Penglihatan</th>
            <td><?= htmlspecialchars($pf->penglihatan) ?><?= $pf->penglihatan === 'Alat Bantu' && $pf->penglihatan_alat_bantu ? ' &mdash; ' . htmlspecialchars($pf->penglihatan_alat_bantu) : '' ?></td>
        </tr>
        <tr>
            <th>Pendengaran</th>
            <td><?= htmlspecialchars($pf->pendengaran) ?><?= $pf->pendengaran === 'Alat Bantu' && $pf->pendengaran_alat_bantu ? ' &mdash; ' . htmlspecialchars($pf->pendengaran_alat_bantu) : '' ?></td>
        </tr>
        <tr>
            <th>Mulut</th>
            <td><?= htmlspecialchars($pf->mulut) ?><?= $pf->mulut === 'Lain-lain' && $pf->mulut_lainnya ? ' &mdash; ' . htmlspecialchars($pf->mulut_lainnya) : '' ?></td>
        </tr>
        <tr>
            <th>Reflek</th>
            <td><?= htmlspecialchars($pf->reflek) ?></td>
        </tr>
        <tr>
            <th>Menelan</th>
            <td><?= htmlspecialchars($pf->menelan) ?></td>
        </tr>
        <tr>
            <th>Bicara</th>
            <td><?= htmlspecialchars($pf->bicara) ?></td>
        </tr>
        <tr>
            <th>Luka</th>
            <td><?= $pf->luka ? 'Ada' : 'Tidak Ada' ?><?= $pf->luka && $pf->luka_detail ? ' &mdash; ' . htmlspecialchars($pf->luka_detail) : '' ?></td>
        </tr>
        <tr>
            <th>Defekasi</th>
            <td><?= htmlspecialchars($pf->defekasi) ?></td>
        </tr>
        <tr>
            <th>Miksi (BAK)</th>
            <td><?= htmlspecialchars($pf->milksi) ?></td>
        </tr>
        <tr>
            <th>Gastrointestinal</th>
            <td><?= htmlspecialchars($pf->gastrointestinal) ?></td>
        </tr>

        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-bed"></i> Pola Tidur</td>
        </tr>
        <tr>
            <th>Pola Tidur</th>
            <td><?= $pf->pola_tidur ? 'Masalah' : 'Normal' ?><?= $pf->pola_tidur && $pf->pola_tidur_masalah ? ' &mdash; ' . htmlspecialchars($pf->pola_tidur_masalah) : '' ?></td>
        </tr>
    </table>

    <script>
        // Edit button — reload form in edit mode
        $('#btn-edit-pf').on('click', function() {
            var url = '<?= base_url() ?>AsesmenRD/form_penilaian_fisik?no_rwt=<?= $no_rawat ?>&mode=edit';
            openContent(false, url);
        });

        // Hapus button
        $('#btn-hapus-pf').on('click', function() {
            Swal.fire({
                title: 'Hapus Data?',
                text: "Data penilaian fisik akan dihapus permanen!",
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
                        url: '<?= base_url() ?>AsesmenRD/hapus_penilaian_fisik',
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
                                var url = '<?= base_url() ?>AsesmenRD/form_penilaian_fisik?no_rwt=<?= $no_rawat ?>';
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
    // Helper: get value from existing data (edit) or empty (create)
    $v = function ($field, $default = '') use ($pf, $edit_mode) {
        return $edit_mode && isset($pf->$field) ? $pf->$field : $default;
    };
    ?>

    <form class="row" id="form-assesment-global"
        action="<?= base_url() ?>AsesmenRD/<?= $edit_mode ? 'update_penilaian_fisik' : 'simpan_penilaian_fisik' ?>"
        method="post">
        <input type="hidden" name="no_rawat" value="<?= $no_rawat; ?>">
        <?php if ($edit_mode): ?>
            <input type="hidden" name="id" value="<?= $pf->id; ?>">
        <?php endif; ?>

        <!-- Keadaan Umum & GCS -->
        <div class="col-12 mb-2">
            <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-stethoscope"></i> Keadaan Umum & GCS</label>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">Keadaan Umum</label>
            <input type="text" class="form-control" name="kunjungan_umum_gcs" placeholder="Keadaan umum pasien" value="<?= htmlspecialchars($v('kunjungan_umum_gcs')) ?>">
        </div>

        <div class="col-md-2 mb-3">
            <label class="form-label fw-bold">GCS E</label>
            <input type="number" class="form-control gcs-input" name="kunjungan_umum_e" id="gcs_e" value="<?= $v('kunjungan_umum_e') ?>">
        </div>
        <div class="col-md-2 mb-3">
            <label class="form-label fw-bold">GCS V</label>
            <input type="number" class="form-control gcs-input" name="kunjungan_umum_v" id="gcs_v" value="<?= $v('kunjungan_umum_v') ?>">
        </div>
        <div class="col-md-2 mb-3">
            <label class="form-label fw-bold">GCS M</label>
            <input type="number" class="form-control gcs-input" name="kunjungan_umum_m" id="gcs_m" value="<?= $v('kunjungan_umum_m') ?>">
        </div>
        <div class="col-md-2 mb-3">
            <label class="form-label fw-bold">Total</label>
            <input type="number" class="form-control" name="kunjungan_umum_total" id="gcs_total" readonly style="background-color: #e9ecef; font-weight: bold;" value="<?= $v('kunjungan_umum_total') ?>">
        </div>

        <!-- Tanda Vital -->
        <div class="col-12 mb-2">
            <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-stethoscope"></i> Tanda-tanda Vital</label>
        </div>

        <div class="col-md-6">
            <table class="table table-borderless mb-0">
                <tr>
                    <td class="fw-bold" style="width:130px;">Tekanan Darah</td>
                    <td>: <input type="number" class="form-control d-inline" name="tekanan_darah_sistolik" style="width:80px;" value="<?= $v('tekanan_darah_sistolik') ?>"> / <input type="number" class="form-control d-inline" name="tekanan_darah_diastolik" style="width:80px;" value="<?= $v('tekanan_darah_diastolik') ?>"> mmHg</td>
                </tr>
                <tr>
                    <td class="fw-bold">Nadi</td>
                    <td>: <input type="number" class="form-control d-inline" name="nadi" style="width:80px;" value="<?= $v('nadi') ?>"> x/menit</td>
                </tr>
                <tr>
                    <td class="fw-bold">SpO2</td>
                    <td>: <input type="text" class="form-control d-inline" name="spo2" style="width:80px;" value="<?= htmlspecialchars($v('spo2')) ?>"> %</td>
                </tr>
            </table>
        </div>

        <div class="col-md-6">
            <table class="table table-borderless mb-0">
                <tr>
                    <td class="fw-bold" style="width:130px;">Suhu Tubuh</td>
                    <td>: <input type="number" class="form-control d-inline" name="suhu_tubuh" style="width:80px;" value="<?= $v('suhu_tubuh') ?>"> &deg;C</td>
                </tr>
                <tr>
                    <td class="fw-bold">Respirasi</td>
                    <td>: <input type="number" class="form-control d-inline" name="respirasi" style="width:80px;" value="<?= $v('respirasi') ?>"> x/menit</td>
                </tr>
                <tr>
                    <td class="fw-bold">GDS</td>
                    <td>: <input type="text" class="form-control d-inline" name="gds" style="width:80px;" value="<?= htmlspecialchars($v('gds')) ?>"></td>
                </tr>
            </table>
        </div>

        <div class="col-12 mb-2">
            <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-stethoscope"></i> Tinggi Badan/Berat Badan</label>
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label fw-bold">Tinggi Badan (cm)</label>
            <input type="number" class="form-control" name="tinggi_badan" value="<?= $v('tinggi_badan') ?>">
        </div>
        <div class="col-md-3 mb-3">
            <label class="form-label fw-bold">Berat Badan (kg)</label>
            <input type="number" class="form-control" name="berat_badan" value="<?= $v('berat_badan') ?>">
        </div>

        <!-- Informasi Tambahan -->
        <div class="col-12 mb-2 mt-2">
            <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-clipboard-list"></i> Informasi Tambahan</label>
        </div>

        <div class="col-md-12 mb-3">
            <div class="d-flex gap-3 mb-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="informasi_tambahan" value="0" id="info_tidak" <?= $v('informasi_tambahan', '0') == '0' ? 'checked' : '' ?> onchange="toggleInfoTambahan()">
                    <label class="form-check-label" for="info_tidak">Tidak ada</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="informasi_tambahan" value="1" id="info_ya" <?= $v('informasi_tambahan') == '1' ? 'checked' : '' ?> onchange="toggleInfoTambahan()">
                    <label class="form-check-label" for="info_ya">Ada</label>
                </div>
            </div>
            <textarea class="form-control <?= $v('informasi_tambahan') == '1' ? '' : 'd-none' ?>" name="informasi_tambahan_jelaskan" id="info_tambahan_text" rows="2" placeholder="Jelaskan informasi tambahan..."><?= htmlspecialchars($v('informasi_tambahan_jelaskan')) ?></textarea>
        </div>

        <!-- Pernafasan -->
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Pernafasan</label>
            <div class="d-flex flex-wrap gap-3 mb-2">
                <?php $pern = $v('pernafasan', 'Normal'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pernafasan" value="Normal" id="pernafasan_normal" <?= $pern == 'Normal' ? 'checked' : '' ?> onchange="toggleLainnya('pernafasan')">
                    <label class="form-check-label" for="pernafasan_normal">Normal</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pernafasan" value="Batuk" id="pernafasan_batuk" <?= $pern == 'Batuk' ? 'checked' : '' ?> onchange="toggleLainnya('pernafasan')">
                    <label class="form-check-label" for="pernafasan_batuk">Batuk</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pernafasan" value="Sesak" id="pernafasan_sesak" <?= $pern == 'Sesak' ? 'checked' : '' ?> onchange="toggleLainnya('pernafasan')">
                    <label class="form-check-label" for="pernafasan_sesak">Sesak</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pernafasan" value="Lain-lain" id="pernafasan_lainlain" <?= $pern == 'Lain-lain' ? 'checked' : '' ?> onchange="toggleLainnya('pernafasan')">
                    <label class="form-check-label" for="pernafasan_lainlain">Lain-lain</label>
                </div>
            </div>
            <input type="text" class="form-control <?= $pern == 'Lain-lain' ? '' : 'd-none' ?>" name="pernafasan_lainnya" id="pernafasan_lainnya" placeholder="Sebutkan..." value="<?= htmlspecialchars($v('pernafasan_lainnya')) ?>">
        </div>

        <!-- Penglihatan -->
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Penglihatan</label>
            <div class="d-flex flex-wrap gap-3 mb-2">
                <?php $peng = $v('penglihatan', 'Baik'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="penglihatan" value="Baik" id="penglihatan_baik" <?= $peng == 'Baik' ? 'checked' : '' ?> onchange="toggleAlatBantu('penglihatan')">
                    <label class="form-check-label" for="penglihatan_baik">Baik</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="penglihatan" value="Rusak" id="penglihatan_rusak" <?= $peng == 'Rusak' ? 'checked' : '' ?> onchange="toggleAlatBantu('penglihatan')">
                    <label class="form-check-label" for="penglihatan_rusak">Rusak</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="penglihatan" value="Alat Bantu" id="penglihatan_alatbantu" <?= $peng == 'Alat Bantu' ? 'checked' : '' ?> onchange="toggleAlatBantu('penglihatan')">
                    <label class="form-check-label" for="penglihatan_alatbantu">Alat Bantu</label>
                </div>
            </div>
            <input type="text" class="form-control <?= $peng == 'Alat Bantu' ? '' : 'd-none' ?>" name="penglihatan_alat_bantu" id="penglihatan_alat_bantu" placeholder="Jenis alat bantu..." value="<?= htmlspecialchars($v('penglihatan_alat_bantu')) ?>">
        </div>

        <!-- Pendengaran -->
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Pendengaran</label>
            <div class="d-flex flex-wrap gap-3 mb-2">
                <?php $deng = $v('pendengaran', 'Baik'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pendengaran" value="Baik" id="pendengaran_baik" <?= $deng == 'Baik' ? 'checked' : '' ?> onchange="toggleAlatBantu('pendengaran')">
                    <label class="form-check-label" for="pendengaran_baik">Baik</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pendengaran" value="Rusak" id="pendengaran_rusak" <?= $deng == 'Rusak' ? 'checked' : '' ?> onchange="toggleAlatBantu('pendengaran')">
                    <label class="form-check-label" for="pendengaran_rusak">Rusak</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pendengaran" value="Alat Bantu" id="pendengaran_alatbantu" <?= $deng == 'Alat Bantu' ? 'checked' : '' ?> onchange="toggleAlatBantu('pendengaran')">
                    <label class="form-check-label" for="pendengaran_alatbantu">Alat Bantu</label>
                </div>
            </div>
            <input type="text" class="form-control <?= $deng == 'Alat Bantu' ? '' : 'd-none' ?>" name="pendengaran_alat_bantu" id="pendengaran_alat_bantu" placeholder="Jenis alat bantu..." value="<?= htmlspecialchars($v('pendengaran_alat_bantu')) ?>">
        </div>

        <!-- Mulut -->
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Mulut</label>
            <div class="d-flex flex-wrap gap-3 mb-2">
                <?php $mlt = $v('mulut', 'Bersih'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mulut" value="Bersih" id="mulut_bersih" <?= $mlt == 'Bersih' ? 'checked' : '' ?> onchange="toggleLainnya('mulut')">
                    <label class="form-check-label" for="mulut_bersih">Bersih</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mulut" value="Kotor" id="mulut_kotor" <?= $mlt == 'Kotor' ? 'checked' : '' ?> onchange="toggleLainnya('mulut')">
                    <label class="form-check-label" for="mulut_kotor">Kotor</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mulut" value="Lain-lain" id="mulut_lainlain" <?= $mlt == 'Lain-lain' ? 'checked' : '' ?> onchange="toggleLainnya('mulut')">
                    <label class="form-check-label" for="mulut_lainlain">Lain-lain</label>
                </div>
            </div>
            <input type="text" class="form-control <?= $mlt == 'Lain-lain' ? '' : 'd-none' ?>" name="mulut_lainnya" id="mulut_lainnya" placeholder="Sebutkan..." value="<?= htmlspecialchars($v('mulut_lainnya')) ?>">
        </div>

        <!-- Reflek, Menelan, Bicara -->
        <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">Reflek</label>
            <div class="d-flex flex-wrap gap-3">
                <?php $ref = $v('reflek', 'Normal'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="reflek" value="Normal" id="reflek_normal" <?= $ref == 'Normal' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="reflek_normal">Normal</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="reflek" value="Sulit" id="reflek_sulit" <?= $ref == 'Sulit' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="reflek_sulit">Sulit</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="reflek" value="Rusak" id="reflek_rusak" <?= $ref == 'Rusak' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="reflek_rusak">Rusak</label>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">Menelan</label>
            <div class="d-flex flex-wrap gap-3">
                <?php $mnl = $v('menelan', 'Normal'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="menelan" value="Normal" id="menelan_normal" <?= $mnl == 'Normal' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="menelan_normal">Normal</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="menelan" value="Gangguan" id="menelan_gangguan" <?= $mnl == 'Gangguan' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="menelan_gangguan">Gangguan</label>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">Bicara</label>
            <div class="d-flex flex-wrap gap-3">
                <?php $bcr = $v('bicara', 'Normal'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="bicara" value="Normal" id="bicara_normal" <?= $bcr == 'Normal' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="bicara_normal">Normal</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="bicara" value="Gangguan" id="bicara_gangguan" <?= $bcr == 'Gangguan' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="bicara_gangguan">Gangguan</label>
                </div>
            </div>
        </div>

        <!-- Luka -->
        <div class="col-md-12 mb-3">
            <label class="form-label fw-bold">Luka</label>
            <div class="d-flex gap-3 mb-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="luka" value="0" id="luka_tidak" <?= $v('luka', '0') == '0' ? 'checked' : '' ?> onchange="toggleLuka()">
                    <label class="form-check-label" for="luka_tidak">Tidak Ada</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="luka" value="1" id="luka_ya" <?= $v('luka') == '1' ? 'checked' : '' ?> onchange="toggleLuka()">
                    <label class="form-check-label" for="luka_ya">Ada</label>
                </div>
            </div>
            <textarea class="form-control <?= $v('luka') == '1' ? '' : 'd-none' ?>" name="luka_detail" id="luka_detail_text" rows="2" placeholder="Lokasi, jenis, ukuran luka..."><?= htmlspecialchars($v('luka_detail')) ?></textarea>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">Defekasi</label>
            <div class="d-flex flex-column gap-1">
                <?php $def = $v('defekasi', 'Normal'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="defekasi" value="Normal" id="defekasi_normal" <?= $def == 'Normal' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="defekasi_normal">Normal</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="defekasi" value="Konstipasi" id="defekasi_konstipasi" <?= $def == 'Konstipasi' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="defekasi_konstipasi">Konstipasi</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="defekasi" value="Inkontinensia alvi" id="defekasi_inkontinensia" <?= $def == 'Inkontinensia alvi' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="defekasi_inkontinensia">Inkontinensia alvi</label>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">Miksi (BAK)</label>
            <div class="d-flex flex-column gap-1">
                <?php $mks = $v('milksi', 'Normal'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="milksi" value="Normal" id="miksi_normal" <?= $mks == 'Normal' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="miksi_normal">Normal</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="milksi" value="Retensio" id="miksi_retensio" <?= $mks == 'Retensio' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="miksi_retensio">Retensio</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="milksi" value="Inkontinensia uri" id="miksi_inkontinensia" <?= $mks == 'Inkontinensia uri' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="miksi_inkontinensia">Inkontinensia uri</label>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">Gastrointestinal</label>
            <div class="d-flex flex-column gap-1">
                <?php $gas = $v('gastrointestinal', 'Normal'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gastrointestinal" value="Normal" id="gastro_normal" <?= $gas == 'Normal' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="gastro_normal">Normal</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gastrointestinal" value="Refluks" id="gastro_refluks" <?= $gas == 'Refluks' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="gastro_refluks">Refluks</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gastrointestinal" value="Nausea" id="gastro_nausea" <?= $gas == 'Nausea' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="gastro_nausea">Nausea</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gastrointestinal" value="Muntah" id="gastro_muntah" <?= $gas == 'Muntah' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="gastro_muntah">Muntah</label>
                </div>
            </div>
        </div>

        <!-- Pola Tidur -->
        <div class="col-12 mb-2 mt-2">
            <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-bed"></i> Pola Tidur</label>
        </div>

        <div class="col-md-12 mb-3">
            <div class="d-flex gap-3 mb-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pola_tidur" value="0" id="tidur_tidak" <?= $v('pola_tidur', '0') == '0' ? 'checked' : '' ?> onchange="togglePolaTidur()">
                    <label class="form-check-label" for="tidur_tidak">Normal</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pola_tidur" value="1" id="tidur_ya" <?= $v('pola_tidur') == '1' ? 'checked' : '' ?> onchange="togglePolaTidur()">
                    <label class="form-check-label" for="tidur_ya">Masalah</label>
                </div>
            </div>
            <input type="text" class="form-control <?= $v('pola_tidur') == '1' ? '' : 'd-none' ?>" name="pola_tidur_masalah" id="pola_tidur_text" placeholder="Jelaskan masalah pola tidur..." value="<?= htmlspecialchars($v('pola_tidur_masalah')) ?>">
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
        // Auto-hitung GCS Total
        $(document).on('input', '.gcs-input', function() {
            var e = parseInt($('#gcs_e').val()) || 0;
            var v = parseInt($('#gcs_v').val()) || 0;
            var m = parseInt($('#gcs_m').val()) || 0;
            var total = e + v + m;
            $('#gcs_total').val(total > 0 ? total : '');
        });

        function toggleInfoTambahan() {
            var val = $('input[name="informasi_tambahan"]:checked').val();
            if (val == '1') {
                $('#info_tambahan_text').removeClass('d-none');
            } else {
                $('#info_tambahan_text').addClass('d-none').val('');
            }
        }

        function toggleLainnya(name) {
            var val = $('input[name="' + name + '"]:checked').val();
            if (val == 'Lain-lain') {
                $('#' + name + '_lainnya').removeClass('d-none');
            } else {
                $('#' + name + '_lainnya').addClass('d-none').val('');
            }
        }

        function toggleAlatBantu(name) {
            var val = $('input[name="' + name + '"]:checked').val();
            if (val == 'Alat Bantu') {
                $('#' + name + '_alat_bantu').removeClass('d-none');
            } else {
                $('#' + name + '_alat_bantu').addClass('d-none').val('');
            }
        }

        function toggleLuka() {
            var val = $('input[name="luka"]:checked').val();
            if (val == '1') {
                $('#luka_detail_text').removeClass('d-none');
            } else {
                $('#luka_detail_text').addClass('d-none').val('');
            }
        }

        function togglePolaTidur() {
            var val = $('input[name="pola_tidur"]:checked').val();
            if (val == '1') {
                $('#pola_tidur_text').removeClass('d-none');
            } else {
                $('#pola_tidur_text').addClass('d-none').val('');
            }
        }

        <?php if ($edit_mode): ?>
            // Batal edit — kembali ke read mode
            $('#btn-batal-edit').on('click', function() {
                pfAutoSave.clear();
                var url = '<?= base_url() ?>AsesmenRD/form_penilaian_fisik?no_rwt=<?= $no_rawat ?>';
                openContent(false, url);
            });
        <?php endif; ?>

        // ============ AUTO-SAVE ke localStorage ============
        var pfAutoSave = (function() {
            var STORAGE_KEY = 'pf_draft_<?= $no_rawat ?>_<?= $edit_mode ? 'edit' : 'create' ?>';
            var timer = null;

            function getFormData() {
                var data = {};
                $('#form-assesment-global').find('input, textarea, select').each(function() {
                    var el = $(this);
                    var name = el.attr('name');
                    if (!name || name === 'no_rawat' || name === 'id') return;
                    if (el.is(':radio')) {
                        if (el.is(':checked')) data[name] = el.val();
                    } else {
                        data[name] = el.val();
                    }
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

            function restore() {
                try {
                    var raw = localStorage.getItem(STORAGE_KEY);
                    if (!raw) return;
                    var d = JSON.parse(raw);
                    if (!d || !d._timestamp) return;

                    // Abaikan draft lebih dari 24 jam
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

            function applyData(d) {
                $('#form-assesment-global').find('input, textarea, select').each(function() {
                    var el = $(this);
                    var name = el.attr('name');
                    if (!name || !(name in d) || name === 'no_rawat' || name === 'id') return;
                    if (el.is(':radio')) {
                        el.prop('checked', el.val() === d[name]);
                    } else {
                        el.val(d[name]);
                    }
                });
                // Trigger toggle visibility
                toggleInfoTambahan();
                toggleLainnya('pernafasan');
                toggleLainnya('mulut');
                toggleAlatBantu('penglihatan');
                toggleAlatBantu('pendengaran');
                toggleLuka();
                togglePolaTidur();
                // Recalc GCS
                $('.gcs-input').trigger('input');
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

        // Listen semua perubahan input
        $('#form-assesment-global').on('input change', 'input, textarea, select', function() {
            pfAutoSave.scheduleSave();
        });

        // Hapus draft saat reset
        $('#form-assesment-global').on('reset', function() {
            pfAutoSave.clear();
        });

        // Cek & restore draft saat form dimuat (tunggu Swal loading tertutup)
        $(document).one('formLoaded', function() {
            pfAutoSave.restore();
        });
    </script>
<?php endif; ?>