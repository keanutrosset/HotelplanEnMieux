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
  require "view/createTravel.php";
  exit();
}

function toCreateATravel($travel, $image){

  if(isset($travel["title"]) && isset($travel["destination"]) && isset($travel["createType"])|| $image["error"] != 0){
    $correctFilesType = array("image/png", "image/jpg", "image/jpeg", "image/gif");
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

          header("Location:?action=profil");
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
      header("Location:?action=createTravel");
      exit();
    }


  }
  function modifyTravel($userID, $travelID){

    require_once "model/travelsManagement.php";

    $travel = dataFromOneTravel($userID, $travelID);

    $checklist = checklistReturn();

    $checklistSelected = checklistSelectedReturn($travelID);

    $activity = activityReturn($travelID);

    $_SESSION["travelID"] = $travelID;

    print_r("<br><br><br><br>");
    print_r($checklist);
    print_r($checklistSelected);
    print_r($travelID);

    require "view/modifyTravel.php";
    exit();
  }
  function toModifyThisTravel($userID, $travelToModify, $imageToModify, $travelID){
    if(isset($travelToModify["title"]) && isset($travelToModify["destination"]) && isset($travelToModify["createType"])|| $imageToModify["error"] != 0){
      $correctFilesType = array("image/png", "image/jpg", "image/jpeg", "image/gif");
        if(in_array($imageToModify['image']['type'], $correctFilesType) && $imageToModify['image']['size'] < 10000000)
        {
            do
            {
                $testFileName = "view/content/img/".md5(uniqid(rand(), true)).".".substr($imageToModify['image']['type'], strrpos($imageToModify['image']['type'], '/')+1);

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

          move_uploaded_file($imageToModify['image']['tmp_name'], $testFileName);

          $travelToModify["path"] = $testFileName;
          $travelToModify["travelID"] = $travelID;

          unset($_SESSION["travelID"]);

          require_once "model/travelsManagement.php";
          if(modifyATravel($travelToModify, $imageToModify, $userID)){

            header("Location:?action=profil");
            exit();

          }
          else{
            $_GET['modifyTravelError'] = true;
            modifyTravel();
            exit();
          }

        }
      }
    }

      function deleteTravel($travelID){

        require_once "model/travelsManagement.php";
        print_r("<br><br><br><br>");
        print_r($travelID);
        if(deleteATravel($travelID["delete"])){
          $_POST["profilMessage"] = 0;

          header("Location:?action=profil");
          exit();
        }
        else{
          $_POST["profilMessage"] = 1;
        }
    }


?>
