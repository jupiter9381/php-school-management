<?php
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/tmp']);
$mpdf->Image('pass.jpg',0,0,210,297,'jpg','',true, false);
$mpdf->displayDefaultOrientation = true;
// Output a PDF file directly to the browser
$mpdf->Output();
?>