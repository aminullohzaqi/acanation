<?php
    session_start();
    include "../../../koneksi.php";
    $username = $_SESSION["username"]; 
    
    $angkatan=$_POST["angkatan"];
    $kelas=$_POST["kelas"];
    $semester=$_POST["semester"];

    $result=mysqli_query($conn, "SELECT * FROM `data_user` WHERE `angkatan`='$angkatan' AND `kelas`='$kelas'");
    while($row_hasil=mysqli_fetch_array($result)){
  	    echo"<option value=$row_hasil[id]>$row_hasil[nama]</option>";
    }

    $result_matkul=mysqli_query($conn, "SELECT * FROM `matkul` WHERE `semester` = '$semester'");
    while($row=mysqli_fetch_array($result_matkul)){
  	    echo"<option value=$row[id]>$row[matakuliah]</option>";
    }
    
?>

