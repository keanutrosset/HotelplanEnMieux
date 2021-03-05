<?php

if(isset($_POST["profilMessage"]))
{
    $profilMessage = $_POST["profilMessage"];
}
else
{
    $profilMessage = 0;
}

$titre = "HotelplanEnMieux - Profil";
ob_start();

?>
<div class="text-center page-section">
  <h2 class="section-heading text-uppercase">Bienvenue <?= $_SESSION["email"]; ?> !</h2>

  <br>
  <br>
  <br>
  <br>
  <br>


  <div style="text-align: center">

      <section id="contentAnnonces" class="check-nav-content">

          <div class="message-box">
              <?php if($profilMessage == 1):?>
                  <div class="login-alert alert alert-error alert-big">
                      <strong>Erreur</strong>
                      <p>L'annonce n'a pas pu être effacée.</p>
                  </div>
              <?php elseif($profilMessage == 2):?>
              <div class="login-alert alert alert-success alert-big">
                  <strong>Succès</strong>
                  <p>L'annonce a été effacée.</p>
              </div>
              <?php elseif($profilMessage == 3):?>
                  <div class="login-alert alert alert-success alert-big">
                      <strong>Succès</strong>
                      <p>Un email a été envoyé pour votre demande d'achat.</p>
                  </div>
              <?php elseif($profilMessage == 5):?>
                  <div class="login-alert alert alert-success alert-big">
                      <strong>Succès</strong>
                      <p>L'annonce a été créée.</p>
                  </div>
              <?php endif?>
          </div>

          <div style="width:100%; text-align: center;">
              <div style="">
                  <div class="profilAnnonces">
                      <table style="min-width: 711px; border-top: 1px solid #333">

                          <?php if(count($vendorAds) > 0):?>
                              <?php foreach ($vendorAds as $annonce) : ?>
                                  <tr>
                                      <td class="scroll-list-box scroll-list-item">
                                          <p><strong>Titre : </strong><?= $annonce['titre']; ?></p>
                                      </td>

                                      <td class="scroll-list-box scroll-list-item">
                                          <p><strong>Categorie : </strong><?= $annonce['categorie']; ?></p>
                                      </td>

                                      <td class="scroll-list-box scroll-list-item">
                                          <p><strong>Description : </strong>
                                              <textarea class="form-control" style="resize:none;" rows="5" type="text" readonly><?= $annonce['description']; ?>
                                              </textarea></p>
                                      </td>

                                      <td class="scroll-list-box scroll-list-item-little">
                                          <p><strong>Prix : <br> </strong><?= $annonce['prix']; ?> CHF</p>
                                      </td>

                                      <td class="scroll-list-box scroll-list-item">
                                          <a href="<?=$annonce["path"]?>"><img src="<?= $annonce['path']; ?>" alt="Annonce" height="100" width="100"></a>
                                      </td>

                                      <td class="scroll-list-box scroll-list-button">
                                          <form method="post" name="formDelete" action="index.php?action=modifyAnnonce">
                                              <button type="submit" name="fakeId" value="<?= $annonce['id']; ?>" class="btn btn-blue">M</button>
                                          </form>
                                      </td>

                                      <td class="scroll-list-box scroll-list-button">
                                          <form method="post" name="formDelete" action="index.php?action=deleteAnnonce">
                                              <button type="submit" name="fakeId" value="<?= $annonce['id']; ?>" class="btn btn-red">X</button>
                                          </form>
                                      </td>
                                  </tr>

                              <?php endforeach ?>
                          <?php else:?>
                              Vous n'avez pas d'annonces
                          <?php endif?>
                      </table>
                  </div>
              </div>
          </div>
      </section>

      <section id="contentOptions" class="check-nav-content">

          <div class="block-page">

              <div class="block-half-page-profil">
                  <div class="message-box">
                      <?php if($profilMessage == 7):?>
                          <div class="login-alert alert alert-error">
                              <strong>Erreur</strong>
                              <p>L'adresse mail n'a pas pu être changée.</p>
                          </div>
                      <?php endif?>
                  </div>
                  <h4>Changer d'adresse mail:</h4>
                  <form method="post" name="formRegister" action="index.php?action=changeMail">
                      <div class="form-group">
                          <label for="loginPseudo"><br/></label>
                          <input type="email" class="form-control" id="newMail" name="newMail" aria-describedby="pseudoHelp" placeholder="Entrez une nouvelle adresse mail" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Changer Adresse Mail</button>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>

                  </form>
              </div>

              <div class="vertical-line"></div>

              <div class="block-half-page-profil">
                  <div class="message-box">
                      <?php if($profilMessage == 9):?>
                          <div class="login-alert alert alert-error">
                              <strong>Erreur</strong>
                              <p>Les mots de passe ne correspondent pas.</p>
                          </div>
                      <?php endif?>
                  </div>
                  <h4>Changer de mot de passe:</h4>
                  <form method="post" name="formRegister" action="index.php?action=changePassword">
                      <div class="form-group">
                          <label for="loginPsw">Ancien mot de passe:</label>
                          <input type="password" class="form-control" id="oldPsw" name="oldPsw" aria-describedby="userNameHelp" placeholder="Entrez votre ancien mot de passe" required>
                      </div>
                      <div class="form-group">
                          <label for="loginPsw">Nouveau mot de passe:</label>
                          <input type="password" class="form-control" id="newPsw" name="newPsw" aria-describedby="userNameHelp" placeholder="Entrez un nouveau mot de passe" required>
                      </div>
                      <div class="form-group">
                          <label for="loginPsw">Confirmation du nouveau mot de passe:</label>
                          <input type="password" class="form-control" id="newPswBis" name="newPswBis" aria-describedby="userNameHelp" placeholder="Confirmer votre mot de passe" required>
                      </div>
                      <button type="submit" class="btn btn-primary">Changer Mot de passe</button>
                      <br>
                      <br>
                      <br>
                      <br>


                  </form>

                  <hr/>

                  <form method="post" name="formLogout" action="index.php?action=logout">
                      <button type="submit" class="btn btn-primary btn-xl text-uppercase">Se déconnecter</button>
                  </form>
              </div>
      </section>

  </div>
</div>

<?php

$content = ob_get_clean();
require "view/gabarit.php";

?>
