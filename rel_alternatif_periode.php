<?php
$row = $db->get_row("SELECT * FROM tb_alternatif WHERE kode_alternatif='$_GET[ID]'"); 
?>
<div class="page-header">
    <h1>Periode &raquo; <small><?=$row->nama_alternatif?></small></h1>
</div>
<div class="row">
<div class="col-sm-4">
<form method="post" action="?m=rel_alternatif_ubah&ID=<?=$row->kode_alternatif?>">
<select name="periode" id="periode" class="form-control">
<?php
$years = date("Y");
$year = $years - 10;

while ($years >= $year){ ?>
    <option value="<?= $years ?>"><?= $years ?></option>
<?php
    $years--;
}
?>
</select>
<button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Pilih</button>
<a class="btn btn-danger" href="?m=rel_alternatif"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
</form>
</div>
</div>