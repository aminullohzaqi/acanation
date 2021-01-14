<?php
    include('../../koneksi.php');
    $id	= $_GET['id'];

    $sql 	= "DELETE FROM `matkul` WHERE `id` ='".$id."'";
    $query	= mysqli_query($conn,$sql);
    header('location: daftar.php');
?>
