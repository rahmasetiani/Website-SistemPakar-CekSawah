<div class="container d-flex justify-content-center">
    <center><h2>Ubah Data Penyakit</h2></center>
</div>
<hr>

<?php
include "lib/koneksi.php";

$kdpenyakit = isset($_POST['kd_penyakit']) ? $_POST['kd_penyakit'] : '';
$nmpenyakit = isset($_POST['nm_penyakit']) ? $_POST['nm_penyakit'] : '';
$pengobatan = isset($_POST['pengobatan']) ? $_POST['pengobatan'] : '';


//validasi 
if (isset($_POST['btnsimpan'])) {

    $pesanerror = array();
    if (trim($nmpenyakit) == "") {
        $pesanerror[] = "Nama Penyakit Wajib Diisi";
    }

   

    if (trim($pengobatan) == "") {
        $pesanerror[] = "Pengobatan Wajib Diisi";
    }

    $ceksql = mysqli_query($konek, "select * from tblpenyakit where nm_penyakit='$nmpenyakit' AND NOT(nm_penyakit='" . $_POST['txtlama'] . "')");
    if (mysqli_num_rows($ceksql) >= 1) {
        $pesanerror[] = "Nama Penyakit Sudah Ada";
    }

    //tampilkam isi pesan error;

    if (count($pesanerror) >= 1) {
        $no = 0;
        foreach ($pesanerror as $indek => $isi_pesan) {
            $no++;
            echo "$no. $isi_pesan";
        }
        echo "<hr>";
    } else {
        $update = mysqli_query($konek, "update tblpenyakit set nm_penyakit='$nmpenyakit',pengobatan='$pengobatan' where kd_penyakit='$kdpenyakit'");
        if ($update) {
            echo  "<meta http-equiv='refresh' content='0; url=?open=Penyakit-Data'>";
        }
        exit;
    }
}
?>

<?php
$kdpenyakit = $_GET['kode'];

$data = mysqli_query($konek, "select * from tblpenyakit where kd_penyakit='$kdpenyakit'");

$hasil = mysqli_fetch_array($data);

//$dataNama	= isset($_POST['nm_gejala']) ? $_POST['nm_gejala'] : $hasil['nm_gejala'];
//echo "$dataNama";
?>

<div class="container d-flex justify-content-center">
<div class="col-lg-10">
<form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
        <div class="form-group">
             <label for="kd_penyakit">Kode Penyakit</label>
             <input type="text" class="form-control" id="kd_penyakit" name="kd_penyakit" size="14" value="<?php echo $hasil['kd_penyakit']; ?>" readonly="readonly" />
        </div>      
        <div class="form-group">
          <label for="nm_penyakit">Nama Penyakit</label>
          <input type="text" class="form-control" id="nm_penyakit" name="nm_penyakit" maxlength="100" value="<?php echo $hasil['nm_penyakit']; ?>" autofocus>
          <input type="hidden" name="txtlama" value="<?php echo $hasil['nm_penyakit']; ?>" />
        </div>
        
        <div class="form-group">
          <label for="pengobatan">Pengobatan</label>
          <textarea class="form-control" id="pengobatan" name="pengobatan" rows="6"><?php echo $hasil['pengobatan']; ?></textarea>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary" name="btnsimpan">Ubah</button>
        </div>
  
    </form>
    </div>     
</div>
