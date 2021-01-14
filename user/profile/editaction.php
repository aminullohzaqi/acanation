<?php
    session_start();
    include "../../koneksi.php";

    $username = $_SESSION["username"];
    $gambarLama = $_POST["gambar"];
	
	// cek apakah user pilih gambar baru atau tidak
	if( $_FILES['gambar']['error'] === 4 ) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}
	
	$query = "UPDATE `data_user` SET display = '$gambar' WHERE id = '$username'";

    mysqli_query($conn, $query);
    $_SESSION["display"] = $gambar;
    
    if($gambar = upload()){
        echo "<script>
            alert('Display Berhasil Diubah');
            document.location.href='profile.php';
        </script>";
    }

    function upload() {

        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];

        // cek apakah tidak ada gambar yang diupload
        if( $error === 4 ) {
            echo "<script>
                    alert('pilih gambar terlebih dahulu!');
                </script>";
            return false;
        }

        // cek apakah yang diupload adalah gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
            echo "<script>
                    alert('yang anda upload bukan gambar!');
                </script>";
            return false;
        }

        // cek jika ukurannya terlalu besar
        if( $ukuranFile > 1000000 ) {
            echo "<script>
                    alert('ukuran gambar terlalu besar!');
                </script>";
            return false;
        }

        // lolos pengecekan, gambar siap diupload
        // generate nama gambar baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, '../../img/' . $namaFileBaru);

        return $namaFileBaru;
    }
?>