<?php
    session_start();
    include "../koneksi.php";
    if(!isset($_SESSION["username"])){
        header("Location: ../index.php");
        exit;
    }
    if($_SESSION["role"] == "admin"){
        header("Location: ../admin/index.php");
        exit;
    }

    $username = $_SESSION["username"];
    $display  = $_SESSION["display"];
    $result = mysqli_query($conn, "SELECT `user`.`id`, `data_user`.`nama` FROM `user`
        LEFT JOIN `data_user` ON `data_user`.`id` = `user`.`id`
        WHERE `data_user`.`id` = '$username'");

    $row = mysqli_fetch_assoc($result);
    $pengumuman = mysqli_query($conn, "SELECT * FROM `data_user`
        LEFT JOIN `pengumuman` ON `pengumuman`.`id_admin` = `data_user`.`id`
	    WHERE `pengumuman`.`judul` != 'NULL' ORDER BY `tanggal` DESC LIMIT 2");

    $skslulus = mysqli_query($conn, "SELECT SUM(sks) FROM `matkul`
        LEFT JOIN `nilai` ON `nilai`.`id_matkul` = `matkul`.`id`
        WHERE `nilai`.`id_user` = '$username'");
    $sks = mysqli_fetch_array($skslulus);

    function jumlah_nilai($nilai){
        global $conn;
        global $username;
        $return = array();
        $jumlah=mysqli_query($conn,"SELECT COUNT(nilai) FROM `nilai`
                WHERE `id_user` = '$username' AND `nilai` = '$nilai'");
        while ($row=mysqli_fetch_array($jumlah)){ 
            $return = $row[0];    
        }
        return $return;
    }

    function ip($semester){
        global $conn;
        global $username;

        $sks = mysqli_query($conn, "SELECT SUM(sks) FROM `matkul`
        LEFT JOIN `nilai` ON `nilai`.`id_matkul` = `matkul`.`id`
        WHERE `nilai`.`id_user` = '$username' AND `matkul`.`semester` = '$semester'");
        $row_sks = mysqli_fetch_array($sks);

        $bobot = mysqli_query($conn, "SELECT SUM(bobot) FROM `matkul`
        LEFT JOIN `nilai` ON `nilai`.`id_matkul` = `matkul`.`id`
        WHERE `nilai`.`id_user` = '$username' AND `matkul`.`semester` = '$semester'");
        $row_bobot = mysqli_fetch_array($bobot);

        $total_sks   = $row_sks[0];
        $total_bobot = $row_bobot[0];
        
        $IPS         = "";
        if($total_bobot != 0 || $total_sks !=0){
            $IPS     = $total_bobot/$total_sks;
        }
        else{
            $IPS = 0;
        }  
        return $IPS;
    }

    function ipk(){
        global $conn;
        $IPK = "";

        if(ip("S2") == 0){
            $IPK = (ip("S1"));
        }
        else if(ip("S3") == 0){
            $IPK = (ip("S1")+ip("S2"))/2;
        }
        else if(ip("S4") == 0){
            $IPK = (ip("S1")+ip("S2")+ip("S3"))/3;
        }
        else if(ip("S5") == 0){
            $IPK = (ip("S1")+ip("S2")+ip("S3")+ip("S4"))/4;
        }
        else if(ip("S6") == 0){
            $IPK = (ip("S1")+ip("S2")+ip("S3")+ip("S4")+ip("S5"))/5;
        }
        else if(ip("S7") == 0){
            $IPK = (ip("S1")+ip("S2")+ip("S3")+ip("S4")+ip("S5")+ip("S6"))/6;
        }
        else if(ip("S8") == 0){
            $IPK = (ip("S1")+ip("S2")+ip("S3")+ip("S4")+ip("S5")+ip("S6")+ip("S7"))/7;
        }
        else if(ip("S8") != 0){
            $IPK = (ip("S1")+ip("S2")+ip("S3")+ip("S4")+ip("S5")+ip("S6")+ip("S7")+ip("S8"))/8;
        }

        return $IPK;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <?php include "snippets/headindex.php" ?>
</head>
<body>
    <?php include "snippets/sidenavindex.php" ?>
    <div class="main">
        <div class="container">
            <div class="konten">
                <div class="row d-flex justify-content-between first-row">
                    <div class="col-md-5 shadow total welcome">
                        <div class="d-flex dashboard-content">
                            <div>
                                <h2>Selamat Datang</h2>
                                <h5><?php echo $row["nama"]; ?></h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-5x fa-user" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 shadow total sks">
                        <div class="d-flex dashboard-content">
                            <div>
                                <h2><?php echo $sks[0]; ?></h2>
                                <h5>SKS Lulus</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-5x fa-graduation-cap" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 shadow total ip">
                        <div class="d-flex dashboard-content">
                            <div>
                                <h2><?php echo (round(ipk(),2)); ?></h2>
                                <h5>Index Prestasi</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-5x fa-line-chart" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="graph row d-flex justify-content-between">
                    <div class="col-md-7 bar chart shadow" style="">
                        <h5 class="text-center judul">Perbandingan Nilai</h5>
                        <canvas id="nilai"></canvas>
                    </div>
                    <div class="col-md-4 pie chart shadow" style="">
                        <h5 class="text-center judul">Pengumuman</h5>
                        <?php while ($row=mysqli_fetch_array($pengumuman)){ ?>
                        <div class="pengumuman d-flex">
                            <div class="col-md-3 image">
                                <div class="btn btn-info">
                                    <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="info col-md-8">
                                <div class="sender">
                                    <strong><?php echo $row["nama"]?></strong><br>
                                    <em><?php echo $row["tanggal"]?></em>
                                </div>
                                <div class="content">
                                    <p><?php echo $row["isi"]?></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
		var ctx = document.getElementById("nilai").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
				labels: ["A", "A-", "B", "B-", "C", "D", "E"],
				datasets: [{
					label: 'Nilai',
					data: [
                        <?php echo jumlah_nilai("A");?>,
                        <?php echo jumlah_nilai("A-");?>,
                        <?php echo jumlah_nilai("B");?>,
                        <?php echo jumlah_nilai("B-");?>,
                        <?php echo jumlah_nilai("C");?>,
                        <?php echo jumlah_nilai("D");?>,
                        <?php echo jumlah_nilai("E");?>,
                    ],
					backgroundColor: [
					'rgba(255, 99, 132, 0.8)',
					'rgba(54, 162, 235, 0.8)',
					'rgba(255, 206, 86, 0.8)',
                    'rgba(0, 255, 12, 0.8)',
                    'rgba(144, 0, 255, 0.8)',
                    'rgba(255, 94, 20, 0.8)',
                    'rgba(130, 130, 130, 0.8)',
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
                    'rgba(0, 255, 12, 1)',
                    'rgba(144, 0, 255, 1)',
                    'rgba(255, 94, 20, 1)',
                    'rgba(130, 130, 130, 1)',
					],
					borderWidth: 1,
                    fill: false,
				}]
			},
			options: {
            responsive: true,
            maintainAspectRatio: true,
            legend: {
                position: 'left',
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