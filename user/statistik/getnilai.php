<?php
    session_start();
    include "../../koneksi.php";
    if(!isset($_SESSION["username"])){
        header("Location: ../index.php");
        exit;
    }
    $semester=$_POST["semester"];
    $username = $_SESSION["username"]; 
    function jumlah_nilai($nilai){
        global $conn;
        global $username;
        global $semester;
        $return = array();
        $jumlah=mysqli_query($conn,"SELECT COUNT(nilai) FROM `matkul`
        LEFT JOIN `nilai` ON `nilai`.`id_matkul` = `matkul`.`id`
        WHERE `nilai`.`id_user` = '$username' AND `matkul`.`semester` = '$semester' AND `nilai`.`nilai` = '$nilai'");
        while ($row=mysqli_fetch_array($jumlah)){ 
            $return = $row[0];    
        }
        return $return;
    }
?>  
   <canvas id="nilai_list"></canvas>
   <script>
		var ctx = document.getElementById("nilai_list").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
				labels: ["A", "A-", "B", "B-", "C", "D", "E"],
				datasets: [{
					label: 'Nilai',
					data: [
                        <?php echo jumlah_nilai("A") ?>,
                        <?php echo jumlah_nilai("A-") ?>,
                        <?php echo jumlah_nilai("B") ?>,
                        <?php echo jumlah_nilai("B-") ?>,
                        <?php echo jumlah_nilai("C") ?>,
                        <?php echo jumlah_nilai("D") ?>,
                        <?php echo jumlah_nilai("E") ?>,
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