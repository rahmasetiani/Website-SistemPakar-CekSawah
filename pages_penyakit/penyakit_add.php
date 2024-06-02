<?php
  include "lib/koneksi.php";
  
  if (isset($_GET['status'])) {
    $query = mysqli_query($konek, "SELECT MAX(kd_penyakit) AS maxkode FROM tblpenyakit");
    $hasil = mysqli_fetch_array($query);
    $kode  = $hasil['maxkode'];

    $kode2 = (int) substr($kode, 1, 2);
    $kode2++;

    $kode3 = 'P'.sprintf("%02s", $kode2);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Penyakit</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="col-lg-10">
      <h2 class="text-center mt-5">Tambah Data Penyakit</h2>
      <hr>
      <?php
        // Validasi 
        if (isset($_POST['btnsimpan'])) {
          $kdpenyakit = $_POST['kd_penyakit'];
          $nmpenyakit = $_POST['nm_penyakit'];
          $pengobatan = $_POST['pengobatan'];

          $pesanerror = array();

          if (trim($nmpenyakit) == "") {
            $pesanerror[] = "Nama Penyakit Wajib Diisi";
          }
          
          $cekdata = mysqli_query($konek, "SELECT * FROM tblpenyakit WHERE nm_penyakit='$nmpenyakit'");
          if (mysqli_num_rows($cekdata) >= 1) {
            $pesanerror[] = "Nama Penyakit Sudah ada";
          }

          if (trim($pengobatan) == '') {
            $pesanerror[] = "Pengobatan Belum Diisi";
          }
          
          if (count($pesanerror) >= 1) {
            echo "<div class='alert alert-danger'>";
            foreach ($pesanerror as $index => $isi_pesan) {
              echo "$isi_pesan<br>";
            }
            echo "</div>";
          } else {
            $simpan = mysqli_query($konek, "INSERT INTO tblpenyakit (kd_penyakit, nm_penyakit, pengobatan) VALUES ('$kdpenyakit', '$nmpenyakit',  '$pengobatan')");
            if ($simpan) {
              echo "<meta http-equiv='refresh' content='0; url=?open=Penyakit-Data'>";
            }
          }
        }
      ?>

      <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
        <div class="form-group">
          <label for="kd_penyakit">Kode Penyakit</label>
          <input type="text" class="form-control" id="kd_penyakit" name="kd_penyakit" value="<?php echo $kode3; ?>" readonly>
        </div>

        <div class="form-group">
  <label for="nm_penyakit">Nama Penyakit</label>
  <input type="text" class="form-control" id="nm_penyakit" name="nm_penyakit" maxlength="100" autofocus>
</div>



        <div class="form-group">
          <label for="pengobatan">Pengobatan</label>
          <textarea class="form-control" id="pengobatan" name="pengobatan" rows="6"></textarea>
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
