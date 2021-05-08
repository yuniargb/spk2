<div class="page-header">
    <h2>Perhitungan</h2>
</div>
<?php
$c = $db->get_results("SELECT * FROM tb_rel_alternatif WHERE kode_nilai_kriteria NOT IN (SELECT kode_nilai_kriteria FROM tb_nilai_kriteria)");
if (!$ALTERNATIF || !$KRITERIA):
    echo "Tampaknya anda belum mengatur alternatif dan kriteria. Silahkan tambahkan minimal 3 alternatif dan 3 kriteria.";
elseif ($c):
    echo "Tampaknya anda belum mengatur nilai alternatif. Silahkan atur pada menu <strong>Nilai Alternatif</strong>.";
else:
    ?>
    
    <div class="panel panel-primary">
        <div class="panel-heading"><strong>AHP Kriteria Analisa</strong></div>
        <div class="panel-body"> 
            <div class="table-responsive">            
                <table class="table table-bordered table-hover table-striped">
                    <thead><tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <?php foreach($KRITERIA as $key => $val):?>
                            <th><?=$key?></th>
                        <?php endforeach?>
                    </tr></thead>
                    <tbody>
                        <?php
                        $data = get_rel_kriteria();  
                        $kolom_total = get_kolom_total($data); 
                        $normal = AHP_normalize($data, $kolom_total);                  
                        $rata = AHP_get_rata($normal);     
                        $cm = AHP_consistency_measure($data, $rata);
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
                            </tr>
                            <?php $a++; endforeach;?>
                        </tbody>
                        <tfoot><tr>
                            <td colspan="2" class="text-right">Total</td>
                            <?php foreach($kolom_total as $key => $val):?>
                                <td><?=round($val, 3)?></td>
                            <?php endforeach?>
                        </tr></tfoot>         
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading"><strong>AHP Matriks Bobot Prioritas dan Konsistensi Kriteria </strong></div>
            <div class="panel-body"> 
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead><tr>
                            <th>Kode</th>
                            <?php foreach($KRITERIA as $key => $val):?>
                                <th><?=$key?> - <?=$KRITERIA[$key]['nama_kriteria']?></th>
                            <?php endforeach?>
                            <th>Prioritas</th>
                            <th>CM</th>
                        </tr></thead>
                        <?php                                                           
                        foreach($normal as $key => $val):
                            $db->query("UPDATE tb_kriteria SET bobot='$rata[$key]' WHERE kode_kriteria='$key'");
                            ?>
                            <tr>
                                <td><?=$key?> - <?=$KRITERIA[$key]['nama_kriteria']?></td>
                                <?php foreach($val as $k => $v):?>
                                    <td><?=round($v, 3)?></td>
                                <?php endforeach?>   
                                <td><?=round($rata[$key], 3)?></td> 
                                <td><?=round($cm[$key], 3)?></td>              
                            </tr>                        
                        <?php endforeach?>                       
                    </table>
                </div>
            </div>
            <div class="panel-body">
                <p>Berikut tabel ratio index berdasarkan ordo matriks.</p>     

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead><tr>
                            <th>Ordo matriks</th>
                            <?php foreach($nRI as $key => $val):?>
                                <?php if(count($data)==$key):?>
                                    <td class="text-primary"><strong><?=$key?></strong></td>
                                    <?php else:?>
                                        <td><?=$key?></td>
                                    <?php endif?>
                                <?php endforeach?>
                            </tr></thead>
                            <tr>
                                <th>Ratio index</th>
                                <?php foreach($nRI as $key => $val):?>
                                    <?php if(count($data)==$key):?>
                                        <td class="text-primary"><strong><?=$val?></strong></td>
                                        <?php else:?>
                                            <td><?=$val?></td>
                                        <?php endif?>
                                    <?php endforeach?>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <?php
                        $CI = ((array_sum($cm)/count($cm))-count($cm))/(count($cm)-1);  
                        $RI = $nRI[count($data)];
                        $CR = $CI/$RI;
                        echo "<p>Consistency Index: ".round($CI, 3)."<br />";   
                        echo "Ratio Index: ".round($RI, 3)."<br />";
                        echo "Consistency Ratio: ".round($CR, 3);
                        if($CR>0.10){
                            echo " (Tidak konsisten)<br />";    
                        } else {
                            echo " (Konsisten)<br />";
                        }
                        ?>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading"><strong>SAW Hasil Analisa</strong></div>
                    <div class="panel-body oxa"> 
                        <table class="table table-bordered table-striped table-hover">
                            <?php                                            
                            echo SAW_step1();                    
                            ?>
                        </table>
                        <table class="table table-bordered table-striped table-hover">      
                            <?php    
                            echo SAW_step2();
                            ?>
                        </table>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading"><strong>SAW Normalisasi</strong></div>
                    <div class="panel-body oxa">
                        <table class="table table-bordered table-striped table-hover">
                            <?php    

                            $normal = SAW_nomalize(SAW_get_rel(false));

                            $r.= "<tr><th></th>";   	
                            $no=1;	
                            foreach($normal[key($normal)] as $key => $value){
                                $r.= "<th>$key - ".$KRITERIA[$key]['nama_kriteria']."</th>";
                                $no++;      
                            }    

                            $no=1;	
                            foreach($normal as $key => $value){
                                $r.= "<tr>";
                                $r.= "<th>$key - $ALTERNATIF[$key]</th>";
                                foreach($value as $k => $v){
                                    $r.= "<td>".round($v,2)."</td>";
                                }        
                                $r.= "</tr>";
                                $no++;    
                            }    
                            $r.= "</tr>"; 
                            echo  $r;
                            ?>
                        </table>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading"><strong>SAW Perangkingan</strong></div>
                    <div class="panel-body oxa">
                    <table class="table table-bordered table-striped table-hover">
                    <?php        
                    reset($normal);                
                    
                    echo"<tr><th></th>";   	
                    $no=1;	
                    foreach($normal[key($normal)] as $key => $value){
                        echo"<th>$key - ".$KRITERIA[$key]['nama_kriteria']."</th>";
                        $no++;      
                    }            
                    echo"<th>Total</th><th>Rank</th>";
                    echo"</tr>";
                    
                    echo"<tr><th>Bobot</th>";  
                    foreach($KRITERIA as $key => $value){
                        echo "<td class='text-primary'>".round($value['bobot'], 3)."</td>";
                    } 
                    echo "<th></th><th></th></tr>";
                    $total = hitung($normal);        
                    $rank = get_rank($total);
                    
                    foreach($rank as $key => $value){
                        echo"<tr>";
                        echo"<th>$key - $ALTERNATIF[$key]</th>";
                        $tot=0;
                        foreach($normal[$key] as $k => $v){                           
                            $tot+=$v * $KRITERIA[$k]['bobot'];                                 
                            echo "<td>".round($v * $KRITERIA[$k]['bobot'], 3 )."</td>";
                        }        
                        echo "<td class='text-primary'>".round($total[$key], 3)."</td>";
                        echo "<td class='text-primary'>".$value."</td>";
                        echo "</tr>";
                        $no++;    
                    }                            
                    ?>
                    </table>              
                        <div class="form-group">
                            <a class="btn btn-default" target="_blank" href="cetak.php?m=hitung"><span class="glyphicon glyphicon-print"></span> Cetak</a>
                        </div> 
                    </div>
                </div>
                <style>
                    .text-primary{font-weight: bold;}
                </style>
            <?php endif?>
