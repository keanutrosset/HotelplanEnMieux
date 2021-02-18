<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : Projet PreTPI web + DB
 * Created  : 12.02.2021
 *
 * Git source  : [https://github.com/keanutrosset/HotelplanEnMieux]
 *
 */


$title = 'HotelplanEnMieux - Register';

// tampon de flux stocké en mémoire
ob_start();
?>

<div class="text-center page-section">
      <h2 class="section-heading text-uppercase">Register</h2>
  <?php if (@$_GET['registerError'] == true) :?>
  <h5><span style="color:red">Inscription refusée</span></h5>
  <?php endif ?>
  <article>
      <form class='form' method='POST'>

          <p class="text-muted">Pour vous inscrire chez HotelplanEnMieux, nous vous prions de renseigner les champs suivants:</p>
          <div class="container" style="margin-top:50px">
              <label class="text-muted" for="userEmail"><h5>Adresse mail</h5></label>
              <input type="email" placeholder="Entrez votre adresse mail" name="inputUserEmailAddress" required>
            </br>
              <label class="text-muted" for="userPsw"><h5>Mot de passe</h5></label>
              <input type="password" placeholder="Entrez votre mot de passe" name="inputUserPsw" required>
            </br>
              <label class="text-muted" for="psw-repeat"><h5>Repetez le mot de passe</h5></label>
              <input type="password" placeholder="Repetez le mot de passe" name="inputUserPswRepeat" required>
            </br>
              <p class="section-subheading text-muted">En soumettant votre demande de compte, vous validez les conditions générales d'utilisation.<a href="https://termsfeed.com/blog/privacy-policies-vs-terms-conditions/">CGU et vie privée</a>.</p>
              <button type="submit" class="btn btn-primary" style="margin-top:25px">Register</button>
          </div>
      </form>
      <div class="container signin" style="margin-top:50px">
          <h5 class="section-subheading text-muted">Déjà membre ? <a href="index.php?action=login">Login</a></h5>
      </div>
  </article>
</div>

<?php
    $content = ob_get_clean();
    require 'gabarit.php';
?>
