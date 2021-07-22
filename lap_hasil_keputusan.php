<div class="page-header">
    <h2>Laporan</h2>
</div>        
                <div class="panel panel-primary">
                    <div class="panel-heading"><strong>Cetak Laporan Hasil Keputusan</strong></div>
                    <div class="panel-body oxa">
                    <table class="table table-bordered table-striped table-hover">
                    <?php       
                    echo SAW_step2(true,$_POST['periode']);
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
            
