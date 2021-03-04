<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : PreTPI HotelplanEnMieux
 * Created  : 15.02.2021
 *
 * Git source  : [https://github.com/keanutrosset/HotelplanEnMieux]
 *
 */


$title = "HotelplanEnMieux - Contact";

// tampon de flux stocké en mémoire
ob_start();
?>

<!-- Contact-->
<section class="page-section" id="contact">
<div class="container">
    <div class="text-center">
        <h2 class="section-heading text-uppercase">Contactez-moi</h2>
        <h3 class="section-subheading text-muted">Je repondrais au plus vite.</h3>
    </div>
    <form id="contactForm" name="sentMessage" novalidate="novalidate">
        <div class="row align-items-stretch mb-5">
            <div class="col-md-6">
                <div class="form-group">
                    <input class="form-control" id="name" type="text" placeholder="Votre Nom *" required="required" data-validation-required-message="S'il vous plaît, entrez votre nom." />
                    <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                    <input class="form-control" id="email" type="email" placeholder="Votre Email *" required="required" data-validation-required-message="S'il vous plaît, entrez votre email." />
                    <p class="help-block text-danger"></p>
                </div>
                <div class="form-group mb-md-0">
                    <input class="form-control" id="phone" type="tel" placeholder="Votre Numero de telephone *" required="required" data-validation-required-message="S'il vous plaît, entrez votre numero de telephone." />
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-textarea mb-md-0">
                    <textarea class="form-control" id="message" placeholder="Votre Message *" required="required" data-validation-required-message="S'il vous plaît, entrez votre message."></textarea>
                    <p class="help-block text-danger"></p>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">Envoyer le Message</button>
        </div>
    </form>
</div>
</section>

<?php
    $content = ob_get_clean();
    require "gabarit.php";
?>
