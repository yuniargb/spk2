<div class="page-header">
    <h1>Tambah Alternatif</h1>
</div>
<div class="row">
<div class="col-sm-6">
<?php if($_POST) include'aksi.php'?>
<form method="post" action="?m=alternatif_tambah">
<?php
$row = $db->get_row("SELECT MAX(kode_alternatif) as kda FROM tb_alternatif");
$getNum = substr($row->kda,1) + 1;
if($getNum < 10){
    $newID = 'A0'.$getNum;
}else{
    $newID = 'A'.$getNum;
}

?>

<div class="form-group">
    <label>Kode <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="kode" value="<?=$newID?>" readonly/>
</div>
<div class="form-group">
    <label>Nama Alternatif <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="nama" value="<?=$_POST[nama]?>"/>
</div>
<div class="form-group">
    <label>No Telepon <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="no_telp" value="<?=$_POST[no_telp]?>"/>
</div>
<div class="form-group">
    <label>Alamat <span class="text-danger">*</span></label>
    <textarea class="form-control" name="alamat"><?=$_POST[alamat]?></textarea>
</div>
<button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
<a class="btn btn-danger" href="?m=alternatif"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
</form>
</div>
</div>