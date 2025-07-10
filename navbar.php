<?php // navbar.php ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body {
  background-color: #f8f9fa;
}
.sidebar {
  width: 250px;
  position: fixed;
  height: 100vh;
  background: linear-gradient(to bottom right, #0f9b8e, #43cea2);
  padding-top: 20px;
  color: white;
}
.sidebar a {
  padding: 15px 30px;
  display: block;
  color: white;
  text-decoration: none;
  font-weight: 500;
}
.sidebar a:hover, .sidebar a.active {
  background-color: rgba(255,255,255,0.1);
  border-left: 5px solid #fff;
}
.main {
  margin-left: 250px;
  padding: 30px;
}
.card-menu {
  transition: all 0.3s;
  border: none;
  color: white;
  cursor: pointer;
}
.card-menu:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
.card-orange { background-color: #fd7e14; }
.card-green { background-color: #28a745; }
.card-red { background-color: #dc3545; }
.card-purple { background-color: #6f42c1; }
</style>
<div class="sidebar">
  <div class="d-flex flex-column p-3 text-white bg-gradient" style="width: 250px; min-height: 100vh; background: linear-gradient(to bottom, #009688, #26a69a);">
  <!-- Logo -->
  <div class="text-center mb-4">
    <img src="assets/logo.png" alt="Logo Gizi Balita" width="80" class="rounded-circle">
    <h4 class="mt-2">K-MEANS</h4>
  </div>
   <!-- Menu -->
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="index.php" class="nav-link text-white"><i class="fas fa-home me-2"></i> Dashboard</a>
    </li>
    <li>
      <a href="upload.php" class="nav-link text-white"><i class="fas fa-upload me-2"></i> Upload CSV</a>
    </li>
    <li>
      <a href="proses.php" class="nav-link text-white"><i class="fas fa-cogs me-2"></i> Proses</a>
    </li>
    <li>
      <a href="elbow.php" class="nav-link text-white"><i class="fas fa-chart-line me-2"></i> Elbow Method</a>
    </li>
    <li>
      <a href="cluster_result.php" class="nav-link text-white"><i class="fas fa-layer-group me-2"></i> Hasil Clustering</a>
    </li>
    <li>
      <a href="evaluasi.php" class="nav-link text-white"><i class="fas fa-check-circle me-2"></i> Evaluasi</a>
    </li>
    <li>
      <a href="reset.php" class="nav-link text-white"><i class="fas fa-redo me-2"></i> Reset</a>
    </li>
  </ul>
</div>

  
</div>
<div class="main">