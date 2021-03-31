<?php

  // include autoloader
  require_once 'vendor/dompdf/dompdf/autoload.inc.php';

  require_once __DIR__.'/../bootstrap.php';

  // reference the Dompdf namespace
  use Dompdf\Dompdf;
  use Dompdf\Options;

  // instantiate and use the dompdf class
  $dompdf = new Dompdf(array('enable_remote' => true));
  //$options = $dompdf->getOptions();
  //$options->setDefaultFont('Courier');
  //$dompdf->setOptions($options);


  ob_start();
  $css = file_get_contents("css/styles.css" , True);
  require_once "model/travelsManagement.php";

  $vendorAds = dataFromAllVendor();

  $homePageFlag = true;
  require_once 'view/homeForPdf.php';

  //$html = file_get_contents("view/homeForPdf.php", True);
  $html = ob_get_clean();
  $dompdf->loadHtml($html);

  // (Optional) Setup the paper size and orientation
  $dompdf->setPaper('A4', 'landscape');

  // Render the HTML as PDF
  $dompdf->render();

  // Output the generated PDF to Browser
  $dompdf->stream("HotelplanEnMieux - PDF.pdf", array("Attachment" => 0));
