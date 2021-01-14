<?php
    session_start();
    include "../koneksi.php";
    if(!isset($_SESSION["username"])){
        header("Location: ../index.php");
        exit;
    }
    if($_SESSION["role"] == "user"){
        header("Location: ../user/index.php");
        exit;
    }

    $username = $_SESSION["username"];
    $display  = $_SESSION["display"];

    $result = mysqli_query($conn, "SELECT `user`.`id`, `data_user`.`nama` FROM `user`
        LEFT JOIN `data_user` ON `data_user`.`id` = `user`.`id`
        WHERE `data_user`.`id` = '$username'");
    $row = mysqli_fetch_assoc($result);

    $user = mysqli_query($conn, "SELECT COUNT(nama) FROM `user`
        LEFT JOIN `data_user` ON `data_user`.`id` = `user`.`id`
        WHERE `user`.`role` = 'user'");
    $row_user = mysqli_fetch_array($user); 

    $matkul = mysqli_query($conn, "SELECT COUNT(matakuliah) FROM `matkul`");
    $row_matkul = mysqli_fetch_array($matkul);

    $sks = mysqli_query($conn, "SELECT SUM(sks) FROM `matkul`");
    $row_sks = mysqli_fetch_array($sks);

    $angkatan = mysqli_query($conn, "SELECT COUNT(tahun) FROM `angkatan`");
    $row_angkatan = mysqli_fetch_array($angkatan);

    $tahun_angkatan = mysqli_query($conn, "SELECT * FROM `angkatan`");

    function angkatan($tahun){
        global $conn;
        $return = array();
        $jumlah=mysqli_query($conn,"SELECT COUNT(id) FROM `data_user` WHERE `angkatan` = '$tahun'");
        while ($row=mysqli_fetch_array($jumlah)){ 
            $return = $row[0];    
        }
        return $return;

    }
    function sks($semester){
        global $conn;
        $return = array();
        $jumlah=mysqli_query($conn,"SELECT SUM(sks) FROM `matkul` WHERE `semester` = '$semester'");
        while ($row=mysqli_fetch_array($jumlah)){ 
            $return = $row[0];    
        }
        return $return;

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" type="image" href="Assets/img/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="../Assets/js/Chart.min.js"></script>
    <link href="../Assets/css/style.css" rel="stylesheet">
    <link href="../Assets/css/styleadmin.css" rel="stylesheet">
</head>
<body>
    <div class="sidenav shadow">
        <div class="logo-brand">
            <img src="../img/<?php echo $display; ?>" class="logo">
            <h4><?php echo $row["nama"]; ?></h4>
        </div>
        <br>
        <a href="index.php" class="active"><i class="fa fa-fw fa-desktop" aria-hidden="true"></i> Home</a>
        <a href="nilai/editnilai.php"><i class="fa fa-fw fa-file-text" aria-hidden="true"></i> Nilai</a>
        <a href="matkul/daftar.php"><i class="fa fa-fw fa-list-ul" aria-hidden="true"></i> Mata Kuliah</a>
        <a href="pengumuman/pengumuman.php"><i class="fa fa-fw fa-bullhorn" aria-hidden="true"></i> Pengumuman</a>
        <a href="user/userlist.php"><i class="fa fa-fw fa-users" aria-hidden="true"></i> User</a>
        <a href="logout.php"><i class="fa fa-fw fa-sign-out" aria-hidden="true"></i> Log Out</a>
		<br>
		<br>
        <div class="custom-control custom-switch" id="dark-mode">
            <input type="checkbox" class="custom-control-input" id="darkSwitch">
            <label class="custom-control-label darklabel" for="darkSwitch">Dark</label>
        </div>
        <script src="../Assets/js/dark-mode-switch.min.js"></script>
    </div>
    <nav class="navbar fixed-top navbar-expand-md navbar-light bg-light shadow">
        <a class="navbar-brand" href="index.php">Acanation</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a href="index.php"><i class="fa fa-fw fa-desktop" aria-hidden="true"></i> Home</a>
            </li>
            <li class="nav-item">
                <a href="nilai/editnilai.php"><i class="fa fa-fw fa-file-text" aria-hidden="true"></i> Nilai</a>
            </li>
            <li class="nav-item">
                <a href="matkul/daftar.php"><i class="fa fa-fw fa-list-ul" aria-hidden="true"></i> Mata Kuliah</a>
            </li>
            <li class="nav-item">
                <a href="pengumuman/pengumuman.php"><i class="fa fa-fw fa-bullhorn" aria-hidden="true"></i> Pengumuman</a>
            </li>
            <li class="nav-item">
                <a href="user/userlist.php"><i class="fa fa-fw fa-users" aria-hidden="true"></i> User</a>
            </li>
            <li class="nav-item">
                <a href="logout.php"><i class="fa fa-fw fa-sign-out" aria-hidden="true"></i> Log Out</a>
            </li>
            <br>
            <div class="custom-control custom-switch" id="dark-mode">
                <input type="checkbox" class="custom-control-input" id="darkSwitch">
                <label class="custom-control-label darklabel" for="darkSwitch">Dark</label>
            </div>
            <script src="../Assets/js/dark-mode-switch.min.js"></script>
            </ul>
        </div>
    </nav>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <div class="main">
        <div class="container">
            <div class="konten">
                <div class="row d-flex justify-content-between first-row">
                    <div class="col-md-3 shadow total user">
                        <div class="d-flex dashboard-content">
                            <div>
                                <h2><?php echo $row_user[0]; ?></h2>
                                <h5>User</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-5x fa-users" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 shadow total matkul">
                        <div class="d-flex dashboard-content">
                            <div>
                                <h2><?php echo $row_matkul[0]; ?></h2>
                                <h5>Mata Kuliah</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-5x fa-book" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 shadow total sks">
                        <div class="d-flex dashboard-content">
                            <div>
                                <h2><?php echo $row_sks[0]; ?></h2>
                                <h5>SKS</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-5x fa-graduation-cap" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 shadow total angkatan">
                        <div class="d-flex dashboard-content">
                            <div>
                                <h2><?php echo $row_angkatan[0]; ?></h2>
                                <h5>Angkatan</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-5x fa-tags" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="graph row d-flex justify-content-between">
                    <div class="col-md-7 bar chart isi shadow" style="">
                        <h3 class="text-center judul">User</h3>
                        <canvas id="angkatan"></canvas>
                    </div>
                    <div class="col-md-4 pie chart isi shadow" style="">
                        <h3 class="text-center judul">SKS</h3>
                        <canvas id="sks"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
		var ctx = document.getElementById("angkatan").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: [ <?php while($row_tahun = mysqli_fetch_array($tahun_angkatan)){
                    echo '"'; echo $row_tahun["tahun"]; echo '"'; echo ',';} ?>],
				datasets: [{
					label: 'Jumlah',
					data: [
                    <?php echo angkatan("2017") ?>,
                    <?php echo angkatan("2018") ?>,
                    <?php echo angkatan("2019") ?>],
					backgroundColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					],
					borderWidth: 1,
                    fill: false,
				}]
			},
			options: {
            responsive: true,
            maintainAspectRatio: true,
            legend: {
                display: false},
            scales: {
                yAxes: [{
                    ticks: {
                        stepSize: 5,
                    },
                    gridLines: {
                        drawOnChartArea: false
                    }
                }],
                xAxes: [{
                    gridLines: {
                        drawOnChartArea: false
                    }
                }]
            }
        }
		});
    </script>
    <script>
		var ctx = document.getElementById("sks").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
				labels: ["Semester 1", "Semester 2", "Semester 3", "Semester 4", "Semester 5", "Semester 6",
                        "Semester 7", "Semester 8",],
				datasets: [{
					label: 'Jumlah',
					data: [
                    <?php echo sks("S1") ?>,
                    <?php echo sks("S2") ?>,
                    <?php echo sks("S3") ?>,
                    <?php echo sks("S4") ?>,
                    <?php echo sks("S5") ?>,
                    <?php echo sks("S6") ?>,
                    <?php echo sks("S7") ?>,
                    <?php echo sks("S8") ?>,],
					backgroundColor: [
					'rgba(255, 99, 132, 0.8)',
					'rgba(54, 162, 235, 0.8)',
					'rgba(255, 206, 86, 0.8)',
                    'rgba(0, 255, 12, 0.8)',
                    'rgba(144, 0, 255, 0.8)',
                    'rgba(255, 94, 20, 0.8)',
                    'rgba(87, 4, 239, 0.8)',
                    'rgba(4, 239, 228, 0.8)',
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
                    'rgba(0, 255, 12, 1)',
                    'rgba(144, 0, 255, 1)',
                    'rgba(255, 94, 20, 1)',
                    'rgba(87, 4, 239, 1)',
                    'rgba(4, 239, 228, 1)',
					],
					borderWidth: 1,
                    fill: false,
				}]
			},
			options: {
            responsive: true,
            maintainAspectRatio: true,
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    display: false
                }],
                xAxes: [{
                    display: false
                }],
            }
        }
		});
    </script>
</body>
</html>