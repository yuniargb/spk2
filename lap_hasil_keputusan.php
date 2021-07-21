<div class="page-header">
    <h2>Laporan</h2>
</div>        
                <div class="panel panel-primary">
                    <div class="panel-heading"><strong>Cetak Laporan Hasil Keputusan</strong></div>
                    <div class="panel-body oxa">
                    <table class="table table-bordered table-striped table-hover">
                    <?php       
                    $normal = SAW_nomalize(SAW_get_rel($_POST['periode'])); 
                    reset($normal);                
                    
                    echo"<tr>";   	
                    $no=1;
                    echo "<th>No</th>";
                    echo "<th>Nama Alternatif</th>";
                    echo "<th>Periode</th>";
                    foreach($normal[key($normal)] as $key => $value){
                        echo"<th>".$KRITERIA[$key]['nama_kriteria']."</th>";
                        $no++;      
                    }    
                    echo"</tr>";
                    
                    $total = hitung($normal);        
                    $rank = get_rank($total);
                    $no=1;
                    foreach($rank as $key => $value){
                        echo"<tr>";
                        echo"<th>$no</th>";
                        echo"<th>$ALTERNATIF[$key]</th>";
                        echo"<th>$_POST[periode]</th>";
                        $tot=0;
                        foreach($normal[$key] as $k => $v){                           
                            $tot+=$v * $KRITERIA[$k]['bobot'];                                 
                            echo "<td>".round($v * $KRITERIA[$k]['bobot'], 3 )."</td>";
                        }        
                        echo "</tr>";
                        $no++;    
                    }                            
                    ?>
                    </table>              
                        <div class="form-group">
                            <a class="btn btn-default" target="_blank" href="cetak_laporan.php?m=hasil_keputusan&periode=<?= $_POST['periode'] ?>"><span class="glyphicon glyphicon-print"></span> Cetak Laporan</a>
                        </div> 
                    </div>
                </div>
                <style>
                    .text-primary{font-weight: bold;}
                </style>
            
