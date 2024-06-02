<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Virus</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Styling for navigation */
        nav {
            background-color: #4caf50; /* Warna hijau untuk background header */
            padding: 40px 0; /* Padding atas dan bawah 40px */
            width: 100%; /* Menjadikan lebar header 100% */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Menambahkan bayangan */
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #F5F5F5;
            text-decoration: none;
            padding: 15px 20px; /* Perbesar padding untuk menyesuaikan dengan teks yang lebih besar */
            border-radius: 5px;
            transition: background-color 0.3s;
            font-size: 18px; /* Perbesar ukuran teks */
            text-transform: uppercase; /* Mengubah teks menjadi huruf besar */
        }

        nav ul li a:hover {
            background-color: #AED9E0; /* Warna hijau yang lebih gelap saat dihover */
        }

        /* Styling for active link */
        nav ul li a.active {
            background-color: #4caf50; /* Warna hijau yang lebih gelap saat dipilih */
        }

        /* Media query for responsiveness */
        @media (max-width: 768px) {
            nav ul {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            nav ul li {
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
<?php session_start(); ?>
<header>
    <nav>
        <ul>
            <?php if(isset($_SESSION['SES_LOGIN'])): ?>
                <li><a href="?open=Halaman-Utama" title="Halaman Utama" id="beranda">Beranda</a></li>
                <li><a href="?open=konsultasi_gejala_penyakit" title="Konsultasi" id="diagnosa">Diagnosa</a></li>
                <li><a href="?open=Penyakit-Data" title="Penyakit-Data">Data Penyakit</a></li>
                <li><a href="?open=Gejala-Data" title="Gejala-Data">Data Gejala</a></li>
                <li><a href="?open=Basis-Aturan" title="Basis-Aturan">Basis Aturan</a></li>
                <li><a href="?open=Laporan" title="Laporan">Laporan</a></li>
                <li><a href="?open=Logout" title="Logout (Exit)">Logout</a></li>
            <?php else: ?>
                <li><a href="?open=Halaman-Utama" title="Halaman Utama" id="beranda">Beranda</a></li>
                <li><a href="?open=konsultasi_gejala_penyakit" title="Konsultasi" id="diagnosa">Diagnosa</a></li>
                <li><a href="?open=login-admin" title="Login Admin">Login Admin</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Menandai tautan yang aktif berdasarkan parameter URL
    document.addEventListener("DOMContentLoaded", function() {
        const currentPage = window.location.search;
        const links = document.querySelectorAll("nav ul li a");
        
        links.forEach(function(link) {
            if (link.getAttribute("href") === currentPage) {
                link.classList.add("active");
            }
        });
    });
</script>
</body>
</html>
