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
    $id = $_GET['id'];
    $username = $_SESSION["username"];
    $display  = $_SESSION["display"];
    $result = mysqli_query($conn, "SELECT `user`.`id`, `data_user`.`nama` FROM `user`
        LEFT JOIN `data_user` ON `data_user`.`id` = `user`.`id`
        WHERE `data_user`.`id` = '$username'");

    $row = mysqli_fetch_assoc($result);

    $query_nama = mysqli_query($conn, "SELECT * FROM `data_user` WHERE `id` = '$id'");
    $row_nama = mysqli_fetch_assoc($query_nama);
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>List User</title>
    <?php include "snippets/head.php"; ?>
</head>
<body>
    <?php include "snippets/sidenav.php"; ?>
    <div class="main">
        <div class="title">
            <h2>User</h2>
        </div>
        <div class="isi container">
            <div class="konten">
            <table id="tabeltambah">
                <tr>
                    <th>NPT</th>
                    <td><?php echo $row_nama["id"];?></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><?php echo $row_nama["nama"];?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $row_nama["email"];?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?php echo $row_nama["alamat"];?></td>
                </tr>
                <tr>
                    <th>Angkatan</th>
                    <td><?php echo $row_nama["angkatan"];?></td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td><?php echo $row_nama["kelas"];?></td>
                </tr>
                <tr>
                    <td><a href="edit.php?id=<?php echo $row_nama["id"];?>" class="btn btn-info" style="margin-top: 10px;">Edit User</a></td>
                </tr>
            </table>
            </div>
        </div>
    </div>
</body>