<?php
include "lib/koneksi.php";

// Pagination variables
$batas = 10; // Number of records per page
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
if (empty($halaman)) {
    $posisi = 0;
    $halaman = 1;
} else {
    $posisi = ($halaman - 1) * $batas;
}

// Fetch consultation data with pagination
$query_lap = mysqli_query($konek, "SELECT * FROM tblpengunjung ORDER BY tgl_diagnosa DESC LIMIT $posisi, $batas");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Hasil Diagnosa</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h2 class="text-center">Laporan Hasil Diagnosa</h2>
  <hr>
  <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="bulan">Bulan:</label>
          <select class="form-control" name="bulan" id="bulan">
            <option value="kosong">..........</option>
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="tahun">Tahun:</label>
          <select class="form-control" name="tahun" id="tahun">
            <option value="kosong">..........</option>
            <?php
              $tgl = date("Y-m-d");
              $thn = substr($tgl,0,4);
              $thndpn = $thn - 5;
              for ($a=$thn;$a>=$thndpn;$a--) {
                echo "<option value='$a'>$a</option>";
              }
            ?>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <button type="submit" href='?open=Lihat-Data'  class="btn btn-primary mt-4" name="btnlihat">Lihat Data</button>
      </div>
    </div>
  </form>

  <div class="table-responsive mt-5">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th class="text-center">No</th>
          <th class="text-center">Tgl Diagnosa</th>
          <th class="text-center">Nama Pengunjung</th>
          <th class="text-center">Gejala yang Dialami</th>
          <th class="text-center">Diagnosa Penyakit</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (isset($_POST['btnlihat'])) {
          $tahun = $_POST['tahun'];
          $bulan = $_POST['bulan'];

          $sort_query = mysqli_query($konek,"SELECT * FROM tblpengunjung WHERE tgl_diagnosa LIKE '%$tahun-$bulan%' LIMIT $posisi, $batas");
          if (mysqli_num_rows($sort_query) > 0) {
            $no = $posisi + 1;
            while ($hasil = mysqli_fetch_array($sort_query)) {
              $tgll = $hasil['tgl_diagnosa'];
              $thn = substr($tgll, 0, 4);
              $bln = substr($tgll, 5, 2);
              $tgl = substr($tgll, 8, 2);
              $hsl = $tgl . '-' . $bln . '-' . $thn;

              echo "<tr>
                      <td class='text-center'>$no</td>
                      <td class='text-center'>$hsl</td>
                      <td>$hasil[nm_pengunjung]</td>
                      <td>$hasil[gejala]</td>
                      <td>$hasil[penyakit]</td> 
                    </tr>";
              $no++;
            }
          } else {
            echo "<tr><td colspan='5' class='text-center'>Data tidak ditemukan</td></tr>";
          }
        } else {
          // Display all data if no filter is applied
          if (mysqli_num_rows($query_lap) > 0) {
            $no = $posisi + 1;
            while ($hasil = mysqli_fetch_array($query_lap)) {
              $tgll = $hasil['tgl_diagnosa'];
              $thn = substr($tgll, 0, 4);
              $bln = substr($tgll, 5, 2);
              $tgl = substr($tgll, 8, 2);
              $hsl = $tgl . '-' . $bln . '-' . $thn;

              echo "<tr>
                      <td class='text-center'>$no</td>
                      <td class='text-center'>$hsl</td>
                      <td>$hasil[nm_pengunjung]</td>
                      <td>$hasil[gejala]</td>
                      <td>$hasil[penyakit]</td> 
                    </tr>";
              $no++;
            }
          } else {
            echo "<tr><td colspan='5' class='text-center'>Data tidak ditemukan</td></tr>";
          }
        }
        ?>
      </tbody>
    </table>
  </div>
  
  <!-- Pagination -->
  <ul class="pagination justify-content-center">
    <?php
      // Count total number of pages
      $total_pages_query = "SELECT COUNT(*) AS total FROM tblpengunjung";
      $total_pages_result = mysqli_query($konek, $total_pages_query);
      $total_rows = mysqli_fetch_assoc($total_pages_result)['total'];
      $total_pages = ceil($total_rows / $batas);

      // Render pagination links
           for ($i = 1; $i <= $total_pages; $i++) {
        if ($i != $halaman) {
          echo "<li class='page-item'><a class='page-link' href='?open=Laporan&halaman={$i}'>$i</a></li>";
        } else {
          echo "<li class='page-item active'><a class='page-link' href='#'>$i</a></li>";
        }
      }
    ?>
  </ul>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

