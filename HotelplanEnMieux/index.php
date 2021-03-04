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
          login($_POST);
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
              createTravel($_POST, $_FILES);
          }
          else
          {
              loginRegister($_POST);
          }
          break;

      default :
          home();
  }
}
else
{
    home();
}
