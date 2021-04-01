<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : PreTPI HotelplanEnMieux
 * Created  : 15.02.2021
 *
 * Git source  : [https://github.com/keanutrosset/HotelplanEnMieux]
 *
 */


session_start();

/*print_r("<br><br><br><br>");
print_r($_SESSION);*/

require "controler/travel.php";
require "controler/user.php";


if (isset($_GET['action']))
{
  $action = $_GET['action'];

  switch ($action)
  {
      case 'home' :
          home();
          break;

      case 'login' :
          login($_POST, "home");
          break;

      case 'logout' :
          logout();
          break;

      case 'register' :
          register($_POST);
          break;

     case 'profil' :
          profil();
          break;

      case 'contact':
          contact();
          break;

      case 'createTravel':

          if(isset($_SESSION["userId"]))
          {
              createTravel();
          }
          else
          {
              login($_POST, "createTravel");
          }
          break;

      case 'toCreateATravel':

            toCreateATravel($_POST, $_FILES);
            break;

      case 'contactMail':
          contactEmail($_POST);
          break;

      case 'changeMail':
          changeUserEmail($_POST["newMail"]);
          break;

      case 'changePassword':
          changeUserPassword($_POST["oldPsw"],$_POST["newPsw"],$_POST["newPswBis"]);
          break;

      case 'deleteAccount':
          deleteAccount($_SESSION["userId"]);
          break;

      case 'modifyTravel':
          modifyTravel($_SESSION["userId"], $_POST["modify"]);
          break;

      case 'toModifyThisTravel':
          toModifyThisTravel($_SESSION["userId"],$_POST, $_FILES, $_SESSION["travelID"]);
          break;

      case 'deleteTravel':
          deleteTravel($_POST);
          break;

      case 'participate':
          participate($_SESSION["userId"],$_POST["participate"]);
          break;

      case 'myTravelHistory':
          myTravelHistory($_SESSION["userId"]);
          break;

      case 'acceptAUser':
          acceptAUser($_POST["accept"]);
          break;

      case 'exportPDF':
          exportPDF($_POST["pdf"]);
          break;

      case 'dontAcceptAUser':
          dontAcceptAUser($_POST["dontAccept"]);
          break;

      case 'saveChecklist':
          saveChecklist($_POST);
          break;

      default :
          home();
  }
}
else
{
    home();
}
