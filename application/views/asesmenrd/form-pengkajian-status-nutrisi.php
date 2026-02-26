<style>
    /* === Konsistensi font form penilaian fisik === */
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
</style>

<h5 class="fw-bold text-primary mb-3 pf-title"><i class="fa fa-file-lines"></i> Penilaian Fisik</h5>
<hr>

<form class="row" id="form-assesment-global" action="<?= base_url(); ?>AsesmenRD/simpan_penilaian_fisik" method="post">
    <input type="hidden" name="no_rawat" value="<?= $no_rawat; ?>">

    <!-- Keadaan Umum & GCS -->
    <div class="col-12 mb-2">
        <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-stethoscope"></i> Keadaan Umum & GCS</label>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-bold">Keadaan Umum</label>
        <input type="text" class="form-control" name="kunjungan_umum_gcs" placeholder="Keadaan umum pasien">
    </div>

    <div class="col-md-2 mb-3">
        <label class="form-label fw-bold">GCS E</label>
        <input type="number" class="form-control gcs-input" name="kunjungan_umum_e" id="gcs_e">
    </div>
    <div class="col-md-2 mb-3">
        <label class="form-label fw-bold">GCS V</label>
        <input type="number" class="form-control gcs-input" name="kunjungan_umum_v" id="gcs_v">
    </div>
    <div class="col-md-2 mb-3">
        <label class="form-label fw-bold">GCS M</label>
        <input type="number" class="form-control gcs-input" name="kunjungan_umum_m" id="gcs_m">
    </div>
    <div class="col-md-2 mb-3">
        <label class="form-label fw-bold">Total</label>
        <input type="number" class="form-control" name="kunjungan_umum_total" id="gcs_total" readonly style="background-color: #e9ecef; font-weight: bold;">
    </div>

    <!-- Tanda Vital -->
    <div class="col-12 mb-2">
        <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-stethoscope"></i> Tanda-tanda Vital</label>
    </div>

    <div class="col-md-6">
        <table class="table table-borderless mb-0">
            <tr>
                <td class="fw-bold" style="width:130px;">Tekanan Darah</td>
                <td>: <input type="number" class="form-control d-inline" name="tekanan_darah_sistolik" style="width:80px;"> / <input type="number" class="form-control d-inline" name="tekanan_darah_diastolik" style="width:80px;"> mmHg</td>
            </tr>
            <tr>
                <td class="fw-bold">Nadi</td>
                <td>: <input type="number" class="form-control d-inline" name="nadi" style="width:80px;"> x/menit</td>
            </tr>
            <tr>
                <td class="fw-bold">SpO2</td>
                <td>: <input type="text" class="form-control d-inline" name="spo2" style="width:80px;"> %</td>
            </tr>
        </table>
    </div>

    <div class="col-md-6">
        <table class="table table-borderless mb-0">
            <tr>
                <td class="fw-bold" style="width:130px;">Suhu Tubuh</td>
                <td>: <input type="number" class="form-control d-inline" name="suhu_tubuh" style="width:80px;"> &deg;C</td>
            </tr>
            <tr>
                <td class="fw-bold">Respirasi</td>
                <td>: <input type="number" class="form-control d-inline" name="respirasi" style="width:80px;"> x/menit</td>
            </tr>
            <tr>
                <td class="fw-bold">GDS</td>
                <td>: <input type="text" class="form-control d-inline" name="gds" style="width:80px;"></td>
            </tr>
        </table>
    </div>


    <div class="col-12 mb-2">
        <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-stethoscope"></i> Tinggi Badan/Berat Badan</label>
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label fw-bold">Tinggi Badan (cm)</label>
        <input type="number" class="form-control" name="tinggi_badan" placeholder="170">
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label fw-bold">Berat Badan (kg)</label>
        <input type="number" class="form-control" name="berat_badan" placeholder="65">
    </div>

    <!-- Informasi Tambahan -->
    <div class="col-12 mb-2 mt-2">
        <label class="form-label fw-bold text-primary section-heading"><i class="fa fa-clipboard-list"></i> Informasi Tambahan</label>
    </div>

    <div class="col-md-12 mb-3">
        <div class="d-flex gap-3 mb-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="informasi_tambahan" value="0" id="info_tidak" checked onchange="toggleInfoTambahan()">
                <label class="form-check-label" for="info_tidak">Tidak ada</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="informasi_tambahan" value="1" id="info_ya" onchange="toggleInfoTambahan()">
                <label class="form-check-label" for="info_ya">Ada</label>
            </div>
        </div>
        <textarea class="form-control d-none" name="informasi_tambahan_jelaskan" id="info_tambahan_text" rows="2" placeholder="Jelaskan informasi tambahan..."></textarea>
    </div>

    <!-- Pernafasan -->
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Pernafasan</label>
        <div class="d-flex flex-wrap gap-3 mb-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pernafasan" value="Normal" checked onchange="toggleLainnya('pernafasan')">
                <label class="form-check-label">Normal</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pernafasan" value="Batuk" onchange="toggleLainnya('pernafasan')">
                <label class="form-check-label">Batuk</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pernafasan" value="Sesak" onchange="toggleLainnya('pernafasan')">
                <label class="form-check-label">Sesak</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pernafasan" value="Lain-lain" onchange="toggleLainnya('pernafasan')">
                <label class="form-check-label">Lain-lain</label>
            </div>
        </div>
        <input type="text" class="form-control d-none" name="pernafasan_lainnya" id="pernafasan_lainnya" placeholder="Sebutkan...">
    </div>

    <!-- Penglihatan -->
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Penglihatan</label>
        <div class="d-flex flex-wrap gap-3 mb-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="penglihatan" value="Baik" checked onchange="toggleAlatBantu('penglihatan')">
                <label class="form-check-label">Baik</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="penglihatan" value="Rusak" onchange="toggleAlatBantu('penglihatan')">
                <label class="form-check-label">Rusak</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="penglihatan" value="Alat Bantu" onchange="toggleAlatBantu('penglihatan')">
                <label class="form-check-label">Alat Bantu</label>
            </div>
        </div>
        <input type="text" class="form-control d-none" name="penglihatan_alat_bantu" id="penglihatan_alat_bantu" placeholder="Jenis alat bantu...">
    </div>

    <!-- Pendengaran -->
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Pendengaran</label>
        <div class="d-flex flex-wrap gap-3 mb-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pendengaran" value="Baik" checked onchange="toggleAlatBantu('pendengaran')">
                <label class="form-check-label">Baik</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pendengaran" value="Rusak" onchange="toggleAlatBantu('pendengaran')">
                <label class="form-check-label">Rusak</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pendengaran" value="Alat Bantu" onchange="toggleAlatBantu('pendengaran')">
                <label class="form-check-label">Alat Bantu</label>
            </div>
        </div>
        <input type="text" class="form-control d-none" name="pendengaran_alat_bantu" id="pendengaran_alat_bantu" placeholder="Jenis alat bantu...">
    </div>

    <!-- Mulut -->
    <div class="col-md-6 mb-3">
        <label class="form-label fw-bold">Mulut</label>
        <div class="d-flex flex-wrap gap-3 mb-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="mulut" value="Bersih" checked onchange="toggleLainnya('mulut')">
                <label class="form-check-label">Bersih</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="mulut" value="Kotor" onchange="toggleLainnya('mulut')">
                <label class="form-check-label">Kotor</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="mulut" value="Lain-lain" onchange="toggleLainnya('mulut')">
                <label class="form-check-label">Lain-lain</label>
            </div>
        </div>
        <input type="text" class="form-control d-none" name="mulut_lainnya" id="mulut_lainnya" placeholder="Sebutkan...">
    </div>

    <!-- Reflek, Menelan, Bicara -->
    <div class="col-md-4 mb-3">
        <label class="form-label fw-bold">Reflek</label>
        <div class="d-flex flex-wrap gap-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="reflek" value="Normal" checked>
                <label class="form-check-label">Normal</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="reflek" value="Sulit">
                <label class="form-check-label">Sulit</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="reflek" value="Rusak">
                <label class="form-check-label">Rusak</label>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-bold">Menelan</label>
        <div class="d-flex flex-wrap gap-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="menelan" value="Normal" checked>
                <label class="form-check-label">Normal</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="menelan" value="Gangguan">
                <label class="form-check-label">Gangguan</label>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-bold">Bicara</label>
        <div class="d-flex flex-wrap gap-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="bicara" value="Normal" checked>
                <label class="form-check-label">Normal</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="bicara" value="Gangguan">
                <label class="form-check-label">Gangguan</label>
            </div>
        </div>
    </div>

    <!-- Luka -->
    <div class="col-md-12 mb-3">
        <label class="form-label fw-bold">Luka</label>
        <div class="d-flex gap-3 mb-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="luka" value="0" id="luka_tidak" checked onchange="toggleLuka()">
                <label class="form-check-label" for="luka_tidak">Tidak Ada</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="luka" value="1" id="luka_ya" onchange="toggleLuka()">
                <label class="form-check-label" for="luka_ya">Ada</label>
            </div>
        </div>
        <textarea class="form-control d-none" name="luka_detail" id="luka_detail_text" rows="2" placeholder="Lokasi, jenis, ukuran luka..."></textarea>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-bold">Defekasi</label>
        <div class="d-flex flex-column gap-1">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="defekasi" value="Normal" checked>
                <label class="form-check-label">Normal</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="defekasi" value="Konstipasi">
                <label class="form-check-label">Konstipasi</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="defekasi" value="Inkontinensia alvi">
                <label class="form-check-label">Inkontinensia alvi</label>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-bold">Miksi (BAK)</label>
        <div class="d-flex flex-column gap-1">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="milksi" value="Normal" checked>
                <label class="form-check-label">Normal</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="milksi" value="Retensio">
                <label class="form-check-label">Retensio</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="milksi" value="Inkontinensia uri">
                <label class="form-check-label">Inkontinensia uri</label>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label fw-bold">Gastrointestinal</label>
        <div class="d-flex flex-column gap-1">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gastrointestinal" value="Normal" checked>
                <label class="form-check-label">Normal</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gastrointestinal" value="Refluks">
                <label class="form-check-label">Refluks</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gastrointestinal" value="Nausea">
                <label class="form-check-label">Nausea</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gastrointestinal" value="Muntah">
                <label class="form-check-label">Muntah</label>
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
                <input class="form-check-input" type="radio" name="pola_tidur" value="0" id="tidur_tidak" checked onchange="togglePolaTidur()">
                <label class="form-check-label" for="tidur_tidak">Normal</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pola_tidur" value="1" id="tidur_ya" onchange="togglePolaTidur()">
                <label class="form-check-label" for="tidur_ya">Masalah</label>
            </div>
        </div>
        <input type="text" class="form-control d-none" name="pola_tidur_masalah" id="pola_tidur_text" placeholder="Jelaskan masalah pola tidur...">
    </div>

    <!-- Tombol Simpan -->
    <div class="col-12 mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Simpan
        </button>
        <button type="reset" class="btn btn-secondary">
            <i class="fa fa-undo"></i> Reset
        </button>
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
</script>