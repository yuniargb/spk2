<div class="page-header">
    <h1>Nilai Bobot Alternatif</h1>
</div>
<?php
    if($_POST['pilih'] || $_POST['delete']) include'aksi.php';
?>
<div class="panel panel-default">
<div class="panel-heading">
    <form class="form-inline" method="post">
        <div class="form-group">
            <select class="form-control" name="alternatif">
            <?=get_alternatif_option( $_POST['alternatif'])?>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" name="pilih" type="submit" value="pilih"><span class="glyphicon glyphicon-edit"></span> Pilih</button>
        </div>
    </form>

    <br>
    <form class="form-inline" method="post">
        <button class="btn btn-warning btn-xs" name="proses" type="submit" value="proses"><span class="glyphicon glyphicon-edit"></span> Proses</button>
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
            ra.nilai_alternatif
        FROM tb_rel_alternatif ra 
        	INNER JOIN tb_alternatif a ON a.kode_alternatif = ra.kode_alternatif
        WHERE ra.status = 1 AND nama_alternatif LIKE '%".esc_field($_GET[q])."%'
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
            if($dt['nilai_alternatif'])
                echo "<td>". $dt['nilai_alternatif'] ."</td>";    
            else  
            echo "<td>  0 </td>";             
        }        
    ?>
    <td>
        <a class="btn btn-xs btn-warning" href="?m=rel_alternatif_periode&ID=<?=$value[0]['kode_alternatif']?>"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
        
        
        <form class="form-inline" method="post">
            <input type="hidden" name="ID" value="<?=$value[0]['kode_alternatif']?>">
            <button class="btn btn-danger btn-xs" name="delete" type="submit" value="delete"><span class="glyphicon glyphicon-trash"></span> Delete</button>
        </form>  
    </td>
</tr>
<?php endforeach;
?>
</tbody>
</table>

<?php
    if($_POST['proses']) include'hitung_saw.php';
    ?>
</div>