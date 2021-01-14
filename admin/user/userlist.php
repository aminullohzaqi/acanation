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
            <h2>List User</h2>
        </div>
        <div class="isi container">
            <div class="konten">
                <form action='getuser.php' method="GET">
                <div class="col-md-12 d-flex">
                    <div>
                        <label for="angkatan">Angkatan</label>
                        <select name="angkatan" id="angkatan" class="list" style="width:178px">
                            <?php $select=mysqli_query($conn, "SELECT * FROM `angkatan`");?>
                                <option value="">--PILIH--</option>
                                <?php while ($row=mysqli_fetch_array($select)){ ?>
                                <option value="<?php echo $row['tahun'];?>"><?php echo $row['tahun'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div style="padding-left: 30px;">
                        <label for="">Kelas</label>
                        <select name="kelas" id="kelas" class="list" style="width:178px">
                            <?php $select=mysqli_query($conn, "SELECT * FROM `kelas`");?>
                                <option value="">--PILIH--</option>
                                <?php while ($row=mysqli_fetch_array($select)){ ?>
                                <option value="<?php echo $row['nama_kelas'];?>"><?php echo $row['nama_kelas'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div style="padding-left: 30px;">
                        <a href="tambahuser.php">
                            <i class="fa fa-user-plus" aria-hidden="true">Tambah User</i>
                        </a>
                    </div>
                </div>
                </form>
                <div id="txtHint">
                    <div class="empty">
                        <img class="emptylogo" src="../../Assets/img/paper.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".list").change(function(){
                var angkatan=$("#angkatan").val();
                var kelas=$("#kelas").val();
                $.ajax({
                type:"post",
                url:"getuserlist.php",
                data:"angkatan="+angkatan+"&kelas="+kelas,
                success:function(data){
                    $("#txtHint").html(data);
                }
                });
            });
        });
    </script>
</body>
</html>