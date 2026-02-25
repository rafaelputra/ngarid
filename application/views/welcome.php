<div class="xs-pd-20 pd-20">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h2>Data Kunjungan Pasien</h2>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Kunjungan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="pd-20 card-box">
                <div class="table-responsive">
                    <table id="tbl-kunjungan" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No. RM</th>
                                <th>Nama</th>
                                <th>No. Rawat</th>
                                <th>Tgl Lahir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($kunjungan as $k): ?>
                                <tr>
                                    <td><?= $k->no_rkm_medis; ?></td>
                                    <td><?= $k->nm_pasien; ?></td>
                                    <td><?= $k->no_rawat; ?></td>
                                    <td><?= $k->tgl_lahir; ?></td>
                                    <td>
                                        <a href="<?= base_url(); ?>AsesmenRD?no_rwt=<?= $k->no_rawat; ?>"
                                            class="btn btn-sm btn-primary">
                                            <i class="fa fa-file-lines"></i> AskepRID
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tbl-kunjungan').DataTable({
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data",
                zeroRecords: "Data tidak ditemukan",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }
        });
    });
</script>