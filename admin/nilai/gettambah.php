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
    $nama = $_GET['nama'];
    $semester = $_GET['semester'];
    $matkul = $_GET['matkul'];

    $query_nama = mysqli_query($conn, "SELECT * FROM `data_user` WHERE `id` = '$nama'");
    $row_nama = mysqli_fetch_assoc($query_nama);

    $query_matkul = mysqli_query($conn, "SELECT * FROM `matkul` WHERE `id` = '$matkul'");
    $row_matkul = mysqli_fetch_assoc($query_matkul);

    $query_nilai = mysqli_query($conn, "SELECT * FROM `nilai` WHERE `id_user` = '$nama' AND `id_matkul` = '$matkul'");
    $row_nilai = mysqli_fetch_assoc($query_nilai);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Nilai</title>
    <?php include "snippets/head.php"; ?>
</head>
<body>
    <?php include "snippets/sidenav.php"; ?>
    <div class="main">
        <div class="title">
            <h2>Tambah Nilai</h2>
        </div>
        <div class="isi container">
            <div class="konten">
                <div>
                    <table id="tabeljudul">
                        <tr>
                            <th>Nama</th>
                            <td><?php echo $row_nama["nama"];?></td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td><?php echo $kelas;?></td>
                        </tr>
                        <tr>
                            <th>Angkatan</th>
                            <td><?php echo $angkatan; ?></td>
                        </tr>
                        <tr>
                            <th>Mata Kuliah</th>
                            <td><?php echo $row_matkul["matakuliah"]; ?></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <form action="../action.php" method="GET">
                    <table id="tabeltambah">
                        <tr>
                            <td><input type="hidden" name="nama" value="<?php echo $nama; ?>"></td>
                            <td><input type="hidden" name="matkul" value="<?php echo $matkul; ?>"></td>
                            <td><input type="hidden" name="sks" value="<?php echo $row_matkul["sks"];?>"></td>
                        </tr>
                        <tr>
                            <th>Kehadiran</th>
                            <td><input type="number" name="kehadiran" id="" value="<?php echo $row_nilai["kehadiran"];?>"></td>
                        </tr>
                        <tr>
                            <th>Tugas</th>
                            <td><input type="number" name="tugas" id="" value="<?php echo $row_nilai["tugas"];?>"></td>
                        </tr>
                        <tr>
                            <th>UTS</th>
                            <td><input type="number" name="uts" id="" value="<?php echo $row_nilai["uts"];?>"></td>
                        </tr>
                        <tr>
                            <th>UAS</th>
                            <td><input type="number" name="uas" id="" value="<?php echo $row_nilai["uas"];?>"></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="tambahnilai" value="Tambah" class="btn btn-info" style="margin-top: 10px;"></td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>