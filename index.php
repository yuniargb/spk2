<?php
    include'functions.php';
    if(empty($_SESSION[login]))
        header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Sistem Pendukung Keputusan(SPK) Metode Simple Additive Weighting (SAW). Studi kasus: TUBAGUS AGLONEMA."/>
    <link rel="icon" href="assets/images/favicon.png"/>

    <title>SISTEM PENDUKUNG KEPUTUSAN PEMILIHAN PAKET UMROH UNTUK CALON JAMAAH DENGAN METODE ANALYTICAL HIERARCHY PROCESS (AHP) DAN SIMPLE ADDITIVE WEIGHTING (SAW) PADA (Study Kasus : PT AMANAH UMROH HANDAL)
</title>
    <link href="assets/css/flatly-bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/general.css" rel="stylesheet"/>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>           
  </head>
  <body data-spy="scroll" data-target=".navbar" data-offset="50">
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?m=hitung">
            <img class="img-responsive" width="100" src="assets/images/logo.png"/>
          </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="?m=kriteria" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-th-large"></span> Kriteria <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="?m=kriteria"><span class="glyphicon glyphicon-th-large"></span> Kriteria</a></li>
                    <li><a href="?m=crips"><span class="glyphicon glyphicon-star"></span> Nilai Kriteria</a></li>
                </ul>
            </li>
            <li><a href="?m=rel_kriteria"><span class="glyphicon glyphicon-th"></span> Nilai Perbandingan Kriteria AHP</a></li>
            <li class="dropdown">
                <a href="?m=alternatif" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Alternatif <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="?m=alternatif"><span class="glyphicon glyphicon-user"></span> Alternatif</a></li>
                    <li><a href="?m=rel_alternatif"><span class="glyphicon glyphicon-user"></span> Nilai Alternatif</a></li>
                </ul>
            </li>
            <li><a href="?m=hitung"><span class="glyphicon glyphicon-calendar"></span> Perhitungan</a></li>                
            <li><a href="?m=password"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
            <li><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>      
          </ul>          
        </div><!--/.nav-collapse -->
    </nav>

    <div class="container">
    <?php
        if(file_exists($mod.'.php'))
            include $mod.'.php';
        else
            include 'home.php';
    ?>
    </div>
    <footer class="footer bg-primary">
      <div class="container">
        <p>  Copyright &copy; 2021 - Sistem Pendukung Keputusan Paket Umroh AHP-SAW</p>
      </div>
    </footer>
</html>