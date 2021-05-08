<div class="page-header">
    <h1>Nilai Bobot Alternatif</h1>
</div>
<div class="panel panel-default">
<div class="panel-heading">
<form class="form-inline">
    <input type="hidden" name="m" value="rel_alternatif" />
    <div class="form-group">
        <input class="form-control" type="text" name="q" value="<?=$_GET['q']?>" placeholder="Pencarian..." />
    </div>
    <div class="form-group">
        <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
    </div>
</form>
</div>
<table class="table table-bordered table-hover table-striped">
<thead>
    <tr>
        <th>Kode</th>
        <th>Nama Alternatif</th>
        <?php
        $heads = $db->get_var("SELECT COUNT(*) FROM tb_kriteria");
        if($heads>0):
        for($a = 1; $a<=$heads; $a++){
            echo "<th>C$a - ".$KRITERIA['C0'.$a]['nama_kriteria']."</th>";
        }
        endif;  
        ?>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
<?php

$rows = $db->get_results("SELECT
        	a.kode_alternatif, a.nama_alternatif,	
        	ra.kode_nilai_kriteria,
            c.keterangan
        FROM tb_rel_alternatif ra 
        	INNER JOIN tb_alternatif a ON a.kode_alternatif = ra.kode_alternatif
            LEFT JOIN tb_nilai_kriteria c ON c.kode_nilai_kriteria = ra.kode_nilai_kriteria
        WHERE nama_alternatif LIKE '%".esc_field($_GET[q])."%'
        ORDER BY kode_alternatif, ra.kode_kriteria;", ARRAY_A);
$data = array();        
foreach($rows as $row){
    $data[$row['nama_alternatif']][]  = $row;    
}

$no=0;

foreach($data as $key => $value):?>
<tr>
    <td>A<?=++$no ?></td>
    <td><?=$key;?></td>
    <?php  
        foreach($value as $dt){
            echo "<td>$dt[keterangan]</td>";               
        }        
    ?>
    <td>
        <a class="btn btn-xs btn-warning" href="?m=rel_alternatif_ubah&ID=<?=$value[0]['kode_alternatif']?>"><span class="glyphicon glyphicon-edit"></span> Ubah</a>        
    </td>
</tr>
<?php endforeach;
?>
</tbody>
</table>
</div>