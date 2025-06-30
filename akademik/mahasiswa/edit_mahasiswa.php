<?php 
require_once '../koneksi/koneksi.php';

if(empty($_POST)){
    echo "<script>
        alert('Mohon masukan data!');
        window.location.href = 'index.php';
        </script>";
    exit;
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
    $dataLama = $conn->query("SELECT * FROM mahasiswa WHERE id = $id")->fetch_assoc();

    $nama = $_POST['nama'] ?? $dataLama['nama'];
    $nim = $_POST['nim'] ?? $dataLama['nim'];
    $prodi = $_POST['prodi'] ?? $dataLama['prodi'];

    
    //cek apakah ada data yangkosong
    if(empty($nama) || empty($nim) || empty($prodi)){
        echo "<script>
        alert('Gagal Mengubah Data!');
        window.location.href = 'index.php';
        </script>";
        exit;
    }


    $stmt = $conn->prepare("UPDATE mahasiswa SET nama = ?,nim = ?, prodi = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nama, $nim, $prodi, $id);
    $stmt->execute();

    header("Location: index.php");
}




?>