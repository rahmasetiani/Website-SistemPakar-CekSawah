<?php
# KONTROL MENU PROGRAM
if($_GET) {
  // Jika mendapatkan variabel URL ?page
  switch($_GET['open']){        
    case '' :
      if(!file_exists ("public/beranda.php")) die ("Empty Main Page!"); 
      include "public/beranda.php"; break;
      
    case 'Halaman-Utama' :
      if(!file_exists ("public/beranda.php")) die ("File program tidak ditemukan !"); 
      include "public/beranda.php"; break;
      
    case 'konsultasi_gejala_penyakit' :
      if(!file_exists ("konsultasi_pilih_gejala.php")) die ("File program tidak ditemukan !"); 
      include "konsultasi_pilih_gejala.php"; break;
    
    case 'login-admin'  :
      if (!file_exists("pages_login/login.php"))  die ("File program tidak ditemukan !");
      include "pages_login/login.php"; break;

    case 'Login-Validasi' :
      if(!file_exists ("pages_login/login_validasi.php")) die ("File program tidak ditemukan !"); 
     include "pages_login/login_validasi.php"; break;

    case 'Halaman-Utama-Admin' :
      if(!file_exists ("public/beranda.php")) die ("File program tidak ditemukan !"); 
      include "public/beranda.php";	break;

      case 'Logout' :
        if(!file_exists ("pages_login/login_out.php")) die ("File program tidak ditemukan !"); 
        include "pages_login/login_out.php"; break;	
           

    # PENYAKIT
		case 'Penyakit-Data' :
			if(!file_exists ("pages_penyakit/penyakit_data.php")) die ("File program tidak ditemukan !"); 
			include "pages_penyakit/penyakit_data.php"; break;		
		case 'Penyakit-Add' :
			if(!file_exists ("pages_penyakit/penyakit_add.php")) die ("File program tidak ditemukan !"); 
			include "pages_penyakit/penyakit_add.php"; break;		
		case 'Penyakit-Delete' :
			if(!file_exists ("pages_penyakit/penyakit_delete.php")) die ("File program tidak ditemukan !"); 
			include "pages_penyakit/penyakit_delete.php"; break;		
		case 'Penyakit-Edit' :
			if(!file_exists ("pages_penyakit/penyakit_edit.php")) die ("File program tidak ditemukan !"); 
			include "pages_penyakit/penyakit_edit.php"; break;	

    # GEJALA
		case 'Gejala-Data' :
			if(!file_exists ("pages_gejala/gejala_data.php")) die ("File program tidak ditemukan !"); 
			include "pages_gejala/gejala_data.php"; break;		
		case 'Gejala-Add' :
			if(!file_exists ("pages_gejala/gejala_tambah.php")) die ("File program tidak ditemukan !"); 
			include "pages_gejala/gejala_tambah.php";	break;		
		case 'Gejala-Hapus' :
			if(!file_exists ("pages_gejala/gejala_delete.php")) die ("File program tidak ditemukan !"); 
			include "pages_gejala/gejala_delete.php"; break;		
		case 'Gejala-Edit' :
			if(!file_exists ("pages_gejala/gejala_edit.php")) die ("File program tidak ditemukan !"); 
			include "pages_gejala/gejala_edit.php"; break;	

    # ATURAN
		case 'Basis-Aturan' :
			if(!file_exists ("pages_aturan/aturan_data.php")) die ("File program tidak ditemukan !"); 
			include "pages_aturan/aturan_data.php"; break;		
		case 'Aturan-Add' :
			if(!file_exists ("pages_aturan/aturan_add.php")) die ("File program tidak ditemukan !"); 
			include "pages_aturan/aturan_add.php"; break;		
		case 'Aturan-Hapus' :
			if(!file_exists ("pages_aturan/aturan_delete.php")) die ("File program tidak ditemukan !"); 
			include "pages_aturan/aturan_delete.php"; break;		
		case 'Aturan-Edit' :
			if(!file_exists ("pages_aturan/aturan_edit.php")) die ("File program tidak ditemukan !"); 
			include "pages_aturan/aturan_edit.php"; break;		
      
    # KONSULTASI
    case 'proses_bayes' :
     if (!file_exists("hitung_bayes.php")) die ("File program tidak ditemukan !");
     include "hitung_bayes.php"; break;

    case 'Proses2' :
      if(isset($_GET['page'])=='konsultasi_pilih_gejala'){
        if(!file_exists ("../konsultasi_pilih_gejala.php")) die ("File program tidak ditemukan !"); 
        include "../konsultasi_pilih_gejala.php"; 
      }
    break;

    #RIWAYAT
		case 'Laporan' :
			if(!file_exists ("pages_laporan/laporan.php")) die ("File program tidak ditemukan !"); 
			include "pages_laporan/laporan.php"; break;	

		# REPORT INFORMASI / LAPORAN DATA
		case 'Lihat-Data' :
		    if (!file_exists("pages_laporan/lihat_data.php")) die ("File program tidak ditemukan !");
		    include "pages_laporan/lihat_data.php";
		    break;	

    default:
      if(!file_exists ("public/beranda.php")) die ("Empty Main Page!"); 
      include "public/beranda.php";           
    break;
  }

}
else {
  // Jika tidak mendapatkan variabel URL : ?page
  if(!file_exists ("public/beranda.php")) die ("File program tidak ditemukan !"); 
  include "public/beranda.php"; 
}
?>