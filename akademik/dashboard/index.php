<?php 
session_start();
require_once '../koneksi/koneksi.php';

// Cek session
if(!isset($_SESSION['username'])){
    header("Location: ../index.php");
    exit;
}


$mahasiswa = $conn->query("SELECT COUNT(*) as total FROM mahasiswa")->fetch_assoc();


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Mahasiswa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <button class="btn btn-dark d-md-none" id="toggleSidebar">
            ☰
            </button>
            <a class="navbar-brand ms-2" href="#">🎓 KampusKu</a>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="#" class="active">🏠 Dashboard</a>
        <a href="../mahasiswa/index.php">👨‍🎓 Mahasiswa</a>
        <a href="../logout/index.php">🔐 Logout</a>
    </div>

    <!-- Konten -->
    <div class="content mt-5">
        <h3 class="mb-4">Selamat Datang, Admin</h3>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white shadow position-relative">
                    <div class="card-body text-center">
                        <h5>Total Mahasiswa</h5>
                        <p class="fs-3"><?= $mahasiswa['total'] ?></p>
                        <span class="card-icon">🎓</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS + Sidebar Toggle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/sidebar.js"></script>
</body>
</html>
