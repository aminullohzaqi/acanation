<?php
    session_start();
    include "../../../koneksi.php";
    $username = $_SESSION["username"]; 
    
    $angkatan=$_POST["angkatan"];
    $kelas=$_POST["kelas"];
    $semester=$_POST["semester"];

    $result_matkul=mysqli_query($conn, "SELECT * FROM `matkul` WHERE `semester` = '$semester'");
    while($row=mysqli_fetch_array($result_matkul)){
  	    echo"<option value=$row[id]>$row[matakuliah]</option>";
    }
    
?>

