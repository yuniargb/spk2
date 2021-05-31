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
</style>
<h1>Perhitungan</h1>
<?php         
$normal = SAW_nomalize(SAW_get_rel(false));
?>

<table class="table table-bordered table-striped table-hover">
<?php        
echo"<tr><th></th>";   	
$no=1;	
foreach($normal[key($normal)] as $key => $value){
    echo"<th>".$KRITERIA[$key][nama_kriteria]."</th>";
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