<?php
  include "lib/koneksi.php";

  $batas = 10;
  $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
  if (empty($halaman)) {
    $posisi = 0;
    $halaman = 1;
  } else {
    $posisi = ($halaman - 1) * $batas;
  }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Basis Aturan</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
  <center><h2>Data Basis Aturan</h2></center><hr>

  <?php
    if (!$konek) {
        echo "<div class='alert alert-danger'>Connection to the database failed!</div>";
        exit();
    }

    $query = "SELECT a.kd_aturan, b.kd_penyakit, b.nm_penyakit, c.kd_gejala, c.nm_gejala, a.nl_prob 
            FROM tblaturan a 
            JOIN tblpenyakit b ON a.kd_penyakit = b.kd_penyakit 
            JOIN tblgejala c ON a.kd_gejala = c.kd_gejala 
            ORDER BY b.kd_penyakit ASC, c.kd_gejala ASC 
            LIMIT $posisi, $batas";

  $tampil = mysqli_query($konek, $query); 
  if (!$tampil) {
    echo "<div class='alert alert-danger'>Error executing query: " . mysqli_error($konek) . "</div>";
    exit();
}
?>
<div class="mb-3">
    <form action="?open=Aturan-Add&status=tambah" target="_self" method="Post">
        <button type="submit" name="btntambah" class="btn btn-primary">Tambah Data</button>
    </form>  
  </div>

  <table class="table table-striped table-bordered">
        <thead class="thead-dark">
          
          <tr>
        <!--<th> No </th> !-->  
        <th>No</th>
        <th width="20%">Nama Penyakit</th>
        <th>Nama Gejala</th>
        <th>Nilai Probabilitas (%)</th>
        <th colspan="2" width="10%">Action</th>
      </tr>
      </thead>
        <tbody>

       
  <?php
    $no = $posisi + 1;

    while ($data = mysqli_fetch_array($tampil)) {
      $warna = ($no % 2 == 1) ? '' : '#F5F5F5';

      echo "<tr bgcolor='$warna'>
              <td align='center'>$no</td>
              <td>$data[nm_penyakit]</td>
              <td>$data[nm_gejala]</td>
              <td align='center'>$data[nl_prob]</td>
              <td align='center'><a href='?open=Aturan-Edit&kode=$data[kd_aturan]' target='_self' alt='Edit Data' class='btn btn-warning btn-sm'>Ubah</a></td>
              <td align='center'><a href='?open=Aturan-Hapus&kode=$data[kd_aturan]' target='_self' alt='Delete Data' class='btn btn-danger btn-sm'>Hapus</a></td>
            </tr>";
      $no++;
    }

    echo "</table>";

    $semuadata = "SELECT a.kd_aturan, b.kd_penyakit, b.nm_penyakit, c.kd_gejala, c.nm_gejala, a.nl_prob 
                  FROM tblaturan a 
                  JOIN tblpenyakit b ON a.kd_penyakit = b.kd_penyakit 
                  JOIN tblgejala c ON a.kd_gejala = c.kd_gejala 
                  ORDER BY b.kd_penyakit ASC, c.kd_gejala ASC";

    $query2     = mysqli_query($konek, $semuadata);
    $jmldata    = mysqli_num_rows($query2);
    $jmlhalaman = ceil($jmldata / $batas);

echo "<ul class='pagination justify-content-center'>";
      for ($a = 1; $a <= $jmlhalaman; $a++) {
        if ($a != $halaman) {
          echo "<li class='page-item'><a class='page-link' href='?open=Basis-Aturan&halaman=$a'>$a</a></li>";
        } else {
          echo "<li class='page-item active'><a class='page-link' href='#'>$a</a></li>";
        }
      }
      echo "</ul>";
      ?>
      
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>