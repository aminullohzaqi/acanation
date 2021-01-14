<?php
    session_start();
    include "../../koneksi.php";
    if(!isset($_SESSION["username"])){
        header("Location: ../../index.php");
        exit;
    }
    if($_SESSION["role"] == "admin"){
        header("Location: ../../admin/index.php");
        exit;
    }

    $username = $_SESSION["username"];
    $kelas    = $_SESSION["kelas"];
    $angkatan = $_SESSION["angkatan"];
    $display  = $_SESSION["display"];

    $result = mysqli_query($conn, "SELECT `user`.`id`, `data_user`.`nama` FROM `user`
        LEFT JOIN `data_user` ON `data_user`.`id` = `user`.`id`
        WHERE `data_user`.`id` = '$username'");

    $row = mysqli_fetch_assoc($result);

    $forum  = mysqli_query($conn, "SELECT * FROM `data_user`
        LEFT JOIN `forum` ON `forum`.`id_user` = `data_user`.`id`
        LEFT JOIN `angkatan` ON `forum`.`angkatan` = `angkatan`.`tahun`
        LEFT JOIN `kelas` ON `forum`.`kelas` = `kelas`.`nama_kelas`
        WHERE `forum`.`kelas` = '$kelas' AND `forum`.`angkatan` = '$angkatan'
        ORDER BY `forum`.`tanggal` DESC");
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forum Kelas</title>
    <?php include "snippets/head.php"; ?>
</head>
<body>
    <?php include "snippets/sidenav.php"; ?>
    <div class="main">
        <div class="title">
            <h2>Forum Kelas</h2>
        </div>
        <div class="isi container">
            <div class="konten">
            <div>
                <form action="../action.php" method="post">
                    <div class="judul">
                        <textarea name="judul" style="width: 20%; height: 30px" id="InputTextArea" placeholder="Add title forum here..." onkeyup="resizeTextarea('InputTextArea')"></textarea>
                    </div>
                    <div class="d-flex row justify-content-start">
                        <div class="col-md-7">
                            <textarea name="isi" style="width: 100%; height: 30px" id="InputTextArea" placeholder="Add content here..." onkeyup="resizeTextarea('InputTextArea')"></textarea>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="tambahforum" class="btn btn-info btn-komen">
                                <i class="fa fa-xs fa-paper-plane" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <table id="tabelforum">
                    <?php while ($row=mysqli_fetch_array($forum)){ ?>
                    <tr>
                        <td rowspan=2>
                            <img class="img-komen" src="../../img/<?php echo $row["display"] ?>" alt="">
                            <br>
                            <strong><?php echo $row["nama"]?></strong>
                            <br>
                            <em><?php echo $row["tanggal"]?></em>
                            <br>
                            <a href="detail.php?id=<?php echo $row[7]; ?>">
                                <i class="fa fa-eye" aria-hidden="true"></i> Detail
                            </a>
                        </td>
                        <td>
                            <div>
                            <h3 class="judul-forum"><?php echo $row["judul"]?></h3>
                            <p class="konten-forum"><?php echo $row["isi"]?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php $komentar = mysqli_query($conn, "SELECT COUNT(komentar) FROM `komentar`
                                                WHERE `id_forum` = '$row[7]'");
                                    $row_komen = mysqli_fetch_array($komentar);
                                    echo $row_komen[0];
                                    echo " komentar kelas";
                            ?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            </div>
        </div>
    </div>
    <script>
        function resizeTextarea (id) {
        var a = document.getElementById(id);
        a.style.height = 'auto';
        a.style.height = a.scrollHeight+'px';
        }

        function init() {
        var a = document.getElementsByTagName('textarea');
        for(var i=0,inb=a.length;i<inb;i++) {
            if(a[i].getAttribute('data-resizable')=='true')
            resizeTextarea(a[i].id);
        }
        }

        addEventListener('DOMContentLoaded', init);
    </script>
</body>
</html>