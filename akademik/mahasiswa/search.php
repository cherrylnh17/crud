<?php 
require_once '../koneksi/koneksi.php';

// Cek session
if(!isset($_SESSION['username'])){
    header("Location: ../index.php");
    exit;
}

//mengambil data mahasiswa
$search = $_GET['nama'];
$safe = $conn->real_escape_string($search);

$result = $conn->query("SELECT * FROM mahasiswa WHERE nama LIKE '%$safe%'");


//nomot untuk bagian tabel
$nomor = 1


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
        <a href="../dashboard/index.php">🏠 Dashboard</a>
        <a href="#" class="active">👨‍🎓 Mahasiswa</a>
        <a href="../logout/index.php">🔐 Logout</a>
    </div>

    <!-- Konten -->
    <div class="content mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Data Mahasiswa</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">+ Tambah Mahasiswa</button>
        </div>
        <div class="search-mahasiswa d-flex">
            <form action="search.php" class="d-flex" role="search" method="GET">
                <input class="form-control me-2 form-control-sm" type="search" name="nama" placeholder="Nama Mahasiswa" aria-label="Search"/>
                <button class="btn btn-outline-success btn-sm" type="submit">Cari</button>
            </form>
        </div>

        <div class="table-responsive shadow-sm bg-white p-3 rounded">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Prodi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Proses looping data -->
                    <?php while($mahasiswa = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $nomor ?></td>
                        <td><?= $mahasiswa['nama'] ?></td>
                        <td><?= $mahasiswa['nim'] ?></td>
                        <td><?= $mahasiswa['prodi'] ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modal-<?= $mahasiswa['id'] ?>">Edit</button>
                            <a href="delete_mahasiswa.php?id=<?= $mahasiswa['id'] ?>" class="btn btn-sm btn-danger" onclick="confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    
                    <div class="modal fade" id="modal-<?= $mahasiswa['id'] ?>" tabindex="-1" aria-labelledby="modal-dosen-label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modal-dosen-label"><?= $mahasiswa['nama'] ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="data-diri">
                                        <div class="biodata-dosen row m-0 gap-2">
                                            <form action="edit_mahasiswa.php" method="POST">
                                                <input type="hidden" value="<?= $mahasiswa['id'] ?>" name="id">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama</label>
                                                    <input type="text" name="nama" class="form-control" value="<?= $mahasiswa['nama'] ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">NIM</label>
                                                    <input type="text" name="nim" class="form-control" value="<?= $mahasiswa['nim'] ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Prodi</label>
                                                    <select name="prodi" class="form-select" required>
                                                        <option value="Bisnis Digital" <?= $mahasiswa['prodi'] == 'Bisnis Digital' ? 'selected' : '' ?>>Bisnis Digittal</option>
                                                        <option value="Teknik Informatika" <?= $mahasiswa['prodi'] == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
                                                        <option value="Sistem Informasi"  <?= $mahasiswa['prodi'] == 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
                                                        <option value="Teknik Elektro"  <?= $mahasiswa['prodi'] == 'Teknik Elektro' ? 'selected' : '' ?>>Teknik Elektro</option>
                                                    </select>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Ubah Data</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <?php $nomor++ ?>
                    <?php endwhile ; ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal Tambah Mahasiswa -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="add_mahasiswa.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" name="nim" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prodi</label>
                        <select class="form-select" name="prodi" required>
                            <option value="Bisnis Digital" selected>Bisnis Digittal</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Teknik Elektro">Teknik Elektro</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Bootstrap JS + Sidebar Toggle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/sidebar.js"></script>
</body>
</html>
