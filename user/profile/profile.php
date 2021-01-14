<?php
    session_start();
    include "../../koneksi.php";
    if(!isset($_SESSION["username"])){
        header("Location: ../.../index.php");
        exit;
    }
    if($_SESSION["role"] == "admin"){
        header("Location: ../../admin/index.php");
        exit;
    }

    $username = $_SESSION["username"];
    $display  = $_SESSION["display"];
    $result = mysqli_query($conn, "SELECT `user`.`id`, `data_user`.`nama` FROM `user`
        LEFT JOIN `data_user` ON `data_user`.`id` = `user`.`id`
        WHERE `data_user`.`id` = '$username'");

    $row = mysqli_fetch_assoc($result);

    $profile = mysqli_query($conn, "SELECT * FROM `data_user` WHERE `id` = '$username'");
    $row_profile = mysqli_fetch_assoc($profile);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>Profile</title>
    <?php include "snippets/head.php" ?>
</head>
<body>
    <?php include "snippets/sidenav.php" ?>
    <div class="main">
        <div class="title">
            <h2>Profile</h2>
        </div>
        <div class="isi container">
            <div class="konten">
            <div class="image d-flex">
                <div class="foto">
                    <img src="../../img/<?= $row_profile["display"]; ?>" height="80">
                </div>
                <div class="link">
                    <a href="editdisplay.php?gambar=<?php echo $row_profile["display"];?>&id=<?php echo $row_profile["id"];?>">
                        <i class="fa fa-lg fa-pencil-square" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            
            <div class="profil">
                <table id="tabelprofile">
                    <tr>
                        <th>Nama</th>
                        <td><?php echo $row_profile["nama"]?></td>
                    </tr>
                    <tr>
                        <th>NPT</th>
                        <td><?php echo $row_profile["id"]?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $row_profile["email"]?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><?php echo $row_profile["alamat"]?></td>
                    </tr>
                    <tr>
                        <th>Angkatan</th>
                        <td><?php echo $row_profile["angkatan"]?></td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td><?php echo $row_profile["kelas"]?></td>
                    </tr>
                </table>
            </div>
            
            </div>
        </div>
    </div>
</body>
