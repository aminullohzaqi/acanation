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
    <title>Mata Kuliah</title>
    <?php include "snippets/head.php"; ?>
</head>
<body>
    <?php include "snippets/sidenav.php"; ?>
    <div class="main">
        <div class="title">
            <h2>Tambah Mata Kuliah</h2>
        </div>
        <div class="isi container">
            <div class="konten">
            <form action="../action.php" method="POST">
                <table id=tabeltambah>
                    <tr>
                        <th>ID Mata Kuliah</th>
                        <td><input type="text" name="id" id=""></td>
                    </tr>
                    <tr>
                        <th>Mata Kuliah</th>
                        <td><input type="text" name="matakuliah" id=""></td>
                    </tr>
                    <tr>
                        <th>Jumlah SKS</th>
                        <td><input type="number" name="sks" id=""></td>
                    </tr>
                    <tr>
                        <th>Semester</th>
                        <td>
                            <select name="semester" onchange="semesterList(this.value)" style="width:150px">
                                <option value="">Select Semester</option>
                                <?php $select=mysqli_query($conn, "SELECT * FROM `semester`");
                                    while ($row=mysqli_fetch_array($select)){ ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['status'];?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <input type="submit" value="Tambah" name="tambahmatkul" class="btn btn-info" style="margin-top: 10px;">
            </form>
            </div>
        </div>
    </div>
</body>
</html>