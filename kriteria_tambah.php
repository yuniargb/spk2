<div class="page-header">
    <h1>Tambah Kriteria</h1>
</div>
<div class="row">
<div class="col-sm-6">
<?php if($_POST) include'aksi.php'?>
<form method="post" action="?m=kriteria_tambah">
<?php
$row = $db->get_row("SELECT MAX(kode_kriteria) as kda FROM tb_kriteria");
$getNum = substr($row->kda,1) + 1;
if($getNum < 10){
    $newID = 'C0'.$getNum;
}else{
    $newID = 'C'.$getNum;
}

?>
<div class="form-group">
    <label>Kode <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="kode" value="<?=$newID?>" readonly/>
</div>
<div class="form-group">
    <label>Nama Kriteria <span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="nama" value="<?=$_POST[nama]?>"/>
</div>
<div class="form-group">
    <label>Atribut <span class="text-danger">*</span></label>
    <select class="form-control" name="atribut">
        <option></option>
        <?=get_atribut_option($_POST[atribut])?>
    </select>
</div>
<button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
<a class="btn btn-danger" href="?m=kriteria"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
</form>
</div>
</div>