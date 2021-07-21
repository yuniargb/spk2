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
    <h2>Hasil Keputusan</h2>
</div>

<h6>Periode : <?= $_GET['periode'] ?></h6>

<p>Berdasarkan Keputusan penilaian supplier, maka supplier dengan data sebagai berikut :</p>

<?php
foreach($rank as $key => $value){
    if($key == $_['ID']){
        
    }
    echo "<tr>";
    echo "<th>$ALTERNATIF[$key]</th>";
    echo "<td class='text-primary'>".round($total[$key], 3)."</td>";
    echo "<td>$_GET[periode]</td>";
    echo "</tr>";
    // $no++;    
}     
?>
            
