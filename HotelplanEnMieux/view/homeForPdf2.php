<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : PreTPI HotelplanEnMieux
 * Created  : 15.02.2021
 *
 * Git source  : [https://github.com/keanutrosset/HotelplanEnMieux]
 *
 */


$title = "HotelplanEnMieux";

$aTravel = $vendorAds[array_search($travelID, array_column($vendorAds, "ID"))];

$pdf = true;

//$imageType = pathinfo($aTravel["image"],  PATHINFO_EXTENSION);
//$aTravel["image"] = base64_encode(file_get_contents($aTravel["image"]));

// tampon de flux stocké en mémoire
ob_start();
?>
<img class="img-fluid d-block mx-auto" src="<?= $aTravel["image"] ?>" style="max-width: 30em; max-height: 30em;" alt="" />

</section>
