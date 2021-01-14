<?php
    session_start();
    include "../../koneksi.php";
    if(!isset($_SESSION["username"])){
        header("Location: ../index.php");
        exit;
    }
    if($_SESSION["role"] == "user"){
        header("Location: ../user/index.php");
        exit;
    }

    $username = $_SESSION["username"];
    $display  = $_SESSION["display"];
    $result = mysqli_query($conn, "SELECT `user`.`id`, `data_user`.`nama` FROM `user`
        LEFT JOIN `data_user` ON `data_user`.`id` = `user`.`id`
        WHERE `data_user`.`id` = '$username'");

    $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Tambah User</title>
    <?php include "snippets/head.php"; ?>
</head>
<body>
    <?php include "snippets/sidenav.php"; ?>
    <div class="main">
        <div class="title">
            <h2>Tambah User</h2>
        </div>
        <div class="isi container">
            <div class="konten">
            <form action="../action.php" method="POST">
                <table id="tabeltambah">
                    <tr>
                        <th>NPT</th>
                        <td><input type="number" name="npt" id="" placeholder="41170001"></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td><input type="text" name="nama" placeholder="Abdul Baits"></td>
                    </tr>
                    <tr>
                        <th>E-Mail</th>
                        <td><input type="email" name="email" placeholder="example@stmkg.ac.id"></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><textarea name="alamat" rows="4" cols="30"></textarea></td>
                    </tr>
                    <tr>
                        <th>Angkatan</th>
                        <td>
                            <select name="angkatan" id="">
                            <?php $angkatan=mysqli_query($conn, "SELECT * FROM `angkatan`");?>
                                <option value="">Select Angkatan</option>
                                <?php while ($row=mysqli_fetch_array($angkatan)){ ?>
                                <option value="<?php echo $row['tahun'];?>"><?php echo $row['tahun'];?></option>
                            <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td>
                            <select name="kelas" id="">
                            <?php $kelas=mysqli_query($conn, "SELECT * FROM `kelas`");?>
                                <option value="">Select Kelas</option>
                                <?php while ($row=mysqli_fetch_array($kelas)){ ?>
                                <option value="<?php echo $row['nama_kelas'];?>"><?php echo $row['nama_kelas'];?></option>
                            <?php } ?>
                            </select> 
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Tambah" name="tambahuser" class="btn btn-info" style="margin-top: 10px;"></td>
                    </tr>
                </table>
            </form>
            </div>
        </div>
    </div>
</body>
</html>