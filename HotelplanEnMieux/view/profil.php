<?php
/**
* Author   : keanu.trosset@cpnv.ch
* Project  : Projet PreTPI web + DB
* Created  : 12.02.2021
*
* Git source  : [https://github.com/keanutrosset/HotelplanEnMieux]
*
*/

$title ='HotelplanEnMieux - Profil';

ob_start();

if(isset($_POST["profilMessage"]))
{
    $profilMessage = $_POST["profilMessage"];
}
else
{
    $profilMessage = 0;
}

?>
<div class="text-center page-section">
  <h2 class="section-heading text-uppercase">Bienvenue <?= $_SESSION["email"]; ?> !</h2>


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

          <div style="text-align: center;">
            <div class="bg-dark align-center">
              <table style="min-width: 711px; border: 1px solid">
                <?php if(count($vendorAds) > 0):?>
                    <?php foreach ($vendorAds as $travel) : ?>
                      <?php if($travel["isVisible"] == "0");?>
                        <tr style="border: 1px solid yellow">
                            <td class="text-white">
                                <p><strong>Titre : </strong><?= $travel['title']; ?></p>
                            </td>

                            <td class="text-white">
                                <p><strong>Destination : </strong><?= $travel['destination']; ?></p>
                            </td>

                            <!--<td class="scroll-list-box scroll-list-item">
                                <p><strong>Description : </strong>
                                    <textarea class="form-control" style="resize:none;" rows="5" type="text" readonly></*?= $travel['description']; ?>
                                    </textarea></p>
                            </td>

                            <td class="scroll-list-box scroll-list-item-little">
                                <p><strong>Prix : <br> </strong></*?= $travel['prix']; ?> CHF</p>
                            </td>!-->

                            <td class="scroll-list-box scroll-list-item">
                                <a href="<?=$annonce["image"]?>"><img src="<?= $travel['image']; ?>" alt="Annonce" height="100" width="100"></a>
                            </td>

                            <td class="scroll-list-box scroll-list-button">
                                <form method="post" name="formDelete" action="index.php?action=modifyTravel">
                                    <button type="submit" name="modify" value="<?= $travel['ID']; ?>" class="btn btn-blue">M</button>
                                </form>
                            </td>

                            <td class="scroll-list-box scroll-list-button">
                                <form method="post" name="formDelete" action="index.php?action=deleteTravel">
                                    <button type="submit" name="delete" value="<?= $travel['ID']; ?>" class="btn btn-red">X</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else:?>
                    <p class="text-white">Vous n'avez pas d'annonces<p>
                <?php endif?>
              </table>
            </div>
          </div>
      </section>

      <hr/>

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

                  </form>
                </div>


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

                <div class="block-half-page-profil">
                    <div class="message-box">
                        <?php if($profilMessage == 10):?>
                            <div class="login-alert alert alert-error">
                                <strong>Erreur</strong>
                                <p>Le compte n'a pas pu être supprimé.</p>
                            </div>
                        <?php endif?>
                    </div>
                    <h4>Supprimer ce compte:</h4>
                    <form method="post" id="deleteAccount" name="formRegister" action="index.php?action=deleteAccount">
                      <button type="button" onclick="confirmDeleteAccount()" class="btn btn-primary">Supprimer définitivement ce compte?</button>
                      <br>
                      <br>
                    </form>
                </div>

                <hr/>

                <form method="post" name="formLogout"  action="index.php?action=logout">
                    <button type="submit" class="btn btn-primary btn-xl text-uppercase">Se déconnecter</button>
                </form>
              </div>
      </section>

  </div>
</div>


<script>
function confirmDeleteAccount() {
  if (confirm("Cela va effacer definitivement votre compte! Voulez vous vraiment le supprimer?")) {
    document.getElementById("deleteAccount").submit();
  }else{
  }
}
</script>

<?php

$content = ob_get_clean();
require "view/gabarit.php";

?>
