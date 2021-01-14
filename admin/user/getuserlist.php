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
    
    $angkatan=$_POST["angkatan"];
    $kelas=$_POST["kelas"];

    $result=mysqli_query($conn, "SELECT * FROM `data_user` WHERE `angkatan` = '$angkatan' AND `kelas` = '$kelas' ORDER BY `id` ASC");
?>
    <table id="tabel">
        <tr>
            <th>NPT</th>
            <th>Nama</th>
            <th>E-Mail</th>
            <th>Detail</th>
        </tr>
    <?php while($row=mysqli_fetch_array($result)){?>
        <tr>
            <td><?php echo $row["id"];?></td>
            <td><?php echo $row["nama"];?></td>
            <td><?php echo $row["email"];?></td>
            <td><a href="getuser.php?id=<?php echo $row["id"];?>">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
            </td>
        </tr>
    <?php } ?>
    </table>
    

