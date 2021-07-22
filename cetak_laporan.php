<?php include 'functions.php';?>
<!doctype html>
<html>
<head>
<title>Cetak Laporan</title>
<style>
body{
    font-family: Verdana;
    font-size: 13px;
}
.head{
    font-size: 14px;
    border-bottom: 4px double #000;
    padding:3px 0;
}
table{
    border-collapse: collapse;   
    margin-bottom: 10px; 
}
td, th{
    /* border: 1px solid #000; */
    padding: 3px;
}
.wrapper{
    margin: 0 auto;
    width: 980px;
}
.title{
    line-height:  20%;;
}
hr{
    border: 2px solid black;
}
.ttd{
    float: right;
    text-align: center;
}
.ttd-box{
    height: 50px;
}
.text-red{
    color: red;
}
</style>
</head>
<body onload="window.print()">
<div class="wrapper">
    <table width="100%">
        <tr>
            <td width="25%" align="center">
                <img width="100" src="assets/images/logo.png"/>
            </td>
            <td align="center" class="title">
                <h4 class="text-red">IYON COLLECTION</h4>
                <h4>MENJUAL RUPA-RUPA</h4>
                <h4>PAKAIAN GAMIS DEWASA</h4>
                <p>Lantai Dasar AKS No.27 - 28</p>
                <p>Pasar Cipulir - Jakarta Selatan</p>
            </td>
            <td width="25%" align="center">
                
            </td>
        </tr>
    </table>
    <hr>
<?php
if(is_file($_GET[m].'_cetak.php'))
    include $_GET[m].'_cetak.php';
?>
<div class="ttd">
    <h6>Pimpinan Iyon Collection</h6>
    <div class="ttd-box"></div>
    <h6>Jamirosti</h6>
</div>
</div>
</body>
</html>