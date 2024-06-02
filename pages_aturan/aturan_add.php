<?php 
  include "lib/koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Basis Aturan</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="col-lg-8">
      <h2 class="text-center mt-5">Tambah Data Basis Aturan</h2>
      <hr>
      <?php
      // Initialize variables
      $kd_penyakit = isset($_POST['cmbpenyakit']) ? $_POST['cmbpenyakit'] : '';
      $kd_gejala   = isset($_POST['cmbgejala']) ? $_POST['cmbgejala'] : ''; 
      $nilai       = isset($_POST['nil_pro']) ? $_POST['nil_pro'] : '';
      $nilai       = str_replace(",",".",$nilai);

      if (isset($_POST['btnsimpan'])) {
        $pesanerror = array();

        if ($_POST['cmbpenyakit'] == "Kosong") {
          $pesanerror[] = "Penyakit Belum Dipilih";
        }

        if ($_POST['cmbgejala'] == "Kosong") {
          $pesanerror[] = "Gejala Belum Dipilih";
        }

        if ($_POST['nil_pro'] == "Kosong") {
          $pesanerror[] = "Nilai Probabilitas Wajib Diisi";
        }

        $kodesama = mysqli_query($konek, "SELECT * FROM tblaturan WHERE kd_penyakit='$kd_penyakit' AND kd_gejala='$kd_gejala'");
        if ($hasil = mysqli_num_rows($kodesama) >= 1) {
          $pesanerror[] = "Data Sudah ada";
        }

        // Display error messages
        if (count($pesanerror) >= 1) {
          echo "<div class='alert alert-danger'>";
          foreach ($pesanerror as $index => $isi_pesan) {
            echo "<p>$isi_pesan</p>";
          }
          echo "</div>";
        } else {
          // Save data
          $simpan = mysqli_query($konek, "INSERT INTO tblaturan (kd_penyakit, kd_gejala, nl_prob) VALUES ('$kd_penyakit','$kd_gejala','$nilai')");

          // Probability calculations
          $list_penyakit = array();
          $lst_penyakit  = mysqli_query($konek, "SELECT * FROM tblpenyakit ORDER BY kd_penyakit ASC");
          while ($hslpenyakit = mysqli_fetch_array($lst_penyakit)) {
            $list_penyakit[] = $hslpenyakit['kd_penyakit'];
          }

          $list_nilai_prob = array();
          $bagi_nil = array();
          $kali_nil = array();

          for ($a = 0; $a <= count($list_penyakit) - 1; $a++) {
            $sortnilgejala = mysqli_query($konek, "SELECT * FROM tblaturan WHERE kd_penyakit='$list_penyakit[$a]'");            
            $jumlah_nil = 0;
            $nl_prob = 0;

            while ($hasilsort = mysqli_fetch_array($sortnilgejala)) {
              $list_nilai_prob[] = $hasilsort['nl_prob'];
              $jumlah_nil = $jumlah_nil + $hasilsort['nl_prob'];

              // Calculations
              for ($b = 0; $b <= count($list_nilai_prob) - 1; $b++) {
                $bagi_nil[$b] = $list_nilai_prob[$b] / $jumlah_nil;
                $kali_nil[$b] = $list_nilai_prob[$b] * $bagi_nil[$b];   
              }
            }

            // Calculate probability
            for ($d = 0; $d <= count($kali_nil) - 1; $d++) {
              $nl_prob = $nl_prob + $kali_nil[$d];
            }

            // Clear arrays
            unset($list_nilai_prob);
            unset($bagi_nil);
            unset($kali_nil);
            $nl_prob = number_format($nl_prob, 4);            
           
            $simpan_nilai = mysqli_query($konek, "UPDATE tblpenyakit SET nl_penyakit='$nl_prob' WHERE kd_penyakit='$list_penyakit[$a]'");
            if ($simpan_nilai) {
              echo "<meta http-equiv='refresh' content='0; url=?open=Basis-Aturan'>";
            }
          }
        }
      }
      ?>

      <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
        <div class="form-group">
          <label for="cmbpenyakit">Nama Penyakit</label>
          <select class="form-control" id="cmbpenyakit" name="cmbpenyakit">
            <option value="Kosong">Pilih Penyakit</option>
            <?php
              $penyakit = mysqli_query($konek, "SELECT * FROM tblpenyakit ORDER BY kd_penyakit ASC");
              while ($hasilpenyakit = mysqli_fetch_array($penyakit)) {
                echo "<option value='{$hasilpenyakit['kd_penyakit']}'>{$hasilpenyakit['kd_penyakit']} | {$hasilpenyakit['nm_penyakit']}</option>";
              }
            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="cmbgejala">Nama Gejala</label>
          <select class="form-control" id="cmbgejala" name="cmbgejala">
            <option value="Kosong">Pilih Gejala</option>
            <?php
              $gejala = mysqli_query($konek, "SELECT * FROM tblgejala ORDER BY kd_gejala ASC");
              while ($hasilgejala = mysqli_fetch_array($gejala)) {
                echo "<option value='{$hasilgejala['kd_gejala']}'>{$hasilgejala['kd_gejala']} | {$hasilgejala['nm_gejala']}</option>";
              }
            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="nil_pro">Nilai Probabilitas</label>
          <select class="form-control" id="nil_pro" name="nil_pro">
            <option value="Kosong">Pilih Nilai</option>
            <?php
              for ($a = 10; $a <= 90; $a += 10) {
                $b = $a / 100;
                echo "<option value=\"$b\">$b</option>";
              }
            ?>
          </select>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary" name="btnsimpan">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
