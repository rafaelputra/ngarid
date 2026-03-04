<style>
    .pf-read-table {
        font-size: 0.95rem;
    }

    .pf-read-table th {
        background-color: #f8f9fa;
        font-weight: 600;
        width: 250px;
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

    .barthel-card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .barthel-card .card-header {
        background-color: #e8f0fe;
        font-weight: 600;
        color: #0d6efd;
        padding: 10px 15px;
        border-radius: 7px 7px 0 0;
    }

    .barthel-card .card-body {
        padding: 15px;
    }

    .barthel-option {
        padding: 8px 12px;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        margin-bottom: 8px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .barthel-option:hover {
        background-color: #f8f9fa;
    }

    .barthel-option.selected {
        background-color: #e8f0fe;
        border-color: #0d6efd;
    }

    .barthel-option input[type="radio"] {
        display: none;
    }

    .barthel-score {
        display: inline-block;
        width: 28px;
        height: 28px;
        line-height: 28px;
        text-align: center;
        background-color: #6c757d;
        color: #fff;
        border-radius: 50%;
        font-weight: bold;
        margin-right: 8px;
    }

    .barthel-option.selected .barthel-score {
        background-color: #0d6efd;
    }

    .result-box {
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        border: 2px solid;
        margin-top: 20px;
    }

    .result-box.mandiri {
        background-color: #d1e7dd;
        border-color: #198754;
    }

    .result-box.ringan {
        background-color: #cff4fc;
        border-color: #0dcaf0;
    }

    .result-box.sedang {
        background-color: #fff3cd;
        border-color: #ffc107;
    }

    .result-box.berat {
        background-color: #f8d7da;
        border-color: #dc3545;
    }

    .result-box.total {
        background-color: #d3d3d4;
        border-color: #6c757d;
    }

    .barthel-history-card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-bottom: 10px;
        transition: all 0.2s;
    }

    .barthel-history-card:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .barthel-history-card .card-body {
        padding: 12px 15px;
    }

    .kategori-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .kategori-badge.mandiri {
        background-color: #d1e7dd;
        color: #0f5132;
    }

    .kategori-badge.ringan {
        background-color: #cff4fc;
        color: #055160;
    }

    .kategori-badge.sedang {
        background-color: #fff3cd;
        color: #664d03;
    }

    .kategori-badge.berat {
        background-color: #f8d7da;
        color: #842029;
    }

    .kategori-badge.total {
        background-color: #d3d3d4;
        color: #495057;
    }
</style>

<?php
$has_list = !empty($list_pf);
$edit_mode = ($mode === 'edit' && !empty($pf));
$add_mode = ($mode === 'add');
$show_form = ($edit_mode || $add_mode);

// Function to get kategori from total skor
function get_kategori_barthel($total)
{
    if ($total >= 20) return 'Mandiri';
    if ($total >= 12) return 'Ketergantungan Ringan';
    if ($total >= 9) return 'Ketergantungan Sedang';
    if ($total >= 5) return 'Ketergantungan Berat';
    return 'Ketergantungan Total';
}

function get_kategori_class($kategori)
{
    if ($kategori === 'Mandiri') return 'mandiri';
    if ($kategori === 'Ketergantungan Ringan') return 'ringan';
    if ($kategori === 'Ketergantungan Sedang') return 'sedang';
    if ($kategori === 'Ketergantungan Berat') return 'berat';
    return 'total';
}
?>

<h5 class="fw-bold text-primary mb-3 pf-title"><i class="fa fa-clipboard-check"></i> Pengkajian Status Fungsional (Barthel Index)</h5>
<hr>

<?php if (!$show_form): ?>
    <!-- ===================== LIST MODE ===================== -->
    <div class="mb-3">
        <button type="button" class="btn btn-primary btn-sm" id="btn-tambah-barthel">
            <i class="fa fa-plus"></i> Tambah Penilaian Baru
        </button>
    </div>

    <?php if ($has_list): ?>
        <div class="row">
            <?php foreach ($list_pf as $item):
                $kategori = get_kategori_barthel($item->total_skor);
                $kategori_class = get_kategori_class($kategori);
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="barthel-history-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <strong class="text-primary"><?= date('d-m-Y', strtotime($item->tgl_pengkajian)) ?></strong>
                                    <br>
                                    <small class="text-muted"><?= htmlspecialchars($item->periode) ?></small>
                                </div>
                                <span class="kategori-badge <?= $kategori_class ?>"><?= $item->total_skor ?></span>
                            </div>
                            <div class="mb-2">
                                <span class="kategori-badge <?= $kategori_class ?>"><?= $kategori ?></span>
                            </div>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-outline-info btn-lihat-detail" data-id="<?= $item->id_penilaian ?>">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-outline-warning btn-edit-barthel" data-id="<?= $item->id_penilaian ?>">
                                    <i class="fa fa-pen"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-hapus-barthel" data-id="<?= $item->id_penilaian ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Detail Modal -->
        <div class="modal fade" id="modalDetailBarthel" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa fa-clipboard-list"></i> Detail Penilaian Barthel Index</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="modal-detail-content">
                        <!-- Content loaded via JS -->
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Store data for detail view
            var barthelData = <?= json_encode($list_pf) ?>;

            var defekasi_labels = {
                0: 'Inkontinen / Tak teratur (perlu pencahar)',
                1: 'Kadang tak terkendali (1x seminggu)',
                2: 'Mandiri'
            };
            var berkemih_labels = {
                0: 'Inkontinen & pakai kateter',
                1: 'Kadang tak terkendali (maks 1x 24 jam)',
                2: 'Mandiri'
            };
            var bersih_diri_labels = {
                0: 'Butuh pertolongan orang lain',
                1: 'Mandiri'
            };
            var toilet_labels = {
                0: 'Tergantung orang lain',
                1: 'Perlu pertolongan beberapa aktifitas',
                2: 'Mandiri'
            };
            var makan_labels = {
                0: 'Tidak mampu',
                1: 'Perlu bantuan memotong makanan',
                2: 'Mandiri'
            };
            var pindah_tempat_labels = {
                0: 'Tidak mampu',
                1: 'Perlu banyak bantuan (2 orang)',
                2: 'Bantuan minimal (1 orang)',
                3: 'Mandiri'
            };
            var mobilisasi_labels = {
                0: 'Tidak mampu',
                1: 'Kursi roda',
                2: 'Bantuan 1 orang / walker',
                3: 'Mandiri'
            };
            var berpakaian_labels = {
                0: 'Tergantung orang lain',
                1: 'Sebagian dibantu',
                2: 'Mandiri'
            };
            var tangga_labels = {
                0: 'Tidak mampu',
                1: 'Butuh pertolongan',
                2: 'Mandiri'
            };
            var mandi_labels = {
                0: 'Tergantung orang lain',
                1: 'Mandiri'
            };

            function getKategori(total) {
                if (total >= 20) return 'Mandiri';
                if (total >= 12) return 'Ketergantungan Ringan';
                if (total >= 9) return 'Ketergantungan Sedang';
                if (total >= 5) return 'Ketergantungan Berat';
                return 'Ketergantungan Total';
            }

            function getKategoriClass(kategori) {
                if (kategori === 'Mandiri') return 'mandiri';
                if (kategori === 'Ketergantungan Ringan') return 'ringan';
                if (kategori === 'Ketergantungan Sedang') return 'sedang';
                if (kategori === 'Ketergantungan Berat') return 'berat';
                return 'total';
            }

            $('.btn-lihat-detail').on('click', function() {
                var id = $(this).data('id');
                var item = barthelData.find(function(x) {
                    return x.id_penilaian == id;
                });
                if (!item) return;

                var kategori = getKategori(item.total_skor);
                var kategoriClass = getKategoriClass(kategori);

                var html = '<table class="table table-bordered pf-read-table">' +
                    '<tr class="pf-section-row"><td colspan="3"><i class="fa fa-clipboard-list"></i> Penilaian Barthel Index</td></tr>' +
                    '<tr><th>Tanggal Pengkajian</th><td colspan="2">' + formatDate(item.tgl_pengkajian) + '</td></tr>' +
                    '<tr><th>Periode</th><td colspan="2">' + (item.periode || '-') + '</td></tr>' +
                    '<tr><th>1. Defekasi (BAB)</th><td>' + (defekasi_labels[item.skor_defekasi] || '-') + '</td><td class="text-center fw-bold" style="width:60px">' + item.skor_defekasi + '</td></tr>' +
                    '<tr><th>2. Berkemih (BAK)</th><td>' + (berkemih_labels[item.skor_berkemih] || '-') + '</td><td class="text-center fw-bold">' + item.skor_berkemih + '</td></tr>' +
                    '<tr><th>3. Membersihkan Diri</th><td>' + (bersih_diri_labels[item.skor_bersih_diri] || '-') + '</td><td class="text-center fw-bold">' + item.skor_bersih_diri + '</td></tr>' +
                    '<tr><th>4. Penggunaan Toilet</th><td>' + (toilet_labels[item.skor_toilet] || '-') + '</td><td class="text-center fw-bold">' + item.skor_toilet + '</td></tr>' +
                    '<tr><th>5. Makan</th><td>' + (makan_labels[item.skor_makan] || '-') + '</td><td class="text-center fw-bold">' + item.skor_makan + '</td></tr>' +
                    '<tr><th>6. Berpindah Tempat</th><td>' + (pindah_tempat_labels[item.skor_pindah_tempat] || '-') + '</td><td class="text-center fw-bold">' + item.skor_pindah_tempat + '</td></tr>' +
                    '<tr><th>7. Mobilisasi</th><td>' + (mobilisasi_labels[item.skor_mobilisasi] || '-') + '</td><td class="text-center fw-bold">' + item.skor_mobilisasi + '</td></tr>' +
                    '<tr><th>8. Berpakaian</th><td>' + (berpakaian_labels[item.skor_berpakaian] || '-') + '</td><td class="text-center fw-bold">' + item.skor_berpakaian + '</td></tr>' +
                    '<tr><th>9. Naik Turun Tangga</th><td>' + (tangga_labels[item.skor_tangga] || '-') + '</td><td class="text-center fw-bold">' + item.skor_tangga + '</td></tr>' +
                    '<tr><th>10. Mandi</th><td>' + (mandi_labels[item.skor_mandi] || '-') + '</td><td class="text-center fw-bold">' + item.skor_mandi + '</td></tr>' +
                    '<tr class="table-secondary"><th colspan="2" class="text-end">Total Skor</th><td class="text-center fw-bold fs-5">' + item.total_skor + '</td></tr>' +
                    '</table>' +
                    '<div class="result-box ' + kategoriClass + '">' +
                    '<h5 class="mb-2">Kategori Ketergantungan</h5>' +
                    '<h3 class="fw-bold mb-0">' + kategori + '</h3>' +
                    '<small class="text-muted">20: Mandiri | 12-19: Ringan | 9-11: Sedang | 5-8: Berat | 0-4: Total</small>' +
                    '</div>';

                $('#modal-detail-content').html(html);
                $('#modalDetailBarthel').modal('show');
            });

            function formatDate(dateStr) {
                if (!dateStr) return '-';
                var d = new Date(dateStr);
                return d.getDate().toString().padStart(2, '0') + '-' + (d.getMonth() + 1).toString().padStart(2, '0') + '-' + d.getFullYear();
            }
        </script>
    <?php else: ?>
        <div class="alert alert-info">
            <i class="fa fa-info-circle"></i> Belum ada data penilaian Barthel Index. Klik tombol <strong>Tambah Penilaian Baru</strong> untuk menambahkan.
        </div>
    <?php endif; ?>

    <script>
        $('#btn-tambah-barthel').on('click', function() {
            var url = '<?= base_url() ?>AsesmenRD/form_penilaian_barthel?no_rwt=<?= $no_rawat ?>&mode=add';
            openContent(false, url);
        });

        $('.btn-edit-barthel').on('click', function() {
            var id = $(this).data('id');
            var url = '<?= base_url() ?>AsesmenRD/form_penilaian_barthel?no_rwt=<?= $no_rawat ?>&mode=edit&id=' + id;
            openContent(false, url);
        });

        $('.btn-hapus-barthel').on('click', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Hapus Data?',
                text: 'Data penilaian Barthel Index akan dihapus permanen!',
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
                        url: '<?= base_url() ?>AsesmenRD/hapus_penilaian_barthel',
                        type: 'POST',
                        data: {
                            id_penilaian: id
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
                                var url = '<?= base_url() ?>AsesmenRD/form_penilaian_barthel?no_rwt=<?= $no_rawat ?>';
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
    <!-- ===================== CREATE / EDIT MODE ===================== -->
    <?php
    $v = function ($field, $default = '') use ($pf, $edit_mode) {
        return $edit_mode && isset($pf->$field) ? $pf->$field : $default;
    };
    ?>

    <div class="mb-3">
        <button type="button" class="btn btn-secondary btn-sm" id="btn-kembali">
            <i class="fa fa-arrow-left"></i> Kembali ke Daftar
        </button>
    </div>

    <form class="row" id="form-assesment-global"
        action="<?= base_url() ?>AsesmenRD/<?= $edit_mode ? 'update_penilaian_barthel' : 'simpan_penilaian_barthel' ?>"
        data-refresh-url="<?= base_url() ?>AsesmenRD/form_penilaian_barthel?no_rwt=<?= $no_rawat ?>"
        method="post">
        <input type="hidden" name="no_rawat" value="<?= $no_rawat; ?>">
        <?php if ($edit_mode): ?>
            <input type="hidden" name="id_penilaian" value="<?= $pf->id_penilaian; ?>">
        <?php endif; ?>

        <div class="col-12 mb-3">
            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i>
                <strong>Barthel Index</strong> digunakan untuk mengukur tingkat kemandirian pasien dalam melakukan aktivitas sehari-hari (ADL - Activities of Daily Living).
            </div>
        </div>

        <!-- Tanggal dan Periode -->
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Tanggal Pengkajian <span class="text-danger">*</span></label>
            <input type="date" name="tgl_pengkajian" class="form-control" value="<?= $v('tgl_pengkajian', date('Y-m-d')) ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Periode <span class="text-danger">*</span></label>
            <select name="periode" class="form-select" required>
                <option value="">-- Pilih Periode --</option>
                <?php
                $periode_options = ['Sebelum Sakit', 'Saat Masuk RS', 'Minggu I', 'Minggu II', 'Saat Pulang'];
                foreach ($periode_options as $po):
                ?>
                    <option value="<?= $po ?>" <?= $v('periode') === $po ? 'selected' : '' ?>><?= $po ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- 1. Defekasi (BAB) -->
        <div class="col-md-6">
            <div class="barthel-card">
                <div class="card-header">
                    <i class="fa fa-toilet"></i> 1. Defekasi (BAB)
                </div>
                <div class="card-body">
                    <?php $defekasi = $v('skor_defekasi', 2); ?>
                    <label class="barthel-option d-block <?= $defekasi == 0 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_defekasi" value="0" <?= $defekasi == 0 ? 'checked' : '' ?>>
                        <span class="barthel-score">0</span> Inkontinen / Tak teratur (perlu pencahar)
                    </label>
                    <label class="barthel-option d-block <?= $defekasi == 1 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_defekasi" value="1" <?= $defekasi == 1 ? 'checked' : '' ?>>
                        <span class="barthel-score">1</span> Kadang tak terkendali (1x seminggu)
                    </label>
                    <label class="barthel-option d-block <?= $defekasi == 2 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_defekasi" value="2" <?= $defekasi == 2 ? 'checked' : '' ?>>
                        <span class="barthel-score">2</span> Mandiri
                    </label>
                </div>
            </div>
        </div>

        <!-- 2. Berkemih (BAK) -->
        <div class="col-md-6">
            <div class="barthel-card">
                <div class="card-header">
                    <i class="fa fa-droplet"></i> 2. Berkemih (BAK)
                </div>
                <div class="card-body">
                    <?php $berkemih = $v('skor_berkemih', 2); ?>
                    <label class="barthel-option d-block <?= $berkemih == 0 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_berkemih" value="0" <?= $berkemih == 0 ? 'checked' : '' ?>>
                        <span class="barthel-score">0</span> Inkontinen & pakai kateter
                    </label>
                    <label class="barthel-option d-block <?= $berkemih == 1 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_berkemih" value="1" <?= $berkemih == 1 ? 'checked' : '' ?>>
                        <span class="barthel-score">1</span> Kadang tak terkendali (maks 1x 24 jam)
                    </label>
                    <label class="barthel-option d-block <?= $berkemih == 2 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_berkemih" value="2" <?= $berkemih == 2 ? 'checked' : '' ?>>
                        <span class="barthel-score">2</span> Mandiri
                    </label>
                </div>
            </div>
        </div>

        <!-- 3. Membersihkan Diri -->
        <div class="col-md-6">
            <div class="barthel-card">
                <div class="card-header">
                    <i class="fa fa-hand-sparkles"></i> 3. Membersihkan Diri (cuci muka, sisir, sikat gigi)
                </div>
                <div class="card-body">
                    <?php $bersih = $v('skor_bersih_diri', 1); ?>
                    <label class="barthel-option d-block <?= $bersih == 0 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_bersih_diri" value="0" <?= $bersih == 0 ? 'checked' : '' ?>>
                        <span class="barthel-score">0</span> Butuh pertolongan orang lain
                    </label>
                    <label class="barthel-option d-block <?= $bersih == 1 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_bersih_diri" value="1" <?= $bersih == 1 ? 'checked' : '' ?>>
                        <span class="barthel-score">1</span> Mandiri
                    </label>
                </div>
            </div>
        </div>

        <!-- 4. Penggunaan Toilet -->
        <div class="col-md-6">
            <div class="barthel-card">
                <div class="card-header">
                    <i class="fa fa-restroom"></i> 4. Penggunaan Toilet (keluar/masuk, melepas pakaian)
                </div>
                <div class="card-body">
                    <?php $toilet = $v('skor_toilet', 2); ?>
                    <label class="barthel-option d-block <?= $toilet == 0 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_toilet" value="0" <?= $toilet == 0 ? 'checked' : '' ?>>
                        <span class="barthel-score">0</span> Tergantung orang lain
                    </label>
                    <label class="barthel-option d-block <?= $toilet == 1 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_toilet" value="1" <?= $toilet == 1 ? 'checked' : '' ?>>
                        <span class="barthel-score">1</span> Perlu pertolongan beberapa aktifitas
                    </label>
                    <label class="barthel-option d-block <?= $toilet == 2 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_toilet" value="2" <?= $toilet == 2 ? 'checked' : '' ?>>
                        <span class="barthel-score">2</span> Mandiri
                    </label>
                </div>
            </div>
        </div>

        <!-- 5. Makan -->
        <div class="col-md-6">
            <div class="barthel-card">
                <div class="card-header">
                    <i class="fa fa-utensils"></i> 5. Makan
                </div>
                <div class="card-body">
                    <?php $makan = $v('skor_makan', 2); ?>
                    <label class="barthel-option d-block <?= $makan == 0 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_makan" value="0" <?= $makan == 0 ? 'checked' : '' ?>>
                        <span class="barthel-score">0</span> Tidak mampu
                    </label>
                    <label class="barthel-option d-block <?= $makan == 1 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_makan" value="1" <?= $makan == 1 ? 'checked' : '' ?>>
                        <span class="barthel-score">1</span> Perlu bantuan memotong makanan
                    </label>
                    <label class="barthel-option d-block <?= $makan == 2 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_makan" value="2" <?= $makan == 2 ? 'checked' : '' ?>>
                        <span class="barthel-score">2</span> Mandiri
                    </label>
                </div>
            </div>
        </div>

        <!-- 6. Berpindah Tempat / Transfer -->
        <div class="col-md-6">
            <div class="barthel-card">
                <div class="card-header">
                    <i class="fa fa-bed"></i> 6. Berpindah Tempat (dari tempat tidur ke kursi)
                </div>
                <div class="card-body">
                    <?php $pindah = $v('skor_pindah_tempat', 3); ?>
                    <label class="barthel-option d-block <?= $pindah == 0 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_pindah_tempat" value="0" <?= $pindah == 0 ? 'checked' : '' ?>>
                        <span class="barthel-score">0</span> Tidak mampu
                    </label>
                    <label class="barthel-option d-block <?= $pindah == 1 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_pindah_tempat" value="1" <?= $pindah == 1 ? 'checked' : '' ?>>
                        <span class="barthel-score">1</span> Perlu banyak bantuan (2 orang)
                    </label>
                    <label class="barthel-option d-block <?= $pindah == 2 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_pindah_tempat" value="2" <?= $pindah == 2 ? 'checked' : '' ?>>
                        <span class="barthel-score">2</span> Bantuan minimal (1 orang)
                    </label>
                    <label class="barthel-option d-block <?= $pindah == 3 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_pindah_tempat" value="3" <?= $pindah == 3 ? 'checked' : '' ?>>
                        <span class="barthel-score">3</span> Mandiri
                    </label>
                </div>
            </div>
        </div>

        <!-- 7. Mobilisasi / Berjalan -->
        <div class="col-md-6">
            <div class="barthel-card">
                <div class="card-header">
                    <i class="fa fa-person-walking"></i> 7. Mobilisasi / Berjalan (di permukaan datar)
                </div>
                <div class="card-body">
                    <?php $mobilisasi = $v('skor_mobilisasi', 3); ?>
                    <label class="barthel-option d-block <?= $mobilisasi == 0 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_mobilisasi" value="0" <?= $mobilisasi == 0 ? 'checked' : '' ?>>
                        <span class="barthel-score">0</span> Tidak mampu
                    </label>
                    <label class="barthel-option d-block <?= $mobilisasi == 1 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_mobilisasi" value="1" <?= $mobilisasi == 1 ? 'checked' : '' ?>>
                        <span class="barthel-score">1</span> Kursi roda
                    </label>
                    <label class="barthel-option d-block <?= $mobilisasi == 2 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_mobilisasi" value="2" <?= $mobilisasi == 2 ? 'checked' : '' ?>>
                        <span class="barthel-score">2</span> Bantuan 1 orang / walker
                    </label>
                    <label class="barthel-option d-block <?= $mobilisasi == 3 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_mobilisasi" value="3" <?= $mobilisasi == 3 ? 'checked' : '' ?>>
                        <span class="barthel-score">3</span> Mandiri
                    </label>
                </div>
            </div>
        </div>

        <!-- 8. Berpakaian -->
        <div class="col-md-6">
            <div class="barthel-card">
                <div class="card-header">
                    <i class="fa fa-shirt"></i> 8. Berpakaian
                </div>
                <div class="card-body">
                    <?php $pakaian = $v('skor_berpakaian', 2); ?>
                    <label class="barthel-option d-block <?= $pakaian == 0 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_berpakaian" value="0" <?= $pakaian == 0 ? 'checked' : '' ?>>
                        <span class="barthel-score">0</span> Tergantung orang lain
                    </label>
                    <label class="barthel-option d-block <?= $pakaian == 1 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_berpakaian" value="1" <?= $pakaian == 1 ? 'checked' : '' ?>>
                        <span class="barthel-score">1</span> Sebagian dibantu
                    </label>
                    <label class="barthel-option d-block <?= $pakaian == 2 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_berpakaian" value="2" <?= $pakaian == 2 ? 'checked' : '' ?>>
                        <span class="barthel-score">2</span> Mandiri
                    </label>
                </div>
            </div>
        </div>

        <!-- 9. Naik Turun Tangga -->
        <div class="col-md-6">
            <div class="barthel-card">
                <div class="card-header">
                    <i class="fa fa-stairs"></i> 9. Naik Turun Tangga
                </div>
                <div class="card-body">
                    <?php $tangga = $v('skor_tangga', 2); ?>
                    <label class="barthel-option d-block <?= $tangga == 0 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_tangga" value="0" <?= $tangga == 0 ? 'checked' : '' ?>>
                        <span class="barthel-score">0</span> Tidak mampu
                    </label>
                    <label class="barthel-option d-block <?= $tangga == 1 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_tangga" value="1" <?= $tangga == 1 ? 'checked' : '' ?>>
                        <span class="barthel-score">1</span> Butuh pertolongan
                    </label>
                    <label class="barthel-option d-block <?= $tangga == 2 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_tangga" value="2" <?= $tangga == 2 ? 'checked' : '' ?>>
                        <span class="barthel-score">2</span> Mandiri
                    </label>
                </div>
            </div>
        </div>

        <!-- 10. Mandi -->
        <div class="col-md-6">
            <div class="barthel-card">
                <div class="card-header">
                    <i class="fa fa-shower"></i> 10. Mandi
                </div>
                <div class="card-body">
                    <?php $mandi = $v('skor_mandi', 1); ?>
                    <label class="barthel-option d-block <?= $mandi == 0 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_mandi" value="0" <?= $mandi == 0 ? 'checked' : '' ?>>
                        <span class="barthel-score">0</span> Tergantung orang lain
                    </label>
                    <label class="barthel-option d-block <?= $mandi == 1 ? 'selected' : '' ?>">
                        <input type="radio" name="skor_mandi" value="1" <?= $mandi == 1 ? 'checked' : '' ?>>
                        <span class="barthel-score">1</span> Mandiri
                    </label>
                </div>
            </div>
        </div>

        <!-- Result Preview -->
        <div class="col-12">
            <div class="result-box" id="result-preview">
                <h5 class="mb-2">Total Skor: <span id="total-skor">0</span></h5>
                <h4 class="fw-bold mb-0" id="kategori-text">-</h4>
                <small class="text-muted">20: Mandiri | 12-19: Ketergantungan Ringan | 9-11: Sedang | 5-8: Berat | 0-4: Total</small>
            </div>
        </div>

        <!-- Tombol -->
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> <?= $edit_mode ? 'Perbarui' : 'Simpan' ?>
            </button>
            <button type="button" class="btn btn-secondary" id="btn-batal">
                <i class="fa fa-times"></i> Batal
            </button>
        </div>
    </form>

    <script>
        function calculateBarthel() {
            var defekasi = parseInt($('input[name="skor_defekasi"]:checked').val()) || 0;
            var berkemih = parseInt($('input[name="skor_berkemih"]:checked').val()) || 0;
            var bersih = parseInt($('input[name="skor_bersih_diri"]:checked').val()) || 0;
            var toilet = parseInt($('input[name="skor_toilet"]:checked').val()) || 0;
            var makan = parseInt($('input[name="skor_makan"]:checked').val()) || 0;
            var pindah = parseInt($('input[name="skor_pindah_tempat"]:checked').val()) || 0;
            var mobilisasi = parseInt($('input[name="skor_mobilisasi"]:checked').val()) || 0;
            var pakaian = parseInt($('input[name="skor_berpakaian"]:checked').val()) || 0;
            var tangga = parseInt($('input[name="skor_tangga"]:checked').val()) || 0;
            var mandi = parseInt($('input[name="skor_mandi"]:checked').val()) || 0;

            var total = defekasi + berkemih + bersih + toilet + makan + pindah + mobilisasi + pakaian + tangga + mandi;

            var kategori = '';
            var kategoriClass = '';
            if (total >= 20) {
                kategori = 'Mandiri';
                kategoriClass = 'mandiri';
            } else if (total >= 12) {
                kategori = 'Ketergantungan Ringan';
                kategoriClass = 'ringan';
            } else if (total >= 9) {
                kategori = 'Ketergantungan Sedang';
                kategoriClass = 'sedang';
            } else if (total >= 5) {
                kategori = 'Ketergantungan Berat';
                kategoriClass = 'berat';
            } else {
                kategori = 'Ketergantungan Total';
                kategoriClass = 'total';
            }

            $('#total-skor').text(total);
            $('#kategori-text').text(kategori);
            $('#result-preview').removeClass('mandiri ringan sedang berat total').addClass(kategoriClass);
        }

        // Radio button change handler
        $('input[type="radio"]').on('change', function() {
            var name = $(this).attr('name');
            $('input[name="' + name + '"]').closest('.barthel-option').removeClass('selected');
            $(this).closest('.barthel-option').addClass('selected');
            calculateBarthel();
        });

        // Initial calculation
        calculateBarthel();

        $('#btn-kembali, #btn-batal').on('click', function() {
            var url = '<?= base_url() ?>AsesmenRD/form_penilaian_barthel?no_rwt=<?= $no_rawat ?>';
            openContent(false, url);
        });

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
                cancelButtonText: 'Batal'
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
                                var url = '<?= base_url() ?>AsesmenRD/form_penilaian_barthel?no_rwt=<?= $no_rawat ?>';
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