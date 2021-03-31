<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : PreTPI HotelplanEnMieux
 * Created  : 04.03.2021
 *
 * Git source  : [https://github.com/keanutrosset/HotelplanEnMieux]
 *
 */

function checklistReturn($travelID){

  /*$checklistQuery = 'SELECT ID, thingsToTake FROM checklist';*/

  $checklistQuery = 'SELECT checklist.ID, checklist.thingsToTake, checklist.ThingsToDo FROM (SELECT ID, isOk, quantity, IDTravel, IDChecklist FROM travel_checklist WHERE IDTravel = '.$travelID.') AS USER_CHECKLIST
  RIGHT JOIN checklist ON checklist.ID = USER_CHECKLIST.IDChecklist';

  require_once 'model/dbConnector.php';

  $result = executeQuerySelect($checklistQuery);

  /*SELECT * FROM (SELECT * FROM travel_checklist WHERE IDTravel = 34) AS USER_CHECKLIST
  RIGHT JOIN checklist ON checklist.ID = USER_CHECKLIST.IDChecklist*/


  return $result;

}

function checklistSelectedReturn($travelID){

  $strSeparator = '\'';

  $checklistSelectedQuery = 'SELECT quantity, IDChecklist FROM travel_checklist WHERE IDTravel = '.$strSeparator.$travelID.$strSeparator;

  require_once 'model/dbConnector.php';

  $result = executeQuerySelect($checklistSelectedQuery);

  return $result;
}

function checklistForMyTravel(){

  $checklistQuery = 'SELECT * FROM (SELECT * FROM travel_checklist) AS USER_CHECKLIST
  LEFT JOIN checklist ON checklist.ID = USER_CHECKLIST.IDChecklist';

  require_once 'model/dbConnector.php';

  $result = executeQuerySelect($checklistQuery);

  return $result;;
}

function activityReturn($travelID){

  $strSeparator = '\'';

  $activityQuery = 'SELECT ID, description, date, price, hypertextLink, remark FROM travel WHERE IDTravel =' .$strSeparator.$travelID.$strSeparator;

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

  //Section update du voyage
  require_once 'model/dbConnector.php';

  /*
  $actDate = date("Y-m-d");
  $endDate = date("Y-m-d", strtotime($actDate. ' + '.$oneSnow["nbD"].' days'));
  */
  if(isset($travel["path"])){
    $modifyQuery = 'UPDATE travel SET `title` = :title, `destination`= :destination, `image`= :image, `isVisible`= :isVisible, `IDLogUser`= :IDLogUser WHERE ID = :id';
    $modifyData = array(":title"=>$travel["title"],":destination"=>$travel["destination"],":image"=>$travel["path"],":isVisible"=>$travel["createType"], ":IDLogUser"=>$_SESSION["userId"], ":id"=>$travel["travelID"]);
  }
  else{
    $modifyQuery = 'UPDATE travel SET `title` = :title, `destination`= :destination, `isVisible`= :isVisible, `IDLogUser`= :IDLogUser WHERE ID = :id';
    $modifyData = array(":title"=>$travel["title"],":destination"=>$travel["destination"],":isVisible"=>$travel["createType"], ":IDLogUser"=>$_SESSION["userId"], ":id"=>$travel["travelID"]);
  }


  $result = executeQueryInsert($modifyQuery,$modifyData);


  //Section create/update Checklist
  $resultCheck = false;

  $deleteChecklistQuery = 'DELETE FROM travel_checklist WHERE IDTravel = :id';
  $deleteChecklistData = array(":id" => $travel["travelID"]);

  require_once 'model/dbConnector.php';
  $result = executeQueryInsert($deleteChecklistQuery,$deleteChecklistData);

  foreach($travel["createChecklist"] as $thisChecklist){
    if($travel["qtyCheck".$thisChecklist] == ""){
      $travel["qtyCheck".$thisChecklist] = NULL;
    }

    $createChecklistQuery ='INSERT INTO travel_checklist (`quantity`,`IDTravel`, `IDChecklist`) VALUES(:quantity, :IDTravel, :IDChecklist)';
    $createChecklistData = array("quantity"=>$travel["qtyCheck".$thisChecklist],":IDTravel"=>$travel["travelID"],":IDChecklist"=>$thisChecklist);

    $resultCheck = executeQueryInsert($createChecklistQuery,$createChecklistData);
  }

  return $result;
}

function deleteATravel($travelID){

  $result = false;

  $deleteATravelQuery = 'DELETE FROM travel WHERE ID = :id';
  $deleteATravelData = array(":id" => $travelID);

  require_once 'model/dbConnector.php';
  $result = executeQueryInsert($deleteATravelQuery,$deleteATravelData);

  return $result;
}

function participateToATravel($userID,$travelID){

  $result = false;

  $participateToATravelQuery = 'INSERT INTO participate (`userAccepted`, `IDLoguser`, `IDTravel`) VALUES(:userAccepted, :IDLoguser, :IDTravel)';
  $participateToATravelData = array("userAccepted"=>'',"IDLoguser"=>$userID ,":IDTravel"=>$travelID);

  require_once 'model/dbConnector.php';
  $result = executeQueryInsert($participateToATravelQuery,$participateToATravelData);

  return $result;

}

function myparticipateTravel($userID){
  $result = false;

  $strSeparator = '\'';
  $oneTravelQuery = 'SELECT travel.ID AS travelID, travel.IDLogUser, title, destination, image, loguser.email, participate.userAccepted, participate.ID AS participateID
  FROM travel INNER JOIN participate ON travel.ID = participate.IDTravel
  INNER JOIN loguser ON participate.IDLoguser = loguser.ID
  WHERE userAccepted IS NOT NULL AND participate.IDLoguser = '.$strSeparator.$userID.$strSeparator.'OR travel.IDLogUser = '.$strSeparator.$userID.$strSeparator;

  require_once 'model/dbConnector.php';
  $result = executeQuerySelect($oneTravelQuery);

  return $result;
}

function acceptAParticipation($participateID){
  $acceptQuery = 'UPDATE participate SET `userAccepted` = :userAccepted  WHERE ID = :id';
  $acceptData = array(":userAccepted"=>"1", ":id"=>$participateID);

  require_once 'model/dbConnector.php';
  $result = executeQueryInsert($acceptQuery,$acceptData);

  return $result;

}

function dontAcceptAParticipation($participateID){
  $dontAcceptQuery = 'DELETE FROM participate WHERE ID = :id';
  $dontAcceptData = array(":id"=>$participateID);

  require_once 'model/dbConnector.php';
  $result = executeQueryInsert($dontAcceptQuery,$dontAcceptData);

  return $result;
}

function dataFromOneTravel($vendorID, $travelID){
  $result = false;

  $strSeparator = '\'';
  $oneTravelQuery = 'SELECT ID, title, destination, image, isVisible FROM travel
  WHERE IDLogUser = '.$strSeparator.$vendorID.$strSeparator.'AND ID = '.$strSeparator.$travelID.$strSeparator;

  require_once 'model/dbConnector.php';
  $result = executeQuerySelect($oneTravelQuery);


  return $result[0];

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
