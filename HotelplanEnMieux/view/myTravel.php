<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : PreTPI HotelplanEnMieux
 * Created  : 10.03.2021
 *
 * Git source  : [https://github.com/keanutrosset/HotelplanEnMieux]
 *
 */


$title = "HotelplanEnMieux - Mes voyages";

// tampon de flux stocké en mémoire
ob_start();
?>


<section class="page-section bg-light" id="travel">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Mes voyages</h2>
            <h3 class="section-subheading text-muted">Voici les voyages auquels vous participé et avez participé</h3>
        </div>

        <?php if(count($myparticipateTravel) > 0):?>
          <button onclick="filterByName('waitParticipate');" style="Background-color:Yellow; max-width:10em"><h5 class="text-muted" >Jaune: En attente de participation</h5></button>
          <button onclick="filterByName('waitValidation');" style="Background-color:Lightblue; max-width:10em; height:100%"><h5 class="text-muted" >Bleu: En attente de validation</h5></button>
          <button onclick="filterByName('travelEnd');" style="Background-color:Lightgrey ; max-width:10em"><h5 class="text-muted" >Gris: Ce voyage est terminé</h5></button>
          <br>
          <br>
          <div class="row">
          <?php foreach ($myparticipateTravel as $aTravel) : ?>
              <div id="<?= ($aTravel['IDLogUser'] == $_SESSION['userId'] && $aTravel['userAccepted'] == 0) ? 'waitParticipate' :  ($aTravel['userAccepted'] == 0 ? 'waitValidation' : 'travelEnd') ?>" class="col-lg-4 col-sm-6 mb-4 travelCard">
                  <div class="travel-item">
                      <a class="travel-link" data-toggle="modal" href="#travel<?= $aTravel["participateID"]?>">
                          <div class="travel-hover">
                              <div class="travel-hover-content"><i class="fas fa-plus "></i></div>
                          </div>
                          <img class="center" style="display: block; margin-left: auto; margin-right: auto; min-height:20rem; min-width:100%; max-height:20rem; max-width:15rem;" src="<?= $aTravel['image']; ?>" alt="">
                      </a>
                      <div class="travel-caption" style="Background-color:<?= ($aTravel['IDLogUser'] == $_SESSION['userId'] && $aTravel['userAccepted'] == 0) ? 'yellow' :  ($aTravel['userAccepted'] == 0 ? 'lightblue' : 'Lightgrey') ?>">
                          <div class="travel-caption-heading"><?= $aTravel['title']; ?></div>
                          <div class="travel-caption-subheading text-muted"><?= $aTravel['destination']; ?></div>
                      </div>
                  </div>
              </div>

              <!-- travel Modals-->
              <!-- Modal 1-->
              <div class="travel-modal modal fade" id="travel<?= $aTravel["participateID"]?>" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="" /></div>
                          <div class="container">
                              <div class="row justify-content-center">
                                  <div class="col-lg-8">
                                      <div class="modal-body">
                                          <!-- Project Details Go Here-->
                                          <h2 class="text-uppercase"><?= $aTravel['title']; ?></h2>
                                          <p class="item-intro text-muted"><br><?= $aTravel['destination']; ?></p>
                                          <img class="img-fluid d-block mx-auto" src="<?= $aTravel['image']; ?>" style="max-width: 30em; max-height: 30em;" alt="" />
        

                                          <?php if(isset($checklist) && in_array($aTravel['IDTravel'], array_column($checklist, "IDTravel"))) : ?>
                                            <h5>Checklist</h5>
                                            <form method="post" name="formParticipate" action="/?action=saveChecklist">
                                          <?php foreach ($checklist as $onecheck) : ?>
                                            <?php if($onecheck["IDTravel"] == $aTravel['IDTravel']) :?>

                                              <div class="standing-form-checkbox-line">
                                                <input id="chk<?= $onecheck["ID"];?>" name="createChecklist[]" type="checkbox"
                                                <?= $onecheck["isOk"] ? "checked=True" : "" ?> value="<?= $onecheck["ID"]; ?>">

                                                <label for="chk<?= $onecheck["ID"]; ?>"> <b> <?= $onecheck["thingsToTake"]; ?></b></label>

                                                <input  type="number" style="width:3em"
                                                 value="<?= $onecheck["quantity"];?>" placeholder="NB" readonly></td>
                                              </div>

                                            <?php endif?>
                                          <?php endforeach ?>
                                            <button class="btn btn-blue btn-primary" name="IDTravel" value="<?= $aTravel['IDTravel']?>" type="submit">
                                                Sauvegarder la checklist
                                            </button>
                                          </form>
                                          <?php endif?>

                                          <br>

                                          <?php if($aTravel["userAccepted"] == 0) :?>
                                          <h3><?= $aTravel['email']; ?> veux participer a ce voyage</h3>
                                          <?php elseif($aTravel["userAccepted"] == 1) :?>
                                          <h3><?= $aTravel['email']; ?> a participer a ce voyage</h3>
                                          <?php endif?>
                                          <br>
                                          <?php if($aTravel['IDLogUser'] == $_SESSION["userId"] && $aTravel['userAccepted'] == 0):?>
                                          <form method="post" name="formParticipate" action="/?action=acceptAUser">
                                            <button class="btn btn-primary" name="accept" value="<?= $aTravel["participateID"]?>" type="submit">
                                                <i class="fas mr-1"></i>
                                                J'accepte cette personne
                                                <i class="fas mr-1"></i>
                                            </button>
                                          </form>
                                          <br>
                                          <form method="post" name="formParticipate" action="/?action=dontAcceptAUser">
                                            <button class="btn btn-red btn-primary" name="dontAccept" value="<?= $aTravel["participateID"]?>" type="submit">
                                                <i class="fas mr-1"></i>
                                                Je n'accepte pas cette personne
                                                <i class="fas mr-1"></i>
                                            </button>
                                          </form>
                                        <?php elseif($aTravel['IDLogUser'] == $_SESSION["userId"] && $aTravel['userAccepted'] == 1):?>
                                        <?php endif?>

                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <?php endforeach ?>
              <?php else:?>
                  <p class="text-center page-section">Vous n'etes inscrit a aucun voyage / n'avez jamais participé a un voyage.</p>
              <?php endif?>

        </div>
    </div>
</section>

<script>
var last;
function filterByName(filter) {
    allCard = document.getElementsByClassName("travelCard");

    for (var i = 0; i < allCard.length; i++) {
      if(last === filter){
          allCard[i].style.display = "";
      }
      else if(allCard[i].id === filter){
          allCard[i].style.display = "";
      }
      else {
          allCard[i].style.display = "none";
      }
    }
    if(last === filter){
      last = "";
    }
    else{
      last = filter;
    }

}
</script>

<?php
    $content = ob_get_clean();
    require "gabarit.php";
?>
