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

function createATravel($travel, $image)
{
    $strSeparator = '\'';

    require_once 'model/dbConnector.php';

    /*
    $actDate = date("Y-m-d");
    $endDate = date("Y-m-d", strtotime($actDate. ' + '.$oneSnow["nbD"].' days'));
    */



    $createQuery = 'INSERT INTO travel (`title`, `destination`, `image`, `isVisible`, `IDLogUser`) VALUES (:title, :destination, :image, :isVisible, :IDLogUser)';
    $createData = array(":title"=>$travel["title"],":destination"=>$travel["destination"],":image"=>$travel["path"],":isVisible"=>$travel["createType"], ":IDLogUser"=>$_SESSION["userId"]);


    executeQueryInsert($createQuery,$createData);

}

function dataFromVendor($vendorID)
{
  $result = false;

  $strSeparator = '\'';
  $profilQuery = 'SELECT title, destination, image, isVisible FROM travel WHERE IDLogUser = '.$strSeparator.$vendorID.$strSeparator;

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
