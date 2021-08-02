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
$normal = SAW_nomalize(SAW_get_rel($_GET['periode'])); 
$total = hitung($normal);        
$rank = get_rank($total);
$no=1;
foreach($rank as $key => $value){
    if($key == $_GET['ID']){
        $row = get_alternatif($key);

        insert_hasil($key,round($total[$key], 3),$_GET['periode']);
        echo "<table>";
        echo "<tr>";
            echo "<th>";
            echo "Kode Supplier";
            echo "</th>";
            echo "<th>";
            echo ":";
            echo "</th>";
            echo "<td>";
            echo $key;
            echo "</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<th>";
            echo "Nama Supplier";
            echo "</th>";
            echo "<th>";
            echo ":";
            echo "</th>";
            echo "<td>";
            echo $ALTERNATIF[$key];
            echo "</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<th>";
            echo "Alamat";
            echo "</th>";
            echo "<th>";
            echo ":";
            echo "</th>";
            echo "<td>";
            echo $row->alamat;
            echo "</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<th>";
            echo "Nomor Telepon";
            echo "</th>";
            echo "<th>";
            echo ":";
            echo "</th>";
            echo "<td>";
            echo $row->telp;
            echo "</td>";
        echo "</tr>";
        echo "<tr>";
            echo "<th>";
            echo "Hasil";
            echo "</th>";
            echo "<th>";
            echo ":";
            echo "</th>";
            echo "<td>";
            echo round($total[$key], 3);
            echo "</td>";
        echo "</tr>";
        echo "</table>";
    }   
   
    // $no++;    
}     
?>
      
<p>Menyatakan bahwa supplier tersebut terpilih sebebagi supplier terbaik</p>
