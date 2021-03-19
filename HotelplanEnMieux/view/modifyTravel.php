<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : PreTPI HotelplanEnMieux
 * Created  : 15.02.2021
 *
 * Git source  : [https://github.com/keanutrosset/HotelplanEnMieux]
 *
 */


$title = "HotelplanEnMieux - Modifier une annonce";

// tampon de flux stocké en mémoire
ob_start();
?>

<div class="text-center page-section">
    <h2 class="section-heading text-uppercase">Modifier une annonce</h2>


  <?php if (@$_GET['createTravelError'] == true) :?>
      <h5><span class="text-center" style="color:red; text-align:center;">Cette annonce est refusée</span></h5>
  <?php endif ?>

<br>
<br>

<form method="POST" id="formCreation" action="index.php?action=toModifyThisTravel" enctype="multipart/form-data">
    <div class="standing-content">
        <div class="standing-container">

            <div style="text-align:center">
                <img id="sendImage" name="imageExemple" src="<?= $travel['image']; ?>" alt="" style="max-width: 30em; max-height: 30em;">
            </div>

            <div class="standing-big-button" style="text-align:center">
                <input id="inputImage" name="image" class="btn btn-grey btn-big" type="file">
            </div>
        </div>

        <div class="standing-container-right" style="Margin-right:50px; Margin-left:50px">
            <div class="form-group">
                <label for="travel" class="standing-form-label"><strong>Titre</strong></label>
                <input name="title" class="form-control standing-form-input" type="text" placeholder="<?= $travel['title']; ?>">
            </div>

            <div class="form-group">
                <label for="travel" class="standing-form-label"><strong>Destination</strong></label>
                <input name="destination" class="form-control standing-form-input" type="text" placeholder="<?= $travel['destination']; ?>">
            </div>

            <div class="form-group">
                <label for="travel" class="standing-form-label"><strong>Description</strong></label>
                <textarea name="description" class="form-control standing-form-input" style="resize:none;" rows="5" type="text" placeholder="<?= $travel['description']; ?>"></textarea>
            </div>

            <div class="form-group">
                <label for="travel" class="standing-form-label"><strong>Prix</strong></label>
                <input name="price" class="form-control standing-form-input" type="number" step="0.05" placeholder="Prix">
            </div>

            <div class="form-group">
                <br/>
                <H5>Types</H5>
                <br/>
                  <div class="standing-form-checkbox-line">
                    <input id="chkPublic" name="createType" type="radio" <?= $travel["isVisible"] == 0 ? "checked=True" : "" ?> value="0">
                    <label for="chkPublic"> <b> Public</b></label>
                  </div>

                  <div class="standing-form-checkbox-line">
                    <input id="chkPrivate" name="createType" type="radio" <?= $travel["isVisible"] == 1 ? "checked" : "" ?> value="1">
                    <label for="chkPrivate"><b> Privé</b></label>
                  </div>


            </div>

            <div class="form-group">
                <h5>Checklist</h5>
                <br/>

                <?php foreach ($checklist as $onecheck) : ?>
                    <div class="standing-form-checkbox-line">
                      <input id="createChecklist<?= $onecheck["ID"]; ?>" name="createChecklist[]" type="checkbox" <?= in_array($checklist["ID"], $checklistSelected["IDChecklist"]) ? "checked=True" : "" ?>
                      value="<?= $onecheck["ID"]; ?>">
                      <label for="createChecklist<?= $onecheck["ID"]; ?>"> <b> <?= $onecheck["thingsToTake"]; ?></b></label>
                    </div>
                <?php endforeach ?>


            </div>

            <div>
              <table style="width: 100%; height:15em; border: 1px solid black">
                <p>Activity</p>
                <tr>
                  <td>desc</td>
                  <td>patata</td>
                  <td>patati</td>
                  <td>proutproutprout</td>
                </tr>
                <tr>
                  <td><input type="text" name="desc"></td>
                  <td><input type="text" name="desc"></td>
                  <td><input type="text" name="desc"></td>
                  <td><input type="text" name="desc"></td>
                  <td class="scroll-list-box scroll-list-button">
                      <form method="post" name="formModify" action="index.php?action=modifyAnnonce">
                          <button type="submit" name="fakeId" value="<?= $activity['ID']; ?>" class="btn btn-blue">M</button>
                      </form>
                  </td>
                </tr>

              </table>
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
        if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
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