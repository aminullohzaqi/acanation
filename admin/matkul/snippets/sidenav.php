<div class="sidenav shadow">
    <div class="logo-brand">
        <img src="../../img/<?php echo $display; ?>" class="logo">
        <h4><?php echo $row["nama"]; ?></h4>
    </div>
    <br>
    <a href="../index.php"><i class="fa fa-fw fa-desktop" aria-hidden="true"></i> Home</a>
    <a href="../nilai/editnilai.php"><i class="fa fa-fw fa-file-text" aria-hidden="true"></i> Nilai</a>
    <a href="daftar.php" class="active"><i class="fa fa-fw fa-list-ul" aria-hidden="true"></i> Mata Kuliah</a>
    <a href="../pengumuman/pengumuman.php"><i class="fa fa-fw fa-bullhorn" aria-hidden="true"></i> Pengumuman</a>
    <a href="../user/userlist.php"><i class="fa fa-fw fa-users" aria-hidden="true"></i> User</a>
    <a href="../logout.php"><i class="fa fa-fw fa-sign-out" aria-hidden="true"></i> Log Out</a>
	<br>
	<br>
    <div class="custom-control custom-switch" id="dark-mode">
        <input type="checkbox" class="custom-control-input" id="darkSwitch">
        <label class="custom-control-label darklabel" for="darkSwitch">Dark</label>
    </div>
    <script src="../../Assets/js/dark-mode-switch.min.js"></script>
</div>

<nav class="navbar fixed-top navbar-expand-md navbar-light bg-light shadow">
    <a class="navbar-brand" href="index.php">Acanation</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
            <a href="../index.php"><i class="fa fa-fw fa-desktop" aria-hidden="true"></i> Home</a>
        </li>
        <li class="nav-item">
            <a href="../nilai/editnilai.php"><i class="fa fa-fw fa-file-text" aria-hidden="true"></i> Nilai</a>
        </li>
        <li class="nav-item">
            <a href="daftar.php"><i class="fa fa-fw fa-list-ul" aria-hidden="true"></i> Mata Kuliah</a>
        </li>
        <li class="nav-item">
            <a href="../pengumuman/pengumuman.php"><i class="fa fa-fw fa-bullhorn" aria-hidden="true"></i> Pengumuman</a>
        </li>
        <li class="nav-item">
            <a href="../user/userlist.php"><i class="fa fa-fw fa-users" aria-hidden="true"></i> User</a>
        </li>
        <li class="nav-item">
            <a href="../logout.php"><i class="fa fa-fw fa-sign-out" aria-hidden="true"></i> Log Out</a>
        </li>
        <br>
        <div class="custom-control custom-switch" id="dark-mode">
            <input type="checkbox" class="custom-control-input" id="darkSwitch">
            <label class="custom-control-label darklabel" for="darkSwitch">Dark</label>
        </div>
        <script src="../../Assets/js/dark-mode-switch.min.js"></script>
        </ul>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>