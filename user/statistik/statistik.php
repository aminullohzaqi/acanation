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
    $result = mysqli_query($conn, "SELECT `user`.`id`, `data_user`.`nama` FROM `user`
        LEFT JOIN `data_user` ON `data_user`.`id` = `user`.`id`
        WHERE `data_user`.`id` = '$username'");
    $row = mysqli_fetch_assoc($result);
    $select=mysqli_query($conn, "SELECT * FROM `semester`");
    $pilih=mysqli_query($conn, "SELECT * FROM `semester`");

    function ip($npt,$semester){
        global $conn;

        $sks = mysqli_query($conn, "SELECT SUM(sks) FROM `matkul`
        LEFT JOIN `nilai` ON `nilai`.`id_matkul` = `matkul`.`id`
        WHERE `nilai`.`id_user` = '$npt' AND `matkul`.`semester` = '$semester'");
        $row_sks = mysqli_fetch_array($sks);

        $bobot = mysqli_query($conn, "SELECT SUM(bobot) FROM `matkul`
        LEFT JOIN `nilai` ON `nilai`.`id_matkul` = `matkul`.`id`
        WHERE `nilai`.`id_user` = '$npt' AND `matkul`.`semester` = '$semester'");
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

    function jumlah_nilai($nilai, $semester){
        global $conn;
        global $username;
        $return = array();
        $jumlah=mysqli_query($conn,"SELECT COUNT(nilai) FROM `matkul`
        LEFT JOIN `nilai` ON `nilai`.`id_matkul` = `matkul`.`id`
        WHERE `nilai`.`id_user` = '$username' AND `matkul`.`semester` = '$semester' AND `nilai`.`nilai` = '$nilai'");
        while ($row=mysqli_fetch_array($jumlah)){ 
            $return = $row[0];    
        }
        return $return;
    }

    function sks_lulus($semester){
        global $conn;
        global $username;
        $jumlah = mysqli_query($conn, "SELECT SUM(sks) FROM `matkul`
        LEFT JOIN `nilai` ON `nilai`.`id_matkul` = `matkul`.`id`
        WHERE `nilai`.`id_user` = '$username' AND `matkul`.`semester` = '$semester'");
        $row = mysqli_fetch_array($jumlah);
        $result = $row[0];
        return $result;
    }

    function total_sks(){
        global $conn;
        $jumlah = mysqli_query($conn, "SELECT SUM(sks) FROM `matkul`");
        $row = mysqli_fetch_array($jumlah);
        $result = $row[0];
        return $result;
    }
    function sks_selesai(){
        global $conn;
        global $username;
        $jumlah = mysqli_query($conn, "SELECT SUM(sks) FROM `matkul`
        LEFT JOIN `nilai` ON `nilai`.`id_matkul` = `matkul`.`id`
        WHERE `nilai`.`id_user` = '$username'");
        $row = mysqli_fetch_array($jumlah);
        $result = $row[0];
        return $result;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Statistik</title>
    <?php include "snippets/head.php"; ?>
</head>
<body>
    <?php include "snippets/sidenav.php"; ?>
    <div class="main">
        <div class="title">
            <h2>Statistik</h2>
        </div>
        <div class="isi container">
            <div class="konten">
                <div class="graph row d-flex justify-content-around">
                    <div class="col-md-7 bar chart isi shadow" style="">
                        <h5 class="text-center judul">Index Prestasi</h5>
                        <canvas id="ip"></canvas>
                    </div>
                    <div class="col-md-4 pie chart isi shadow" style="">
                        <h5 class="text-center judul">Nilai</h5>
                        <div class="select">
                            <label for="">Semester</label>
                            <select name="semester" id="semester" style="width:178px">
                                <?php $pilih=mysqli_query($conn, "SELECT * FROM `semester`");?>
                                    <?php while ($row=mysqli_fetch_array($pilih)){ ?>
                                    <option value="<?php echo $row['id'];?>"><?php echo $row['status'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id="txtHint">
                            <canvas id="nilai"></canvas>
                        </div>
                    </div>
                    <div class="col-md-7 line chart isi shadow" style="">
                        <h5 class="text-center judul">SKS Lulus</h5>
                        <canvas id="sks"></canvas>
                    </div>
                    <div class="col-md-4 line chart isi shadow" style="">
                        <h5 class="text-center judul">SKS Tempuh</h5>
                        <canvas id="sks_tempuh"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
		var ctx = document.getElementById("ip").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: [<?php while ($row=mysqli_fetch_array($select)){
                            echo '"'; echo $row["status"]; echo '",';} ?>],
				datasets: [{
					label: 'IP',
					data: [
                        <?php echo ip("$username","S1"); ?>,
                        <?php echo ip("$username","S2"); ?>,
                        <?php echo ip("$username","S3"); ?>,
                        <?php echo ip("$username","S4"); ?>,
                        <?php echo ip("$username","S5"); ?>,
                        <?php echo ip("$username","S6"); ?>,
                        <?php echo ip("$username","S7"); ?>,
                        <?php echo ip("$username","S8"); ?>,
                    ],
					backgroundColor: [
					'rgba(255, 99, 132, 0.8)',
					'rgba(54, 162, 235, 0.8)',
					'rgba(255, 206, 86, 0.8)',
                    'rgba(0, 255, 12, 0.8)',
                    'rgba(144, 0, 255, 0.8)',
                    'rgba(249, 120, 0, 0.8)',
                    'rgba(79, 205, 161, 0.8)',
                    'rgba(83, 115, 243, 0.8)',
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
                    'rgba(0, 255, 12, 1)',
                    'rgba(144, 0, 255, 1)',
                    'rgba(249, 120, 0, 1)',
                    'rgba(79, 205, 161, 1)',
                    'rgba(83, 115, 243, 0.8)',
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
                        stepSize: 1,
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
		var ctx = document.getElementById("nilai").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
				labels: ["A", "A-", "B", "B-", "C", "D", "E"],
				datasets: [{
					label: 'Nilai',
					data: [
                        <?php echo jumlah_nilai("A","S1") ?>,
                        <?php echo jumlah_nilai("A-","S1") ?>,
                        <?php echo jumlah_nilai("B","S1") ?>,
                        <?php echo jumlah_nilai("B-","S1") ?>,
                        <?php echo jumlah_nilai("C","S1") ?>,
                        <?php echo jumlah_nilai("D","S1") ?>,
                        <?php echo jumlah_nilai("E","S1") ?>,
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
    <script>
		var ctx = document.getElementById("sks").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ["Semester 1","Semester 2","Semester 3","Semester 4","Semester 5","Semester 6",
                "Semester 7","Semester 8",],
				datasets: [{
					label: 'SKS',
					data: [
                        <?php echo sks_lulus("S1"); ?>,
                        <?php echo sks_lulus("S2")+sks_lulus("S1"); ?>,
                        <?php echo sks_lulus("S3")+sks_lulus("S2")+sks_lulus("S1"); ?>,
                        <?php echo sks_lulus("S4")+sks_lulus("S3")+sks_lulus("S2")+sks_lulus("S1"); ?>,
                        <?php echo sks_lulus("S5")+sks_lulus("S4")+sks_lulus("S3")+sks_lulus("S2")+sks_lulus("S1"); ?>,
                        <?php echo sks_lulus("S6")+sks_lulus("S5")+sks_lulus("S4")+sks_lulus("S3")+sks_lulus("S2")+sks_lulus("S1"); ?>,
                        <?php echo sks_lulus("S7")+sks_lulus("S6")+sks_lulus("S5")+sks_lulus("S4")+sks_lulus("S3")+sks_lulus("S2")+sks_lulus("S1"); ?>,
                        <?php echo sks_lulus("S8")+sks_lulus("S7")+sks_lulus("S6")+sks_lulus("S5")+sks_lulus("S4")+sks_lulus("S3")+sks_lulus("S2")+sks_lulus("S1"); ?>,
                    ],
					backgroundColor: [
					'rgba(255, 99, 132, 0.8)',
					'rgba(54, 162, 235, 0.8)',
					'rgba(255, 206, 86, 0.8)',
                    'rgba(0, 255, 12, 0.8)',
                    'rgba(144, 0, 255, 0.8)',
                    'rgba(249, 120, 0, 0.8)',
                    'rgba(79, 205, 161, 0.8)',
                    'rgba(83, 115, 243, 0.8)',
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
                    'rgba(0, 255, 12, 1)',
                    'rgba(144, 0, 255, 1)',
                    'rgba(249, 120, 0, 1)',
                    'rgba(79, 205, 161, 1)',
                    'rgba(83, 115, 243, 1)',
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
                        stepSize: 20,
                        beginAtZero: true,
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
		var ctx = document.getElementById("sks_tempuh").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'pie',
			data: {
				labels: ["SKS Selesai","Sisa SKS"],
				datasets: [{
					label: 'Nilai',
					data: [
                        <?php echo sks_selesai(); ?>,
                        <?php echo total_sks()-sks_selesai(); ?>,
                    ],
					backgroundColor: [
					'rgba(255, 99, 132, 0.8)',
					'rgba(54, 162, 235, 0.8)',
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
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
    <script type="text/javascript">
        $(document).ready(function(){
            $("#semester").change(function(){
                var semester=$("#semester").val();
                $.ajax({
                type:"post",
                url:"getnilai.php",
                data:"semester="+semester,
                success:function(data){
                    $("#txtHint").html(data);
                }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>