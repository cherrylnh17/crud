<?php
$conn = mysqli_connect("localhost", "root", "", "datamahasiswabaru");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[]= $row;
    }

    return $rows;
}



function tambah($data){
    global $conn;


    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    

    $gambar = upload();
    if(!$gambar){
        return false;
    }



    $query = "INSERT INTO mahasiswa
            VALUES
            ('', '$nim', '$nama', '$email', '$jurusan', '$gambar')
    
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows(($conn));
}


function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tempat = $_FILES['gambar']['tmp_name'];

    //cek apakah ada gambar yng di upload atau tidak

if($error === 4){
    echo "<script>
    alert('Pilih gambar terlebih dahulu');
    
    </script>";
    return false;
}

$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
$ekstensiGambar = explode('.', $namaFile);
$ekstensiGambar = strtolower(end($ekstensiGambar));

if( !in_array($ekstensiGambar, $ekstensiGambarValid)){
    echo "<script>
    alert('file tidak valid');
    </script>";
    return false;
}

if( $ukuranFile > 1000000){
    echo "<script>
    alert('Ukuran terlalu besar');
    
    </script>";
    return false;
}

/* //Membuat nama file yg diupload di database bernama acak agar tidak ada yg sama
$namaFilebaru= uniqid();
$namaFilebaru.= '.';
$namaFilebaru.= $ekstensiGambar;
*/

/* //Membuat nama file yg diupload di database bernama acak agar tidak ada yg sama
move_uploaded_file('$tempat', ''. $namaFilebaru);
return $namaFilebaru;
*/

move_uploaded_file('$tempat', ''. $namaFile);
return $namaFile;

}



function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows(($conn));
}

function ubah($data){
    global $conn;
    $id = $data["id"];
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $gambar = htmlspecialchars($data["gambar"]);
    $jurusan = htmlspecialchars($data["jurusan"]);


    $query = "UPDATE mahasiswa SET
            nim = '$nim',
            nama = '$nama',
            email = '$email',
            gambar = '$gambar',
            jurusan = '$jurusan'
            WHERE id = $id;
    ";
    
    

    mysqli_query($conn, $query);

    return mysqli_affected_rows(($conn));
}


function cari($keyword){
    $query = "SELECT * FROM mahasiswa
    WHERE
    nama LIKE '%$keyword%' OR
    nim LIKE '%$keyword%' OR
    jurusan LIKE '%$keyword%'
    ";
    return query($query);
}





?>
