<?php include 'navbar.php'; ?>
<div class="container mt-5">
  <h2>Hasil Analisa dan Clustering</h2>

  <div class="row mt-4">
    <div class="col-md-6">
      <canvas id="pieChart" width="400" height="400"></canvas>
    </div>
    <div class="col-md-6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Cluster</th>
            <th>Jumlah</th>
            <th>Data</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $summary = array();
          if (($handle = fopen("cluster_summary.csv", "r")) !== FALSE) {
              $first = true;
              while (($data = fgetcsv($handle)) !== FALSE) {
                  if ($first) { $first = false; continue; }
                  $cluster = $data[0];
                  $jumlah = $data[1];
                  $summary[] = $jumlah;
                  echo "<tr>
                          <td>$cluster</td>
                          <td>$jumlah</td>
                          <td><a href='cluster_detail.php?cluster=$cluster' class='btn btn-primary'>Tampilkan</a></td>
                        </tr>";
              }
              fclose($handle);
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Cluster 0', 'Cluster 1', 'Cluster 2'],
        datasets: [{
          data: <?php echo json_encode($summary); ?>,
          backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56']
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: 'top' },
          title: { display: true, text: 'Jumlah dan Jenis Cluster' }
        }
      }
    });
  </script>
</div>
