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

require "controler/travel.php";


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

      case 'contact':
          contact();
          break;

      default :
          home();
  }
}
else
{
    home();
}
