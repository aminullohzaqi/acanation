<?php
    session_start();
    include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="Assets/css/style.css" rel="stylesheet">
    <link href="Assets/css/login.css" rel="stylesheet">
</head>
<body>
    <table id="login" class="container shadow" style="width: 350px; margin-top: 100px;">
        <thead>
            <th style="text-align: center;">USER LOGIN</th>
        </thead>
        <tbody>
            <td>
            <form action="login_auth.php" method="POST">
                    <div class="form-group">
                        <label for="uname"><i class="fa fa-user" aria-hidden="true"></i> Username:</label>
                        <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
                    </div>
                    <div class="form-group">
                        <label for="pwd"><i class="fa fa-lock" aria-hidden="true"></i> Password :</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
                    </div>
                    <button type="submit" class="">LOGIN</button>
            </form> 
            </td>
        </tbody>
    </table>
</body>
</html>