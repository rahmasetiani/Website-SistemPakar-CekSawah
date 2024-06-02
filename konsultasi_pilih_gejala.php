<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Konsultasi Gejala Penyakit</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Custom CSS untuk mempercantik tampilan */
    body {
      background-color: #28a745; /* Warna hijau */
    }
    .container {
      margin-top: 50px;
      background-color: #ffffff; /* Warna putih */
      border-radius: 10px; /* Membuat sudut container menjadi agak melengkung */
      padding: 20px; /* Padding untuk memberi ruang di dalam container */
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Efek bayangan untuk container */
    }
    .form-title {
      text-align: center;
      color: #28a745; /* Warna teks hijau */
    }
    .table-checkbox input[type="checkbox"] {
      margin-right: 10px;
    }
    .form-group table {
      width: 100%; /* Membuat tabel seukuran container */
    }
  </style>
</head>
<body>
  <div class="container">
      <div class="col">
        <h2 class="form-title">Konsultasi Gejala Penyakit Padi</h2>
        <hr>
        <?php
          include "lib/koneksi.php";

          if (isset($_POST['btnkonsul'])) {
            $nama = $_POST['nama'];
            $pesan = array(); 
            if (trim($nama) == "") {
              $pesan[] = "Nama Wajib Diisi";
            }
            if (!isset($_POST['daftargejala'])) {
              $pesan[] = "Gejala Belum Dipilih";
            } else {
              if (count($_POST['daftargejala']) < 2) {
                $pesan[] = "Minimal Masukkan 2 Gejala";
              }
            }
            if (count($pesan) >= 1) {
              $no = 0;
              foreach ($pesan as $index => $pesanerror) {
                $no++;
                echo "$no. $pesanerror<br>";
              }
              echo "<hr>";
            } else {
              $simpan = mysqli_query($konek, "INSERT INTO tblpengunjung (nm_pengunjung, tgl_diagnosa) VALUES ('$nama', '".date('Y-m-d')."')");
              if ($simpan) {
                echo "<meta http-equiv='refresh' content='0; url=?open=proses_bayes&u=".mysqli_insert_id($konek)."'>";
                $id = mysqli_insert_id($konek);
                $tampil_tbl_bantu = mysqli_query($konek, "SELECT * FROM tblbantu WHERE id_pengunjung='$id'");
                $data_gejala = $_POST['daftargejala'];
                if (mysqli_num_rows($tampil_tbl_bantu) == 0) {
                  foreach ($data_gejala as $nilai) {
                    $simpan_bantu = mysqli_query($konek, "INSERT INTO tblbantu (id_pengunjung, kd_gejala) VALUES ('$id', '$nilai')");
                  } 
                } else {
                  $hapus_bantu = mysqli_query($konek, "DELETE FROM tblbantu WHERE id_pengunjung='$id'");
                }
              } 
            }
          }
        ?>
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
          <div class="form-group">
            <label for="nama">Masukkan Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" maxlength="25" autofocus required>
          </div>
          <hr>
          <div class="form-group">
            <div class="row">
              <div class="col-12">
                <table class="table table-striped table-bordered table-checkbox">
                  <thead class="thead-light">
                    <tr>
                      <th colspan="2" class="text-center">Gejala Yang Dialami</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      include "lib/koneksi.php";
                      $query_gejala = mysqli_query($konek, "SELECT * FROM tblgejala ORDER BY kd_gejala ASC");
                      $no = 1;
                      while ($hasilquery = mysqli_fetch_array($query_gejala)) {
                        $warna = ($no % 2 == 1) ? '' : '#DDDDDD';
                        echo "<tr bgcolor='$warna'>"; 
                        echo "<td><input type='checkbox' name='daftargejala[]' value='$hasilquery[kd_gejala]'></td>";
                        echo "<td>$hasilquery[kd_gejala] | $hasilquery[nm_gejala]</td>";
                        echo "</tr>";
                        $no++;
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-success" name="btnkonsul">Konsultasi</button>
            <button type="reset" class="btn btn-secondary" name="btnreset">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
