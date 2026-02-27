<style>
    #form-assesment-global {
        font-size: 1rem;
    }

    #form-assesment-global .section-heading {
        font-size: 1.1rem;
        margin-bottom: .25rem;
    }

    #form-assesment-global .form-label,
    #form-assesment-global .form-check-label {
        font-size: 1rem;
    }

    #form-assesment-global .form-control,
    #form-assesment-global .form-select {
        font-size: 1rem;
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

    .score-pill {
        font-size: 0.9rem;
        padding: .15rem .5rem;
    }
</style>

<h5 class="fw-bold text-primary mb-3 pf-title"><i class="fa fa-file-lines"></i> Pengkajian Status Nutrisi</h5>
<hr>

<?php
$has_data  = !empty($pf);
$edit_mode = ($has_data && $mode === 'edit');
$read_mode = ($has_data && $mode !== 'edit');
?>

<?php if ($read_mode): ?>
    <?php
    $total_skor = (int) $pf->penurunan_bb_skor;
    ?>

    <table class="table table-bordered pf-read-table">
        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-stethoscope"></i> Untuk Pasien Dewasa / Lansia / Onkologi</td>
        </tr>
        <tr>
            <th>Penurunan BB 6 bulan terakhir</th>
            <td><?= htmlspecialchars($pf->penurunan_bb_opsi) ?> (Skor <?= (int) $pf->penurunan_bb_skor ?>)</td>
        </tr>
        <tr>
            <th>Asupan makanan berkurang</th>
            <td><?= $pf->asupan_makanan_dlo ?: '-' ?></td>
        </tr>
        <tr>
            <th>Diagnosa khusus</th>
            <td>
                <?= htmlspecialchars($pf->diagnosa_khusus) ?>
                <?= $pf->diagnosa_khusus === 'Lain-lain' && $pf->diagnosa_khusus_lainnya ? ' — ' . htmlspecialchars($pf->diagnosa_khusus_lainnya) : '' ?>
            </td>
        </tr>
        <tr>
            <th>Total Skor</th>
            <td><strong><?= $total_skor ?></strong> (Skor penurunan BB; ≥ 2 Beresiko Malnutrisi)</td>
        </tr>
        <tr>
            <th>Kesimpulan Penurunan BB</th>
            <td><?= htmlspecialchars($pf->penurunan_bb_kesimpulan ?? ($total_skor >= 2 ? 'Beresiko Malnutrisi' : 'Tidak Beresiko Malnutrisi')) ?></td>
        </tr>

        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-heartbeat"></i> Untuk Pasien Obstetri dan Ginekologi</td>
        </tr>
        <tr>
            <th>Asupan makanan berkurang karena tidak nafsu makan</th>
            <td><?= $pf->asupan_makanan_og ?: '-' ?></td>
        </tr>
        <tr>
            <th>Pertambahan / penurunan berat selama kehamilan</th>
            <td><?= $pf->ada_pertambahan ?: '-' ?></td>
        </tr>
        <tr>
            <th>Nilai HB &lt; 10 gr/dl atau HCT &lt; 30%</th>
            <td><?= $pf->nilai_hb_hct ?: '-' ?></td>
        </tr>
        <tr>
            <th>Kondisi/metabolisme khusus</th>
            <td>
                <?= $pf->kondisi_khusus ?>
                <?php if ($pf->kondisi_khusus === 'Ya'): ?>
                    <?= ' — ' . htmlspecialchars($pf->kondisi_khusus_ya) ?>
                    <?= $pf->kondisi_khusus_ya === 'Lainnya' && $pf->kondisi_khusus_lainnya ? ' (' . htmlspecialchars($pf->kondisi_khusus_lainnya) . ')' : '' ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Kesimpulan (Beresiko Nutrisi)</th>
            <td><?= $pf->kesimpulan_og ?: '-' ?></td>
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
            var url = '<?= base_url() ?>AsesmenRD/form_pengkajian_status_nutrisi?no_rwt=<?= $no_rawat ?>&mode=edit';
            openContent(false, url);
        });

        $('#btn-hapus-pf').on('click', function() {
            Swal.fire({
                title: 'Hapus Data?',
                text: 'Data status nutrisi akan dihapus permanen!',
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
                    url: '<?= base_url() ?>AsesmenRD/hapus_status_nutrisi',
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
                            })
                            .then(function() {
                                var url = '<?= base_url() ?>AsesmenRD/form_pengkajian_status_nutrisi?no_rwt=<?= $no_rawat ?>';
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
    ?>

    <form class="row" id="form-assesment-global"
        action="<?= base_url() ?>AsesmenRD/<?= $edit_mode ? 'update_status_nutrisi' : 'simpan_status_nutrisi' ?>"
        data-refresh-url="<?= base_url() ?>AsesmenRD/form_pengkajian_status_nutrisi?no_rwt=<?= $no_rawat ?>"
        method="post">
        <input type="hidden" name="no_rawat" value="<?= $no_rawat; ?>">
        <?php if ($edit_mode): ?>
            <input type="hidden" name="id" value="<?= $pf->id; ?>">
        <?php endif; ?>

        <div class="col-12 mb-2">
            <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-stethoscope"></i> Untuk Pasien Dewasa / Lansia / Onkologi</label>
        </div>

        <div class="col-md-12 mb-2">
            <small class="text-muted">Bila skor &ge; 2 dan/atau ada kondisi khusus, konsultasi lanjut ke ahli gizi.</small>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label fw-bold">Apakah pasien mengalami penurunan BB dalam 6 bulan terakhir?</label>
            <?php $bb_opsi = $v('penurunan_bb_opsi', 'a'); ?>
            <div class="row g-2">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input bb-radio" type="radio" name="penurunan_bb_opsi" value="a" id="bb_a" data-score="0" <?= $bb_opsi === 'a' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="bb_a">Tidak ada penurunan BB <span class="badge bg-secondary score-pill">Skor 0</span></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input bb-radio" type="radio" name="penurunan_bb_opsi" value="b" id="bb_b" data-score="2" <?= $bb_opsi === 'b' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="bb_b">Tidak yakin / tidak tahu / baju terasa longgar <span class="badge bg-secondary score-pill">Skor 2</span></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input bb-radio" type="radio" name="penurunan_bb_opsi" value="c1" id="bb_c1" data-score="1" <?= $bb_opsi === 'c1' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="bb_c1">Ya, 1 - 5 kg <span class="badge bg-secondary score-pill">Skor 1</span></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input bb-radio" type="radio" name="penurunan_bb_opsi" value="c2" id="bb_c2" data-score="2" <?= $bb_opsi === 'c2' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="bb_c2">Ya, 6 - 10 kg <span class="badge bg-secondary score-pill">Skor 2</span></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input bb-radio" type="radio" name="penurunan_bb_opsi" value="c3" id="bb_c3" data-score="3" <?= $bb_opsi === 'c3' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="bb_c3">Ya, 11 - 15 kg <span class="badge bg-secondary score-pill">Skor 3</span></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input bb-radio" type="radio" name="penurunan_bb_opsi" value="c4" id="bb_c4" data-score="4" <?= $bb_opsi === 'c4' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="bb_c4">Ya, &gt; 15 kg <span class="badge bg-secondary score-pill">Skor 4</span></label>
                    </div>
                </div>
            </div>
            <input type="hidden" name="penurunan_bb_skor" id="penurunan_bb_skor" value="<?= (int) $v('penurunan_bb_skor', 0) ?>">
            <div class="mt-2 text-muted">Skor dipilih: <strong id="bb_skor_display">0</strong></div>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Apakah asupan makanan berkurang karena tidak nafsu makan?</label>
            <?php $asupan = $v('asupan_makanan_dlo', 'Tidak'); ?>
            <div class="d-flex gap-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="asupan_makanan_dlo" value="Tidak" id="asupan_dlo_tidak" <?= $asupan === 'Tidak' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="asupan_dlo_tidak">Tidak</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="asupan_makanan_dlo" value="Ya" id="asupan_dlo_ya" <?= $asupan === 'Ya' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="asupan_dlo_ya">Ya</label>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Pasien dengan diagnosa khusus</label>
            <?php $diag = $v('diagnosa_khusus', 'DM'); ?>
            <div class="d-flex flex-wrap gap-3 mb-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="diagnosa_khusus" value="DM" id="diag_dm" <?= $diag === 'DM' ? 'checked' : '' ?> onchange="toggleDiagLain()">
                    <label class="form-check-label" for="diag_dm">DM</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="diagnosa_khusus" value="CKD" id="diag_ckd" <?= $diag === 'CKD' ? 'checked' : '' ?> onchange="toggleDiagLain()">
                    <label class="form-check-label" for="diag_ckd">CKD</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="diagnosa_khusus" value="Infeksi Kronis" id="diag_infeksi" <?= $diag === 'Infeksi Kronis' ? 'checked' : '' ?> onchange="toggleDiagLain()">
                    <label class="form-check-label" for="diag_infeksi">Infeksi Kronis</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="diagnosa_khusus" value="Lain-lain" id="diag_lain" <?= $diag === 'Lain-lain' ? 'checked' : '' ?> onchange="toggleDiagLain()">
                    <label class="form-check-label" for="diag_lain">Lain-lain</label>
                </div>
            </div>
            <input type="text" class="form-control <?= $diag === 'Lain-lain' ? '' : 'd-none' ?>" name="diagnosa_khusus_lainnya" id="diagnosa_khusus_lainnya" placeholder="Sebutkan diagnosa khusus lainnya" value="<?= htmlspecialchars($v('diagnosa_khusus_lainnya')) ?>">
        </div>

        <div class="col-12 mb-3">
            <div class="alert alert-info py-2 d-flex align-items-center justify-content-between flex-wrap mb-0">
                <span>Total Skor Dewasa/Lansia/Onkologi: <strong id="total_skor_display">0</strong></span>
                <span class="fw-bold text-primary" id="risk_label">Tidak Beresiko Malnutrisi</span>
            </div>
        </div>

        <div class="col-12 mb-2 mt-3">
            <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-heartbeat"></i> Untuk Pasien Obstetri dan Ginekologi</label>
        </div>

        <div class="col-md-12 mb-2">
            <small class="text-muted">Jika salah satu jawab "YA" dan/atau mempunyai riwayat gangguan metabolisme/kondisi khusus dikonsultasikan dan dilakukan pengkajian lebih lanjut oleh Ahli Gizi.</small>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Apakah asupan makanan berkurang karena tidak nafsu makan?</label>
            <?php $og_asupan = $v('asupan_makanan_og', 'Tidak'); ?>
            <div class="d-flex gap-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="asupan_makanan_og" value="Tidak" id="og_asupan_tidak" <?= $og_asupan === 'Tidak' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="og_asupan_tidak">Tidak</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="asupan_makanan_og" value="Ya" id="og_asupan_ya" <?= $og_asupan === 'Ya' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="og_asupan_ya">Ya</label>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Apakah ada pertambahan yang kurang atau lebih selama kehamilan?</label>
            <?php $pert = $v('ada_pertambahan', 'Tidak'); ?>
            <div class="d-flex gap-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ada_pertambahan" value="Tidak" id="pert_tidak" <?= $pert === 'Tidak' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="pert_tidak">Tidak</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ada_pertambahan" value="Ya" id="pert_ya" <?= $pert === 'Ya' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="pert_ya">Ya</label>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Nilai HB &lt; 10 gram/dl atau HCT &lt; 30%</label>
            <?php $hb = $v('nilai_hb_hct', 'Tidak'); ?>
            <div class="d-flex gap-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="nilai_hb_hct" value="Tidak" id="hb_tidak" <?= $hb === 'Tidak' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="hb_tidak">Tidak</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="nilai_hb_hct" value="Ya" id="hb_ya" <?= $hb === 'Ya' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="hb_ya">Ya</label>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Ada gangguan metabolisme/kondisi khusus</label>
            <?php $kk = $v('kondisi_khusus', 'Tidak');
            $kk_ya = $v('kondisi_khusus_ya', 'DM'); ?>
            <div class="d-flex gap-3 mb-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kondisi_khusus" value="Tidak" id="kk_tidak" <?= $kk === 'Tidak' ? 'checked' : '' ?> onchange="toggleKondisiKhusus()">
                    <label class="form-check-label" for="kk_tidak">Tidak</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kondisi_khusus" value="Ya" id="kk_ya" <?= $kk === 'Ya' ? 'checked' : '' ?> onchange="toggleKondisiKhusus()">
                    <label class="form-check-label" for="kk_ya">Ya</label>
                </div>
            </div>

            <div id="kk_detail_wrap" class="<?= $kk === 'Ya' ? '' : 'd-none' ?>">
                <select class="form-select mb-2" name="kondisi_khusus_ya" id="kondisi_khusus_ya" onchange="toggleKkLainnya()">
                    <option value="DM" <?= $kk_ya === 'DM' ? 'selected' : '' ?>>DM</option>
                    <option value="Gangguan fungsi thyroid" <?= $kk_ya === 'Gangguan fungsi thyroid' ? 'selected' : '' ?>>Gangguan fungsi thyroid</option>
                    <option value="Infeksi kronis" <?= $kk_ya === 'Infeksi kronis' ? 'selected' : '' ?>>Infeksi kronis</option>
                    <option value="TB" <?= $kk_ya === 'TB' ? 'selected' : '' ?>>TB</option>
                    <option value="HIV/AIDS" <?= $kk_ya === 'HIV/AIDS' ? 'selected' : '' ?>>HIV/AIDS</option>
                    <option value="Lupus" <?= $kk_ya === 'Lupus' ? 'selected' : '' ?>>Lupus</option>
                    <option value="Lainnya" <?= $kk_ya === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                </select>
                <input type="text" class="form-control <?= $kk_ya === 'Lainnya' && $kk === 'Ya' ? '' : 'd-none' ?>" name="kondisi_khusus_lainnya" id="kondisi_khusus_lainnya" placeholder="Sebutkan kondisi khusus" value="<?= htmlspecialchars($v('kondisi_khusus_lainnya')) ?>">
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Kesimpulan: Beresiko Nutrisi?</label>
            <?php $ks = $v('kesimpulan_og', 'Tidak'); ?>
            <div class="d-flex gap-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kesimpulan_og" value="Tidak" id="ks_tidak" <?= $ks === 'Tidak' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="ks_tidak">Tidak</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kesimpulan_og" value="Ya" id="ks_ya" <?= $ks === 'Ya' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="ks_ya">Ya</label>
                </div>
            </div>
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
        function updateBbScore() {
            var selected = $('.bb-radio:checked');
            var score = parseInt(selected.data('score')) || 0;
            $('#penurunan_bb_skor').val(score);
            $('#bb_skor_display').text(score);
            recalcTotalSkor();
        }

        function recalcTotalSkor() {
            var bb = parseInt($('#penurunan_bb_skor').val()) || 0;
            $('#total_skor_display').text(bb);
            var risk = bb >= 2 ? 'Beresiko Malnutrisi' : 'Tidak Beresiko Malnutrisi';
            $('#risk_label').text(risk);
        }

        function toggleDiagLain() {
            var val = $('input[name="diagnosa_khusus"]:checked').val();
            if (val === 'Lain-lain') {
                $('#diagnosa_khusus_lainnya').removeClass('d-none');
            } else {
                $('#diagnosa_khusus_lainnya').addClass('d-none').val('');
            }
        }

        function toggleKondisiKhusus() {
            var val = $('input[name="kondisi_khusus"]:checked').val();
            if (val === 'Ya') {
                $('#kk_detail_wrap').removeClass('d-none');
            } else {
                $('#kk_detail_wrap').addClass('d-none');
                $('#kondisi_khusus_lainnya').addClass('d-none').val('');
            }
        }

        function toggleKkLainnya() {
            var val = $('#kondisi_khusus_ya').val();
            if (val === 'Lainnya') {
                $('#kondisi_khusus_lainnya').removeClass('d-none');
            } else {
                $('#kondisi_khusus_lainnya').addClass('d-none').val('');
            }
        }

        <?php if ($edit_mode): ?>
            $('#btn-batal-edit').on('click', function() {
                pfAutoSave.clear();
                var url = '<?= base_url() ?>AsesmenRD/form_pengkajian_status_nutrisi?no_rwt=<?= $no_rawat ?>';
                openContent(false, url);
            });
        <?php endif; ?>

        var pfAutoSave = (function() {
            var STORAGE_KEY = 'nutrisi_draft_<?= $no_rawat ?>_<?= $edit_mode ? 'edit' : 'create' ?>';
            var timer = null;

            function getFormData() {
                var data = {};
                $('#form-assesment-global').find('input, textarea, select').each(function() {
                    var el = $(this);
                    var name = el.attr('name');
                    if (!name || name === 'no_rawat' || name === 'id') return;

                    if (el.is(':radio')) {
                        if (el.is(':checked')) data[name] = el.val();
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
                    var name = el.attr('name');
                    if (!name || !(name in d) || name === 'no_rawat' || name === 'id') return;

                    if (el.is(':radio')) {
                        el.prop('checked', d[name] == el.val());
                        return;
                    }

                    el.val(d[name]);
                });

                updateBbScore();
                toggleDiagLain();
                toggleKondisiKhusus();
                toggleKkLainnya();
                recalcTotalSkor();
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
            setTimeout(function() {
                updateBbScore();
                toggleDiagLain();
                toggleKondisiKhusus();
                toggleKkLainnya();
                recalcTotalSkor();
            }, 0);
        });

        $(function() {
            updateBbScore();
            toggleDiagLain();
            toggleKondisiKhusus();
            toggleKkLainnya();
            recalcTotalSkor();
        });

        $(document).one('formLoaded', function() {
            pfAutoSave.restore();
        });

        $('.bb-radio').on('change', updateBbScore);
    </script>
<?php endif; ?>