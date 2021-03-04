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
  </div>

<form method="post" id="formCreation" action="index.php?action=createTravel" enctype="multipart/form-data">
    <div class="standing-content">
        <div class="standing-container">

            <div style="text-align:center">
                <img id="sendImage" name="Image" src="view/content/img/image-background.png" alt="">
            </div>

            <div class="standing-big-button" style="text-align:center">
                <!--<input id="inputImage" class="btn btn-grey btn-big" type="file" onchange="document.forms['formCreation'].submit()">-->
                <input id="inputImage" name="createImage" class="btn btn-grey btn-big" type="file">
            </div>
        </div>

        <div class="standing-container-right" style="Margin-right:50px; Margin-left:50px">
            <div class="form-group">
                <label for="snowCode" class="standing-form-label"><strong>Titre</strong></label>
                <input name="createTitre" class="form-control standing-form-input" type="text" placeholder="Titre">
            </div>

            <div class="form-group">
                <label for="snowCode" class="standing-form-label"><strong>Description</strong></label>
                <textarea name="createDescription" class="form-control standing-form-input" style="resize:none;" rows="5" type="text" placeholder="Description"></textarea>
            </div>

            <div class="form-group">
                <label for="snowCode" class="standing-form-label"><strong>Prix</strong></label>
                <input name="createPrix" class="form-control standing-form-input" type="number" step="10" placeholder="Prix">
            </div>

            <div class="form-group">
                <br/>
                <H5>Types</H5>
                <br/>
                <div class="standing-form-checkbox-line"><input id="chkPublic" name="createType" type="radio" value="Public"><label for="chkpublic"> <b> Public</b></label></div>
                <div class="standing-form-checkbox-line"><input id="chkPrivate" name="createType" type="radio" value="Private"><label for="chkprivate"><b> Privé</b></label></div>
            </div>

            <div class="form-group">
                <h5>Checklist</h5>
                <br/>
                <span id="createList" class="custom-dropdown custom-dropdown--white">
                    <select id="createChecklist" name="createChecklist" class="custom-dropdown__select custom-dropdown__select--grey">
                        <option>Chaussure de marche
                        <option>Vêtement chaud
                        <option>Raquette de ping pong
                        <option>Chaussettes de rechange
                        <option>Equipement de plongée
                        <option>Divers
                    </select>
                </span>
            </div>

            <div class="standing-container-bottom" style="text-align:center">
                <button type="submit" class="btn btn-primary btn-xl text-uppercase">Enregister</button>
            </div>
        </div>
    </div>
</form>
<br>
<script>

    /*function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#sendImage').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }*/
    function readURL(input) {
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById('sendImage').setAttribute('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }else{
            document.getElementById('sendImage').setAttribute('src', '/view/content/img/logos/image-background.png');
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
