<div class="page-header">
    <h2>Perhitungan</h2>
</div>
<!-- <?php
// $c = $db->get_results("SELECT * FROM tb_rel_alternatif WHERE kode_nilai_kriteria NOT IN (SELECT kode_nilai_kriteria FROM tb_nilai_kriteria)");
// if (!$ALTERNATIF || !$KRITERIA):
//     echo "Tampaknya anda belum mengatur alternatif dan kriteria. Silahkan tambahkan minimal 3 alternatif dan 3 kriteria.";
// elseif ($c):
//     echo "Tampaknya anda belum mengatur nilai alternatif. Silahkan atur pada menu <strong>Nilai Alternatif</strong>.";
// else:
    ?> -->
    
    
                <div class="panel panel-primary">
                    <div class="panel-heading"><strong>SAW Hasil Analisa</strong></div>
                    <div class="panel-body oxa"> 
                        <table class="table table-bordered table-striped table-hover">
                            <?php                                            
                            echo SAW_step1();                    
                            ?>
                        </table>
                        <!-- <table class="table table-bordered table-striped table-hover">      
                            <?php    
                            echo SAW_step2();
                            ?>
                        </table> -->
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
            
