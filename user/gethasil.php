<?php
    session_start();
    include "../koneksi.php";
    $semester = $_GET['q'];
    $username = $_SESSION["username"];

    $sql = mysqli_query($conn, "SELECT * FROM `matkul`
    LEFT JOIN `nilai` ON `nilai`.`id_matkul` = `matkul`.`id`
    WHERE `matkul`.`semester` = '$semester' AND `nilai`.`id_user` = '$username'");

    $sks = mysqli_query($conn, "SELECT SUM(sks) FROM `matkul`
    LEFT JOIN `nilai` ON `nilai`.`id_matkul` = `matkul`.`id`
    WHERE `nilai`.`id_user` = '$username' AND `matkul`.`semester` = '$semester'");
    $row_sks = mysqli_fetch_array($sks);

    $bobot = mysqli_query($conn, "SELECT SUM(bobot) FROM `matkul`
    LEFT JOIN `nilai` ON `nilai`.`id_matkul` = `matkul`.`id`
    WHERE `nilai`.`id_user` = '$username' AND `matkul`.`semester` = '$semester'");
    $row_bobot = mysqli_fetch_array($bobot);
?>

    <table id="tabel">
    <tr>
        <th>Mata Kuliah</th>
        <th>SKS</th>
        <th>Kehadiran</th>
        <th>Tugas</th>
        <th>UTS</th>
        <th>UAS</th>
        <th>Nilai Mutu</th>
        <th>Bobot</th>
        <th>Nilai</th>
    </tr>
    <?php while ($row=mysqli_fetch_array($sql)){ ?>
    <tr>
        <td><?php echo $row["matakuliah"]?></td>
        <td><?php echo $row["sks"]?></td>
        <td><?php echo $row["kehadiran"]?></td>
        <td><?php echo $row["tugas"]?></td>
        <td><?php echo $row["uts"]?></td>
        <td><?php echo $row["uas"]?></td>
        <td><?php echo $row["nilaimutu"]?></td>
        <td><?php echo $row["bobot"]?></td>
        <td><?php echo $row["nilai"]?></td>
    </tr>
    
    <?php }
?>
    <tr>
        <th colspan=8>IP Sementara</th>
        <td>
            <?php 
                $total_bobot = $row_bobot[0];
                $total_sks   = $row_sks[0];
                $IPS         = "";
                if($total_bobot != 0 || $total_sks !=0){
                    $IPS     = $total_bobot/$total_sks;
                    echo $IPS;
                }
                else{
                    $IPS = "Belum Ada Nilai";
                    echo $IPS;
                }  
                 
            ?>
        </td>
    </tr>
    </table>