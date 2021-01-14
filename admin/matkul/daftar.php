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
            <h2>Mata Kuliah</h2>
        </div>
        <div class="isi container">
            <div class="konten">
            <form action=''>
                <div class="col-md-12 d-flex">
                    <div>
                        <label for="">Semester</label>
                        <select name="semester" onchange="semesterList(this.value)" style="width:178px">
                            <option value="">Select Semester</option>
                            <?php $select=mysqli_query($conn, "SELECT * FROM `semester`");
                                while ($row=mysqli_fetch_array($select)){ ?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['status'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div style="padding-left: 30px;">
                        <a href="tambahmatkul.php">
                            <i class="fa fa-user-plus" aria-hidden="true">Tambah Mata Kuliah</i>
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
    <script>
        function semesterList(str) {
        var xhttp;  
        if (str == "") {
            document.getElementById("txtHint").innerHTML = "";
            return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "getsemesterlist.php?q="+str, true);
        xhttp.send();
    }
    </script>
</body>
</html>