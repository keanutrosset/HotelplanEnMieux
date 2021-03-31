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

// tampon de flux stocké en mémoire
ob_start();
?>


<!-- Masthead-->
<header class="masthead">
    <div class="container">
        <div class="masthead-subheading"><a style="color:yellow; text-shadow: 1px 1px black, -1px 1px black, 1px -1px black, -1px -1px black">Planification et gestion de<a/></div>
        <div class="masthead-heading text-uppercase" <a style="text-shadow: 1px 1px black, -1px 1px black, 1px -1px black, -1px -1px black">Voyages<a/></div>
        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#travel">Consulter nos voyages</a>
    </div>
</header>
<!-- Services
<section class="page-section" id="services">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Voyages public disponible</h2>
            <h3 class="section-subheading text-muted">Voici les differents voyages que vous pouvez voir sans vous loguez.</h3>
        </div>
        <div class="row text-center">
            <div class="col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-primary"></i>
                    <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="my-3">E-Commerce</h4>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
            </div>
            <div class="col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-primary"></i>
                    <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="my-3">Responsive Design</h4>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
            </div>
            <div class="col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-primary"></i>
                    <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="my-3">Web Security</h4>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
            </div>
        </div>
    </div>
</section> -->

        <?php if(count($vendorAds) > 0):?>
          <!-- travel Grid-->
          <section class="page-section bg-light" id="travel">
              <div class="container">
                  <div class="text-center">
                      <h2 class="section-heading text-uppercase">Voyages</h2>
                      <h3 class="section-subheading text-muted">Voici les voyages publics proposé.</h3>
                  </div>
                  <div class="row">
            <?php foreach ($vendorAds as $aTravel) : ?>
              <?php if($aTravel["isVisible"] == 0):?>

                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="travel-item">
                            <a class="travel-link" data-toggle="modal" href="#travel<?= $aTravel["ID"]?>">
                                <div class="travel-hover">
                                    <div class="travel-hover-content"><i class="fas fa-plus "></i></div>
                                </div>
                                <img class="center" style="display: block; margin-left: auto; margin-right: auto; min-height:20rem; min-width:100%; max-height:20rem; max-width:15rem;" src="<?= $aTravel['image']; ?>" alt="">
                            </a>
                            <div class="travel-caption">
                                <div class="travel-caption-heading"><?= $aTravel['title']; ?></div>
                                <div class="travel-caption-subheading text-muted"><?= $aTravel['destination']; ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- travel Modals-->
                    <!-- Modal 1-->
                    <div class="travel-modal modal fade" id="travel<?= $aTravel["ID"]?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="" /></div>
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8">
                                            <div class="modal-body">
                                                <!-- Project Details Go Here-->
                                                <h2 class="text-uppercase"><?= $aTravel['title']; ?></h2>
                                                <p class="item-intro text-muted"><?= $aTravel['destination']; ?></p>
                                                <img class="img-fluid d-block mx-auto" src="<?= $aTravel['image']; ?>" style="display: block; margin-left: auto; margin-right: auto; min-height:20rem; min-width:100%;" alt="" />
                                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                <ul class="list-inline">
                                                    <li>Date: January 2020</li>
                                                    <li>Client: Threads</li>
                                                    <li>Category: Illustration</li>
                                                </ul>
                                                <form method="post" name="formParticipate" action="/?action=participate">
                                                  <button class="btn btn-primary" name="participate" value="<?= $aTravel["ID"]?>" type="submit">
                                                      <i class="fas mr-1"></i>
                                                      Je veux participer
                                                      <i class="fas mr-1"></i>
                                                  </button>
                                                </form>
                                                <br>
                                                <form method="post" name="formParticipate" action="/?action=exportPDF">
                                                  <button class="btn btn-blue btn-primary" name="pdf" value="<?= $aTravel["ID"]?>" type="submit">
                                                      <i class="fas mr-1"></i>
                                                      Exporter en PDF
                                                      <i class="fas mr-1"></i>
                                                  </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  <?php endif?>
                    <?php endforeach ?>
              <?php else:?>
                <p class="text-center page-section">Aucune annonces disponible pour le moment, veuillez repassez a un autre moment de la journée.</p>
              <?php endif?>

        </div>
    </div>
</section>

<?php
    $content = ob_get_clean();
    require "gabarit.php";
?>
