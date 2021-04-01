<?php

  // include autoloader
  require_once 'vendor/dompdf/dompdf/autoload.inc.php';

  require_once __DIR__.'/../bootstrap.php';

  // reference the Dompdf namespace
  use Dompdf\Dompdf;
  use Dompdf\Options;

  $option = new Options();

  $opciones_ssl=array(
  "ssl"=>array(
  "verify_peer"=>false,
  "verify_peer_name"=>false,
  ),
  );
  // Quality is a number between 0 (best compression) and 100 (best quality)
  function png2jpg($originalFile, $outputFile, $quality) {
    $image = imagecreatefrompng($originalFile);
    imagejpeg($image, $outputFile, $quality);
    imagedestroy($image);
}

  // instantiate and use the dompdf class
  $dompdf = new Dompdf(array('isRemoteEnabled' => true,));
  //$options = $dompdf->getOptions();
  //$options->setDefaultFont('Courier');
  //$dompdf->setOptions($options);


  ob_start();
  $css = file_get_contents("css/styles.css" , True);
  require_once "model/travelsManagement.php";

  $vendorAds = dataFromAllVendor();

  $checklist = checklistForMyTravel();

  $homePageFlag = true;

  $aTravel = $vendorAds[array_search($travelID, array_column($vendorAds, "ID"))];

  $img_path = $aTravel["image"];
  $data = file_get_contents($img_path, false, stream_context_create($opciones_ssl));
  $extencion = pathinfo($img_path,  PATHINFO_EXTENSION);
  $img_base_64 = base64_encode(file_get_contents($img_path));
  $path_img = 'data:image/' . $extencion . ';base64,' . $img_base_64;

  require_once 'view/homeForPdf.php';

  //$html = file_get_contents("view/homeForPdf.php", True);
  $html = ob_get_clean();
  $dompdf->loadHtml($html);

  // (Optional) Setup the paper size and orientation
  $dompdf->setPaper('A4', 'portrait');

  // Render the HTML as PDF
  $dompdf->render();

  // Output the generated PDF to Browser
  $dompdf->stream("HotelplanEnMieux - PDF.pdf", array("Attachment" => 1));
