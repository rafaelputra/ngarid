<style type="text/css">
    .range-label {
        display: grid;
        grid-template-columns: repeat(10, 1fr);
    }

    .range-label span {
        text-align: right;
    }

    .input-text-extra {
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 1px solid grey;
        width: 100%;
    }

    td.text-top {
        vertical-align: top;
    }

    td.data::before {
        content: ':';
        position: absolute;
        top: 50%;
        left: -2px;
        transform: translateY(-50%);
    }

    .w120 {
        min-width: 120px;
    }

    .w200 {
        min-width: 200px;
    }

    .w300 {
        min-width: 300px;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-5-theme/1.3.0/select2-bootstrap-5-theme.min.css"
    integrity="sha512-z/90a5SWiu4MWVelb5+ny7sAayYUfMmdXKEAbpj27PfdkamNdyI3hcjxPxkOPbrXoKIm7r9V2mElt5f1OtVhqA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="xs-pd-20 pd-20">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h3>Asesmen Keperawatan Rawat Inap Dewasa</h3>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Asesmen Keperawatan Rawat Inap Dewasa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="pd-20 card-box">
                <table>
                    <thead>
                        <tr>
                            <th>IDENTITAS PASIEN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>No. Rawat</td>
                            <td>: <?= $pasien->no_rawat; ?></td>
                        </tr>
                        <tr>
                            <td>No. RM</td>
                            <td>: <?= $pasien->no_rkm_medis; ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: <?= $pasien->nm_pasien; ?></td>
                        </tr>
                        <tr>
                            <td>TTL</td>
                            <td>: <?= $pasien->tmp_lahir; ?>, <?= $pasien->tgl_lahir; ?></td>
                        </tr>
                        <tr>
                            <td>Jk</td>
                            <td>: <?= $pasien->jk; ?></td>
                        </tr>
                        <tr>
                            <td>Usia daftar</td>
                            <td>: <?= $pasien->umurdaftar; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-3 col-12">
            <div class="card-box p-2">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    <a class="nav-link text-dark text-start p-2 m-1 border asesment-button active" href="#"
                        onclick="return openContent(this,'<?= base_url(); ?>AsesmenRD/form_penilaian_fisik?no_rwt=<?= $no_rawat; ?>');">
                        <i class="fa fa-file-lines"></i> Penilaian Fisik</a>
                    <a class="nav-link text-dark text-start p-2 m-1 border asesment-button" href="#"
                        onclick="return openContent(this,'<?= base_url(); ?>AsesmenRD/form_skala_nyeri_wong_baker?no_rwt=<?= $no_rawat; ?>');">
                        <i class="fa fa-file-lines"></i> Pengkajian Nyeri</a>
                    <a class="nav-link text-dark text-start p-2 m-1 border asesment-button" href="#"
                        onclick="return openContent(this,'<?= base_url(); ?>AsesmenRD/form_pemeriksaan_fisik?no_rwt=<?= $no_rawat; ?>');">
                        <i class="fa fa-file-lines"></i> Pemeriksaan Fisik</a>
                    <a class="nav-link text-dark text-start p-2 m-1 border asesment-button" href="#"
                        onclick="return openContent(this,'<?= base_url(); ?>AsesmenRD/form_risiko_jatuh?no_rwt=<?= $no_rawat; ?>');">
                        <i class="fa fa-file-lines"></i> Pengkajian Risiko Jatuh</a>
                    <a class="nav-link text-dark text-start p-2 m-1 border asesment-button" href="#"
                        onclick="return openContent(this,'<?= base_url(); ?>AsesmenRD/form_pemeriksaan_penunjang?no_rwt=<?= $no_rawat; ?>');">
                        <i class="fa fa-file-lines"></i> Pemeriksaan Penunjang</a>
                    <a class="nav-link text-dark text-start p-2 m-1 border asesment-button" href="#"
                        onclick="return openContent(this,'<?= base_url(); ?>AsesmenRD/form_status_gizi?no_rwt=<?= $no_rawat; ?>');">
                        <i class="fa fa-file-lines"></i> Pengkajian status gizi</a>
                    <a class="nav-link text-dark text-start p-2 m-1 border asesment-button" href="#"
                        onclick="return openContent(this,'<?= base_url(); ?>AsesmenRD/form_psikososial?no_rwt=<?= $no_rawat; ?>');">
                        <i class="fa fa-file-lines"></i> Riwayat Psikososial</a>
                    <a class="nav-link text-dark text-start p-2 m-1 border asesment-button" href="#"
                        onclick="return openContent(this,'<?= base_url(); ?>AsesmenRD/form_asuhan_keperawatan?no_rwt=<?= $no_rawat; ?>');">
                        <i class="fa fa-file-lines"></i> Asuhan keperawatan</a>
                    <a class="nav-link text-dark text-start p-2 m-1 border asesment-button" href="#"
                        onclick="return openContent(this,'<?= base_url(); ?>AsesmenRD/form_kebutuhan_komunikasi_dan_edukasi?no_rwt=<?= $no_rawat; ?>');">
                        <i class="fa fa-file-lines"></i> Kebutuhan komunikasi dan edukasi</a>
                    <a class="nav-link text-dark text-start p-2 m-1 border asesment-button" href="#"
                        onclick="return openContent(this,'<?= base_url(); ?>AsesmenRD/form_evaluasi_meninggalkan_ruang?no_rwt=<?= $no_rawat; ?>');">
                        <i class="fa fa-file-lines"></i> Evaluasi sebelum meninggalkan ruang</a>
                    <a class="nav-link text-dark text-start p-2 m-1 border asesment-button" href="#"
                        onclick="return openContent(this,'<?= base_url(); ?>AsesmenRD/form_tindak_lanjut_dan_pemulangan?no_rwt=<?= $no_rawat; ?>');">
                        <i class="fa fa-file-lines"></i> Tindak lanjut dan rencana Pemulangan</a>
                </div>
            </div>
            <div class="card-box p-2 mt-2">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    <a class="nav-link btn btn-outline-primary text-dark text-start p-2 m-1 border asesment-button" href="#"
                        onclick="return openContent(this,'');">
                        <i class="icon-copy fa fa-file pr-2"></i> Lihat berkas</a>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-12">
            <div class="card-box p-3 position-relative" style="min-height: 500px;" id="content-area">

                <div id="loader"
                    class="d-none position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center bg-white"
                    style="z-index: 1000; opacity: 0.8; border-radius: 10px;">
                    <div class="spinner-border text-primary"></div>
                    <span class="mt-2 fw-bold text-primary">Memuat Form...</span>
                </div>

                <div id="form-container">
                </div>

            </div>
        </div>

    </div>


</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function() {
        openContent(false, '<?= base_url(); ?>AsesmenRD/form_penilaian_fisik?no_rwt=<?= $no_rawat; ?>');
        $('.select2').select2();
    });

    function openContent(e, url) {
        if (!url) return false;

        Swal.fire({
            title: 'Loading',
            text: 'Memuat form...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        if (e) {
            document.querySelectorAll('.asesment-button').forEach(item => item.classList.remove('active'));
            e.classList.add('active');
        }

        $.get(url).done(function(x) {
            $('#form-container').html(x);
            $('.select2').select2({
                theme: 'bootstrap-5'
            });
            Swal.close();
        }).fail(function() {
            Swal.fire('Error', 'Gagal memuat form, silakan refresh halaman.', 'error');
        });
        return false;
    }

    $(document).on('submit', '#form-assesment-global', function(e) {
        e.preventDefault();
        const form = $(this);
        const url = form.attr('action');
        const refreshUrl = form.attr('data-refresh-url');

        Swal.fire({
            title: 'Simpan Data?',
            text: "Pastikan data sudah benar",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Ya, Simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses...',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: url,
                    type: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json'
                }).done(function(response) {
                    if (response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            timer: 1500,
                            showConfirmButton: false
                        });

                        let refreshUrl = url.replace('simpan_', 'form_') + '?no_rwt=<?= $no_rawat; ?>';
                        openContent(false, refreshUrl);
                    } else {
                        Swal.fire('Gagal', response.message || 'Cek kembali isian Anda', 'error');
                    }
                }).fail(function() {
                    Swal.fire('Error', 'Gagal terhubung ke server.', 'error');
                });
            }
        });
    });
</script>