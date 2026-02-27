<style>
  #form-skala-nyeri {
    font-size: 1rem;
  }

  #form-skala-nyeri .form-label {
    font-size: 1rem;
    margin-bottom: .25rem;
  }

  #form-skala-nyeri .form-check-label,
  #form-skala-nyeri .form-check-label-md {
    font-size: 1rem;
  }

  #form-skala-nyeri .form-control,
  #form-skala-nyeri .form-select {
    font-size: 1rem;
  }

  .nyeri-title {
    font-size: 1.3rem;
  }
</style>

<h5 class="fw-bold text-primary mb-3 nyeri-title"><i class="fa fa-file-lines"></i> Pengkajian Skala Nyeri Wong Baker</h5>
<hr>

<form class="row" id="form-skala-nyeri">
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

  <div class="col-md-3 mb-3">
    <label class="form-label fw-bold">Tanggal</label>
    <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>">
  </div>

  <div class="col-md-3 mb-3">
    <label class="form-label fw-bold">Jam</label>
    <input type="time" class="form-control" name="jam" value="<?= date('H:i') ?>">
  </div>

  <!-- Kriteria Nyeri -->
  <div class="col-md-12 mb-3">
    <label class="form-label fw-bold">Kriteria Nyeri</label>
    <div class="d-flex flex-wrap gap-3">
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="radio" name="kriteria" value="Akut" checked>
        <label class="form-check-label form-check-label-md">Akut</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="radio" name="kriteria" value="Kronik">
        <label class="form-check-label form-check-label-md">Kronik</label>
      </div>
    </div>
  </div>

  <!-- Skala Wong Baker -->
  <div class="col-md-12 mb-3">
    <label class="form-label fw-bold">Skala Nyeri Wong Baker (0-10)</label>
    <div class="d-flex flex-wrap gap-2 mt-2 justify-content-between">
      <?php
      $faces = [
        0 => ['label' => 'Tidak Nyeri', 'emoji' => '😊', 'color' => '#4CAF50'],
        2 => ['label' => 'Sedikit Nyeri', 'emoji' => '🙂', 'color' => '#8BC34A'],
        4 => ['label' => 'Agak Nyeri', 'emoji' => '😐', 'color' => '#FFEB3B'],
        6 => ['label' => 'Lebih Nyeri', 'emoji' => '🙁', 'color' => '#FF9800'],
        8 => ['label' => 'Sangat Nyeri', 'emoji' => '😢', 'color' => '#FF5722'],
        10 => ['label' => 'Nyeri Terberat', 'emoji' => '😭', 'color' => '#F44336'],
      ];
      foreach ($faces as $val => $face): ?>
        <div class="text-center">
          <label class="d-flex flex-column align-items-center cursor-pointer" style="cursor:pointer;">
            <span style="font-size: 3rem;"><?= $face['emoji'] ?></span>
            <input type="radio" name="skala_poin" value="<?= $val ?>" class="form-check-input mt-1" onchange="updateSkalaLabel(this)">
            <small class="mt-1" style="color: <?= $face['color'] ?>; font-weight: bold;"><?= $val ?></small>
            <small class="text-muted" style="font-size: 0.85rem;"><?= $face['label'] ?></small>
          </label>
        </div>
      <?php endforeach; ?>
    </div>
    <input type="hidden" name="skala_nyeri" id="skala_nyeri_val" value="">
  </div>

  <!-- Jenis Nyeri -->
  <div class="col-md-6 mb-3">
    <label class="form-label fw-bold">Jenis Nyeri</label>
    <select class="form-select" name="nyeri">
      <option value="">-- Pilih --</option>
      <option value="Tidak Ada Nyeri">Tidak Ada Nyeri</option>
      <option value="Nyeri Akut">Nyeri Akut</option>
      <option value="Nyeri Kronik">Nyeri Kronik</option>
      <option value="Nyeri Neuropatik">Nyeri Neuropatik</option>
      <option value="Lainnya">Lainnya</option>
    </select>
  </div>

  <!-- Lokasi Nyeri -->
  <div class="col-md-6 mb-3">
    <label class="form-label fw-bold">Lokasi Nyeri</label>
    <input type="text" class="form-control" name="lokasi_nyeri" placeholder="Contoh: Lengan kiri, Punggung">
  </div>

  <!-- Menjalar -->
  <div class="col-md-6 mb-3">
    <label class="form-label fw-bold">Menjalar</label>
    <div class="d-flex gap-3 align-items-center">
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="radio" name="menjalar" value="Tidak">
        <label class="form-check-label form-check-label-md">Tidak</label>
      </div>
      <div class="form-check form-check-custom">
        <input class="form-check-input form-check-input-md" type="radio" name="menjalar" value="Ya">
        <label class="form-check-label form-check-label-md">Ya</label>
      </div>
    </div>
    <input type="text" class="form-control mt-2" name="menjalar_ket" placeholder="Ke mana?">
  </div>

  <!-- Lama & Durasi -->
  <div class="col-md-3 mb-3">
    <label class="form-label fw-bold">Lama Nyeri</label>
    <input type="text" class="form-control" name="lama_nyeri" placeholder="Contoh: 2 jam">
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label fw-bold">Durasi Nyeri</label>
    <select class="form-select" name="durasi_nyeri">
      <option value="">-- Pilih --</option>
      <option value="Terus menerus">Terus menerus</option>
      <option value="Hilang timbul">Hilang timbul</option>
      <option value="Sesaat">Sesaat</option>
    </select>
  </div>

  <!-- Faktor -->
  <div class="col-md-6 mb-3">
    <label class="form-label fw-bold">Faktor yang Memperberat</label>
    <textarea class="form-control" name="faktor_memperberat" rows="2" placeholder="Aktivitas, gerakan, dll..."></textarea>
  </div>
  <div class="col-md-6 mb-3">
    <label class="form-label fw-bold">Faktor yang Memperingan</label>
    <textarea class="form-control" name="faktor_memperingan" rows="2" placeholder="Istirahat, obat, dll..."></textarea>
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

<script>
  function updateSkalaLabel(el) {
    document.getElementById('skala_nyeri_val').value = el.value;
  }
</script>