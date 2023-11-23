<?php
//konek ke db
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data){
global $conn;

    $nrp =htmlspecialchars($_POST["nrp"]);
    $nama = htmlspecialchars($_POST["nama"]);
    $email = htmlspecialchars($_POST["email"]);
    $jurusan = htmlspecialchars($_POST["jurusan"]);


   //upload gambar
   $gambar = upload();
   if( !$gambar ){
    return false;
   }

    
    $query = "INSERT INTO mahasiswa 
              VALUES
                ('','$nrp','$nama','$email','$jurusan','$gambar')";

    mysqli_query($conn , $query);

    return mysqli_affected_rows($conn);
}

function upload(){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];  
    
    //check apakah tidak ada gambar yg diupload
    if( $error === 4 ){
        echo "<script>
        alert('Silahkan Pilih Gambar!');
        </script>";
        return false;
    }
    //check apkakah gambar atau bukan
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
      echo "<script>
                alert('Yang anda upload bukan gambar!');
                </script>";
                return false;
    }
    //check jika ukurannya terlalu besar
    if( $ukuranFile > 100000000){
        echo "<script>
                alert('Ukuran gambar terlalu besar!');
                </script>";
                return false;
    }
    //siap upload gambar
    //generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/', $namaFileBaru);
    return $namaFileBaru;
}

function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;

    $id = ($_POST["id"]);
    $nrp =htmlspecialchars($_POST["nrp"]);
    $nama = htmlspecialchars($_POST["nama"]);
    $email = htmlspecialchars($_POST["email"]);
    $jurusan = htmlspecialchars($_POST["jurusan"]);

    $gambarLama = htmlspecialchars($_POST["gambarLama"]);
    
    if($_FILES['gambar']['error'] === 4 ){
        $gambar = $gambarLama;
    }else{
        $gambar = upload();
    }

   

    
    $query = "UPDATE mahasiswa SET
              nrp ='$nrp',
              nama = '$nama',
              email = '$email',
              jurusan = '$jurusan',
              gambar = '$gambar'
              WHERE id = $id
              ";

    mysqli_query($conn , $query);

    return mysqli_affected_rows($conn);   
}

function cari($keyword){
    $query = "SELECT * FROM mahasiswa
                WHERE 
            nama LIKE '%$keyword%' OR
            nrp LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'
            ";
            return query($query);
}
?>