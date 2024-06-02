<?php
  include "lib/koneksi.php";
  
  if (isset($_GET['status'])) {
    $query = mysqli_query($konek, "SELECT MAX(kd_gejala) AS maxkode FROM tblgejala");
    $hasil = mysqli_fetch_array($query);
    $kode  = $hasil['maxkode'];

    $kode2 = (int) substr($kode, 1, 2);
    $kode2++;

    $kode3 = 'G'.sprintf("%02s", $kode2);
  }
 ?>

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Gejala</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>


<div class="container d-flex justify-content-center">
    <div class="col-lg-10">
      <h2 class="text-center mt-5">Tambah Data Gejala</h2>
      <hr>
      <?php

  //validasi 
   
   if (isset($_POST['btnsimpan'])) {
   	$kdgejala = $_POST['kd_gejala'];
   	$nmgejala = $_POST['nm_gejala'];

   	$pesanerror =  array ();

   	if (trim($nmgejala=="")) {
   		$pesanerror[] = "Nama Gejala Wajib Diisi";
   	}
     
    $cekdata = mysqli_query($konek, "select * from tblgejala where nm_gejala='$nmgejala'");
    if ($hasil = mysqli_num_rows($cekdata)>=1) {
    	$pesanerror[] = "Nama Gejala Sudah ada";
    }

    if (count($pesanerror) >= 1) {
        echo "<div class='alert alert-danger'>";
        foreach ($pesanerror as $index => $isi_pesan) {
          echo "$isi_pesan<br>";
        }
        echo "</div>";
      } else {
        $simpan = mysqli_query($konek, "INSERT INTO tblgejala (kd_gejala, nm_gejala) values ('$kdgejala','$nmgejala')");
        if ($simpan) {
          echo "<meta http-equiv='refresh' content='0; url=?open=Gejala-Data'>";
        }
     }
   }
  ?>
  <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
  <div class="form-group">
  <label for="kd_gejala">Kode Gejala</label>
  <input type="text" class="form-control" id="kd_gejala" name="kd_gejala" value="<?php echo $kode3; ?>" readonly>
        </div>
        <div class="form-group">
  <label for="nm_gejala">Nama Gejala</label>
  <input type="text" class="form-control" id="nm_gejala" name="nm_gejala" maxlength="100" autofocus>
</div>
<div class="text-center">
          <button type="submit" class="btn btn-primary" name="btnsimpan">Simpan</button>
          </div>
      </form>
    </div>
  </div>
</div>

<div class="container-fluid mt-5">
  <div class="table-responsive">
    <!-- Your table code here -->
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>