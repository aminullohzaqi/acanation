<?php
    session_start();
    include "../koneksi.php";

    $username = $_SESSION["username"];

    if(isset($_GET["tambahnilai"])){
        $nama = $_GET["nama"];
        $matkul = $_GET["matkul"];
        $sks = $_GET["sks"];
        $kehadiran = $_GET["kehadiran"];
        $tugas = $_GET["tugas"];
        $uts = $_GET["uts"];
        $uas = $_GET["uas"];
        $nilai_kehadiran = $kehadiran * 0.1;
        $nilai_tugas = $tugas * 0.2;
        $nilai_uts = $uts * 0.3;
        $nilai_uas = $uas * 0.4;
        $nilai = $nilai_kehadiran+$nilai_tugas+$nilai_uts+$nilai_uas;
        if($nilai >= 87.6){
            $nilai = 4;
        }
        else if($nilai >= 80.1 && $nilai <= 87.5){
            $nilai = 3.5;
        }
        else if($nilai >= 70.1 && $nilai <= 80.0){
            $nilai = 3;
        }
        else if($nilai >= 60.1 && $nilai <= 70.0){
            $nilai = 2.5;
        }
        else if($nilai >= 50.1 && $nilai <= 60.0){
            $nilai = 2;
        }
        else if($nilai >= 40.1 && $nilai <= 50.0){
            $nilai = 1;
        }
        else if($nilai >= 0.0 && $nilai <= 40.0){
            $nilai = 0;
        }

        $bobot = $nilai * $sks;
        $simbol = "";
        if($nilai == 4){
            $simbol = "A";
        }
        else if($nilai == 3.5){
            $simbol = "A-";
        }
        else if($nilai == 3){
            $simbol = "B";
        }
        else if($nilai == 2.5){
            $simbol = "B-";
        }
        else if($nilai == 2){
            $simbol = "C";
        }
        else if($nilai == 1){
            $simbol = "D";
        }
        else if($nilai == 0){
            $simbol = "E";
        }

        $sql = "INSERT INTO `nilai` (`id_user`, `id_matkul`, `kehadiran`, `tugas`, `uts`, `uas`, `nilaimutu`, `bobot`, `nilai`)
            VALUES ('".$nama."', '".$matkul."', '".$kehadiran."', '".$tugas."', '".$uts."', '".$uas."', '".$nilai."', '".$bobot."', '".$simbol."')";
        $query = mysqli_query($conn, $sql);

        if ($query){
            echo "<script>
                alert('Berhasil Menambah Nilai');
                document.location.href='nilai/tambahnilai.php';
            </script>";
        }
        else {
            echo"Error:" .$sql. "<br>". mysqli_error($conn);
        }
    }

    if(isset($_GET["editnilai"])){
        $id = $_GET["id"];
        $nama = $_GET["nama"];
        $matkul = $_GET["matkul"];
        $sks = $_GET["sks"];
        $kehadiran = $_GET["kehadiran"];
        $tugas = $_GET["tugas"];
        $uts = $_GET["uts"];
        $uas = $_GET["uas"];
        $nilai_kehadiran = $kehadiran * 0.1;
        $nilai_tugas = $tugas * 0.2;
        $nilai_uts = $uts * 0.3;
        $nilai_uas = $uas * 0.4;
        $nilai = $nilai_kehadiran+$nilai_tugas+$nilai_uts+$nilai_uas;
        if($nilai >= 87.6){
            $nilai = 4;
        }
        else if($nilai >= 80.1 && $nilai <= 87.5){
            $nilai = 3.5;
        }
        else if($nilai >= 70.1 && $nilai <= 80.0){
            $nilai = 3;
        }
        else if($nilai >= 60.1 && $nilai <= 70.0){
            $nilai = 2.5;
        }
        else if($nilai >= 50.1 && $nilai <= 60.0){
            $nilai = 2;
        }
        else if($nilai >= 40.1 && $nilai <= 50.0){
            $nilai = 1;
        }
        else if($nilai >= 0.0 && $nilai <= 40.0){
            $nilai = 0;
        }

        $bobot = $nilai * $sks;
        $simbol = "";
        if($nilai == 4){
            $simbol = "A";
        }
        else if($nilai == 3.5){
            $simbol = "A-";
        }
        else if($nilai == 3){
            $simbol = "B";
        }
        else if($nilai == 2.5){
            $simbol = "B-";
        }
        else if($nilai == 2){
            $simbol = "C";
        }
        else if($nilai == 1){
            $simbol = "D";
        }
        else if($nilai == 0){
            $simbol = "E";
        }

        $sql = "UPDATE `nilai` SET id_user='$nama', id_matkul='$matkul', kehadiran='$kehadiran', 
                tugas='$tugas', uts='$uts', uas='$uas', nilaimutu='$nilai', bobot='$bobot', nilai='$simbol' 
                WHERE id='$id'";
        $query	= mysqli_query($conn,$sql);

          if ($query){
            echo "<script>
                alert('Berhasil Mengubah Nilai');
                document.location.href='nilai/editnilai.php';
            </script>";
          }
          else {
            echo"Error:" .$sql. "<br>". mysqli_error($conn);
          }
    }

    if(isset($_POST['tambahmatkul'])){
        $id         = $_POST["id"];
        $matakuliah = $_POST["matakuliah"];
        $sks        = $_POST["sks"];
        $semester   = $_POST["semester"];

        $sql = "INSERT INTO `matkul` (`id`, `matakuliah`, `sks`, `semester`)
        VALUES ('".$id."', '".$matakuliah."', '".$sks."', '".$semester."')";
        $query = mysqli_query($conn, $sql);

        if ($query){
            echo "<script>
                alert('Berhasil Menambah Mata Kuliah');
                document.location.href='matkul/daftar.php';
            </script>";
        }

        else {
            echo"Error:" .$sql. "<br>". mysqli_error($conn);
        }
    }

    if(isset($_POST['tambahuser'])){
        $npt        = $_POST["npt"];
        $nama       = $_POST["nama"];
        $email      = $_POST["email"];
        $alamat     = $_POST["alamat"];
        $angkatan   = $_POST["angkatan"];
        $kelas      = $_POST["kelas"];

        $sql = "INSERT INTO `user` (`id`, `password`, `role`)
        VALUES ('".$npt."', '".$npt."', 'user')";
        $query = mysqli_query($conn, $sql);

        $sql2 = "INSERT INTO `data_user` (`id`, `nama`, `email`, `alamat`, `angkatan`, `kelas`, `display`)
        VALUES ('".$npt."', '".$nama."', '".$email."', '".$alamat."', '".$angkatan."', '".$kelas."', 'nophoto.jpg')";
        $query2 = mysqli_query($conn, $sql2);


        if ($query2){
            echo "<script>
                alert('Berhasil Menambah User');
                document.location.href='user/userlist.php';
            </script>";
        }

        else {
            echo"Error:" .$sql. "<br>". mysqli_error($conn);
        }
    }

    if(isset($_GET["edituser"])){
        $id = $_GET["id"];
        $nama = $_GET["nama"];
        $email = $_GET["email"];
        $alamat = $_GET["alamat"];
        $angkatan = $_GET["angkatan"];
        $kelas = $_GET["kelas"];
    
        $sql = "UPDATE `data_user` SET id='$id', nama='$nama', email='$email', 
                alamat='$alamat', angkatan='$angkatan', kelas='$kelas' WHERE id='$id'";
        $query	= mysqli_query($conn,$sql);

          if ($query){
            echo "<script>
                    alert('User Berhasil Diubah');
                    document.location.href='user/getuser.php?id=$_GET[id]';
                </script>";
          }
          else {
            echo"Error:" .$sql. "<br>". mysqli_error($conn);
          }
    }

    if(isset($_POST['tambahpengumuman'])){
        $judul  = $_POST["judul"];
        $isi    = $_POST["isi"];

        $sql = "INSERT INTO `pengumuman` (`id_admin`, `judul`, `isi`)
        VALUES ('".$username."', '".$judul."', '".$isi."')";
        $query = mysqli_query($conn, $sql);

        if ($query){
            echo "<script>
                alert('Berhasil Menambahkan Pengumuman');
                document.location.href='pengumuman/pengumuman.php';
            </script>";
        }

        else {
            echo"Error:" .$sql. "<br>". mysqli_error($conn);
        }
    }
?>