<div class="page-header">
    <h2>Laporan</h2>
</div>        
                <div class="panel panel-primary">
                    <div class="panel-heading"><strong>Cetak Laporan Hasil Penilaian Supplier</strong></div>
                    <div class="panel-body oxa">
                    <table class="table table-bordered table-striped table-hover">
                    <?php       
                    $normal = SAW_nomalize(SAW_get_rel($_POST['periode'])); 
                    reset($normal);                
                    
                    echo"<tr>";   	
                    $no=1;
                    echo "<th>Nama Alternatif</th>";
                    echo "<th>Nilai</th>";
                    echo "<th>Periode</th>";
                    // echo "<th>Pilih</th>";
                    echo"</tr>";
                    
                    $total = hitung($normal);        
                    $rank = get_rank($total);
                    $no=1;
                    foreach($rank as $key => $value){
                        echo"<tr>";
                        echo"<th>$ALTERNATIF[$key]</th>";
                        echo "<td class='text-primary'>".round($total[$key], 3)."</td>";
                        echo"<td>$_POST[periode]</td>";
                        // echo "<td><a class='btn btn-warning btn-xs' target='_blank' href='cetak_laporan.php?m=penilaian_supp_detail&ID=$key&periode=". $_POST['periode']."'>cetak</a></td>";
                        $tot=0;
                        echo "</tr>";
                        $no++;    
                    }                            
                    ?>
                    </table>              
                        <div class="form-group">
                            <a class="btn btn-default" target="_blank" href="cetak_laporan.php?m=penilaian_supp&periode=<?= $_POST['periode'] ?>"><span class="glyphicon glyphicon-print"></span> Cetak Laporan</a>
                        </div> 
                    </div>
                </div>
                <style>
                    .text-primary{font-weight: bold;}
                </style>
            
