<h5 class="fw-bold text-primary mb-3"><i class="fa fa-file-lines"></i> Asesmen Keperawatan</h5>
<hr>

<form class="row" id="form-asesmen-keperawatan">
  <input type="hidden" name="no_rawat" value="<?= $no_rawat; ?>">

  <!-- Perawat -->
  <div class="col-md-6 mb-3">
    <label class="form-label fw-bold">Perawat / Pengkaji</label>
    <select class="form-select" name="nip">
      <option value="">-- Pilih Perawat --</option>
      <?php foreach ($petugas as $p): ?>
        <option value="<?= $p->nip ?>"><?= $p->nama ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="col-md-6 mb-3">
    <label class="form-label fw-bold">Tanggal Pengkajian</label>
    <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>">
  </div>

  <!-- Sumber Data -->
  <div class="col-md-12 mb-3">
    <label class="form-label fw-bold">Sumber Data</label>
    <div class="d-flex flex-wrap gap-3">
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="sumber_data[]" value="Pasien">
        <label class="form-check-label form-check-label-md">Pasien</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="sumber_data[]" value="Keluarga">
        <label class="form-check-label form-check-label-md">Keluarga</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="sumber_data[]" value="Rekam Medis">
        <label class="form-check-label form-check-label-md">Rekam Medis</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="sumber_data[]" value="Lainnya">
        <label class="form-check-label form-check-label-md">Lainnya</label>
      </div>
    </div>
  </div>

  <!-- Riwayat Penyakit Sekarang -->
  <div class="col-md-12 mb-3">
    <label class="form-label fw-bold">Riwayat Penyakit Sekarang</label>
    <textarea class="form-control" name="riwayat_sekarang" rows="3" placeholder="Keluhan utama, onset, durasi..."></textarea>
  </div>

  <!-- Riwayat Penyakit Dahulu -->
  <div class="col-md-12 mb-3">
    <label class="form-label fw-bold">Riwayat Penyakit Dahulu</label>
    <textarea class="form-control" name="riwayat_dahulu" rows="3" placeholder="Penyakit sebelumnya, riwayat operasi, dll..."></textarea>
  </div>

  <!-- Riwayat Hemodialisa -->
  <div class="col-md-6 mb-3">
    <label class="form-label fw-bold">HD ke-</label>
    <input type="number" class="form-control" name="hd_ke" placeholder="Contoh: 5">
  </div>
  <div class="col-md-6 mb-3">
    <label class="form-label fw-bold">Lama HD (jam)</label>
    <input type="number" class="form-control" name="lama_hd" placeholder="Contoh: 4" step="0.5">
  </div>

  <!-- Riwayat Alergi -->
  <div class="col-md-12 mb-3">
    <label class="form-label fw-bold">Riwayat Alergi</label>
    <div class="d-flex flex-wrap gap-3 mb-2">
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="radio" name="alergi" value="Tidak Ada">
        <label class="form-check-label form-check-label-md">Tidak Ada</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="radio" name="alergi" value="Obat">
        <label class="form-check-label form-check-label-md">Obat</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="radio" name="alergi" value="Makanan">
        <label class="form-check-label form-check-label-md">Makanan</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="radio" name="alergi" value="Lainnya">
        <label class="form-check-label form-check-label-md">Lainnya</label>
      </div>
    </div>
    <input type="text" class="form-control" name="alergi_keterangan" placeholder="Sebutkan alergi...">
  </div>

  <!-- Keluhan Saat Ini -->
  <div class="col-md-12 mb-3">
    <label class="form-label fw-bold">Keluhan Saat Ini</label>
    <div class="d-flex flex-wrap gap-3">
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="keluhan[]" value="Sesak nafas">
        <label class="form-check-label form-check-label-md">Sesak nafas</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="keluhan[]" value="Mual/Muntah">
        <label class="form-check-label form-check-label-md">Mual/Muntah</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="keluhan[]" value="Pusing">
        <label class="form-check-label form-check-label-md">Pusing</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="keluhan[]" value="Bengkak">
        <label class="form-check-label form-check-label-md">Bengkak</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="keluhan[]" value="Lemas">
        <label class="form-check-label form-check-label-md">Lemas</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="keluhan[]" value="Nyeri">
        <label class="form-check-label form-check-label-md">Nyeri</label>
      </div>
    </div>
  </div>

  <!-- Tombol Simpan -->
  <div class="col-12 mt-3">
    <button type="button" class="btn btn-primary" onclick="alert('Demo: Data berhasil disimpan!')">
      <i class="fa fa-save"></i> Simpan
    </button>
    <button type="reset" class="btn btn-secondary">
      <i class="fa fa-undo"></i> Reset
    </button>
  </div>
</form>
