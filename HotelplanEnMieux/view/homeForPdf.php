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
//ob_start();
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?=$title;?></title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <style><?= $css ?></style>
    </head>
    <body>
<div class="bg-light" id="divMain">
<!-- Masthead-->
<section class="bg-light" id="travel">
    <div class="container">

        <!-- travel Modals-->
        <!-- Modal 1-->
        <div class="travel-modal" id="travel<?= $aTravel["ID"]?>"  role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase"><?= $aTravel['title']; ?></h2>
                                    <p class="item-intro text-muted"><?= $aTravel['destination']; ?></p>
                                    <img class="img-fluid d-block mx-auto" src="<?= $aTravel["image"] ?>" style="max-width: 30em; max-height: 30em;" alt="" />
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    <ul class="list-inline">
                                        <li>Date: January 2020</li>
                                        <li>Client: Threads</li>
                                        <li>Category: Illustration</li>
                                    </ul>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

        </div>
    </div>
</section>
</div>

<!--________FIN CONTENU________-->

<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<!-- Contact form JS-->
<script src="../assets/mail/jqBootstrapValidation.js"></script>
<script src="../assets/mail/contact_me.js"></script>
<!-- Core theme JS-->
</body>
</html>

<?php
    //$content = ob_get_clean();
    //require "gabarit.php";
?>
