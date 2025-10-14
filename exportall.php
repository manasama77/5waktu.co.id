<?php
// Fungsi header dengan mengirimkan raw data excel
header('Cache-Control: max-age=0');
header("Content-type: application/vnd.ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=limawaktulogistic-export-all-data.xls");

// Tambahkan table
include 'alldataexport2.php';
 

?>