<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : PreTPI HotelplanEnMieux
 * Created  : 15.02.2021
 *
 * Git source  : [https://github.com/keanutrosset/HotelplanEnMieux]
 *
 */

function createTravel(){
  require_once "model/travelsManagement.php";
  $checklist = checklistReturn();

  require "view/createTravel.php";
  exit();
}

function toCreateATravel($travel, $image){

  if(isset($travel["title"]) && isset($travel["destination"]) && isset($travel["createType"])|| $image["error"] =! 0){

    $correctFilesType = array("image/png", "image/jpg", "image/jpeg", "image/gif");
    print_r($image);
      if(in_array($image['image']['type'], $correctFilesType) && $image['image']['size'] < 10000000)
      {
          do
          {
              $testFileName = "view/content/img/".md5(uniqid(rand(), true)).".".substr($image['image']['type'], strrpos($image['image']['type'], '/')+1);

              if(file_exists($testFileName))
              {
                  continue;
              }
              else
              {
                  break;
              }
          }
          while(true);

        move_uploaded_file($image['image']['tmp_name'], $testFileName);

        $travel["path"] = $testFileName;

        require_once "model/travelsManagement.php";
        if(createATravel($travel, $image)){

          require_once "controler/user.php";
          profil();
          exit();

        }
        else{
          $_GET['createTravelError'] = true;
          createTravel();
          exit();
        }

      }
    }

    else{
      require "view/createTravel.php";
    }


}

?>
