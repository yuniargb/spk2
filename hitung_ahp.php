<div class="page-header">
    <h2>Perhitungan</h2>
</div>
    
    <div class="panel panel-primary">
        <div class="panel-heading"><strong>AHP Kriteria Analisa</strong></div>
        <div class="panel-body"> 
            <div class="table-responsive">            
                <table class="table table-bordered table-hover table-striped">
                    <?php $data = get_rel_kriteria_res(); ?>
                    <thead><tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <?php foreach($data as $key => $val):?>
                        <th><?=$key?></th>
                        <?php endforeach?>
                    </tr></thead>
                    <tbody>
                        <?php 
                        $kolom_total = get_kolom_total($data); 
                        $normal = AHP_normalize($data, $kolom_total); 
                        // var_dump($kolom_total);                 
                        $jumlah = AHP_get_jumlah($normal);    
                        $rata = AHP_get_rata($jumlah);     
                        $ci = AHP_get_ci($kolom_total,$rata);     
                        $cm = AHP_consistency_measure($data, $rata);
                        $hasil_perbaris = AHP_rata_rata($data, $rata);
                        $hasil = AHP_get_hasil($hasil_perbaris, $rata);
                        // var_dump($data);
                        // var_dump($kolom_total);
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
                            <?php foreach($data as $key => $val):?>
                            <th><?=$key?></th>
                            <?php endforeach?>
                            <th>Jumlah</th>
                            <th>Prioritas</th>
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
                                <td><?=round($jumlah[$key], 3)?></td> 
                                <td><?=round($rata[$key], 3)?></td>              
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
                        $RI = $nRI[count($data)];
                        $CR = $ci/$RI;
                        echo "<p>Consistency Index: ".round($ci, 3)."<br />";   
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
                <style>
                    .text-primary{font-weight: bold;}
                </style>
