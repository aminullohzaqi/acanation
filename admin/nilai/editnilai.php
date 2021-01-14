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
            <form action='getedit.php' method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <label for="angkatan">Angkatan</label>
                        <select name="angkatan" id="angkatan" class="list" style="width:178px">
                            <?php $select=mysqli_query($conn, "SELECT * FROM `angkatan`");?>
                                <option value="">Select Angkatan</option>
                                <?php while ($row=mysqli_fetch_array($select)){ ?>
                                <option value="<?php echo $row['tahun'];?>"><?php echo $row['tahun'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="kelas">Kelas Taruna</label>
                        <select name="kelas" id="kelas" class="list" style="width:178px">
                            <?php $select=mysqli_query($conn, "SELECT * FROM `kelas`");?>
                                <option value="">Select Kelas</option>
                                <?php while ($row=mysqli_fetch_array($select)){ ?>
                                <option value="<?php echo $row['nama_kelas'];?>"><?php echo $row['nama_kelas'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="semester">Semester</label>
                        <select name="semester" id="semester" style="width:178px">
                            <option value="">Select Semester</option>
                            <?php $select=mysqli_query($conn, "SELECT * FROM `semester`");
                                while ($row=mysqli_fetch_array($select)){ ?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['status'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="matkul">Mata Kuliah</label>
                        <select name="matkul" id="matkul" style="width:178px">
                            <option value="">Mata Kuliah</option>
                        </select>
                    </div>
                </div>
                <div>
                    <input type="submit" name="prosesedit" value="Proses" class="btn btn-info" style="margin-top: 10px;">
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
         	$("#semester").change(function(){
                var semester=$("#semester").val();
         	    $.ajax({
         	    type:"post",
         	    url:"ajax/geteditlist.php",
         	    data:"semester="+semester,
         	    success:function(data){
                    $("#matkul").html(data);
         	    }
         	    });
         	});
        });
    </script>
</body>
</html>