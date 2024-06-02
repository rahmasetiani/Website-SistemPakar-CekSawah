<?php
include "lib/koneksi.php";

$kdgejala = isset($_GET['kode']) ? $_GET['kode'] : '';

if ($kdgejala) {
    $data = mysqli_query($konek, "SELECT * FROM tblgejala WHERE kd_gejala='$kdgejala'");
    $hasil = mysqli_fetch_array($data);
    $nmgejala = isset($_POST['nm_gejala']) ? $_POST['nm_gejala'] : $hasil['nm_gejala'];
}

if (isset($_POST['btnsimpan'])) {
    $kdgejala = $_POST['kd_gejala'];
    $nmgejala = $_POST['nm_gejala'];
    $txtlama = $_POST['txtlama'];

    $pesanerror = array();
    if (trim($nmgejala) == "") {
        $pesanerror[] = "Nama Gejala Wajib Diisi";
    }

    $ceksql = mysqli_query($konek, "SELECT * FROM tblgejala WHERE nm_gejala='$nmgejala' AND NOT(nm_gejala='$txtlama')");
    if (mysqli_num_rows($ceksql) >= 1) {
        $pesanerror[] = "Nama Gejala Sudah Ada"; 
    }

    if (count($pesanerror) >= 1) {
        echo "<div class='container mt-3'><div class='alert alert-danger'>";
        foreach ($pesanerror as $index => $isi_pesan) {
            echo "<p>$isi_pesan</p>";
        }
        echo "</div></div>";
    } else {
        $update = mysqli_query($konek, "UPDATE tblgejala SET nm_gejala='$nmgejala' WHERE kd_gejala='$kdgejala'");
        if ($update) {
            echo "<meta http-equiv='refresh' content='0; url=?open=Gejala-Data'>";
        }
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Data Gejala</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container d-flex justify-content-center">
  <div class="col-lg-8">
    <center><h2>Ubah Data Gejala</h2></center>
    <hr>

    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
      <div class="form-group">
        <label for="kd_gejala">Kode Gejala</label>
        <input type="text" class="form-control" id="kd_gejala" name="kd_gejala" value="<?php echo $hasil['kd_gejala']; ?>" readonly="readonly" />
      </div>
      <div class="form-group">
        <label for="nm_gejala">Nama Gejala</label>
        <input type="text" class="form-control" id="nm_gejala" name="nm_gejala" maxlength="100" value="<?php echo $nmgejala; ?>" autofocus>
        <input type="hidden" name="txtlama" value="<?php echo $hasil['nm_gejala']; ?>" />
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary" name="btnsimpan">Ubah</button>
      </div>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
