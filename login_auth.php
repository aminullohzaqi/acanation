<?php
    session_start();
    include "koneksi.php";

    $username = $_POST["uname"];
    $password = $_POST["password"];
    
    $result   = mysqli_query($conn, "SELECT * FROM `user` 
        LEFT JOIN `data_user` ON `data_user`.`id` = `user`.`id`
        WHERE `user`.`id` = '$username' AND `user`.`password` = '$password'");
    
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
			$db_user = $row['id'];
            $db_pass = $row['password'];
            $db_role = $row['role'];
            $db_angkatan = $row['angkatan'];
            $db_kelas= $row['kelas'];
            $db_display = $row['display'];
 
			if($username == $db_user && $password == $db_pass){
                $_SESSION["username"] = $username;
                $_SESSION["angkatan"] = $db_angkatan;
                $_SESSION["kelas"]    = $db_kelas;
                $_SESSION["display"]  = $db_display;
                $_SESSION["role"]     = $db_role;

                if($db_role == 'user'){
                    header("Location: user/index.php");
                    exit;
                }
                else if($db_role == 'admin'){
                    header("Location: admin/index.php");
                    exit;
                }
                
			}else{
                echo "<script>
                    alert('Gagal Login');
                    document.location.href='index.php';
                </script>";
			}
    }
    else{
        echo "<script>
            alert('Gagal Login');
            document.location.href='index.php';
        </script>";
    }
?>