
<div class="page-header">
    <h1>Periode</h1>
</div>
<div class="row">
<div class="col-sm-4">
<form method="post" action="?m=lap_hasil_keputusan">
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
<!-- <a class="btn btn-danger" href="?m=rel_alternatif"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a> -->
</form>
</div>
</div>