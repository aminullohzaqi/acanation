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
            <form action='gettambah.php' method="GET">
                <table id="tabeltambah">
                    <tr>
                        <th>Angkatan</th>
                        <td>
                            <select name="angkatan" id="angkatan" class="list" style="width:178px">
                                <?php $select=mysqli_query($conn, "SELECT * FROM `angkatan`");?>
                                    <option value="">Select Angkatan</option>
                                    <?php while ($row=mysqli_fetch_array($select)){ ?>
                                    <option value="<?php echo $row['tahun'];?>"><?php echo $row['tahun'];?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td>
                            <select name="kelas" id="kelas" class="list" style="width:178px">
                                <?php $select=mysqli_query($conn, "SELECT * FROM `kelas`");?>
                                    <option value="">Select Kelas</option>
                                    <?php while ($row=mysqli_fetch_array($select)){ ?>
                                    <option value="<?php echo $row['nama_kelas'];?>"><?php echo $row['nama_kelas'];?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>
                            <select name="nama" id="nama" style="width:178px">
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Semester</th>
                        <td>
                            <select name="semester" id="semester" style="width:178px">
                                <option value="">Select Semester</option>
                                <?php $select=mysqli_query($conn, "SELECT * FROM `semester`");
                                    while ($row=mysqli_fetch_array($select)){ ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['status'];?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Mata Kuliah</th>
                        <td>
                            <select name="matkul" id="matkul" style="width:178px">
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Proses" name="prosesnilai" class="btn btn-info" style="margin-top: 10px;"></td>
                    </tr>
                </table>
            </form>
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
         	    url:"ajax/getnilailist.php",
         	    data:"angkatan="+angkatan+"&kelas="+kelas,
         	    success:function(data){
                    $("#nama").html(data);
         	    }
         	    });
         	});
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
         	$("#semester").change(function(){
                var semester=$("#semester").val();
         	    $.ajax({
         	    type:"post",
         	    url:"ajax/getnilailist.php",
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