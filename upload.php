<?php include 'navbar.php'; ?>
<div class="container mt-5">
  <h2>Upload Data CSV</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="csvFile">Pilih file CSV:</label>
      <input type="file" class="form-control" name="csvFile" required>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Upload</button>
  </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["csvFile"])) {
  $fileTmpPath = $_FILES["csvFile"]["tmp_name"];
  $destination = "uploads/data.csv";
  if (move_uploaded_file($fileTmpPath, $destination)) {
    echo "<div class='alert alert-success mt-3'>File berhasil diupload!</div>";
  } else {
    echo "<div class='alert alert-danger mt-3'>Gagal mengupload file.</div>";
  }
}
?>
