<?php 
require_once '../koneksi/koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    //Jika ada yang kosong kembalikan ke mahasiswa.php
    if(empty($nama) || empty($nim) || empty($prodi)){
        echo "<script>
        alert('Gagal Menambahkan Data!');
        window.location.href = 'index.php';
        </script>";
        exit;
    }

    //melakukan prepare query
    $stmt = $conn->prepare("INSERT INTO mahasiswa (nama, nim,prodi) VALUES (?,?,?)");
    //Bind param agar terhindar dari sql injection
    $stmt->bind_param("sss", $nama, $nim,$prodi);
    $stmt->execute();

    header("Location: index.php");
}




?>