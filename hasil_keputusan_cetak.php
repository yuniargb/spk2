<style type="text/css" media="print">
  @page { size: landscape;font-size: 10px; }
  @media print {
	p {
		font-size: 6pt;
	}

    table {
        font-size: 6pt;
    }
    }
    .page-header{
        text-align: center;
    }
    .table th,.table td{
        border: 2px solid black;
    }
</style>

<div class="page-header">
    <h2>Laporan Hasil Keputusan</h2>
</div>

<h6>Periode : <?= $_GET['periode'] ?></h6>
<table class="table table-bordered table-striped table-hover" width="100%" border="1">
<?php       
$normal = SAW_nomalize(SAW_get_rel($_GET['periode'])); 
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
    echo"<th>$_GET[periode]</th>";
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
            
