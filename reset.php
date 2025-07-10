<?php include 'navbar.php'; ?>
<div class="container mt-5">
  <h2>Reset Sistem Clustering</h2>

  <?php
  if (isset($_POST['reset'])) {
    $files_to_delete = [
      "hasil.csv",
      "cluster.json",
      "cluster_summary.csv"
    ];

    $deleted = [];
    foreach ($files_to_delete as $file) {
      if (file_exists($file)) {
        unlink($file);
        $deleted[] = $file;
      }
    }

    echo "<div class='alert alert-success'>File berikut berhasil dihapus: <strong>" . implode(', ', $deleted) . "</strong></div>";
  } else {
    echo "<div class='alert alert-warning'>Klik tombol di bawah ini untuk mereset sistem. Ini akan menghapus file hasil clustering seperti <code>hasil.csv</code>, <code>cluster.json</code>, dan <code>cluster_summary.png</code>.</div>";
  }
  ?>

  <form method="POST" onsubmit="return confirm('Yakin ingin mereset semua data clustering?')">
    <button name="reset" class="btn btn-danger">Reset Sekarang</button>
  </form>
</div>
