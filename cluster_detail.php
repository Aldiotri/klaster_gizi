<?php include 'navbar.php'; ?>

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-3 sticky-top bg-white pt-3 pb-2" style="z-index: 1000; border-bottom: 1px solid #dee2e6;">
    <h2 class="mb-0">Hasil Lengkap Clustering</h2>
    <a href="cluster_result.php" class="btn btn-outline-primary">← Kembali ke Hasil Cluster</a>
  </div>

  <?php
  $cluster_data = [];

  if (($handle = fopen("hasil.csv", "r")) !== FALSE) {
    $first = true;
    $headers = [];

    while (($data = fgetcsv($handle)) !== FALSE) {
      if ($first) {
        $headers = $data;
        $first = false;
      } else {
        $cluster_idx = array_search("Cluster", $headers);
        $cluster = $data[$cluster_idx];
        $cluster_data[$cluster][] = $data;
      }
    }
    fclose($handle);
  }
  ?>

  <ul class="nav nav-tabs mt-4" role="tablist">
    <?php foreach ($cluster_data as $key => $rows): ?>
      <li class="nav-item">
        <a class="nav-link <?= $key == 0 ? 'active' : '' ?>" data-bs-toggle="tab" href="#cluster<?= $key ?>">Cluster <?= $key ?> (<?= count($rows) ?> data)</a>
      </li>
    <?php endforeach; ?>
  </ul>

  <div class="tab-content mt-3">
    <?php foreach ($cluster_data as $key => $rows): ?>
      <div class="tab-pane fade <?= $key == 0 ? 'show active' : '' ?>" id="cluster<?= $key ?>">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <?php foreach ($headers as $h) echo "<th>$h</th>"; ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $r): ?>
              <tr>
                <?php foreach ($r as $val) echo "<td>$val</td>"; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
