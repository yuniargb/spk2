<div class="page-header">
    <h1>Nilai Bobot Kriteria</h1>
</div>
<?php
if($_POST['pilih'] || $_POST['edit'] || $_POST['delete']) include'aksi.php';
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline" method="post">
            <div class="form-group">
                <select class="form-control" name="kriteria">
                <?=get_kriteria_option( $_POST['kriteria'])?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" name="pilih" type="submit" value="pilih"><span class="glyphicon glyphicon-edit"></span> Pilih</button>
            </div>
        </form>
        <br>
        <form class="form-inline" method="post">
            <div class="form-group">
                <select class="form-control" name="ID1">
                <?=get_kriteria_res_option( $_POST['ID1'])?>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="nilai">
                <?=AHP_get_nilai_option($_POST['nilai'])?>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="ID2">
                <?=get_kriteria_res_option( $_POST['ID2'])?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" name="edit" type="submit" value="edit"><span class="glyphicon glyphicon-edit"></span> Ubah</button>
            </div>
        </form>
        <br>
        <form class="form-inline" method="post">
            <button class="btn btn-warning" name="proses" type="submit" value="proses"><span class="glyphicon glyphicon-edit"></span> Proses</button>
        </form>
    </div>
    <div class="table-responsive">            
        <table class="table table-bordered table-hover table-striped">
        <?php
            $data = get_rel_kriteria_res();
        ?>
            <thead><tr>
                <th>Kode</th>
                <th>Nama</th>
                <?php foreach($data as $key => $val):?>
                <th><?=$key?></th>
                <?php endforeach?>
                <th>Aksi</th>
            </tr></thead>
            <tbody>
            <?php  
            $kolom_total = get_kolom_total($data); 
            $normal = AHP_normalize($data, $kolom_total);       
            $a=1;
            foreach($data as $key => $val):?>
            <tr>
                <td><?=$key?></td>
                <td><?=$KRITERIA[$key]['nama_kriteria']?></td>
                <?php  
                    $b=1;
                    foreach($val as $k => $v){ 
                        if( $key == $k ) 
                            $class = 'success';
                        elseif($b > $a)
                            $class = 'danger';
                        else
                            $class = '';
                            
                        echo "<td class='$class'>".round($v, 3)."</td>";   
                        $b++;            
                    } 
                    $no++;       
                ?>
                <td>
                <form class="form-inline" method="post">
                    <input type="hidden" name="ID" value="<?=$key?>">
                    <button class="btn btn-danger btn-sm" name="delete" type="submit" value="delete"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                </form>    
                </td>
            </tr>
            <?php $a++; endforeach;?>
            </tbody>        
        </table>
    </div>
    <?php
    if($_POST['proses']) include'hitung_ahp.php';
    ?>
  
</div>