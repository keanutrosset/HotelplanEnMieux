<?php
  $title ='HotelplanEnMieux - Login/Logout';
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : Projet PreTPI web + DB
 * Created  : 12.02.2021
 *
 * Git source  : [https://github.com/keanutrosset/HotelplanEnMieux]
 *
 */

ob_start();
?>
<div class="text-center page-section">
    <h2 class="section-heading text-uppercase">Login</h2>

<?php if (@$_GET['loginError'] == true) :?>
    <h5><span style="color:red">Login refusé</span></h5>
<?php endif ?>
<article style="margin-top:92px">
      <form class='form' method='POST'>
          <div class="container">
              <label class="text-muted" for="userEmail"><h5>Adresse mail</h5></label>
              <input type="email" placeholder="Entrez votre adresse mail" name="inputUserEmailAddress" required>
            </br>
              <label class="text-muted" for="userPsw"><h5>Mot de passe</h5></label>
              <input type="password" placeholder="Entrez votre mot de passe" name="inputUserPsw" required>
          </div>
          <span class="text-muted"><a href="#">Mot de passe oublié ?</a></span>
        </br>
          <div class="container" style="margin-top:25px">
              <button type="submit" class="btn btn-primary">Login</button>
              <button type="reset"class="btn btn-primary">Reset</button>
          </div>
      </form>
    <div class="container signin" style="margin-top:50px">
        <h5 class="text-muted">Besoin d'un compte ? <a href="index.php?action=register">Register</a></h5>
    </div>
</article>
</div>
<?php
  $content = ob_get_clean();
  require 'gabarit.php';
?>
