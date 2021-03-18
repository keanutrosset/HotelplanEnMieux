<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : PreTPI HotelplanEnMieux
 * Created  : 04.03.2021
 *
 * Git source  : [https://github.com/keanutrosset/HotelplanEnMieux]
 *
 */

function checklistReturn(){

  $checklistQuery = 'SELECT ID, thingsToTake FROM checklist';

  require_once 'model/dbConnector.php';

  $result = executeQuerySelect($checklistQuery);

  return $result;

}

function activityReturn($travelID){

  $strSeparator = '\'';

  $activityQuery = 'SELECT ID, description, date, price, hypertextLink, remark FROM travel WHERE IDTravel =' .$strSeparator.$travelID.$strSeparator;;

  require_once 'model/dbConnector.php';

  $result = executeQuerySelect($activityQuery);

  return $result;
}

function createATravel($travel, $image)
{

    require_once 'model/dbConnector.php';

    /*
    $actDate = date("Y-m-d");
    $endDate = date("Y-m-d", strtotime($actDate. ' + '.$oneSnow["nbD"].' days'));
    */

    $createQuery = 'INSERT INTO travel (`title`, `destination`, `image`, `isVisible`, `IDLogUser`) VALUES (:title, :destination, :image, :isVisible, :IDLogUser)';
    $createData = array(":title"=>$travel["title"],":destination"=>$travel["destination"],":image"=>$travel["path"],":isVisible"=>$travel["createType"], ":IDLogUser"=>$_SESSION["userId"]);


    $result = executeQueryInsert($createQuery,$createData);

    /*foreach($travel["createChecklist"] as $thisChecklist){
      $createChecklistData ='INSERT INTO travel_checklist (`IDTravel`, `IDChecklist`) VALUES(:IDTravel, :IDChecklist)';
      $createChecklistData = array(":IDTravel"=>$travelID,":IDChecklist"=>$thisChecklist);

      $resultCheck = executeQueryInsert($createChecklistData,$createChecklistData);
    }*/

    return $result;

}

function modifyATravel($travel, $image, $userID){

  require_once 'model/dbConnector.php';

  /*
  $actDate = date("Y-m-d");
  $endDate = date("Y-m-d", strtotime($actDate. ' + '.$oneSnow["nbD"].' days'));
  */

  $createQuery = 'INSERT INTO travel (`title`, `destination`, `image`, `isVisible`, `IDLogUser`) VALUES (:title, :destination, :image, :isVisible, :IDLogUser)';
  $createData = array(":title"=>$travel["title"],":destination"=>$travel["destination"],":image"=>$travel["path"],":isVisible"=>$travel["createType"], ":IDLogUser"=>$_SESSION["userId"]);


  $result = executeQueryInsert($createQuery,$createData);

  foreach($travel["createChecklist"] as $thisChecklist){
    $createChecklistData ='INSERT INTO travel_checklist (`IDTravel`, `IDChecklist`) VALUES(:IDTravel, :IDChecklist)';
    $createChecklistData = array(":IDTravel"=>$travelID,":IDChecklist"=>$thisChecklist);

    $resultCheck = executeQueryInsert($createChecklistData,$createChecklistData);
  }

  return $result;
}

function dataFromOneTravel($vendorID, $travelID){
  $result = false;

  $strSeparator = '\'';
  $oneTravelQuery = 'SELECT ID, title, destination, image, isVisible FROM travel
  WHERE IDLogUser = '.$strSeparator.$vendorID.$strSeparator.'AND ID = '.$strSeparator.$travelID.$strSeparator;

  require_once 'model/dbConnector.php';
  $result = executeQuerySelect($oneTravelQuery)[0];


  return $result;

}

function dataFromVendor($vendorID)
{
  $result = false;

  $strSeparator = '\'';
  $profilQuery = 'SELECT ID, title, destination, image, isVisible FROM travel WHERE IDLogUser = '.$strSeparator.$vendorID.$strSeparator;

  require_once 'model/dbConnector.php';
  $result = executeQuerySelect($profilQuery);


  return $result;
}

function dataFromAllVendor(){
  $result = false;

  $strSeparator = '\'';
  $homeQuery = 'SELECT ID, title, destination, image, isVisible FROM travel';

  require_once 'model/dbConnector.php';
  $result = executeQuerySelect($homeQuery);


  return $result;
}
