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

    $id_forum = $_GET["id"];

    $result = mysqli_query($conn, "SELECT `user`.`id`, `data_user`.`nama` FROM `user`
        LEFT JOIN `data_user` ON `data_user`.`id` = `user`.`id`
        WHERE `data_user`.`id` = '$username'");

    $row = mysqli_fetch_assoc($result);

    $forum  = mysqli_query($conn, "SELECT * FROM `data_user`
        LEFT JOIN `forum` ON `forum`.`id_user` = `data_user`.`id`
        LEFT JOIN `angkatan` ON `forum`.`angkatan` = `angkatan`.`tahun`
        LEFT JOIN `kelas` ON `forum`.`kelas` = `kelas`.`nama_kelas`
        WHERE `forum`.`kelas` = '$kelas' AND `forum`.`angkatan` = '$angkatan' AND `forum`.`id` = '$id_forum'");

    $komentar = mysqli_query($conn, "SELECT `data_user`.`nama`, `data_user`.`display`, 
        `komentar`.`komentar` FROM `data_user`
        LEFT JOIN `komentar` ON `komentar`.`id_user` = `data_user`.`id`
        WHERE `komentar`.`id_forum` = '$id_forum'");
    
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
            <?php while ($row=mysqli_fetch_array($forum)){ ?>
                <div class="sender d-flex">
                    <div class="image-sender">
                        <img class="img-sender" src="../../img/<?php echo $row["display"] ?>" alt="">
                    </div>
                    <div class="forum-sender">
                        <div class="title-sender">
                            <h3 class="title-forum"><?php echo $row["judul"]?></h3>
                            <p class="name-sender"><?php echo $row["nama"]?></p>
                            <p class="date-sender"><?php echo $row["tanggal"]?></p>
                        </div>
                        <div class="isi-forum">
                            <p><?php echo $row["isi"]?></p>
                        </div>
                        <div class="komentar">
                            <table>
                            <?php while ($row_komentar=mysqli_fetch_array($komentar)){ ?>
                                <tr>
                                    <div class="comment d-flex">
                                        <div class="image-comment">
                                            <img class="img-comment" src="../../img/<?php echo $row_komentar["display"] ?>" alt="">
                                        </div>
                                        <div class="konten-comment">
                                            <strong><?php echo $row_komentar["nama"];?></strong>
                                            <br>
                                            <?php echo $row_komentar["komentar"];?>
                                        </div>
                                    </div>
                                </tr>
                            <?php } ?>
                            </table>
                            <form action="../action.php" method="get">
                                <input type="hidden" name="id" id="" value="<?php echo $row[7]; ?>">
                                <div class="d-flex">
                                    <textarea id="InputTextArea" cols="30" rows="1" name="komentar" placeholder="Add comment here..." onkeyup="resizeTextarea('InputTextArea')"></textarea>
                                    <button type="submit" name="tambahkomentar" class="btn btn-info btn-komen">
                                        <i class="fa fa-xs fa-paper-plane" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <?php } ?>
                    </div>
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