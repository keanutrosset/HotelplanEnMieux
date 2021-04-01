<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : PreTPI HotelplanEnMieux
 * Created  : 15.02.2021
 *
 * Git source  : [https://github.com/keanutrosset/HotelplanEnMieux]
 *
 */


$title = "HotelplanEnMieux - Crée une annonce";

// tampon de flux stocké en mémoire
ob_start();
?>

<div class="text-center page-section">
    <h2 class="section-heading text-uppercase">Créer une annonce</h2>


  <?php if (@$_GET['createTravelError'] == true) :?>
      <h5><span class="text-center" style="color:red; text-align:center;">Cette annonce est refusée</span></h5>
  <?php endif ?>

<br>
<br>

<form method="POST" id="formCreation" action="/?action=toCreateATravel" enctype="multipart/form-data">
    <div class="standing-content">
        <div class="standing-container">

            <div style="text-align:center">
                <img id="sendImage" name="imageExemple" src="view/content/img/image-background.png" alt="" style="max-width: 30em; max-height: 30em; ">
            </div>

            <div class="standing-big-button" style="text-align:center">
                <input id="inputImage" name="image" class="btn btn-grey btn-big" type="file" required>
            </div>
        </div>

        <div class="standing-container-right" style="Margin-right:50px; Margin-left:50px">
            <div class="form-group">
                <label for="travel" class="standing-form-label"><strong>Titre</strong></label>
                <input name="title" class="form-control standing-form-input" type="text" placeholder="Titre" required>
            </div>

            <div class="form-group">
                <label for="travel" class="standing-form-label"><strong>Destination</strong></label>
                <input name="destination" class="form-control standing-form-input" type="text" placeholder="Destination" required>
            </div>

            <!-- <div class="form-group">
                <label for="travel" class="standing-form-label"><strong>Description</strong></label>
                <textarea name="description" class="form-control standing-form-input" style="resize:none;" rows="5" type="text" placeholder="Description" required></textarea>
            </div>

            <div class="form-group">
                <label for="travel" class="standing-form-label"><strong>Prix</strong></label>
                <input name="price" class="form-control standing-form-input" type="number" step="0.05" placeholder="Prix" required>
            </div> -->

            <div class="form-group">
                <br/>
                <H5>Types</H5>
                <br/>
                <div class="standing-form-checkbox-line"><input id="chkPublic" name="createType" type="radio" value="0"><label for="chkPublic" required> <b> Public</b></label></div>
                <div class="standing-form-checkbox-line"><input id="chkPrivate" name="createType" type="radio" checked value="1"><label for="chkPrivate" required><b> Privé</b></label></div>
            </div>


            </div>

            <div class="standing-container-bottom" style="text-align:center">
                <button type="submit" class="btn btn-primary btn-xl text-uppercase">Enregister</button>
            </div>
        </div>
    </div>
</form>
</div>
<br>
<script>

    function readURL(input) {
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0]&& (/*ext == "gif" ||*/ ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById('sendImage').setAttribute('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }else{
            document.getElementById('sendImage').setAttribute('src', '/view/content/img/image-background.png');
            //document.getElementById('sendImage').setAttribute()
        }
    }

    document.getElementById("inputImage").onchange = function() {
        readURL(this);
    };
</script>


<?php
    $content = ob_get_clean();
    require "gabarit.php";
?>
