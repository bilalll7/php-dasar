<?php 
require 'functions.php';

if( isset($_POST["submit"])){
    


    //check data apakah data berhasil ditambhakan atau tidak
    // if(mysqli_affected_rows($conn) > 0 ){
    //     echo"Berhasil";
    // }else{
    //     echo "gagal";
    //     echo"<br>";
    //     echo mysqli_error($conn);
    // }
    if (tambah($_POST) > 0){

        echo "<script>
        alert('data berhasil ditambahkan');
        document.location.href = 'index.php';
        </script>
        ";
    }else {
        echo "<script>
        alert('data gagal ditambahkan');
        document.location.href = 'index.php';
        </script>
        ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="nrp">NRP :</label>
                <input type="text" name="nrp" id="nrp" required>
            </li>
            <li>
                <label for="nama">NAMA :</label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" required>
            </li>
            <li>
                <label for="jurusan">Jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" required>
            </li>
            <li>
                <label for="gambar">Gambar :</label>
                <input type="text" name="gambar" id="gambar" required>
            </li>
            <li>
                <button type="submit" name="submit">Tambah Data !</button>
            </li>
        </ul>
    </form>
</body>
</html>