<?php 

echo $main_content; 


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$name.'.xls"');
header('Cache-Control: max-age=0');
?>
