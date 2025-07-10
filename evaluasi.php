<?php include 'navbar.php'; ?>
<div class="container mt-5">
  <h2>Evaluasi Hasil Clustering</h2>

  <?php
  $inertia = file_exists('inertia.txt') ? file_get_contents('inertia.txt') : 'Tidak tersedia';
  $silhouette = file_exists('silhouette.txt') ? file_get_contents('silhouette.txt') : 'Tidak tersedia';
  ?>

  <div class="card mt-4">
    <div class="card-body">
      <h5 class="card-title">Inertia (Within-Cluster Sum of Squares)</h5>
      <p class="card-text"><?= $inertia ?></p>
    </div>
  </div>

  <div class="card mt-4">
    <div class="card-body">
      <h5 class="card-title">Silhouette Score</h5>
      <p class="card-text"><?= $silhouette ?></p>
    </div>
  </div>

  <div class="alert alert-info mt-4">
    <strong>Catatan:</strong><br>
    - Nilai inertia yang lebih kecil menunjukkan klaster yang lebih padat.<br>
    - Nilai silhouette antara -1 dan 1. Semakin mendekati 1 → klaster semakin baik.
  </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
