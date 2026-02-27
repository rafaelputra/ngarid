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

    /* Read-mode table */
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
</style>

<h5 class="fw-bold text-primary mb-3 pf-title"><i class="fa fa-file-lines"></i> Khusus untuk Pasien Obstetri Gynekologi</h5>
<hr>

<?php
$has_data   = !empty($pf);
$edit_mode  = ($has_data && $mode === 'edit');
$read_mode  = ($has_data && $mode !== 'edit');
?>

<?php if ($read_mode): ?>
    <!-- ============ READ MODE ============ -->
    <?php
    // Helper: ambil value dari $pf atau default
    $v = function ($field, $default = '') use ($pf, $has_data) {
        if ($has_data && isset($pf->$field)) {
            return $pf->$field;
        }
        return $default;
    };
    ?>

    <table class="table table-bordered pf-read-table">
        <!-- Kehamilan -->
        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-baby"></i> Data Kehamilan</td>
        </tr>
        <tr>
            <th>Sedang Hamil</th>
            <td><?= htmlspecialchars($v('is_hamil')) ?></td>
        </tr>
        <?php if ($v('is_hamil') === 'Ya'): ?>
            <tr>
                <th>HPHT</th>
                <td><?= htmlspecialchars($v('hpht')) ?></td>
            </tr>
            <tr>
                <th>HPL</th>
                <td><?= htmlspecialchars($v('hpl')) ?></td>
            </tr>
            <tr>
                <th>Usia Kehamilan (minggu)</th>
                <td><?= htmlspecialchars($v('usia_hamil')) ?></td>
            </tr>
            <tr>
                <th>Status G/P/A</th>
                <td>G<?= htmlspecialchars($v('status_g')) ?> P<?= htmlspecialchars($v('status_p')) ?> A<?= htmlspecialchars($v('status_a')) ?></td>
            </tr>
            <tr>
                <th>Penyulit Kehamilan</th>
                <td><?= htmlspecialchars($v('penyulit_kehamilan')) ?></td>
            </tr>
            <?php if ($v('penyulit_kehamilan') === 'Ada'): ?>
                <tr>
                    <th>Detail Penyulit</th>
                    <td><?= htmlspecialchars($v('detail_penyulit')) ?></td>
                </tr>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Riwayat Menstruasi -->
        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-calendar"></i> Riwayat Menstruasi</td>
        </tr>
        <tr>
            <th>Riwayat Menstruasi</th>
            <td><?= htmlspecialchars($v('riwayat_mens')) ?></td>
        </tr>

        <!-- Post Partum -->
        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-heart"></i> Post Partum</td>
        </tr>
        <tr>
            <th>Post Partum</th>
            <td><?= htmlspecialchars($v('post_partum')) ?></td>
        </tr>
        <?php if ($v('post_partum') === 'Ya'): ?>
            <tr>
                <th>Post Partum Hari ke-</th>
                <td><?= htmlspecialchars($v('post_partum_hari')) ?></td>
            </tr>
            <tr>
                <th>Riwayat Persalinan</th>
                <td><?= htmlspecialchars($v('riwayat_persalinan')) ?></td>
            </tr>
            <?php if ($v('riwayat_persalinan') === 'Partus Spontan dengan Penyulit'): ?>
                <tr>
                    <th>Jelaskan (Partus Spontan)</th>
                    <td><?= htmlspecialchars($v('partus_spontan_jelaskan')) ?></td>
                </tr>
            <?php endif; ?>
            <?php if ($v('riwayat_persalinan') === 'Partus dengan tindakan lainnya'): ?>
                <tr>
                    <th>Jelaskan (Tindakan)</th>
                    <td><?= htmlspecialchars($v('partus_tindakan_jelaskan')) ?></td>
                </tr>
            <?php endif; ?>
            <tr>
                <th>Lochea</th>
                <td><?= htmlspecialchars($v('lochea')) ?></td>
            </tr>
            <tr>
                <th>Jumlah Lochea</th>
                <td><?= htmlspecialchars($v('lochea_jumlah')) ?></td>
            </tr>
            <tr>
                <th>Payudara</th>
                <td><?= htmlspecialchars($v('payudara')) ?></td>
            </tr>
            <tr>
                <th>Pengeluaran ASI</th>
                <td><?= htmlspecialchars($v('pengeluaran_asi')) ?></td>
            </tr>
            <tr>
                <th>Kontraksi</th>
                <td><?= htmlspecialchars($v('kontraksi')) ?></td>
            </tr>
        <?php endif; ?>

        <!-- Skrining Gynekologi -->
        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-stethoscope"></i> Skrining Gynekologi</td>
        </tr>
        <tr>
            <th>Riwayat Pap Smear</th>
            <td><?= htmlspecialchars($v('riwayat_papsmear')) ?></td>
        </tr>
        <?php if ($v('riwayat_papsmear') === 'Pernah'): ?>
            <tr>
                <th>Tanggal Pap Smear</th>
                <td><?= htmlspecialchars($v('papsmear_tanggal')) ?></td>
            </tr>
            <tr>
                <th>Hasil Pap Smear</th>
                <td><?= htmlspecialchars($v('papsmear_hasil')) ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <th>Mammografi</th>
            <td><?= htmlspecialchars($v('mammografi')) ?></td>
        </tr>
        <?php if ($v('mammografi') === 'Pernah'): ?>
            <tr>
                <th>Tanggal Mammografi</th>
                <td><?= htmlspecialchars($v('mammografi_tanggal')) ?></td>
            </tr>
            <tr>
                <th>Hasil Mammografi</th>
                <td><?= htmlspecialchars($v('mammografi_hasil')) ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <th>SADARI</th>
            <td><?= htmlspecialchars($v('sadari')) ?></td>
        </tr>
        <?php if ($v('sadari') === 'Pernah'): ?>
            <tr>
                <th>Tanggal SADARI</th>
                <td><?= htmlspecialchars($v('sadari_tanggal')) ?></td>
            </tr>
            <tr>
                <th>Hasil SADARI</th>
                <td><?= htmlspecialchars($v('sadari_hasil')) ?></td>
            </tr>
        <?php endif; ?>

        <!-- Informasi Tambahan -->
        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-info-circle"></i> Informasi Tambahan</td>
        </tr>
        <tr>
            <th>Informasi Tambahan</th>
            <td><?= htmlspecialchars($v('informasi_tambahan')) ?></td>
        </tr>
        <?php if ($v('informasi_tambahan') === 'Ada'): ?>
            <tr>
                <th>Detail Informasi</th>
                <td><?= htmlspecialchars($v('informasi_tambahan_ada')) ?></td>
            </tr>
        <?php endif; ?>
    </table>

    <div class="mt-3 mb-3">
        <button type="button" class="btn btn-warning btn-sm" id="btn-edit-obs">
            <i class="fa fa-pen-to-square"></i> Edit
        </button>
        <button type="button" class="btn btn-danger btn-sm" id="btn-hapus-obs">
            <i class="fa fa-trash"></i> Hapus
        </button>
    </div>

    <script>
        // Edit button — reload form in edit mode
        $('#btn-edit-obs').on('click', function() {
            var url = '<?= base_url() ?>AsesmenRD/form_pasien_obstetri_gynekologi?no_rwt=<?= $no_rawat ?>&mode=edit';
            openContent(false, url);
        });

        // Hapus button
        $('#btn-hapus-obs').on('click', function() {
            Swal.fire({
                title: 'Hapus Data?',
                text: "Data obstetri gynekologi akan dihapus permanen!",
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
                        url: '<?= base_url() ?>AsesmenRD/hapus_obstetri',
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
                                var url = '<?= base_url() ?>AsesmenRD/form_pasien_obstetri_gynekologi?no_rwt=<?= $no_rawat ?>';
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
    <!-- ============ CREATE / EDIT MODE (Form) ============ -->
    <?php
    // Helper: get value from existing data (edit) or empty (create)
    $v = function ($field, $default = '') use ($pf, $edit_mode) {
        return $edit_mode && isset($pf->$field) ? $pf->$field : $default;
    };
    ?>

    <form class="row" id="form-assesment-global"
        action="<?= base_url() ?>AsesmenRD/<?= $edit_mode ? 'update_pasien_obstetri_gynekologi' : 'simpan_pasien_obstetri_gynekologi' ?>"
        method="post">
        <input type="hidden" name="no_rawat" value="<?= $no_rawat; ?>">
        <?php if ($edit_mode): ?>
            <input type="hidden" name="id" value="<?= $pf->id; ?>">
        <?php endif; ?>

        <!-- ====== KEHAMILAN ====== -->
        <div class="col-12 mb-2">
            <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-baby"></i> Data Kehamilan</label>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label fw-bold">Sedang Hamil</label>
            <div class="d-flex flex-wrap gap-3">
                <?php $hamil = $v('is_hamil', 'Tidak'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_hamil" value="Tidak" id="hamil_tidak" <?= $hamil == 'Tidak' ? 'checked' : '' ?> onchange="toggleHamil()">
                    <label class="form-check-label" for="hamil_tidak">Tidak</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_hamil" value="Ya" id="hamil_ya" <?= $hamil == 'Ya' ? 'checked' : '' ?> onchange="toggleHamil()">
                    <label class="form-check-label" for="hamil_ya">Ya</label>
                </div>
            </div>
        </div>

        <div id="section-hamil" class="<?= $hamil == 'Ya' ? '' : 'd-none' ?>">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">HPHT</label>
                    <input type="date" class="form-control" name="hpht" value="<?= htmlspecialchars($v('hpht')) ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">HPL</label>
                    <input type="date" class="form-control" name="hpl" value="<?= htmlspecialchars($v('hpl')) ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Usia Kehamilan (minggu)</label>
                    <input type="number" class="form-control" name="usia_hamil" value="<?= htmlspecialchars($v('usia_hamil')) ?>" placeholder="Minggu">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Status G (Gravida)</label>
                    <input type="text" class="form-control" name="status_g" value="<?= htmlspecialchars($v('status_g')) ?>" placeholder="Contoh: 2">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Status P (Para)</label>
                    <input type="text" class="form-control" name="status_p" value="<?= htmlspecialchars($v('status_p')) ?>" placeholder="Contoh: 1">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Status A (Abortus)</label>
                    <input type="text" class="form-control" name="status_a" value="<?= htmlspecialchars($v('status_a')) ?>" placeholder="Contoh: 0">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Penyulit Kehamilan</label>
                    <div class="d-flex flex-wrap gap-3 mb-2">
                        <?php $penyulit = $v('penyulit_kehamilan', 'Tidak Ada'); ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="penyulit_kehamilan" value="Tidak Ada" id="penyulit_tidak" <?= $penyulit == 'Tidak Ada' ? 'checked' : '' ?> onchange="togglePenyulit()">
                            <label class="form-check-label" for="penyulit_tidak">Tidak Ada</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="penyulit_kehamilan" value="Ada" id="penyulit_ada" <?= $penyulit == 'Ada' ? 'checked' : '' ?> onchange="togglePenyulit()">
                            <label class="form-check-label" for="penyulit_ada">Ada</label>
                        </div>
                    </div>
                    <textarea class="form-control <?= $penyulit == 'Ada' ? '' : 'd-none' ?>" name="detail_penyulit" id="detail_penyulit" rows="2" placeholder="Jelaskan penyulit kehamilan..."><?= htmlspecialchars($v('detail_penyulit')) ?></textarea>
                </div>
            </div>
        </div>

        <!-- ====== RIWAYAT MENSTRUASI ====== -->
        <div class="col-12 mb-2 mt-2">
            <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-calendar"></i> Riwayat Menstruasi</label>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label fw-bold">Riwayat Menstruasi</label>
            <div class="d-flex flex-wrap gap-3">
                <?php $mens = $v('riwayat_mens', 'Teratur'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="riwayat_mens" value="Teratur" id="mens_teratur" <?= $mens == 'Teratur' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="mens_teratur">Teratur</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="riwayat_mens" value="Tidak Teratur" id="mens_tidak_teratur" <?= $mens == 'Tidak Teratur' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="mens_tidak_teratur">Tidak Teratur</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="riwayat_mens" value="Monopause" id="mens_monopause" <?= $mens == 'Monopause' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="mens_monopause">Monopause</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="riwayat_mens" value="Dismenorea" id="mens_dismenorea" <?= $mens == 'Dismenorea' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="mens_dismenorea">Dismenorea</label>
                </div>
            </div>
        </div>

        <!-- ====== POST PARTUM ====== -->
        <div class="col-12 mb-2 mt-2">
            <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-heart"></i> Post Partum</label>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label fw-bold">Post Partum</label>
            <div class="d-flex flex-wrap gap-3">
                <?php $pp = $v('post_partum', 'Tidak'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="post_partum" value="Tidak" id="pp_tidak" <?= $pp == 'Tidak' ? 'checked' : '' ?> onchange="togglePostPartum()">
                    <label class="form-check-label" for="pp_tidak">Tidak</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="post_partum" value="Ya" id="pp_ya" <?= $pp == 'Ya' ? 'checked' : '' ?> onchange="togglePostPartum()">
                    <label class="form-check-label" for="pp_ya">Ya</label>
                </div>
            </div>
        </div>

        <div id="section-postpartum" class="<?= $pp == 'Ya' ? '' : 'd-none' ?>">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Post Partum Hari ke-</label>
                    <input type="number" class="form-control" name="post_partum_hari" value="<?= htmlspecialchars($v('post_partum_hari')) ?>" placeholder="Hari ke-">
                </div>

                <div class="col-md-8 mb-3">
                    <label class="form-label fw-bold">Riwayat Persalinan</label>
                    <div class="d-flex flex-wrap gap-3">
                        <?php $persalinan = $v('riwayat_persalinan', 'Partus Spontan'); ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="riwayat_persalinan" value="Partus Spontan" id="persalinan_spontan" <?= $persalinan == 'Partus Spontan' ? 'checked' : '' ?> onchange="togglePersalinan()">
                            <label class="form-check-label" for="persalinan_spontan">Partus Spontan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="riwayat_persalinan" value="Sectio Caesaria" id="persalinan_sc" <?= $persalinan == 'Sectio Caesaria' ? 'checked' : '' ?> onchange="togglePersalinan()">
                            <label class="form-check-label" for="persalinan_sc">Sectio Caesaria</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="riwayat_persalinan" value="Partus Spontan dengan Penyulit" id="persalinan_penyulit" <?= $persalinan == 'Partus Spontan dengan Penyulit' ? 'checked' : '' ?> onchange="togglePersalinan()">
                            <label class="form-check-label" for="persalinan_penyulit">Partus Spontan dengan Penyulit</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="riwayat_persalinan" value="Partus dengan tindakan lainnya" id="persalinan_tindakan" <?= $persalinan == 'Partus dengan tindakan lainnya' ? 'checked' : '' ?> onchange="togglePersalinan()">
                            <label class="form-check-label" for="persalinan_tindakan">Partus dengan tindakan lainnya</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3 <?= $persalinan == 'Partus Spontan dengan Penyulit' ? '' : 'd-none' ?>" id="wrap-partus-spontan-jelaskan">
                    <label class="form-label fw-bold">Jelaskan (Partus Spontan dengan Penyulit)</label>
                    <input type="text" class="form-control" name="partus_spontan_jelaskan" value="<?= htmlspecialchars($v('partus_spontan_jelaskan')) ?>" placeholder="Jelaskan penyulit...">
                </div>

                <div class="col-md-6 mb-3 <?= $persalinan == 'Partus dengan tindakan lainnya' ? '' : 'd-none' ?>" id="wrap-partus-tindakan-jelaskan">
                    <label class="form-label fw-bold">Jelaskan (Tindakan Lainnya)</label>
                    <input type="text" class="form-control" name="partus_tindakan_jelaskan" value="<?= htmlspecialchars($v('partus_tindakan_jelaskan')) ?>" placeholder="Jelaskan tindakan...">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Lochea</label>
                    <input type="text" class="form-control" name="lochea" value="<?= htmlspecialchars($v('lochea')) ?>" placeholder="Jenis lochea...">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Jumlah Lochea</label>
                    <input type="text" class="form-control" name="lochea_jumlah" value="<?= htmlspecialchars($v('lochea_jumlah')) ?>" placeholder="Jumlah...">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Payudara</label>
                    <input type="text" class="form-control" name="payudara" value="<?= htmlspecialchars($v('payudara')) ?>" placeholder="Kondisi payudara...">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Pengeluaran ASI</label>
                    <input type="text" class="form-control" name="pengeluaran_asi" value="<?= htmlspecialchars($v('pengeluaran_asi')) ?>" placeholder="Pengeluaran ASI...">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold">Kontraksi</label>
                    <input type="text" class="form-control" name="kontraksi" value="<?= htmlspecialchars($v('kontraksi')) ?>" placeholder="Kontraksi uterus...">
                </div>
            </div>
        </div>

        <!-- ====== SKRINING GYNEKOLOGI ====== -->
        <div class="col-12 mb-2 mt-2">
            <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-stethoscope"></i> Skrining Gynekologi</label>
        </div>

        <!-- Pap Smear -->
        <div class="col-md-12 mb-3">
            <label class="form-label fw-bold">Riwayat Pap Smear</label>
            <div class="d-flex flex-wrap gap-3 mb-2">
                <?php $pap = $v('riwayat_papsmear', 'Tidak Pernah'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="riwayat_papsmear" value="Tidak Pernah" id="pap_tidak" <?= $pap == 'Tidak Pernah' ? 'checked' : '' ?> onchange="togglePapsmear()">
                    <label class="form-check-label" for="pap_tidak">Tidak Pernah</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="riwayat_papsmear" value="Pernah" id="pap_pernah" <?= $pap == 'Pernah' ? 'checked' : '' ?> onchange="togglePapsmear()">
                    <label class="form-check-label" for="pap_pernah">Pernah</label>
                </div>
            </div>
        </div>
        <div id="section-papsmear" class="row <?= $pap == 'Pernah' ? '' : 'd-none' ?>">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Tanggal Pap Smear</label>
                <input type="date" class="form-control" name="papsmear_tanggal" value="<?= htmlspecialchars($v('papsmear_tanggal')) ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Hasil Pap Smear</label>
                <input type="text" class="form-control" name="papsmear_hasil" value="<?= htmlspecialchars($v('papsmear_hasil')) ?>" placeholder="Hasil pemeriksaan...">
            </div>
        </div>

        <!-- Mammografi -->
        <div class="col-md-12 mb-3">
            <label class="form-label fw-bold">Mammografi</label>
            <div class="d-flex flex-wrap gap-3 mb-2">
                <?php $mammo = $v('mammografi', 'Tidak Pernah'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mammografi" value="Tidak Pernah" id="mammo_tidak" <?= $mammo == 'Tidak Pernah' ? 'checked' : '' ?> onchange="toggleMammografi()">
                    <label class="form-check-label" for="mammo_tidak">Tidak Pernah</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="mammografi" value="Pernah" id="mammo_pernah" <?= $mammo == 'Pernah' ? 'checked' : '' ?> onchange="toggleMammografi()">
                    <label class="form-check-label" for="mammo_pernah">Pernah</label>
                </div>
            </div>
        </div>
        <div id="section-mammografi" class="row <?= $mammo == 'Pernah' ? '' : 'd-none' ?>">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Tanggal Mammografi</label>
                <input type="date" class="form-control" name="mammografi_tanggal" value="<?= htmlspecialchars($v('mammografi_tanggal')) ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Hasil Mammografi</label>
                <input type="text" class="form-control" name="mammografi_hasil" value="<?= htmlspecialchars($v('mammografi_hasil')) ?>" placeholder="Hasil pemeriksaan...">
            </div>
        </div>

        <!-- SADARI -->
        <div class="col-md-12 mb-3">
            <label class="form-label fw-bold">SADARI</label>
            <div class="d-flex flex-wrap gap-3 mb-2">
                <?php $sadari = $v('sadari', 'Tidak Pernah'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sadari" value="Tidak Pernah" id="sadari_tidak" <?= $sadari == 'Tidak Pernah' ? 'checked' : '' ?> onchange="toggleSadari()">
                    <label class="form-check-label" for="sadari_tidak">Tidak Pernah</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sadari" value="Pernah" id="sadari_pernah" <?= $sadari == 'Pernah' ? 'checked' : '' ?> onchange="toggleSadari()">
                    <label class="form-check-label" for="sadari_pernah">Pernah</label>
                </div>
            </div>
        </div>
        <div id="section-sadari" class="row <?= $sadari == 'Pernah' ? '' : 'd-none' ?>">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Tanggal SADARI</label>
                <input type="date" class="form-control" name="sadari_tanggal" value="<?= htmlspecialchars($v('sadari_tanggal')) ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Hasil SADARI</label>
                <input type="text" class="form-control" name="sadari_hasil" value="<?= htmlspecialchars($v('sadari_hasil')) ?>" placeholder="Hasil pemeriksaan...">
            </div>
        </div>

        <!-- ====== INFORMASI TAMBAHAN ====== -->
        <div class="col-12 mb-2 mt-2">
            <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-info-circle"></i> Informasi Tambahan</label>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label fw-bold">Informasi Tambahan</label>
            <div class="d-flex flex-wrap gap-3 mb-2">
                <?php $info = $v('informasi_tambahan', 'Tidak Ada'); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="informasi_tambahan" value="Tidak Ada" id="info_tidak" <?= $info == 'Tidak Ada' ? 'checked' : '' ?> onchange="toggleInfoTambahan()">
                    <label class="form-check-label" for="info_tidak">Tidak Ada</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="informasi_tambahan" value="Ada" id="info_ada" <?= $info == 'Ada' ? 'checked' : '' ?> onchange="toggleInfoTambahan()">
                    <label class="form-check-label" for="info_ada">Ada</label>
                </div>
            </div>
            <textarea class="form-control <?= $info == 'Ada' ? '' : 'd-none' ?>" name="informasi_tambahan_ada" id="informasi_tambahan_ada" rows="3" placeholder="Tuliskan informasi tambahan..."><?= htmlspecialchars($v('informasi_tambahan_ada')) ?></textarea>
        </div>

        <!-- Tombol -->
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> <?= $edit_mode ? 'Perbarui' : 'Simpan' ?>
            </button>
            <?php if ($edit_mode): ?>
                <button type="button" class="btn btn-secondary" id="btn-batal-edit-obs">
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
        function toggleHamil() {
            var val = $('input[name="is_hamil"]:checked').val();
            if (val === 'Ya') {
                $('#section-hamil').removeClass('d-none');
            } else {
                $('#section-hamil').addClass('d-none');
            }
        }

        function togglePenyulit() {
            var val = $('input[name="penyulit_kehamilan"]:checked').val();
            if (val === 'Ada') {
                $('#detail_penyulit').removeClass('d-none');
            } else {
                $('#detail_penyulit').addClass('d-none').val('');
            }
        }

        function togglePostPartum() {
            var val = $('input[name="post_partum"]:checked').val();
            if (val === 'Ya') {
                $('#section-postpartum').removeClass('d-none');
            } else {
                $('#section-postpartum').addClass('d-none');
            }
        }

        function togglePersalinan() {
            var val = $('input[name="riwayat_persalinan"]:checked').val();
            $('#wrap-partus-spontan-jelaskan').addClass('d-none');
            $('#wrap-partus-tindakan-jelaskan').addClass('d-none');

            if (val === 'Partus Spontan dengan Penyulit') {
                $('#wrap-partus-spontan-jelaskan').removeClass('d-none');
            } else if (val === 'Partus dengan tindakan lainnya') {
                $('#wrap-partus-tindakan-jelaskan').removeClass('d-none');
            }
        }

        function togglePapsmear() {
            var val = $('input[name="riwayat_papsmear"]:checked').val();
            if (val === 'Pernah') {
                $('#section-papsmear').removeClass('d-none');
            } else {
                $('#section-papsmear').addClass('d-none');
            }
        }

        function toggleMammografi() {
            var val = $('input[name="mammografi"]:checked').val();
            if (val === 'Pernah') {
                $('#section-mammografi').removeClass('d-none');
            } else {
                $('#section-mammografi').addClass('d-none');
            }
        }

        function toggleSadari() {
            var val = $('input[name="sadari"]:checked').val();
            if (val === 'Pernah') {
                $('#section-sadari').removeClass('d-none');
            } else {
                $('#section-sadari').addClass('d-none');
            }
        }

        function toggleInfoTambahan() {
            var val = $('input[name="informasi_tambahan"]:checked').val();
            if (val === 'Ada') {
                $('#informasi_tambahan_ada').removeClass('d-none');
            } else {
                $('#informasi_tambahan_ada').addClass('d-none').val('');
            }
        }

        <?php if ($edit_mode): ?>
            // Batal edit — kembali ke read mode
            $('#btn-batal-edit-obs').on('click', function() {
                obsAutoSave.clear();
                var url = '<?= base_url() ?>AsesmenRD/form_pasien_obstetri_gynekologi?no_rwt=<?= $no_rawat ?>';
                openContent(false, url);
            });
        <?php endif; ?>

        // ============ AUTO-SAVE ke localStorage ============
        var obsAutoSave = (function() {
            var STORAGE_KEY = 'obs_draft_<?= $no_rawat ?>_<?= $edit_mode ? 'edit' : 'create' ?>';
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
                toggleHamil();
                togglePenyulit();
                togglePostPartum();
                togglePersalinan();
                togglePapsmear();
                toggleMammografi();
                toggleSadari();
                toggleInfoTambahan();
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
            obsAutoSave.scheduleSave();
        });

        // Hapus draft saat reset
        $('#form-assesment-global').on('reset', function() {
            obsAutoSave.clear();
        });

        // Cek & restore draft saat form dimuat
        $(document).one('formLoaded', function() {
            obsAutoSave.restore();
        });
    </script>
<?php endif; ?>