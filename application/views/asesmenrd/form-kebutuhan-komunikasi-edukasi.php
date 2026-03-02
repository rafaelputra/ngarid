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

    .section-card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .section-card .card-header {
        background-color: #0d6efd;
        font-weight: 600;
        color: #fff;
        padding: 10px 15px;
        border-radius: 7px 7px 0 0;
    }

    .section-card .card-body {
        padding: 15px;
    }
</style>

<?php
$has_data   = !empty($pf);
$read_mode  = $has_data && $mode !== 'edit';
$edit_mode  = $has_data && $mode === 'edit';

$edukasi_opsi = [
    'Proses Penyakit',
    'Rehab Medis',
    'Psikologis',
    'Pengobatan/Tindakan',
    'Penanganan Nyeri',
    'Nutrisi',
    'Terapi/Obat',
    'Perawatan di Rumah',
    'Perawatan di RS',
    'Lain-lain',
];

$hambatan_opsi = [
    'Bahasa',
    'Pendengaran',
    'Hilang Memori',
    'Motivasi Buruk',
    'Masalah Penglihatan',
    'Tidak bisa Membaca',
    'Kognitif',
    'Cemas',
    'Emosi',
    'Kesulitan Bicara',
    'Tidak ada pertisipasi dari caregiver',
    'Tidak ditemukan hambatan belajar',
    'Secara fisiologi tidak mampu belajar',
];
?>

<h5 class="fw-bold text-primary mb-3 pf-title"><i class="fa fa-file-lines"></i> Kebutuhan Komunikasi dan Edukasi</h5>
<hr>

