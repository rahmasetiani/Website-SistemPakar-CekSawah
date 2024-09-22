<?php
 include "lib/koneksi.php";

 if (isset($_GET['kode'])) {
    $kode        = $_GET['kode'];
    $hapus       = mysqli_query($konek, "delete from tblgejala where kd_gejala='$kode'");
    $hapusgejala = mysqli_query($konek, "delete from tblaturan where kd_gejala='$kode'");

    //proses mencari nilai penyakit;
    $list_penyakit = array();
    $lst_penyakit  = mysqli_query($konek, "select * from tblpenyakit order by kd_penyakit asc");
    while ($hslpenyakit = mysqli_fetch_array($lst_penyakit)) {
        $list_penyakit[] = $hslpenyakit['kd_penyakit'];
    }

    //lakukan looping untuk mencari nilai probabilitas penyakit setiap gejala di tabel aturan;
    foreach ($list_penyakit as $penyakit) {
        $sortnilgejala = mysqli_query($konek, "select * from tblaturan where kd_penyakit='$penyakit'");            
        $jumlah_nil = 0;
        $list_nilai_prob = array();
        $bagi_nil = array();
        $kali_nil = array();
        $nl_prob = 0;

        while ($hasilsort = mysqli_fetch_array($sortnilgejala)) {
            $list_nilai_prob[] = $hasilsort['nl_prob'];
            $jumlah_nil += $hasilsort['nl_prob'];
        }

        if ($jumlah_nil > 0) { // Cek jika jumlah_nil tidak nol
            foreach ($list_nilai_prob as $nilai_prob) {
                $bagi_nil[] = $nilai_prob / $jumlah_nil;
            }

            foreach ($bagi_nil as $index => $nilai_bagi) {
                $kali_nil[] = $list_nilai_prob[$index] * $nilai_bagi;
            }

            //nilai probabilitas penyakit
            foreach ($kali_nil as $nilai_kali) {
                $nl_prob += $nilai_kali;
            }
        }

        $nl_prob = number_format($nl_prob, 4);            
        $simpan_nilai = mysqli_query($konek, "update tblpenyakit set nl_penyakit='$nl_prob' where kd_penyakit='$penyakit'");
    }

    if ($hapus) {
        echo "<meta http-equiv='refresh' content='0; url=?open=Gejala-Data'>";
    } else {
        echo "Data yang Dihapus Tidak ada"; 
    }
 }
?>
