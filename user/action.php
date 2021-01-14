<?php
    session_start();
    include "../koneksi.php";

    $username = $_SESSION["username"];
    $angkatan = $_SESSION["angkatan"];
    $kelas    = $_SESSION["kelas"];
    $display  = $_SESSION["display"];

    if(isset($_POST['tambahforum'])){
        $judul      = $_POST["judul"];
        $isi        = $_POST["isi"];

        $sql = "INSERT INTO `forum` (`kelas`, `angkatan`, `id_user`, `judul`, `isi`)
        VALUES ('".$kelas."', '".$angkatan."', '".$username."', '".$judul."', '".$isi."')";
        $query = mysqli_query($conn, $sql);

        if ($query){
            echo "<script>
                document.location.href='forum/forumkelas.php';
            </script>";
        }

        else {
            echo"Error:" .$sql. "<br>". mysqli_error($conn);
        }
    }
    if(isset($_GET['tambahkomentar'])){
        $id      = $_GET["id"];
        $komentar= $_GET["komentar"];

        $sql = "INSERT INTO `komentar` (`id_forum`, `id_user`, `komentar`)
        VALUES ('".$id."', '".$username."', '".$komentar."')";
        $query = mysqli_query($conn, $sql);

        if ($query){
            echo "<script>
                document.location.href='forum/detail.php?id=$id';
            </script>";
        }

        else {
            echo"Error:" .$sql. "<br>". mysqli_error($conn);
        }
    }
?>
