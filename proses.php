<?php include 'navbar.php'; ?>
<div class="container mt-5">
  <h2>Proses Clustering</h2>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kriteria = $_POST['kriteria'] ?? [];
    $jumlah_cluster = (int) $_POST['jumlah_cluster'];

    if (count($kriteria) < 1) {
      echo "<div class='alert alert-danger'>Pilih minimal 1 kriteria!</div>";
    } else {
      // Simpan kriteria yang dipilih
      file_put_contents('kriteria.json', json_encode($kriteria));

      // Jalankan kmeans.py (pastikan Python bisa akses kriteria.json)
      $cmd = "python kmeans.py uploads/data.csv hasil.csv $jumlah_cluster 2>&1";
      $output = shell_exec($cmd);
      echo "<pre>$output</pre>";
      echo "<div class='alert alert-success'>Clustering selesai. <a href='cluster_result.php'>Lihat hasil per cluster</a></div>";
    }
  }
  ?>

  <form method="POST" class="row g-3 mt-4">
    <div class="col-md-4">
      <label class="form-label">Pilih Kriteria:</label><br>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="kriteria[]" value="bb" id="k_bb" checked>
        <label class="form-check-label" for="k_bb">Berat Badan</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="kriteria[]" value="tb" id="k_tb" checked>
        <label class="form-check-label" for="k_tb">Tinggi Badan</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="kriteria[]" value="umur" id="k_umur" checked>
        <label class="form-check-label" for="k_umur">Umur</label>
      </div>
    </div>

    <div class="col-md-3">
      <label class="form-label">Jumlah Cluster</label>
      <input type="number" name="jumlah_cluster" class="form-control" min="2" max="10" value="3" required>
    </div>

    <div class="col-md-3 align-self-end">
      <button type="submit" class="btn btn-primary">Proses Clustering</button>
    </div>
  </form>
</div>

