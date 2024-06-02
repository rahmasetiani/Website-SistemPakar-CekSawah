<?php 
  include "lib/koneksi.php";
?>

<?php
  $id          = $_GET['kode'];
  // Initialize variables
  $kd_penyakit = isset($_POST['cmbpenyakit']) ? $_POST['cmbpenyakit'] : '';
  $kd_gejala   = isset($_POST['cmbgejala']) ? $_POST['cmbgejala'] : ''; 
  $nilai       = isset($_POST['nil_pro']) ? $_POST['nil_pro'] : '';

  if (isset($_POST['btnsimpan'])) {
    $pesanerror = array();

    if ($_POST['cmbpenyakit']=="Kosong") {
      $pesanerror[] = "Penyakit Belum Dipilih";
    }

    if ($_POST['cmbgejala']=="Kosong") {
      $pesanerror[] = "Gejala Belum Dipilih";
    }

    if (trim($_POST['nil_pro']=="")) {
      $pesanerror[] = "Nilai Probabilitas Belum Diisi";
    } elseif (!preg_match("/^[0-9].*$/", $_POST['nil_pro'])) {
      $pesanerror[] = "Inputan Nilai Probabilitas Hanya Berupa Angka dan Titik (.)";
    }

    $kodesama = mysqli_query($konek, "select * from tblaturan where kd_penyakit='$kd_penyakit' and kd_gejala='$kd_gejala' and not (kd_gejala='".$_POST['cmbgejalalama']."') ");
    if ($hasil = mysqli_num_rows($kodesama)>=1) {
      $pesanerror[] = "Data Sudah ada";
    } 

    if (count($pesanerror)>=1) {
      echo '<div class="alert alert-danger">';
      foreach ($pesanerror as $index => $isi_pesan) {
        echo ($index + 1) . ". $isi_pesan <br>";
      }
      echo '</div>';
    } else { 
      $simpandata = mysqli_query($konek, "update tblaturan set kd_gejala='$kd_gejala', nl_prob='$nilai' where kd_aturan='$id'");

      //Perhitungan Probabilitas penyakit;
      $list_penyakit = array();
      $lst_penyakit  = mysqli_query($konek, "select * from tblpenyakit order by kd_penyakit asc");
      while ($hslpenyakit = mysqli_fetch_array($lst_penyakit)) {
        $list_penyakit[] = $hslpenyakit['kd_penyakit'];
      }

      //lakukan looping untuk mencari nilai probabilitas penyakit setiap gejala di tabel aturan;
      for ($a=0; $a<count($list_penyakit); $a++) {
        $sortnilgejala = mysqli_query($konek, "select * from tblaturan where kd_penyakit='$list_penyakit[$a]'");
        $jumlah_nil = 0;
        $nl_prob    = 0;

        $list_nilai_prob = array();
        while ($hasilsort = mysqli_fetch_array($sortnilgejala)) {
          $list_nilai_prob[] = $hasilsort['nl_prob'];
          $jumlah_nil += $hasilsort['nl_prob'];
        }

        $bagi_nil = array_map(function($val) use ($jumlah_nil) {
          return $val / $jumlah_nil;
        }, $list_nilai_prob);

        $kali_nil = array_map(function($val, $bagi) {
          return $val * $bagi;
        }, $list_nilai_prob, $bagi_nil);

        $nl_prob = array_sum($kali_nil);
        $nl_prob = number_format($nl_prob, 4);            

        $simpan_nilai = mysqli_query($konek, "update tblpenyakit set nl_penyakit='$nl_prob' where kd_penyakit='$list_penyakit[$a]'");
        if ($simpan_nilai) {
          echo "<meta http-equiv='refresh' content='0; url=?open=Basis-Aturan'>";
        }
      }
    }
  }
?>

<?php
  $query = "select * from tblaturan where kd_aturan='$id'";
  $tampil = mysqli_query($konek, $query);
  $hasiltampil = mysqli_fetch_array($tampil);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Data Basis Aturan</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container d-flex justify-content-center">
  <div class="col-lg-8">
    <center><h2>Ubah Data Basis Aturan</h2></center>
    <hr>


        <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
          <div class="form-group">
            <label for="cmbpenyakit">Nama Penyakit</label>
            <select name="cmbpenyakit" id="cmbpenyakit" class="form-control" disabled>
              <option value="Kosong">....................</option>
              <?php
                $penyakit = mysqli_query($konek, "select * from tblpenyakit order by kd_penyakit asc");
                while ($hasilpenyakit = mysqli_fetch_array($penyakit)) {
                  $selected = ($hasilpenyakit['kd_penyakit'] == $hasiltampil['kd_penyakit']) ? "selected" : "";
                  echo "<option value='{$hasilpenyakit['kd_penyakit']}' $selected>{$hasilpenyakit['kd_penyakit']} | {$hasilpenyakit['nm_penyakit']}</option>";
                }
              ?>
            </select>
            <input type="hidden" name="cmbpenyakitlama" value="<?php echo $hasiltampil['kd_penyakit'];?>">
          </div>

          <div class="form-group">
            <label for="cmbgejala">Nama Gejala</label>
            <select name="cmbgejala" id="cmbgejala" class="form-control">
              <option value="Kosong">....................</option>
              <?php
                $gejala = mysqli_query($konek, "select * from tblgejala order by kd_gejala asc");
                while ($hasilgejala = mysqli_fetch_array($gejala)) {
                  $selected = ($hasilgejala['kd_gejala'] == $hasiltampil['kd_gejala']) ? "selected" : "";
                  echo "<option value='{$hasilgejala['kd_gejala']}' $selected>{$hasilgejala['kd_gejala']} | {$hasilgejala['nm_gejala']}</option>";
                }
              ?>
            </select>
            <input type="hidden" name="cmbgejalalama" value="<?php echo $hasiltampil['kd_gejala'];?>">
          </div>

          <div class="form-group">
            <label for="nil_pro">Nilai Probabilitas</label>
            <select name="nil_pro" id="nil_pro" class="form-control">
              <option value="Kosong">.....</option>
              <?php
                for ($a = 10; $a <= 90; $a += 10) {
                  $b = $a / 100;
                  $selected = ($hasiltampil['nl_prob'] == $b) ? "selected" : "";
                  echo "<option value=\"$b\" $selected>$b</option>";
                }
              ?>
            </select>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary" name="btnsimpan">Ubah</button>
          </div>
        </form>
        
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