<?php if ($read_mode): ?>
    <?php
    $v = function ($field, $default = '') use ($pf, $has_data) {
        if ($has_data && isset($pf->$field)) {
            return $pf->$field;
        }
        return $default;
    };

    $edukasi_arr = $v('edukasi_diberikan') ? array_map('trim', explode(',', $v('edukasi_diberikan'))) : [];
    $bahasa_arr = $v('bahasa_sehari') ? array_map('trim', explode(',', $v('bahasa_sehari'))) : [];
    $hambatan_arr = $v('hambatan_edukasi') ? array_map('trim', explode(',', $v('hambatan_edukasi'))) : [];
    ?>

    <table class="table table-bordered pf-read-table">
        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-book-open"></i> Kebutuhan Edukasi</td>
        </tr>
        <tr>
            <th>Edukasi Diberikan</th>
            <td>
                <?= $edukasi_arr ? implode(', ', $edukasi_arr) : '-' ?>
                <?php if (in_array('Perawatan di RS', $edukasi_arr) && $v('edukasi_diberikan_rs')): ?>
                    <br><small class="text-muted">RS: <?= htmlspecialchars($v('edukasi_diberikan_rs')) ?></small>
                <?php endif; ?>
                <?php if (in_array('Lain-lain', $edukasi_arr) && $v('edukasi_diberikan_lain_lain')): ?>
                    <br><small class="text-muted">Lain-lain: <?= htmlspecialchars($v('edukasi_diberikan_lain_lain')) ?></small>
                <?php endif; ?>
            </td>
        </tr>

        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-heart"></i> Keyakinan terhadap Penyakit</td>
        </tr>
        <tr>
            <th>Keyakinan Penyakit</th>
            <td>
                <?= htmlspecialchars($v('keyakinan_penyakit')) ?>
                <?= $v('keyakinan_penyakit') === 'Lain-lain' && $v('keyakinan_penyakit_lainnya') ? ' &mdash; ' . htmlspecialchars($v('keyakinan_penyakit_lainnya')) : '' ?>
            </td>
        </tr>

        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-comment"></i> Bicara & Bahasa</td>
        </tr>
        <tr>
            <th>Bicara</th>
            <td>
                <?= htmlspecialchars($v('bicara')) ?>
                <?= $v('bicara') === 'Gangguan Bicara' && $v('gangguan_bicara_sejak') ? ' &mdash; Sejak: ' . htmlspecialchars($v('gangguan_bicara_sejak')) : '' ?>
            </td>
        </tr>
        <tr>
            <th>Bahasa Sehari-hari</th>
            <td>
                <?php
                $bahasa_display = [];
                foreach ($bahasa_arr as $bhs) {
                    if ($bhs === 'Indonesia') {
                        $bahasa_display[] = 'Indonesia (' . htmlspecialchars($v('indonesia_ap')) . ')';
                    } elseif ($bhs === 'Inggris') {
                        $bahasa_display[] = 'Inggris (' . htmlspecialchars($v('inggris_ap')) . ')';
                    } elseif ($bhs === 'Daerah') {
                        $bahasa_display[] = 'Daerah: ' . htmlspecialchars($v('daerah_jelaskan'));
                    } elseif ($bhs === 'Lain-lain') {
                        $bahasa_display[] = 'Lain-lain: ' . htmlspecialchars($v('lain_jelaskan'));
                    } else {
                        $bahasa_display[] = htmlspecialchars($bhs);
                    }
                }
                echo $bahasa_display ? implode(', ', $bahasa_display) : '-';
                ?>
            </td>
        </tr>

        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-language"></i> Penerjemah</td>
        </tr>
        <tr>
            <th>Perlu Penerjemah</th>
            <td>
                <?= htmlspecialchars($v('perlu_penerjemah')) ?>
                <?= $v('perlu_penerjemah') === 'Ya' && $v('ya_bahasa') ? ' &mdash; Bahasa: ' . htmlspecialchars($v('ya_bahasa')) : '' ?>
            </td>
        </tr>
        <tr>
            <th>Bahasa Isyarat</th>
            <td><?= htmlspecialchars($v('bs_ya_tidak')) ?></td>
        </tr>

        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-exclamation-triangle"></i> Hambatan Edukasi</td>
        </tr>
        <tr>
            <th>Hambatan Edukasi</th>
            <td>
                <?= $hambatan_arr ? implode(', ', $hambatan_arr) : '-' ?>
                <?php if ($v('hambatan_edukasi_lainnya')): ?>
                    <br><small class="text-muted">Lainnya: <?= htmlspecialchars($v('hambatan_edukasi_lainnya')) ?></small>
                <?php endif; ?>
            </td>
        </tr>

        <tr class="pf-section-row">
            <td colspan="2"><i class="fa fa-graduation-cap"></i> Pendidikan & Penerimaan Informasi</td>
        </tr>
        <tr>
            <th>Tingkat Pendidikan</th>
            <td>
                <?= htmlspecialchars($v('tingkat_pendidikan')) ?>
                <?= $v('tingkat_pendidikan') === 'Lain-lain' && $v('tingkat_pendidikan_lainnya') ? ' &mdash; ' . htmlspecialchars($v('tingkat_pendidikan_lainnya')) : '' ?>
            </td>
        </tr>
        <tr>
            <th>Pasien/Keluarga Menerima Informasi</th>
            <td>
                <?= htmlspecialchars($v('pasien_keluarga_menerima_informasi')) ?>
                <?= $v('pasien_keluarga_menerima_informasi') === 'Tidak' && $v('pasien_keluarga_menerima_informasi_lainnya') ? ' &mdash; ' . htmlspecialchars($v('pasien_keluarga_menerima_informasi_lainnya')) : '' ?>
            </td>
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
            var url = '<?= base_url() ?>AsesmenRD/form_kebutuhan_komunikasi_edukasi?no_rwt=<?= $no_rawat ?>&mode=edit';
            openContent(false, url);
        });

        $('#btn-hapus-pf').on('click', function() {
            Swal.fire({
                title: 'Yakin hapus data?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.post('<?= base_url() ?>AsesmenRD/hapus_kebutuhan_komunikasi_edukasi', {
                        id: '<?= $pf->id ?>'
                    }, null, 'json').done(function(res) {
                        if (res.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Dihapus!',
                                text: res.message,
                                timer: 1500,
                                showConfirmButton: false
                            }).then(function() {
                                var url = '<?= base_url() ?>AsesmenRD/form_kebutuhan_komunikasi_edukasi?no_rwt=<?= $no_rawat ?>';
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

    $arr = function ($field) use ($v) {
        $val = $v($field);
        if (!$val) return [];
        if (is_array($val)) return $val;
        return array_filter(array_map('trim', explode(',', $val)));
    };

    $checked = function ($field, $value) use ($arr) {
        return in_array($value, $arr($field), true) ? 'checked' : '';
    };
    ?>

    <form class="row" id="form-assesment-global"
        action="<?= base_url() ?>AsesmenRD/<?= $edit_mode ? 'update_kebutuhan_komunikasi_edukasi' : 'simpan_kebutuhan_komunikasi_edukasi' ?>"
        method="post">
        <input type="hidden" name="no_rawat" value="<?= $no_rawat; ?>">
        <?php if ($edit_mode): ?>
            <input type="hidden" name="id" value="<?= $pf->id; ?>">
        <?php endif; ?>

        <!-- ====== EDUKASI DIBERIKAN ====== -->
        <div class="col-12 mb-3">
            <div class="section-card">
                <div class="card-header">
                    <i class="fa fa-book-open"></i> Kebutuhan Edukasi yang Diberikan
                </div>
                <div class="card-body">
                    <div class="row g-2 mb-3">
                        <?php foreach ($edukasi_opsi as $idx => $opt): ?>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="edukasi_diberikan[]" id="edukasi_<?= $idx ?>" value="<?= $opt ?>" <?= $checked('edukasi_diberikan', $opt) ?> onchange="toggleEdukasi()">
                                    <label class="form-check-label" for="edukasi_<?= $idx ?>"><?= $opt ?></label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6 <?= in_array('Perawatan di RS', $arr('edukasi_diberikan')) ? '' : 'd-none' ?>" id="wrap_edukasi_rs">
                            <label class="form-label fw-bold">Keterangan Perawatan di RS</label>
                            <input type="text" class="form-control" name="edukasi_diberikan_rs" id="edukasi_diberikan_rs" placeholder="Jelaskan perawatan di RS..." value="<?= htmlspecialchars($v('edukasi_diberikan_rs')) ?>">
                        </div>
                        <div class="col-md-6 <?= in_array('Lain-lain', $arr('edukasi_diberikan')) ? '' : 'd-none' ?>" id="wrap_edukasi_lain">
                            <label class="form-label fw-bold">Keterangan Lain-lain</label>
                            <input type="text" class="form-control" name="edukasi_diberikan_lain_lain" id="edukasi_diberikan_lain_lain" placeholder="Jelaskan lain-lain..." value="<?= htmlspecialchars($v('edukasi_diberikan_lain_lain')) ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ====== KEYAKINAN PENYAKIT ====== -->
        <div class="col-12 mb-3">
            <div class="section-card">
                <div class="card-header">
                    <i class="fa fa-heart"></i> Keyakinan dan Nilai-Nilai Pasien/Keluarga Tentang Penyakitnya
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-3 mb-2">
                        <?php $ky = $v('keyakinan_penyakit', 'Yakin Sembuh'); ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="keyakinan_penyakit" value="Yakin Sembuh" id="ky_yakin" <?= $ky === 'Yakin Sembuh' ? 'checked' : '' ?> onchange="toggleKeyakinanLain()">
                            <label class="form-check-label" for="ky_yakin">Yakin Sembuh</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="keyakinan_penyakit" value="Pasrah" id="ky_pasrah" <?= $ky === 'Pasrah' ? 'checked' : '' ?> onchange="toggleKeyakinanLain()">
                            <label class="form-check-label" for="ky_pasrah">Pasrah</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="keyakinan_penyakit" value="Lain-lain" id="ky_lain" <?= $ky === 'Lain-lain' ? 'checked' : '' ?> onchange="toggleKeyakinanLain()">
                            <label class="form-check-label" for="ky_lain">Lain-lain</label>
                        </div>
                    </div>
                    <input type="text" class="form-control <?= $ky === 'Lain-lain' ? '' : 'd-none' ?>" name="keyakinan_penyakit_lainnya" id="keyakinan_penyakit_lainnya" placeholder="Sebutkan..." value="<?= htmlspecialchars($v('keyakinan_penyakit_lainnya')) ?>">
                </div>
            </div>
        </div>

        <!-- ====== BICARA ====== -->
        <div class="col-md-6 mb-3">
            <div class="section-card">
                <div class="card-header">
                    <i class="fa fa-comment"></i> Bicara
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-3 mb-2">
                        <?php $bcr = $v('bicara', 'Normal'); ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="bicara" value="Normal" id="bicara_normal" <?= $bcr === 'Normal' ? 'checked' : '' ?> onchange="toggleGangguanBicara()">
                            <label class="form-check-label" for="bicara_normal">Normal</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="bicara" value="Gangguan Bicara" id="bicara_gangguan" <?= $bcr === 'Gangguan Bicara' ? 'checked' : '' ?> onchange="toggleGangguanBicara()">
                            <label class="form-check-label" for="bicara_gangguan">Gangguan Bicara</label>
                        </div>
                    </div>
                    <input type="text" class="form-control <?= $bcr === 'Gangguan Bicara' ? '' : 'd-none' ?>" name="gangguan_bicara_sejak" id="gangguan_bicara_sejak" placeholder="Sejak kapan..." value="<?= htmlspecialchars($v('gangguan_bicara_sejak')) ?>">
                </div>
            </div>
        </div>

        <!-- ====== BAHASA SEHARI-HARI ====== -->
        <div class="col-md-6 mb-3">
            <div class="section-card">
                <div class="card-header">
                    <i class="fa fa-language"></i> Bahasa Sehari-hari
                </div>
                <div class="card-body">
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="bahasa_sehari[]" value="Indonesia" id="bhs_indo" <?= $checked('bahasa_sehari', 'Indonesia') ?> onchange="toggleBahasa()">
                                <label class="form-check-label" for="bhs_indo">Indonesia</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="bahasa_sehari[]" value="Inggris" id="bhs_inggris" <?= $checked('bahasa_sehari', 'Inggris') ?> onchange="toggleBahasa()">
                                <label class="form-check-label" for="bhs_inggris">Inggris</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="bahasa_sehari[]" value="Daerah" id="bhs_daerah" <?= $checked('bahasa_sehari', 'Daerah') ?> onchange="toggleBahasa()">
                                <label class="form-check-label" for="bhs_daerah">Daerah</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="bahasa_sehari[]" value="Lain-lain" id="bhs_lain" <?= $checked('bahasa_sehari', 'Lain-lain') ?> onchange="toggleBahasa()">
                                <label class="form-check-label" for="bhs_lain">Lain-lain</label>
                            </div>
                        </div>
                    </div>

                    <div class="<?= in_array('Indonesia', $arr('bahasa_sehari')) ? '' : 'd-none' ?> mb-2" id="wrap_indo_ap">
                        <label class="form-label fw-bold small">Indonesia (Aktif/Pasif)</label>
                        <div class="d-flex gap-3">
                            <?php $indo_ap = $v('indonesia_ap', 'aktif'); ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="indonesia_ap" value="aktif" id="indo_aktif" <?= $indo_ap === 'aktif' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="indo_aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="indonesia_ap" value="pasif" id="indo_pasif" <?= $indo_ap === 'pasif' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="indo_pasif">Pasif</label>
                            </div>
                        </div>
                    </div>

                    <div class="<?= in_array('Inggris', $arr('bahasa_sehari')) ? '' : 'd-none' ?> mb-2" id="wrap_inggris_ap">
                        <label class="form-label fw-bold small">Inggris (Aktif/Pasif)</label>
                        <div class="d-flex gap-3">
                            <?php $ing_ap = $v('inggris_ap', 'aktif'); ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="inggris_ap" value="aktif" id="ing_aktif" <?= $ing_ap === 'aktif' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="ing_aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="inggris_ap" value="pasif" id="ing_pasif" <?= $ing_ap === 'pasif' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="ing_pasif">Pasif</label>
                            </div>
                        </div>
                    </div>

                    <div class="<?= in_array('Daerah', $arr('bahasa_sehari')) ? '' : 'd-none' ?> mb-2" id="wrap_daerah">
                        <label class="form-label fw-bold small">Bahasa Daerah</label>
                        <input type="text" class="form-control form-control-sm" name="daerah_jelaskan" placeholder="Jelaskan bahasa daerah..." value="<?= htmlspecialchars($v('daerah_jelaskan')) ?>">
                    </div>

                    <div class="<?= in_array('Lain-lain', $arr('bahasa_sehari')) ? '' : 'd-none' ?> mb-2" id="wrap_bhs_lain">
                        <label class="form-label fw-bold small">Bahasa Lainnya</label>
                        <input type="text" class="form-control form-control-sm" name="lain_jelaskan" placeholder="Jelaskan bahasa lain..." value="<?= htmlspecialchars($v('lain_jelaskan')) ?>">
                    </div>
                </div>
            </div>
        </div>

        <!-- ====== PENERJEMAH ====== -->
        <div class="col-md-6 mb-3">
            <div class="section-card">
                <div class="card-header">
                    <i class="fa fa-user-group"></i> Perlu Penerjemah
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-3 mb-2">
                        <?php $pnj = $v('perlu_penerjemah', 'Tidak'); ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="perlu_penerjemah" value="Tidak" id="pnj_tidak" <?= $pnj === 'Tidak' ? 'checked' : '' ?> onchange="togglePenerjemah()">
                            <label class="form-check-label" for="pnj_tidak">Tidak</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="perlu_penerjemah" value="Ya" id="pnj_ya" <?= $pnj === 'Ya' ? 'checked' : '' ?> onchange="togglePenerjemah()">
                            <label class="form-check-label" for="pnj_ya">Ya</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="perlu_penerjemah" value="Bahasa Isyarat" id="pnj_isyarat" <?= $pnj === 'Bahasa Isyarat' ? 'checked' : '' ?> onchange="togglePenerjemah()">
                            <label class="form-check-label" for="pnj_isyarat">Bahasa Isyarat</label>
                        </div>
                    </div>
                    <input type="text" class="form-control <?= $pnj === 'Ya' ? '' : 'd-none' ?>" name="ya_bahasa" id="ya_bahasa" placeholder="Bahasa apa..." value="<?= htmlspecialchars($v('ya_bahasa')) ?>">

                    <hr class="my-3">
                    <label class="form-label fw-bold">Bahasa Isyarat</label>
                    <div class="d-flex gap-3">
                        <?php $bs = $v('bs_ya_tidak', 'Tidak'); ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="bs_ya_tidak" value="Ya" id="bs_ya" <?= $bs === 'Ya' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="bs_ya">Ya</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="bs_ya_tidak" value="Tidak" id="bs_tidak" <?= $bs === 'Tidak' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="bs_tidak">Tidak</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ====== HAMBATAN EDUKASI ====== -->
        <div class="col-md-6 mb-3">
            <div class="section-card">
                <div class="card-header">
                    <i class="fa fa-exclamation-triangle"></i> Hambatan Edukasi
                </div>
                <div class="card-body">
                    <div class="row g-2 mb-2">
                        <?php foreach ($hambatan_opsi as $idx => $opt): ?>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="hambatan_edukasi[]" id="hambatan_<?= $idx ?>" value="<?= $opt ?>" <?= $checked('hambatan_edukasi', $opt) ?>>
                                    <label class="form-check-label" for="hambatan_<?= $idx ?>"><?= $opt ?></label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="mt-2">
                        <label class="form-label fw-bold small">Hambatan Lainnya</label>
                        <input type="text" class="form-control form-control-sm" name="hambatan_edukasi_lainnya" placeholder="Jelaskan hambatan lain..." value="<?= htmlspecialchars($v('hambatan_edukasi_lainnya')) ?>">
                    </div>
                </div>
            </div>
        </div>

        <!-- ====== TINGKAT PENDIDIKAN ====== -->
        <div class="col-md-6 mb-3">
            <div class="section-card">
                <div class="card-header">
                    <i class="fa fa-graduation-cap"></i> Tingkat Pendidikan
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-3 mb-2">
                        <?php $tp = $v('tingkat_pendidikan', 'SLTA'); ?>
                        <?php $pendidikan_opsi = ['TK', 'SD', 'SLTP', 'SLTA', 'Akademi', 'Sarjana', 'Lain-lain']; ?>
                        <?php foreach ($pendidikan_opsi as $opt): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tingkat_pendidikan" value="<?= $opt ?>" id="tp_<?= strtolower(str_replace('-', '', $opt)) ?>" <?= $tp === $opt ? 'checked' : '' ?> onchange="togglePendidikanLain()">
                                <label class="form-check-label" for="tp_<?= strtolower(str_replace('-', '', $opt)) ?>"><?= $opt ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <input type="text" class="form-control <?= $tp === 'Lain-lain' ? '' : 'd-none' ?>" name="tingkat_pendidikan_lainnya" id="tingkat_pendidikan_lainnya" placeholder="Sebutkan..." value="<?= htmlspecialchars($v('tingkat_pendidikan_lainnya')) ?>">
                </div>
            </div>
        </div>

        <!-- ====== PASIEN/KELUARGA MENERIMA INFORMASI ====== -->
        <div class="col-12 mb-3">
            <div class="section-card">
                <div class="card-header">
                    <i class="fa fa-info-circle"></i> Pasien/Keluarga Mampu Menerima Informasi
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-3 mb-2">
                        <?php $pmi = $v('pasien_keluarga_menerima_informasi', 'Ya'); ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pasien_keluarga_menerima_informasi" value="Ya" id="pmi_ya" <?= $pmi === 'Ya' ? 'checked' : '' ?> onchange="toggleMenerimaInfoLain()">
                            <label class="form-check-label" for="pmi_ya">Ya</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pasien_keluarga_menerima_informasi" value="Tidak" id="pmi_tidak" <?= $pmi === 'Tidak' ? 'checked' : '' ?> onchange="toggleMenerimaInfoLain()">
                            <label class="form-check-label" for="pmi_tidak">Tidak</label>
                        </div>
                    </div>
                    <input type="text" class="form-control <?= $pmi === 'Tidak' ? '' : 'd-none' ?>" name="pasien_keluarga_menerima_informasi_lainnya" id="pasien_keluarga_menerima_informasi_lainnya" placeholder="Alasan tidak menerima informasi..." value="<?= htmlspecialchars($v('pasien_keluarga_menerima_informasi_lainnya')) ?>">
                </div>
            </div>
        </div>

        <!-- Tombol -->
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
        function toggleEdukasi() {
            var vals = [];
            $('input[name="edukasi_diberikan[]"]:checked').each(function() {
                vals.push($(this).val());
            });
            if (vals.indexOf('Perawatan di RS') !== -1) {
                $('#wrap_edukasi_rs').removeClass('d-none');
            } else {
                $('#wrap_edukasi_rs').addClass('d-none');
                $('#edukasi_diberikan_rs').val('');
            }
            if (vals.indexOf('Lain-lain') !== -1) {
                $('#wrap_edukasi_lain').removeClass('d-none');
            } else {
                $('#wrap_edukasi_lain').addClass('d-none');
                $('#edukasi_diberikan_lain_lain').val('');
            }
        }

        function toggleKeyakinanLain() {
            var val = $('input[name="keyakinan_penyakit"]:checked').val();
            if (val === 'Lain-lain') {
                $('#keyakinan_penyakit_lainnya').removeClass('d-none');
            } else {
                $('#keyakinan_penyakit_lainnya').addClass('d-none').val('');
            }
        }

        function toggleGangguanBicara() {
            var val = $('input[name="bicara"]:checked').val();
            if (val === 'Gangguan Bicara') {
                $('#gangguan_bicara_sejak').removeClass('d-none');
            } else {
                $('#gangguan_bicara_sejak').addClass('d-none').val('');
            }
        }

        function toggleBahasa() {
            var vals = [];
            $('input[name="bahasa_sehari[]"]:checked').each(function() {
                vals.push($(this).val());
            });

            if (vals.indexOf('Indonesia') !== -1) {
                $('#wrap_indo_ap').removeClass('d-none');
            } else {
                $('#wrap_indo_ap').addClass('d-none');
            }

            if (vals.indexOf('Inggris') !== -1) {
                $('#wrap_inggris_ap').removeClass('d-none');
            } else {
                $('#wrap_inggris_ap').addClass('d-none');
            }

            if (vals.indexOf('Daerah') !== -1) {
                $('#wrap_daerah').removeClass('d-none');
            } else {
                $('#wrap_daerah').addClass('d-none');
                $('input[name="daerah_jelaskan"]').val('');
            }

            if (vals.indexOf('Lain-lain') !== -1) {
                $('#wrap_bhs_lain').removeClass('d-none');
            } else {
                $('#wrap_bhs_lain').addClass('d-none');
                $('input[name="lain_jelaskan"]').val('');
            }
        }

        function togglePenerjemah() {
            var val = $('input[name="perlu_penerjemah"]:checked').val();
            if (val === 'Ya') {
                $('#ya_bahasa').removeClass('d-none');
            } else {
                $('#ya_bahasa').addClass('d-none').val('');
            }
        }

        function togglePendidikanLain() {
            var val = $('input[name="tingkat_pendidikan"]:checked').val();
            if (val === 'Lain-lain') {
                $('#tingkat_pendidikan_lainnya').removeClass('d-none');
            } else {
                $('#tingkat_pendidikan_lainnya').addClass('d-none').val('');
            }
        }

        function toggleMenerimaInfoLain() {
            var val = $('input[name="pasien_keluarga_menerima_informasi"]:checked').val();
            if (val === 'Tidak') {
                $('#pasien_keluarga_menerima_informasi_lainnya').removeClass('d-none');
            } else {
                $('#pasien_keluarga_menerima_informasi_lainnya').addClass('d-none').val('');
            }
        }

        <?php if ($edit_mode): ?>
            $('#btn-batal-edit').on('click', function() {
                var url = '<?= base_url() ?>AsesmenRD/form_kebutuhan_komunikasi_edukasi?no_rwt=<?= $no_rawat ?>';
                openContent(false, url);
            });
        <?php endif; ?>

        // AJAX submit
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
                                var url = '<?= base_url() ?>AsesmenRD/form_kebutuhan_komunikasi_edukasi?no_rwt=<?= $no_rawat ?>';
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
<?php endif; ?>