<?php 
session_start();
require_once 'koneksi/koneksi.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $dataAkun = $conn->query("SELECT * FROM user")->fetch_assoc();

    $username = $_POST['username'];
    $email = $_POST['email'];

    if($email == $dataAkun['email']){
        echo "<script>
        alert('Email Sudah digunakan!');
        window.location.href = 'index.php';
        </script>";
        exit;
    }

    $password = $_POST['password'];
    $errors = [];

    

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (?,?,?)");
    $stmt->bind_param("sss", $username, $email, $password_hash);
    $stmt->execute();

    header("Location: index.php");
    exit;
}




?>