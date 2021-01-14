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
	    WHERE `pengumuman`.`judul` != 'NULL' ORDER BY `tanggal` DESC");
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
            <div class="d-flex justify-content-end">
                <a href="tambahpengumuman.php">
                    <i class="fa fa-lg fa-plus-square" aria-hidden="true">Tambah Pengumuman</i>
                </a>
                <br>
            </div>
            <table id="tabelpengumuman">
                <?php while ($row=mysqli_fetch_array($pengumuman)){ ?>
                <tr>
                    <td>
                        <img class="img-komen" src="../../img/<?php echo $row["display"] ?>" alt="">
                        <br><br>
                        <strong><?php echo $row["nama"]?></strong>
                        <br>
                        <em><?php echo $row["tanggal"]?></em>
                        <br>
                    </td>
                    <td>
                        <div>
                        <h3><?php echo $row["judul"]?></h3>
                        <p><?php echo $row["isi"]?></p>
                        
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    
    <div>
        
    </div>
</body>
</html>