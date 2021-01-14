<?php
    session_start();
    include "../../koneksi.php";
    $semester = $_GET['q'];
    $username = $_SESSION["username"];

    $sql = mysqli_query($conn, "SELECT * FROM `matkul` WHERE `semester` = '$semester'"); ?>

    <table id="tabel">
    <tr>
        <th>ID</th>
        <th>Mata Kuliah</th>
        <th>Jumlah SKS</th>
        <th>Hapus</th>
    </tr>
    <?php while ($row=mysqli_fetch_array($sql)){ ?>
    <tr>
        <td><?php echo $row["id"]?></td>
        <td><?php echo $row["matakuliah"]?></td>
        <td><?php echo $row["sks"]?></td>
        <td>
            <a href="delete.php?id=<?php echo $row["id"]?>" onclick="return confirm('Yakin mau di hapus?');">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
        </td>
    </tr>
    
    <?php }
?>
    </table>