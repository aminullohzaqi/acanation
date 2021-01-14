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

    $angkatan = $_GET['angkatan'];
    $kelas = $_GET['kelas'];
    $semester = $_GET['semester'];
    $matkul = $_GET['matkul'];

    $query_matkul = mysqli_query($conn, "SELECT * FROM `matkul` WHERE `id` = '$matkul'");
    $row_matkul = mysqli_fetch_assoc($query_matkul);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Nilai Taruna</title>
    <?php include "snippets/head.php"; ?>
</head>
<body>
    <?php include "snippets/sidenav.php"; ?>
    <div class="main">
        <div class="title">
            <h2>Nilai Taruna</h2>
        </div>
        <div class="isi container">
            <div class="konten">
                <div class="d-flex justify-content-end">
                    <a href="tambahnilai.php">
                        <i class="fa fa-sm fa-plus-square" aria-hidden="true">Tambah Nilai</i>
                    </a>
                    <br>
                </div>
                <div>
                    <table id="tabeljudul">
                        <tr>
                            <th>Kelas</th>
                            <td><?php echo $kelas;?></td>
                        </tr>
                        <tr>
                            <th>Angkatan</th>
                            <td><?php echo $angkatan;?></td>
                        </tr>
                        <tr>
                            <th>Mata Kuliah</th>
                            <td><?php echo $row_matkul["matakuliah"];?></td>
                        </tr>
                    </table>
                </div>
                <br>
                <div>
                    <?php 
                        $query_daftar = mysqli_query($conn, "SELECT * FROM `matkul`
                        LEFT JOIN `nilai` ON `nilai`.`id_matkul` = `matkul`.`id`
                        LEFT JOIN `data_user` ON `nilai`.`id_user` = `data_user`.`id`
                        WHERE `matkul`.`id` = '$matkul' AND `data_user`.`angkatan` = '$angkatan' AND `data_user`.`kelas` = '$kelas'
                        ORDER BY `data_user`.`id` ASC");
                    ?>
                    <table id="tabel">
                        <tr>
                            <th>Nama Taruna</th>
                            <th>NPT</th>
                            <th>Kehadiran</th>
                            <th>Tugas</th>
                            <th>UTS</th>
                            <th>UAS</th>
                            <th>Edit</th>
                        </tr>
                        <?php while ($row=mysqli_fetch_array($query_daftar)){ ?>
                        <tr>
                            <td><?php echo $row["nama"]?></td>
                            <td><?php echo $row["id_user"]?></td>
                            <td><?php echo $row["kehadiran"]?></td>
                            <td><?php echo $row["tugas"]?></td>
                            <td><?php echo $row["uts"]?></td>
                            <td><?php echo $row["uas"]?></td>
                            <td>
                                <a href="geteditform.php?nama=<?php echo $row["id_user"];?>&matkul=<?php echo $matkul;?>&kelas=<?php echo $kelas;?>&angkatan=<?php echo $angkatan;?>">
                                    <i class="fa fa-lg fa-pencil" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <?php }?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>