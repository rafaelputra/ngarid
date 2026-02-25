<h5 class="fw-bold text-primary mb-3"><i class="fa fa-file-lines"></i> Pemeriksaan Fisik</h5>
<hr>

<form class="row" id="form-pemeriksaan-fisik">
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
    <label class="form-label fw-bold">Tanggal Pemeriksaan</label>
    <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>">
  </div>

  <!-- Keadaan Umum -->
  <div class="col-md-6 mb-3">
    <label class="form-label fw-bold">Keadaan Umum</label>
    <select class="form-select" name="keadaan_umum">
      <option value="">-- Pilih --</option>
      <option value="Baik">Baik</option>
      <option value="Cukup">Cukup</option>
      <option value="Lemah">Lemah</option>
      <option value="Buruk">Buruk</option>
    </select>
  </div>

  <!-- Kesadaran -->
  <div class="col-md-6 mb-3">
    <label class="form-label fw-bold">Kesadaran</label>
    <select class="form-select" name="kesadaran">
      <option value="">-- Pilih --</option>
      <option value="Compos Mentis">Compos Mentis</option>
      <option value="Apatis">Apatis</option>
      <option value="Somnolen">Somnolen</option>
      <option value="Stupor">Stupor</option>
      <option value="Koma">Koma</option>
    </select>
  </div>

  <!-- Tanda Vital -->
  <div class="col-12 mb-2">
    <label class="form-label fw-bold text-primary">Tanda-Tanda Vital</label>
  </div>

  <div class="col-md-3 mb-3">
    <label class="form-label fw-bold">Sistol (mmHg)</label>
    <input type="number" class="form-control" name="sistol" placeholder="120">
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label fw-bold">Diastol (mmHg)</label>
    <input type="number" class="form-control" name="diastol" placeholder="80">
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label fw-bold">MAP</label>
    <input type="number" class="form-control" name="map" placeholder="93" step="0.1">
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label fw-bold">Suhu (&deg;C)</label>
    <input type="number" class="form-control" name="suhu" placeholder="36.5" step="0.1">
  </div>

  <div class="col-md-3 mb-3">
    <label class="form-label fw-bold">Nadi (x/mnt)</label>
    <input type="number" class="form-control" name="nadi" placeholder="80">
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label fw-bold">RR (x/mnt)</label>
    <input type="number" class="form-control" name="rr" placeholder="20">
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label fw-bold">SpO2 (%)</label>
    <input type="number" class="form-control" name="spo2" placeholder="98">
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label fw-bold">BB (Kg)</label>
    <input type="number" class="form-control" name="bb" placeholder="65" step="0.1">
  </div>

  <!-- BB Kering -->
  <div class="col-md-4 mb-3">
    <label class="form-label fw-bold">BB Kering (Kg)</label>
    <input type="number" class="form-control" name="bb_kering" placeholder="62" step="0.1">
  </div>
  <div class="col-md-4 mb-3">
    <label class="form-label fw-bold">UF Goal (ml)</label>
    <input type="number" class="form-control" name="uf_goal" placeholder="3000">
  </div>
  <div class="col-md-4 mb-3">
    <label class="form-label fw-bold">TB (cm)</label>
    <input type="number" class="form-control" name="tb" placeholder="170">
  </div>

  <!-- Pemeriksaan Kepala -->
  <div class="col-12 mb-2 mt-2">
    <label class="form-label fw-bold text-primary">Pemeriksaan Fisik Per Sistem</label>
  </div>

  <div class="col-md-6 mb-3">
    <label class="form-label fw-bold">Kepala</label>
    <div class="d-flex flex-wrap gap-3">
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="kepala[]" value="Normal">
        <label class="form-check-label form-check-label-md">Normal</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="kepala[]" value="Anemis">
        <label class="form-check-label form-check-label-md">Anemis</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="kepala[]" value="Ikterik">
        <label class="form-check-label form-check-label-md">Ikterik</label>
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-3">
    <label class="form-label fw-bold">Leher</label>
    <div class="d-flex flex-wrap gap-3">
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="leher[]" value="Normal">
        <label class="form-check-label form-check-label-md">Normal</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="leher[]" value="JVP Meningkat">
        <label class="form-check-label form-check-label-md">JVP Meningkat</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="leher[]" value="Pembesaran KGB">
        <label class="form-check-label form-check-label-md">Pembesaran KGB</label>
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-3">
    <label class="form-label fw-bold">Dada/Thorax</label>
    <div class="d-flex flex-wrap gap-3">
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="dada[]" value="Normal">
        <label class="form-check-label form-check-label-md">Normal</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="dada[]" value="Ronkhi">
        <label class="form-check-label form-check-label-md">Ronkhi</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="dada[]" value="Wheezing">
        <label class="form-check-label form-check-label-md">Wheezing</label>
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-3">
    <label class="form-label fw-bold">Abdomen</label>
    <div class="d-flex flex-wrap gap-3">
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="abdomen[]" value="Normal">
        <label class="form-check-label form-check-label-md">Normal</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="abdomen[]" value="Nyeri Tekan">
        <label class="form-check-label form-check-label-md">Nyeri Tekan</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="abdomen[]" value="Distensi">
        <label class="form-check-label form-check-label-md">Distensi</label>
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-3">
    <label class="form-label fw-bold">Ekstremitas</label>
    <div class="d-flex flex-wrap gap-3">
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="ekstremitas[]" value="Normal">
        <label class="form-check-label form-check-label-md">Normal</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="ekstremitas[]" value="Edema">
        <label class="form-check-label form-check-label-md">Edema</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="checkbox" name="ekstremitas[]" value="Sianosis">
        <label class="form-check-label form-check-label-md">Sianosis</label>
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-3">
    <label class="form-label fw-bold">Akses Vaskuler</label>
    <select class="form-select" name="akses_vaskuler">
      <option value="">-- Pilih --</option>
      <option value="AV Fistula">AV Fistula</option>
      <option value="AV Graft">AV Graft</option>
      <option value="CDL">CDL (Catheter Double Lumen)</option>
      <option value="Femoral">Femoral</option>
    </select>
  </div>

  <!-- Keterangan Tambahan -->
  <div class="col-md-12 mb-3">
    <label class="form-label fw-bold">Keterangan Tambahan</label>
    <textarea class="form-control" name="keterangan" rows="3" placeholder="Catatan pemeriksaan fisik lainnya..."></textarea>
  </div>

  <!-- Tombol -->
  <div class="col-12 mt-3">
    <button type="button" class="btn btn-primary" onclick="alert('Demo: Data berhasil disimpan!')">
      <i class="fa fa-save"></i> Simpan
    </button>
    <button type="reset" class="btn btn-secondary">
      <i class="fa fa-undo"></i> Reset
    </button>
  </div>
</form>
