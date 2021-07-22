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
echo SAW_step2(true,$_GET['periode']);
?>             
                    </table>       
            
