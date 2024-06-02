<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hasil Konsultasi Penyakit</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #28a745; /* Warna hijau */
      color: black;
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
  </style>
</head>
<body>
  <div class="container">
    <div class="col">
      <h2 class="form-title">Hasil Diagnosa</h2>
      <hr>
      <?php 
      include "lib/koneksi.php";

      $user=$_GET['u'];
      echo "<h4>Gejala yang didiagnosa:</h4><br>";

      //sort gejala dipilih dari database
      $dataGejala = array();
      $tampil_data_gejala = mysqli_query($konek,"SELECT * FROM tblbantu WHERE id_pengunjung='$user'");
      while ($hasil_tampil_data_gejala = mysqli_fetch_array($tampil_data_gejala)) {
        $dataGejala[] = $hasil_tampil_data_gejala['kd_gejala']; 
      }

      //sort penyakit dengan gejala yang dipilih
      $list_penyakit_k = array();
      $a=0;
      foreach ($dataGejala as $list_pyk_k) {
        $query_penyakit_k = mysqli_query($konek,"SELECT * FROM tblaturan WHERE kd_gejala='$list_pyk_k'");
        $jml_gejala = mysqli_num_rows($query_penyakit_k);
        while ($hasil_query_penyakit_k = mysqli_fetch_array($query_penyakit_k)) {
          $list_penyakit_k [$a][0] = $hasil_query_penyakit_k['kd_gejala']; // Enclosed in quotes
          $list_penyakit_k [$a][1] = $hasil_query_penyakit_k['kd_penyakit']; // Enclosed in quotes
          $a++;
        }
      }

      //ambil penyakit aja
      foreach ($list_penyakit_k as $nil_penyakit_k) {
        $validasi = mysqli_query($konek,"SELECT * FROM tblbantu_2 WHERE kd_penyakit='$nil_penyakit_k[1]'");
        if (mysqli_num_rows($validasi)==0) {
          $simpan =  mysqli_query($konek,"INSERT INTO tblbantu_2 SET id_pengunjung='$user', kd_penyakit='$nil_penyakit_k[1]', jml_gejala='1'");
        } else {
          $ubah = mysqli_query($konek,"UPDATE tblbantu_2 SET jml_gejala=jml_gejala+1 WHERE kd_penyakit='$nil_penyakit_k[1]'");
        }
      }

      //sort penyakit dengan jumlah gejalanya yang diderita user
      $list_penyakit_jml_gejala = array ();
      $q=0;
      $list_penyakit_gejala = mysqli_query($konek, "SELECT * FROM tblbantu_2 WHERE id_pengunjung='$user' ORDER BY kd_penyakit ASC");
      while ($h_list_penyakit_gejala = mysqli_fetch_array($list_penyakit_gejala)){
        $list_penyakit_jml_gejala[$q][0] = $h_list_penyakit_gejala['kd_penyakit'];
        $list_penyakit_jml_gejala[$q][1] = $h_list_penyakit_gejala['jml_gejala'];
        $q++; 
      }

      //sort jumlah penyakit dan gejalanya yang didatabase
      $list_penyakit_kk = array ();
      $b=0;
      foreach
	  ($list_penyakit_k as $list_pyk_k) {
        $query_penyakit_kk = mysqli_query($konek, "SELECT * FROM tblaturan WHERE kd_penyakit='$list_pyk_k[1]'");
        $jumlah_gejala = mysqli_num_rows($query_penyakit_kk);
        while ($hasil_query_penyakit_kk = mysqli_fetch_array($query_penyakit_kk)) {
          $list_penyakit_kk[$b][0] = $hasil_query_penyakit_kk['kd_penyakit'];
        }
        $list_penyakit_kk[$b][1] = $jumlah_gejala;
        $hasil = floor($list_penyakit_kk[$b][1] / 2);
        $list_penyakit_kk[$b][2] = $hasil;
        $b++;
      }

      //bandingkan jumlah yang ada di table aturan dengan jumlah gejala yang terpilih
      $list_penyakit_penuh_kriteria = array ();
      foreach ($list_penyakit_jml_gejala as $h_list_penyakit_jml_gejala) {
        foreach ($list_penyakit_kk as $h_list_penyakit_kk) {
          if ($h_list_penyakit_jml_gejala[0] == $h_list_penyakit_kk[0]) {
            if ($h_list_penyakit_jml_gejala[1] >= $h_list_penyakit_kk[2]) {
              $list_penyakit_penuh_kriteria[] = $h_list_penyakit_jml_gejala[1];
            }
          }
        }
      }

      $list_penyakit_tersaring = array ();
      if (count($list_penyakit_penuh_kriteria) == -1) {
        echo "<h3>Tidak Bisa Melakukan Diagnosa Penyakit, Gejala Yang Anda Masukkan Kurang Spesifik</h3>";
        $hapus = mysqli_query($konek, "DELETE FROM tblbantu_2 WHERE id_pengunjung='$user'");
        $hps_pengunjung = mysqli_query($konek,"DELETE FROM tblpengunjung WHERE id_pengunjung='$user'");
        $hps_tblbantu = mysqli_query($konek,"DELETE FROM tblbantu WHERE id_pengunjung='$user'");
      } else {
        $gejala_user = array();
        foreach ($dataGejala as $nilai) {
          $q_gejala = "SELECT * FROM tblgejala WHERE kd_gejala='$nilai'";
          $r_gejala = mysqli_query($konek, $q_gejala) or die ("Error gejala".mysqli_error());
          $gejalaHsl = mysqli_fetch_array($r_gejala);
          echo $gejalaHsl['kd_gejala'] . ": " . $gejalaHsl['nm_gejala'] . "<br>";

          //simpan data gejala dalam array
          $gejala_user[$gejalaHsl['kd_gejala']] = $gejalaHsl['nm_gejala'];
        }

        //Data Penyakit
        $penyakit = array(); 
        $gebot = array();
        $p = 0;
        $q_penyakit = "SELECT kd_penyakit, nl_penyakit FROM tblpenyakit";
        $r_penyakit = mysqli_query($konek, $q_penyakit) or die ("Error penyakit".mysqli_error());
        while ($data_penyakit = mysqli_fetch_array($r_penyakit)) {
          $penyakit[$p][0] = $data_penyakit['kd_penyakit'];
          $penyakit[$p][1] = $data_penyakit['nl_penyakit'];
          $q = 0;
          //Data Gejala Bobot
          foreach ($dataGejala as $cek_gejala) {
            $q_gejala2 = "SELECT tblaturan.nl_prob FROM tblaturan WHERE tblaturan.kd_penyakit='$data_penyakit[kd_penyakit]' AND tblaturan.kd_gejala='$cek_gejala'";
            $r_gejala2 = mysqli_query($konek, $q_gejala2) or die ("Error gejala".mysqli_error());
            $bobot_gejala = mysqli_fetch_array($r_gejala2);
            
            if(mysqli_num_rows($r_gejala2) >= 1){
              $gebot[$p][$q][0] = $data_penyakit['kd_penyakit'];
              $gebot[$p][$q][1] = $cek_gejala;
              $gebot[$p][$q][2] = $bobot_gejala['nl_prob'];
            } else {
              $gebot[$p][$q][0] = $data_penyakit['kd_penyakit'];
              $gebot[$p][$q][1] = $cek_gejala;
              $gebot[$p][$q][2] = 0;
            }
            $q++;
          }
          $p++;
        }

        //hitung gejala bobot
        $atas = array();
        $sum_bawah = array();
        $bawah = array();
        $hit_gebot = array();
        $hit_total = array();
        $hit_persen = array();
        $hit_max = array();
        for ($a = 0; $a <= count($penyakit) - 1; $a++) { 
          for ($b = 0; $b <= count($dataGejala) - 1; $b++) { 
            //hitung atas
            $atas[$a][$b] = $gebot[$a][$b][2] * $penyakit[$a][1];
            //hitung bawah
            for ($c = 0; $c <= count($penyakit) - 1; $c++) { 
              $sum_bawah[$a][$b][$c] = $gebot[$c][$b][2] * $penyakit[$c][1];
            }
            $bawah[$a][$b] = array_sum($sum_bawah[$a][$b]);
            //hitung atas/bawah
            $hit_gebot[$a][$b] = $atas[$a][$b] / $bawah[$a][$b];
          }
          //sum bobot
          $hit_total[$a] = round(array_sum($hit_gebot[$a]), 4);
          //persentase
          $hit_persen[$a][0] = $penyakit[$a][0];
          $hit_persen[$a][1] = round($hit_total[$a] * 100 / count($dataGejala), 0);
        }

        foreach ($hit_persen as $key) {
          //simpan hasil persentase ke data sementara
          $yo = implode(',', $key);
          list($sakit, $persen) = explode(',', $yo
		);
		$q_persen = "INSERT INTO tbldiagnosa SET id_pengunjung='$user', kd_penyakit='$sakit', persen='$persen' ";
		$r_persen = mysqli_query($konek, $q_persen) or die ("Error gejala".mysqli_error());
	  }

	  //Hasil konsultasi
	  $q_hasilkonsul = "SELECT tbldiagnosa.id_pengunjung, tblpenyakit.kd_penyakit, tblpenyakit.nm_penyakit, tbldiagnosa.persen FROM tbldiagnosa, tblpenyakit WHERE tbldiagnosa.kd_penyakit=tblpenyakit.kd_penyakit AND tbldiagnosa.id_pengunjung='$user'";
	  $r_hasilkonsul = mysqli_query($konek, $q_hasilkonsul) or die ("Error gejala".mysqli_error());
	  echo "<br/><strong><h4>Persentasi Penyakit:</h4></strong><br/>";
	  echo "<table class='table'>";
	  echo "<thead>";
	  echo "<tr>";
	  echo "<th>Kode Penyakit</th>";
	  echo "<th>Nama Penyakit</th>";
	  echo "<th>Persentase</th>";
	  echo "</tr>";
	  echo "</thead>";
	  echo "<tbody>";
	  while ($hasil = mysqli_fetch_array($r_hasilkonsul)) {
		if ($hasil['persen'] != 0.00) {
		  echo "<tr>";
		  echo "<td>" . $hasil['kd_penyakit'] . "</td>";
		  echo "<td>" . $hasil['nm_penyakit'] . "</td>";
		  echo "<td>" . $hasil['persen'] . "%</td>";
		  echo "</tr>";
		}
	  }
	  echo "</tbody>";
	  echo "</table>";

	  $q_max  = "SELECT tbldiagnosa.kd_penyakit, tblpenyakit.nm_penyakit, tblpenyakit.pengobatan, tbldiagnosa.persen FROM tbldiagnosa INNER JOIN tblpenyakit ON tbldiagnosa.kd_penyakit=tblpenyakit.kd_penyakit WHERE tbldiagnosa.persen=(SELECT MAX(tbldiagnosa.persen) AS persen FROM tbldiagnosa WHERE tbldiagnosa.id_pengunjung='$user') AND tbldiagnosa.id_pengunjung='$user'";
	  $r_max  = mysqli_query($konek, $q_max);
	  $hs_max = mysqli_fetch_array($r_max); 
	  echo "<h4>Kemungkinan terbesar anda terkena penyakit {$hs_max['nm_penyakit']} dengan persentase kemungkinan {$hs_max['persen']}%</h4><br>";
	  echo "<h4>Pengobatan:</h4><br>";
	  echo "<ul>";
	  $h_obat = explode(",", $hs_max['pengobatan']);
	  foreach ($h_obat as $obat) {
		echo "<li>$obat</li>";
	  }
	  echo "</ul>";

	  //Simpan Data Konsultasi
	  $gejala_user = implode(',', $gejala_user);
	  $gejala_user = str_replace(',', ', ', $gejala_user);
	  $q_u_gejala = "UPDATE tblpengunjung SET gejala='$gejala_user', penyakit='{$hs_max['nm_penyakit']}', nl_bayes='{$hs_max['persen']}', pengobatan='{$hs_max['pengobatan']}' WHERE id_pengunjung='$user'";
	  $r_u_gejala = mysqli_query($konek, $q_u_gejala) or die ("Error gejala".mysqli_error());
	  //hapus data sementara
	  $q_d_gejala = "DELETE FROM tbldiagnosa WHERE id_pengunjung='$user'";
	  $r_d_gejala = mysqli_query($konek, $q_d_gejala) or die ("Error gejala".mysqli_error());
	  $hapus_tbl_bantu = mysqli_query($konek,"DELETE FROM tblbantu WHERE id_pengunjung='$user'");
	  $hapus_tbl_bantu2 = mysqli_query($konek,"DELETE FROM tblbantu_2 WHERE id_pengunjung='$user'");
	}
	?>
	<script>  
        function print_d(){  
          window.open('<?php echo "user_cetak.php?u=$_GET[u]";?>','_blank');  
        }  
      </script> 
      <button class="btn btn-primary mb-3" onClick="print_d()">Print Hasil</button>
  </div>
</div>

</body>
</html>


