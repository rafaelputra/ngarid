<style>
    .morse-card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 15px;
    }

    .morse-card .card-header {
        background: linear-gradient(135deg, #4e73df, #224abe);
        color: #fff;
        font-weight: 600;
        padding: 10px 15px;
        font-size: 14px;
    }

    .morse-card .card-body {
        padding: 15px;
    }

    .param-table {
        width: 100%;
        border-collapse: collapse;
    }

    .param-table th,
    .param-table td {
        border: 1px solid #dee2e6;
        padding: 8px 10px;
        font-size: 13px;
        vertical-align: middle;
    }

    .param-table thead th {
        background: #f0f4ff;
        text-align: center;
        font-weight: 600;
    }

    .param-table .param-name {
        font-weight: 600;
        background: #f8f9fa;
        width: 180px;
    }

    .param-table .kriteria-cell {
        width: 280px;
    }

    .param-table .skor-cell {
        width: 60px;
        text-align: center;
        font-weight: 600;
    }

    .param-table .input-cell {
        text-align: center;
        width: 80px;
    }

    .param-table .input-cell input[type="radio"] {
        width: 16px;
        height: 16px;
        cursor: pointer;
    }

    .skor-total-row td {
        background: #e8ecf4;
        font-weight: 700;
        font-size: 14px;
    }

    .pilih-row td {
        background: #fff3cd;
    }

    .kategori-badge {
        display: inline-block;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .kategori-rt {
        background: #f8d7da;
        color: #842029;
    }

    .kategori-rs {
        background: #fff3cd;
        color: #664d03;
    }

    .kategori-rr {
        background: #d1e7dd;
        color: #0f5132;
    }

    .result-box-jatuh {
        border: 2px solid #dee2e6;
        border-radius: 8px;
        padding: 15px;
        text-align: center;
        margin-top: 15px;
    }

    .result-box-jatuh.rt-active {
        background-color: #f8d7da;
        border-color: #dc3545;
    }

    .result-box-jatuh.rs-active {
        background-color: #fff3cd;
        border-color: #ffc107;
    }

    .result-box-jatuh.rr-active {
        background-color: #d1e7dd;
        border-color: #198754;
    }

    /* Intervensi section */
    .intervensi-section {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-top: 20px;
        overflow: hidden;
    }

    .intervensi-section .section-header {
        padding: 10px 15px;
        font-weight: 600;
        font-size: 13px;
    }

    .intervensi-section .section-header.rt-header {
        background: #f8d7da;
        color: #842029;
    }

    .intervensi-section .section-header.rs-header {
        background: #fff3cd;
        color: #664d03;
    }

    .intervensi-section .section-header.rr-header {
        background: #d1e7dd;
        color: #0f5132;
    }

    .intervensi-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .intervensi-table th,
    .intervensi-table td {
        border: 1px solid #dee2e6;
        padding: 6px 10px;
        vertical-align: middle;
    }

    .intervensi-table thead th {
        background: #f0f4ff;
        text-align: center;
        font-weight: 600;
    }

    .intervensi-table .shift-group {
        text-align: center;
    }

    .intervensi-table .shift-group input[type="checkbox"] {
        width: 16px;
        height: 16px;
    }

    .pf-read-table th {
        width: 200px;
    }

    /* Step Navigation */
    .step-indicator {
        display: flex;
        gap: 0;
        margin-bottom: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #dee2e6;
    }

    .step-indicator .step-item {
        flex: 1;
        text-align: center;
        padding: 12px 10px;
        cursor: pointer;
        border-bottom: 3px solid transparent;
        color: #6c757d;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.3s;
        position: relative;
    }

    .step-indicator .step-item:not(:last-child)::after {
        content: '';
        position: absolute;
        right: 0;
        top: 20%;
        height: 60%;
        width: 1px;
        background: #dee2e6;
    }

    .step-indicator .step-item:hover {
        background: #e9ecef;
    }

    .step-indicator .step-item.active {
        border-bottom-color: #4e73df;
        color: #4e73df;
        background: #fff;
    }

    .step-indicator .step-item.filled {
        color: #198754;
    }

    .step-indicator .step-item.filled.active {
        border-bottom-color: #198754;
    }

    .skor-step {
        display: none;
    }

    .skor-step.active {
        display: block;
    }
</style>

<?php
$has_data  = !empty($pf);
$edit_mode = ($has_data && $mode === 'edit');
$read_mode = ($has_data && $mode !== 'edit');

// Intervensi data
$intervensi_list = isset($intervensi) ? $intervensi : [];
?>

<h5 class="fw-bold text-primary mb-3"><i class="fa fa-person-falling"></i> Pengkajian Resiko Pasien Jatuh Dewasa (Morse Fall)</h5>
<hr>

<?php if ($read_mode): ?>
    <!-- ===================== READ MODE ===================== -->
    <?php
    $v = function ($field, $default = '') use ($pf, $has_data) {
        if ($has_data && isset($pf->$field)) {
            return $pf->$field;
        }
        return $default;
    };

    $kategori_labels = [
        'RT' => ['Resiko Tinggi (RT)', 'kategori-rt'],
        'RS' => ['Resiko Sedang (RS)', 'kategori-rs'],
        'RR' => ['Resiko Rendah (RR)', 'kategori-rr'],
    ];

    $riwayat_labels   = [0 => 'Tidak', 25 => 'Ya'];
    $diagnosa_labels  = [0 => 'Tidak', 15 => 'Ya'];
    $alat_labels      = [0 => 'Bedrest, Dibantu Perawat', 15 => 'Penopang, tongkat, walker', 30 => 'Furniture'];
    $infus_labels     = [0 => 'Tidak', 20 => 'Ya'];
    $berjalan_labels  = [0 => 'Normal, bedrest, pasien mobile', 10 => 'Lemah', 20 => 'Terganggu'];
    $mental_labels    = [0 => 'Orientasi sesuai kemampuan diri', 15 => 'Lupa keterbatasan diri'];
    ?>

    <div class="mb-3">
        <small class="text-muted">
            <strong>Kriteria Skor:</strong> Resiko Tinggi (RT) = Skor &gt; 45 &nbsp;|&nbsp;
            Resiko Sedang (RS) = Skor 25–44 &nbsp;|&nbsp;
            Resiko Rendah (RR) = Skor 0–24
        </small>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered pf-read-table" style="font-size:13px;">
            <thead>
                <tr class="table-primary">
                    <th>Parameter</th>
                    <th>Kriteria</th>
                    <th style="width:60px">Skor</th>
                    <th style="width:120px">Skor 1<?= $v('tgl_1') ? '<br><small>' . date('d/m/Y', strtotime($v('tgl_1'))) . '</small>' : '' ?></th>
                    <th style="width:120px">Skor 2<?= $v('tgl_2') ? '<br><small>' . date('d/m/Y', strtotime($v('tgl_2'))) . '</small>' : '' ?></th>
                    <th style="width:120px">Skor 3<?= $v('tgl_3') ? '<br><small>' . date('d/m/Y', strtotime($v('tgl_3'))) . '</small>' : '' ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $params = [
                    ['Riwayat Jatuh', 'riwayat_jatuh', $riwayat_labels, [['Ya', 25], ['Tidak', 0]]],
                    ['Diagnosa Sekunder', 'diagnosa_sekunder', $diagnosa_labels, [['Ya', 15], ['Tidak', 0]]],
                    ['Alat Bantu Jalan', 'alat_bantu', $alat_labels, [['Furniture', 30], ['Penopang, tongkat, walker', 15], ['Bedrest, Dibantu Perawat', 0]]],
                    ['Terpasang Infus', 'terpasang_infus', $infus_labels, [['Ya', 20], ['Tidak', 0]]],
                    ['Cara Berjalan/Pindah', 'cara_berjalan', $berjalan_labels, [['Terganggu', 20], ['Lemah', 10], ['Normal, bedrest, pasien mobile', 0]]],
                    ['Status Mental', 'status_mental', $mental_labels, [['Lupa keterbatasan diri', 15], ['Orientasi sesuai kemampuan diri', 0]]],
                ];

                foreach ($params as $p):
                    $rows = count($p[3]);
                    foreach ($p[3] as $i => $kriteria):
                ?>
                        <tr>
                            <?php if ($i === 0): ?>
                                <td rowspan="<?= $rows ?>" class="fw-bold align-middle" style="background:#f8f9fa"><?= $p[0] ?></td>
                            <?php endif; ?>
                            <td><?= $kriteria[0] ?></td>
                            <td class="text-center fw-bold"><?= $kriteria[1] ?></td>
                            <?php if ($i === 0): ?>
                                <td rowspan="<?= $rows ?>" class="text-center align-middle fw-bold"><?= $v('skor1_' . $p[1]) !== null ? $v('skor1_' . $p[1]) : '-' ?></td>
                                <td rowspan="<?= $rows ?>" class="text-center align-middle fw-bold"><?= $v('skor2_' . $p[1]) !== null ? $v('skor2_' . $p[1]) : '-' ?></td>
                                <td rowspan="<?= $rows ?>" class="text-center align-middle fw-bold"><?= $v('skor3_' . $p[1]) !== null ? $v('skor3_' . $p[1]) : '-' ?></td>
                            <?php endif; ?>
                        </tr>
                <?php
                    endforeach;
                endforeach;
                ?>
                <tr class="table-secondary">
                    <td colspan="3" class="text-end fw-bold">SKOR TOTAL</td>
                    <td class="text-center fw-bold fs-6"><?= $v('skor1_total', 0) ?></td>
                    <td class="text-center fw-bold fs-6"><?= $v('skor2_total') !== null ? $v('skor2_total') : '-' ?></td>
                    <td class="text-center fw-bold fs-6"><?= $v('skor3_total') !== null ? $v('skor3_total') : '-' ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="fw-bold" style="background:#fff3cd">Pilih Skor Resiko Setelah Penilaian</td>
                    <?php for ($s = 1; $s <= 3; $s++):
                        $kat = $v("pilih_setelah_{$s}");
                        $badge = isset($kategori_labels[$kat]) ? $kategori_labels[$kat] : null;
                    ?>
                        <td class="text-center">
                            <?php if ($badge): ?>
                                <span class="kategori-badge <?= $badge[1] ?>"><?= $badge[0] ?></span>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    <?php endfor; ?>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Info Perawat -->
    <table class="table table-bordered pf-read-table" style="font-size:13px;">
        <tr>
            <th>Perawat Yang Menilai</th>
            <td><?= htmlspecialchars($v('perawat_penilai')) ?: '-' ?></td>
        </tr>
    </table>

    <!-- Intervensi Pencegahan -->
    <?php if (!empty($intervensi_list)): ?>
        <h6 class="fw-bold text-primary mt-4 mb-3"><i class="fa fa-shield-halved"></i> Intervensi Pencegahan Pasien Jatuh</h6>

        <div class="table-responsive">
            <table class="table table-bordered" style="font-size:12px;">
                <thead>
                    <tr class="table-primary text-center">
                        <th>Tanggal</th>
                        <th>Shift</th>
                        <th>Tindakan</th>
                        <th>Perawat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($intervensi_list as $iv):
                        $tindakan = [];
                        // RT
                        if ($iv->rt_saran_bantuan) $tindakan[] = '[RT] Sarankan minta bantuan';
                        if ($iv->rt_tempatkan_bel) $tindakan[] = '[RT] Tempatkan bel';
                        if ($iv->rt_posisi_tidur_roda) $tindakan[] = '[RT] Posisi tidur rendah & roda terkunci';
                        if ($iv->rt_gelang_resiko) $tindakan[] = '[RT] Gelang resiko';
                        if ($iv->rt_segitiga_kuning) $tindakan[] = '[RT] Segitiga kuning';
                        if ($iv->rt_pegangan_tangan) $tindakan[] = '[RT] Pegangan tangan';
                        if ($iv->rt_kamar_mandi_pispot) $tindakan[] = '[RT] Kamar mandi/pispot';
                        if ($iv->rt_observasi_2_3_jam) $tindakan[] = '[RT] Observasi 2-3 jam';
                        if ($iv->rt_orientasi_kamar) $tindakan[] = '[RT] Orientasi kamar';
                        if ($iv->rt_pantau_efek_obat) $tindakan[] = '[RT] Pantau efek obat';
                        if ($iv->rt_bantu_ambulasi) $tindakan[] = '[RT] Bantu ambulasi';
                        if ($iv->rt_benda_dekat_pasien) $tindakan[] = '[RT] Benda dekat pasien';
                        if ($iv->rt_lantai_bersih_kering) $tindakan[] = '[RT] Lantai bersih & kering';
                        // RS
                        if ($iv->rs_saran_bantuan) $tindakan[] = '[RS] Sarankan minta bantuan';
                        if ($iv->rs_tempatkan_bel) $tindakan[] = '[RS] Tempatkan bel';
                        if ($iv->rs_posisi_tidur_roda) $tindakan[] = '[RS] Posisi tidur rendah & roda terkunci';
                        if ($iv->rs_pegangan_tangan) $tindakan[] = '[RS] Pegangan tangan';
                        if ($iv->rs_bantu_ambulasi) $tindakan[] = '[RS] Bantu ambulasi';
                        if ($iv->rs_benda_dekat_pasien) $tindakan[] = '[RS] Benda dekat pasien';
                        if ($iv->rs_lantai_bersih_kering) $tindakan[] = '[RS] Lantai bersih & kering';
                        // RR
                        if ($iv->rr_monitor_tanda_vital) $tindakan[] = '[RR] Monitor tanda vital';
                        if ($iv->rr_pengaman_tempat_tidur) $tindakan[] = '[RR] Pengaman tempat tidur';
                    ?>
                        <tr>
                            <td class="text-center"><?= date('d/m/Y', strtotime($iv->tgl_tindakan)) ?></td>
                            <td class="text-center">
                                <span class="badge bg-<?= $iv->shift == 'P' ? 'warning text-dark' : ($iv->shift == 'S' ? 'info' : 'secondary') ?>">
                                    <?= $iv->shift == 'P' ? 'Pagi' : ($iv->shift == 'S' ? 'Siang' : 'Malam') ?>
                                </span>
                            </td>
                            <td><small><?= implode(', ', $tindakan) ?: '-' ?></small></td>
                            <td><?= htmlspecialchars($iv->nama_perawat_shift) ?: '-' ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm btn-hapus-intervensi" data-id="<?= $iv->id_intervensi ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <div class="mt-3 mb-3">
        <button type="button" class="btn btn-warning btn-sm" id="btn-edit-pf">
            <i class="fa fa-pen-to-square"></i> Edit
        </button>
        <button type="button" class="btn btn-danger btn-sm" id="btn-hapus-pf">
            <i class="fa fa-trash"></i> Hapus
        </button>
        <button type="button" class="btn btn-success btn-sm" id="btn-tambah-intervensi">
            <i class="fa fa-plus"></i> Tambah Intervensi
        </button>
    </div>

    <script>
        $('#btn-edit-pf').on('click', function() {
            var url = '<?= base_url() ?>AsesmenRD/form_pengkajian_resiko_pasien_jatuh_dewasa?no_rwt=<?= $no_rawat ?>&mode=edit';
            openContent(false, url);
        });

        $('#btn-hapus-pf').on('click', function() {
            Swal.fire({
                title: 'Hapus data?',
                text: "Data asesmen resiko jatuh akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menghapus...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                    $.ajax({
                        url: '<?= base_url() ?>AsesmenRD/hapus_asesmen_jatuh_dewasa',
                        type: 'POST',
                        data: { id: <?= $pf->id ?> },
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
                                var url = '<?= base_url() ?>AsesmenRD/form_pengkajian_resiko_pasien_jatuh_dewasa?no_rwt=<?= $no_rawat ?>';
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

        // Hapus intervensi
        $('.btn-hapus-intervensi').on('click', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Hapus intervensi?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>AsesmenRD/hapus_intervensi_jatuh',
                        type: 'POST',
                        data: { id_intervensi: id },
                        dataType: 'json'
                    }).done(function(res) {
                        if (res.status) {
                            Swal.fire({ title: 'Berhasil', text: res.message, icon: 'success', timer: 1500, showConfirmButton: false }).then(function() {
                                var url = '<?= base_url() ?>AsesmenRD/form_pengkajian_resiko_pasien_jatuh_dewasa?no_rwt=<?= $no_rawat ?>';
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

        // Tambah intervensi — buka modal
        $('#btn-tambah-intervensi').on('click', function() {
            $('#modal-intervensi').modal('show');
        });
    </script>

    <!-- Modal Intervensi -->
    <div class="modal fade" id="modal-intervensi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h6 class="modal-title"><i class="fa fa-shield-halved"></i> Tambah Intervensi Pencegahan Pasien Jatuh</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-intervensi">
                    <div class="modal-body">
                        <input type="hidden" name="id_pengkajian" value="<?= $pf->id ?>">
                        <input type="hidden" name="no_rawat" value="<?= $no_rawat ?>">

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tanggal Tindakan</label>
                                <input type="date" class="form-control" name="tgl_tindakan" value="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Shift</label>
                                <select class="form-select" name="shift" required>
                                    <option value="">-- Pilih Shift --</option>
                                    <option value="P">Pagi (P)</option>
                                    <option value="S">Siang (S)</option>
                                    <option value="M">Malam (M)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Nama Perawat</label>
                                <input type="text" class="form-control" name="nama_perawat_shift" placeholder="Nama perawat shift">
                            </div>
                        </div>

                        <!-- RT -->
                        <div class="intervensi-section mb-3">
                            <div class="section-header rt-header">
                                <i class="fa fa-exclamation-triangle"></i> RESIKO TINGGI (RT): Intervensi tiap 4 jam dan dinilai ulang tiap 2 hari
                            </div>
                            <div class="p-3">
                                <?php
                                $rt_items = [
                                    'rt_saran_bantuan'       => 'Sarankan pasien/keluarga untuk minta bantuan jika diperlukan',
                                    'rt_tempatkan_bel'       => 'Tempatkan bel dalam jangkauan pasien',
                                    'rt_posisi_tidur_roda'   => 'Pastikan tempat tidur pada posisi terendah dan roda terkunci',
                                    'rt_gelang_resiko'       => 'Pastikan pasien terpasang penanda resiko pada di gelang identitas pasien',
                                    'rt_segitiga_kuning'     => 'Pastikan tanda segitiga kuning resiko jatuh terpasang pada tempat tidur',
                                    'rt_pegangan_tangan'     => 'Pastikan pegangan tempat tidur terpasang dengan baik',
                                    'rt_kamar_mandi_pispot'  => 'Tawarkan bantuan ke kamar mandi / penggunaan pispot setiap 2-3 jam',
                                    'rt_observasi_2_3_jam'   => 'Kunjungi / observasi kebutuhan pasien setiap 2-3 jam',
                                    'rt_orientasi_kamar'     => 'Lakukan orientasi kamar rawat inap kepada pasien / penunggu',
                                    'rt_pantau_efek_obat'    => 'Pantau efek samping dan interaksi obat',
                                    'rt_bantu_ambulasi'      => 'Bantu pasien saat ambulasi',
                                    'rt_benda_dekat_pasien'  => 'Tempatkan benda-benda milik pasien ke dekat pasien',
                                    'rt_lantai_bersih_kering' => 'Kondisikan permukaan lantai bersih, kering, dan tidak licin',
                                ];
                                foreach ($rt_items as $name => $label): ?>
                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="<?= $name ?>" value="1" id="iv_<?= $name ?>">
                                        <label class="form-check-label" for="iv_<?= $name ?>" style="font-size:13px"><?= $label ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- RS -->
                        <div class="intervensi-section mb-3">
                            <div class="section-header rs-header">
                                <i class="fa fa-exclamation-circle"></i> RESIKO SEDANG (RS): Intervensi setiap shift jaga dan dinilai ulang tiap 2 hari
                            </div>
                            <div class="p-3">
                                <?php
                                $rs_items = [
                                    'rs_saran_bantuan'       => 'Sarankan minta bantuan',
                                    'rs_tempatkan_bel'       => 'Tempatkan bel dalam jangkauan pasien',
                                    'rs_posisi_tidur_roda'   => 'Pastikan tempat tidur pada posisi rendah dan roda terkunci',
                                    'rs_pegangan_tangan'     => 'Pastikan pegangan tempat tidur terpasang dengan baik',
                                    'rs_bantu_ambulasi'      => 'Bantu pasien saat ambulasi',
                                    'rs_benda_dekat_pasien'  => 'Tempatkan benda-benda milik pasien ke dekat pasien',
                                    'rs_lantai_bersih_kering' => 'Kondisikan permukaan lantai bersih, kering, dan tidak licin',
                                ];
                                foreach ($rs_items as $name => $label): ?>
                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="<?= $name ?>" value="1" id="iv_<?= $name ?>">
                                        <label class="form-check-label" for="iv_<?= $name ?>" style="font-size:13px"><?= $label ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- RR -->
                        <div class="intervensi-section mb-3">
                            <div class="section-header rr-header">
                                <i class="fa fa-info-circle"></i> RESIKO RENDAH (RR): Dinilai ulang resiko jatuhnya setiap 2 hari
                            </div>
                            <div class="p-3">
                                <?php
                                $rr_items = [
                                    'rr_monitor_tanda_vital'   => 'Monitor kondisi umum pasien dan tanda vital tiap 8 jam',
                                    'rr_pengaman_tempat_tidur' => 'Pastikan pengaman tempat tidur selalu tertutup saat pasien tidur',
                                ];
                                foreach ($rr_items as $name => $label): ?>
                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="<?= $name ?>" value="1" id="iv_<?= $name ?>">
                                        <label class="form-check-label" for="iv_<?= $name ?>" style="font-size:13px"><?= $label ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Intervensi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#form-intervensi').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            Swal.fire({ title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
            $.ajax({
                url: '<?= base_url() ?>AsesmenRD/simpan_intervensi_jatuh',
                type: 'POST',
                data: formData,
                dataType: 'json'
            }).done(function(res) {
                if (res.status) {
                    Swal.fire({ title: 'Berhasil', text: res.message, icon: 'success', timer: 1500, showConfirmButton: false }).then(function() {
                        $('#modal-intervensi').modal('hide');
                        var url = '<?= base_url() ?>AsesmenRD/form_pengkajian_resiko_pasien_jatuh_dewasa?no_rwt=<?= $no_rawat ?>';
                        openContent(false, url);
                    });
                } else {
                    Swal.fire('Gagal', res.message, 'error');
                }
            }).fail(function() {
                Swal.fire('Error', 'Gagal terhubung ke server.', 'error');
            });
        });
    </script>

<?php else: ?>
    <!-- ===================== CREATE / EDIT MODE ===================== -->
    <?php
    $v = function ($field, $default = '') use ($pf, $edit_mode) {
        return $edit_mode && isset($pf->$field) ? $pf->$field : $default;
    };
    ?>

    <form class="row" id="form-assesment-global"
        action="<?= base_url() ?>AsesmenRD/<?= $edit_mode ? 'update_asesmen_jatuh_dewasa' : 'simpan_asesmen_jatuh_dewasa' ?>"
        data-refresh-url="<?= base_url() ?>AsesmenRD/form_pengkajian_resiko_pasien_jatuh_dewasa?no_rwt=<?= $no_rawat ?>"
        method="post">
        <input type="hidden" name="no_rawat" value="<?= $no_rawat; ?>">
        <input type="hidden" name="no_rkm_medis" value="<?= isset($pasien) && $pasien ? $pasien->no_rkm_medis : ''; ?>">
        <?php if ($edit_mode): ?>
            <input type="hidden" name="id" value="<?= $pf->id; ?>">
        <?php endif; ?>

        <div class="col-12 mb-3">
            <small class="text-muted">
                <strong>Kriteria Skor:</strong>
                <span class="kategori-badge kategori-rt">Resiko Tinggi (RT) = Skor &gt; 45</span>
                <span class="kategori-badge kategori-rs ms-1">Resiko Sedang (RS) = Skor 25–44</span>
                <span class="kategori-badge kategori-rr ms-1">Resiko Rendah (RR) = Skor 0–24</span>
            </small>
        </div>

        <!-- Perawat -->
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Perawat Yang Menilai</label>
            <input type="text" class="form-control" name="perawat_penilai" value="<?= htmlspecialchars($v('perawat_penilai')) ?>" placeholder="Nama perawat">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Tanggal Asesmen</label>
            <input type="datetime-local" class="form-control" name="tanggal_asesmen" value="<?= $v('tanggal_asesmen') ?: date('Y-m-d\TH:i') ?>">
        </div>

        <!-- Step indicator -->
        <?php
        $initial_step = 1;
        if ($edit_mode && !empty($pf)) {
            if ($pf->skor1_total !== null && $pf->skor1_total !== '') {
                $initial_step = 2;
                if ($pf->skor2_total !== null && $pf->skor2_total !== '') {
                    $initial_step = 3;
                }
            }
        }
        ?>
        <div class="col-12 mb-3">
            <div class="step-indicator">
                <?php for ($si = 1; $si <= 3; $si++):
                    $filled = $edit_mode && !empty($pf) && isset($pf->{"skor{$si}_total"}) && $pf->{"skor{$si}_total"} !== null && $pf->{"skor{$si}_total"} !== '';
                ?>
                    <div class="step-item <?= $si === $initial_step ? 'active' : '' ?> <?= $filled ? 'filled' : '' ?>" data-step="<?= $si ?>">
                        <i class="fa <?= $filled ? 'fa-check-circle' : 'fa-circle-dot' ?> me-1"></i>
                        Skor <?= $si ?>
                        <?php if ($si > 1): ?><br><small>(Penilaian Ulang)</small><?php endif; ?>
                        <?php if ($filled): ?><br><span class="badge bg-success">Terisi</span><?php endif; ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <!-- Penilaian Skor -->
        <?php for ($sn = 1; $sn <= 3; $sn++): ?>
            <div class="col-12 skor-step <?= $sn === $initial_step ? 'active' : '' ?>" data-step="<?= $sn ?>">
                <div class="morse-card">
                    <div class="card-header">
                        <i class="fa fa-clipboard-check"></i> Penilaian Skor <?= $sn ?>
                        <?php if ($sn > 1): ?>
                            <small>(Opsional — untuk penilaian ulang)</small>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tanggal Penilaian <?= $sn ?></label>
                                <input type="date" class="form-control form-control-sm" name="tgl_<?= $sn ?>" value="<?= $v("tgl_{$sn}") ?: ($sn == 1 ? date('Y-m-d') : '') ?>">
                            </div>
                        </div>

                        <!-- 1. Riwayat Jatuh -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">1. Riwayat Jatuh</label>
                            <?php $rj = $v("skor{$sn}_riwayat_jatuh", $sn == 1 ? '0' : null); ?>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input skor-radio" type="radio" name="skor<?= $sn ?>_riwayat_jatuh" value="25" data-skor="<?= $sn ?>" id="rj<?= $sn ?>_ya" <?= $rj !== null && (int)$rj === 25 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="rj<?= $sn ?>_ya">Ya <span class="badge bg-danger">25</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input skor-radio" type="radio" name="skor<?= $sn ?>_riwayat_jatuh" value="0" data-skor="<?= $sn ?>" id="rj<?= $sn ?>_tidak" <?= $rj !== null && (int)$rj === 0 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="rj<?= $sn ?>_tidak">Tidak <span class="badge bg-secondary">0</span></label>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Diagnosa Sekunder -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">2. Diagnosa Sekunder</label>
                            <?php $ds = $v("skor{$sn}_diagnosa_sekunder", $sn == 1 ? '0' : null); ?>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input skor-radio" type="radio" name="skor<?= $sn ?>_diagnosa_sekunder" value="15" data-skor="<?= $sn ?>" id="ds<?= $sn ?>_ya" <?= $ds !== null && (int)$ds === 15 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="ds<?= $sn ?>_ya">Ya <span class="badge bg-danger">15</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input skor-radio" type="radio" name="skor<?= $sn ?>_diagnosa_sekunder" value="0" data-skor="<?= $sn ?>" id="ds<?= $sn ?>_tidak" <?= $ds !== null && (int)$ds === 0 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="ds<?= $sn ?>_tidak">Tidak <span class="badge bg-secondary">0</span></label>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Alat Bantu Jalan -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">3. Alat Bantu Jalan</label>
                            <?php $ab = $v("skor{$sn}_alat_bantu", $sn == 1 ? '0' : null); ?>
                            <div class="d-flex flex-column gap-1">
                                <div class="form-check">
                                    <input class="form-check-input skor-radio" type="radio" name="skor<?= $sn ?>_alat_bantu" value="30" data-skor="<?= $sn ?>" id="ab<?= $sn ?>_furniture" <?= $ab !== null && (int)$ab === 30 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="ab<?= $sn ?>_furniture">Furniture <span class="badge bg-danger">30</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input skor-radio" type="radio" name="skor<?= $sn ?>_alat_bantu" value="15" data-skor="<?= $sn ?>" id="ab<?= $sn ?>_tongkat" <?= $ab !== null && (int)$ab === 15 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="ab<?= $sn ?>_tongkat">Penopang, tongkat, walker <span class="badge bg-warning text-dark">15</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input skor-radio" type="radio" name="skor<?= $sn ?>_alat_bantu" value="0" data-skor="<?= $sn ?>" id="ab<?= $sn ?>_bedrest" <?= $ab !== null && (int)$ab === 0 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="ab<?= $sn ?>_bedrest">Bedrest, Dibantu Perawat <span class="badge bg-secondary">0</span></label>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Terpasang Infus -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">4. Terpasang Infus</label>
                            <?php $ti = $v("skor{$sn}_terpasang_infus", $sn == 1 ? '0' : null); ?>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input skor-radio" type="radio" name="skor<?= $sn ?>_terpasang_infus" value="20" data-skor="<?= $sn ?>" id="ti<?= $sn ?>_ya" <?= $ti !== null && (int)$ti === 20 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="ti<?= $sn ?>_ya">Ya <span class="badge bg-danger">20</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input skor-radio" type="radio" name="skor<?= $sn ?>_terpasang_infus" value="0" data-skor="<?= $sn ?>" id="ti<?= $sn ?>_tidak" <?= $ti !== null && (int)$ti === 0 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="ti<?= $sn ?>_tidak">Tidak <span class="badge bg-secondary">0</span></label>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Cara Berjalan/Pindah -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">5. Cara Berjalan / Pindah</label>
                            <?php $cb = $v("skor{$sn}_cara_berjalan", $sn == 1 ? '0' : null); ?>
                            <div class="d-flex flex-column gap-1">
                                <div class="form-check">
                                    <input class="form-check-input skor-radio" type="radio" name="skor<?= $sn ?>_cara_berjalan" value="20" data-skor="<?= $sn ?>" id="cb<?= $sn ?>_terganggu" <?= $cb !== null && (int)$cb === 20 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="cb<?= $sn ?>_terganggu">Terganggu <span class="badge bg-danger">20</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input skor-radio" type="radio" name="skor<?= $sn ?>_cara_berjalan" value="10" data-skor="<?= $sn ?>" id="cb<?= $sn ?>_lemah" <?= $cb !== null && (int)$cb === 10 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="cb<?= $sn ?>_lemah">Lemah <span class="badge bg-warning text-dark">10</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input skor-radio" type="radio" name="skor<?= $sn ?>_cara_berjalan" value="0" data-skor="<?= $sn ?>" id="cb<?= $sn ?>_normal" <?= $cb !== null && (int)$cb === 0 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="cb<?= $sn ?>_normal">Normal, bedrest, pasien mobile <span class="badge bg-secondary">0</span></label>
                                </div>
                            </div>
                        </div>

                        <!-- 6. Status Mental -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">6. Status Mental</label>
                            <?php $sm = $v("skor{$sn}_status_mental", $sn == 1 ? '0' : null); ?>
                            <div class="d-flex flex-column gap-1">
                                <div class="form-check">
                                    <input class="form-check-input skor-radio" type="radio" name="skor<?= $sn ?>_status_mental" value="15" data-skor="<?= $sn ?>" id="sm<?= $sn ?>_lupa" <?= $sm !== null && (int)$sm === 15 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="sm<?= $sn ?>_lupa">Lupa keterbatasan diri <span class="badge bg-danger">15</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input skor-radio" type="radio" name="skor<?= $sn ?>_status_mental" value="0" data-skor="<?= $sn ?>" id="sm<?= $sn ?>_orientasi" <?= $sm !== null && (int)$sm === 0 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="sm<?= $sn ?>_orientasi">Orientasi sesuai kemampuan diri <span class="badge bg-secondary">0</span></label>
                                </div>
                            </div>
                        </div>

                        <!-- Skor Total & Kategori -->
                        <div class="result-box-jatuh" id="result-skor<?= $sn ?>">
                            <h5 class="mb-1">Skor Total: <span id="total-skor<?= $sn ?>"><?= $sn == 1 ? '0' : '-' ?></span></h5>
                            <h6 class="fw-bold" id="kategori-skor<?= $sn ?>"><?= $sn == 1 ? '-' : 'Belum dinilai' ?></h6>
                        </div>

                        <!-- Pilih Setelah Penilaian -->
                        <div class="mt-3">
                            <label class="form-label fw-bold">Pilih Skor Resiko Setelah Penilaian</label>
                            <?php $ps = $v("pilih_setelah_{$sn}"); ?>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pilih_setelah_<?= $sn ?>" value="RT" id="ps<?= $sn ?>_rt" <?= $ps === 'RT' ? 'checked' : '' ?>>
                                    <label class="form-check-label kategori-badge kategori-rt" for="ps<?= $sn ?>_rt">RT</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pilih_setelah_<?= $sn ?>" value="RS" id="ps<?= $sn ?>_rs" <?= $ps === 'RS' ? 'checked' : '' ?>>
                                    <label class="form-check-label kategori-badge kategori-rs" for="ps<?= $sn ?>_rs">RS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pilih_setelah_<?= $sn ?>" value="RR" id="ps<?= $sn ?>_rr" <?= $ps === 'RR' ? 'checked' : '' ?>>
                                    <label class="form-check-label kategori-badge kategori-rr" for="ps<?= $sn ?>_rr">RR</label>
                                </div>
                            </div>
                        </div>

                        <!-- Next button -->
                        <?php if ($sn < 3): ?>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-primary btn-next-step" data-next="<?= $sn + 1 ?>">
                                Lanjut ke Skor <?= $sn + 1 ?> <i class="fa fa-arrow-right ms-1"></i>
                            </button>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endfor; ?>

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
        function calculateMorse(skorNum) {
            var fields = [
                'skor' + skorNum + '_riwayat_jatuh',
                'skor' + skorNum + '_diagnosa_sekunder',
                'skor' + skorNum + '_alat_bantu',
                'skor' + skorNum + '_terpasang_infus',
                'skor' + skorNum + '_cara_berjalan',
                'skor' + skorNum + '_status_mental'
            ];

            // Cek apakah ada radio yang dipilih di skor ini
            var hasSelection = false;
            fields.forEach(function(f) {
                if ($('input[name="' + f + '"]:checked').length > 0) {
                    hasSelection = true;
                }
            });

            var box = $('#result-skor' + skorNum);
            box.removeClass('rt-active rs-active rr-active');

            if (!hasSelection) {
                // Skor belum diisi — tampilkan dash
                $('#total-skor' + skorNum).text('-');
                $('#kategori-skor' + skorNum).text('Belum dinilai');
                return;
            }

            var total = 0;
            fields.forEach(function(f) {
                var checked = $('input[name="' + f + '"]:checked');
                if (checked.length > 0) {
                    total += parseInt(checked.val()) || 0;
                }
            });

            $('#total-skor' + skorNum).text(total);

            var kategori = '';
            if (total > 45) {
                kategori = 'Resiko Tinggi (RT)';
                box.addClass('rt-active');
                $('input[name="pilih_setelah_' + skorNum + '"][value="RT"]').prop('checked', true);
            } else if (total >= 25) {
                kategori = 'Resiko Sedang (RS)';
                box.addClass('rs-active');
                $('input[name="pilih_setelah_' + skorNum + '"][value="RS"]').prop('checked', true);
            } else {
                kategori = 'Resiko Rendah (RR)';
                box.addClass('rr-active');
                $('input[name="pilih_setelah_' + skorNum + '"][value="RR"]').prop('checked', true);
            }

            $('#kategori-skor' + skorNum).text(kategori);
        }

        // Event listener
        $('.skor-radio').on('change', function() {
            var skorNum = $(this).data('skor');
            calculateMorse(skorNum);
        });

        // Initial calc
        calculateMorse(1);
        calculateMorse(2);
        calculateMorse(3);

        // Step navigation
        var currentStep = <?= $initial_step ?>;

        function showStep(step) {
            $('.skor-step').removeClass('active');
            $('.skor-step[data-step="' + step + '"]').addClass('active');
            $('.step-indicator .step-item').removeClass('active');
            $('.step-indicator .step-item[data-step="' + step + '"]').addClass('active');
            currentStep = step;
            $('.step-indicator')[0].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        // Next button
        $(document).on('click', '.btn-next-step', function() {
            showStep($(this).data('next'));
        });

        // Step indicator click (navigasi langsung)
        $('.step-indicator .step-item').on('click', function() {
            showStep($(this).data('step'));
        });

        <?php if ($edit_mode): ?>
            $('#btn-batal-edit').on('click', function() {
                var url = '<?= base_url() ?>AsesmenRD/form_pengkajian_resiko_pasien_jatuh_dewasa?no_rwt=<?= $no_rawat ?>';
                openContent(false, url);
            });
        <?php endif; ?>
    </script>
<?php endif; ?>