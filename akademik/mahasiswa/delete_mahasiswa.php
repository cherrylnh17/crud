<?php 
require_once '../koneksi/koneksi.php';

$id = $_GET['id'];

//cek apakah id ada atau tidak
if(empty($id)){
    echo "<script>
    alert('Mahasiswa tidak ditemukan!');
    window.location.href = 'index.php';
    </script>";
}


$stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id = ?");
$stmt->bind_param('i', $id);
if($stmt->execute()){
    echo "<script>
    alert('Data Dosen Berhasil Dihapus!');
    window.location.href = 'index.php';
    </script>";
    exit;
}


?>