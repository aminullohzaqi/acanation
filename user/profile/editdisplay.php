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
    $display  = $_SESSION["display"];
	$gambar = $_GET["gambar"];
	
	$result = mysqli_query($conn, "SELECT `user`.`id`, `data_user`.`nama` FROM `user`
        LEFT JOIN `data_user` ON `data_user`.`id` = `user`.`id`
        WHERE `data_user`.`id` = '$username'");

    $row = mysqli_fetch_assoc($result);

    $profile = mysqli_query($conn, "SELECT * FROM `data_user` WHERE `id` = '$username'");
    $row_profile = mysqli_fetch_assoc($profile);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>Profile</title>
    <?php include "snippets/head.php" ?>
</head>
<body>
	<?php include "snippets/sidenav.php" ?>
	<div class="main">
		<div class="title">
            <h2>Edit Display Profile</h2>
        </div>
		<div class="isi container">
			<div class="konten">
			<form action="editaction.php" method="post" enctype="multipart/form-data">
				<table id="tabelprofile">
					<input type="hidden" name="id" value="<?php $row_profile["id"]; ?>">
					<input type="hidden" name="gambarLama" value="<?= $row_profile["gambar"]; ?>">
					<tr>
						<th>Gambar</th>
						<td><input type="file" name="gambar" id="gambar"></td>
					</tr>
					<tr>
						<td></td>
						<td><button type="submit" name="submit" class="btn btn-info" style="margin-top: 10px;">Edit</button></td>
					</tr>
				</table>
			</form>
			</div>
		</div>
	</div>
</body>