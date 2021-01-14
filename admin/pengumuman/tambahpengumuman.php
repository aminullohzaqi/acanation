<?php
    session_start();
    include "../../koneksi.php";
    if(!isset($_SESSION["username"])){
        header("Location: ../../index.php");
        exit;
    }
    if($_SESSION["role"] == "user"){
        header("Location: ../../user/index.php");
        exit;
    }

    $username = $_SESSION["username"];
    $display  = $_SESSION["display"];

    $result = mysqli_query($conn, "SELECT `user`.`id`, `data_user`.`nama` FROM `user`
        LEFT JOIN `data_user` ON `data_user`.`id` = `user`.`id`
        WHERE `data_user`.`id` = '$username'");

    $row = mysqli_fetch_assoc($result);

    $pengumuman = mysqli_query($conn, "SELECT * FROM `data_user`
        LEFT JOIN `pengumuman` ON `pengumuman`.`id_admin` = `data_user`.`id`
	    WHERE `pengumuman`.`judul` != 'NULL'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pengumuman</title>
    <?php include "snippets/head.php"; ?>
</head>
<body>
    <?php include "snippets/sidenav.php"; ?>
    <div class="main">
        <div class="title">
            <h2>Pengumuman</h2>
        </div>
        <div class="isi container">
            <div class="konten">
                <form action="../action.php" method="post">
                    <table id="tabeltambah">
                        <tr>
                            <th>Judul</th>
                            <td><input type="text" name="judul" id=""></td>
                        </tr>
                        <tr>
                            <th>Isi</th>
                            <td><textarea name="isi" id="" cols="30" rows="10"></textarea></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="tambahpengumuman" value="Tambahkan" class="btn btn-info" style="margin-top: 10px;"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    
    <div>
        
    </div>
</body>
</html>