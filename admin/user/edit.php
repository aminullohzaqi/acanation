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
    <title>Edit User</title>
    <?php include "snippets/head.php"; ?>
</head>
<body>
    <?php include "snippets/sidenav.php"; ?>
    <div class="main">
        <div class="title">
            <h2>Edit User</h2>
        </div>
        <div class="isi container">
            <div class="konten">
            <form action="../action.php" method="GET">
                <table id="tabeltambah">
                    <tr>
                        <th>NPT</th>
                        <td><input type="number" name="id" id="" value="<?php echo $row_nama["id"];?>"></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td><input type="text" name="nama" id="" value="<?php echo $row_nama["nama"];?>"></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input type="text" name="email" id="" value="<?php echo $row_nama["email"];?>"></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><input type="text" name="alamat" id="" value="<?php echo $row_nama["alamat"];?>"></td>
                    </tr>
                    <tr>
                        <th>Angkatan</th>
                        <td><input type="text" name="angkatan" id="" value="<?php echo $row_nama["angkatan"];?>"></td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td><input type="text" name="kelas" id="" value="<?php echo $row_nama["kelas"];?>"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="edituser" value="Edit" class="btn btn-info" style="margin-top: 10px;"></td>
                    </tr>
                </table>
            </form>
            </div>
        </div>
    </div>
</body>