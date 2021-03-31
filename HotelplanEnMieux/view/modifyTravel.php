<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : PreTPI HotelplanEnMieux
 * Created  : 01.02.2021
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

<form method="POST" id="formCreation" action="/?action=toModifyThisTravel" enctype="multipart/form-data">
    <div class="standing-content">
        <div class="standing-container">

            <div style="text-align:center">
                <img id="sendImage" name="image" src="<?= $travel['image'];?>" alt="" style="max-width: 30em; max-height: 30em;">
            </div>

            <div class="standing-big-button" style="text-align:center">
                <input id="inputImage" name="image"  class="btn btn-grey btn-big" type="file">
            </div>
        </div>

        <div class="standing-container-right" style="Margin-right:50px; Margin-left:50px">
            <div class="form-group">
                <label for="travel" class="standing-form-label"><strong>Titre</strong></label>
                <input name="title" class="form-control standing-form-input" type="text" value="<?= $travel['title'];?>" placeholder="<?= $travel['title']; ?> " required>
            </div>

            <div class="form-group">
                <label for="travel" class="standing-form-label"><strong>Destination</strong></label>
                <input name="destination" class="form-control standing-form-input" type="text" value="<?= $travel['destination'];?>" placeholder="<?= $travel['destination']; ?>" required>
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
                      <input id="chk<?= $onecheck["ID"];?>" onclick="showNB('<?= $onecheck["ID"];?>');" name="createChecklist[]" type="checkbox"
                      <?= in_array($onecheck["ID"], $checklistSelected) ? "checked=True" : "" ?> value="<?= $onecheck["ID"]; ?>">

                      <label for="chk<?= $onecheck["ID"]; ?>"> <b> <?= $onecheck["thingsToTake"]; ?></b></label>

                      <input id="qty<?= $onecheck["ID"];?>" type="number" style="width:3em;
                      visibility:<?= in_array($onecheck['ID'], $checklistSelected) ? 'visible' : 'hidden' ?>" step="1" min="0" max="10"
                      name="qtyCheck<?= $onecheck["ID"]; ?>" value="<?= $onecheck["quantity"];?>" placeholder="NB"></td>
                    </div>
                <?php endforeach ?>


            </div>

            <!--<div class="form-group">
              <H5>Activity</H5>
              <table id="activityTable" style="width: 15em; height:15em; border: 1px solid black">
                <tr style="border-bottom: 1px solid black">
                  <td>Description</td>
                  <td>Date</td>
                  <td>Prix</td>
                  <td>Lien hypertexte</td>
                  <td>remarque</td>
                </tr>
                <tr>
                  <td><input type="text" name="description"><?= $activity['description']; ?></td>
                  <td><input type="date" name="date"><?= $activity['date']; ?></td>
                  <td><input type="number" step="0.05" name="price" placeholder="Prix"><?= $activity['price']; ?></td>
                  <td><input type="text" name="hypertextLink"><?= $activity['hypertextLink']; ?></td>
                  <td><textarea type="textarea" name="remark" style="resize:none;"><?= $activity['remark']; ?></textarea></td>
                  <td class="scroll-list-box scroll-list-button">
                      <form method="post" name="formModify" action="addTR()">
                          <button type="submit" name="fakeId" value="<?= $activity['ID']; ?>" class="btn btn-blue">+</button>
                      </form>
                  </td>
                </tr>


              </table>
            </div>-->
            <br>
            <div class="standing-container-bottom" style="text-align:center">
                <button type="submit" class="btn btn-primary btn-xl text-uppercase">Enregister</button>
            </div>
        </div>
    </div>
</form>
</div>
<br>
<script>

    function showNB(id){
        chk = document.getElementById("chk" + id);
        qty = document.getElementById("qty" + id);
        console.log(chk);
        console.log(qty);
        console.log(chk.checked);
        console.log(qty.style);

        if(chk.checked == true){
            qty.style.visibility = "visible";
        }
        else{
          qty.style.visibility = "hidden";
        }
    }

    /*function addTR(id){
      const issueBlock = document.getElementById(id);
      const idNumberOfCount = idPiece+"countOfNewIssue";
      const numberOfCount = document.getElementById(idNumberOfCount);
      if(parseInt(numberOfCount.value) === 0){
          numberOfCount.value = 1;
      }
      let i = numberOfCount.value;
      numberOfCount.value = parseInt(i)+1;

      issueBlock.innerHTML +=
        "<tr>
          <td><input type="text" name="description'+i'"></td>
          <td><input type="date" name="date'+i'"></td>
          <td><input type="number" step="0.05" name="price'+i'" placeholder="Prix"></td>
          <td><input type="text" name="hypertextLink'+i'"></td>
          <td><textarea type="textarea" name="remark'+i'" style="resize:none;"></textarea></td>
          <td class="scroll-list-box scroll-list-button">
              <form method="post" name="formModify" action="">
                  <button type="submit" name="fakeId" value="" class="btn btn-blue">+</button>
              </form>
          </td>
        </tr>"

        ;
        i++;

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
