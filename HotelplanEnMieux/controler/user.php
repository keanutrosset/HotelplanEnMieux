<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : PreTPI HotelplanEnMieux
 * Created  : 15.02.2021
 *
 * Git source  : [https://github.com/keanutrosset/HotelplanEnMieux]
 *
 */


/**
 * This function is designed to redirect the user to the home page (depending on the action received by the index)
 * @param $errorTitle : Variable to display an error title (Optional)
 * @param $errorMessage : contain login fields required to authenticate the user (Optional)
 */
function home($errorTitle = "", $errorMessage = "")
{
    require_once "model/travelsManagement.php";

    $vendorAds = dataFromAllVendor();

    $checklist = checklistForMyTravel();

    $homePageFlag = true;
    ob_start();
    require "view/home.php";
    exit();
}


function contact(){
  require "view/contact.php";
  exit();
}
function myTravelHistory($userID){
  if(isset($_SESSION["userId"]))
  {
      require_once "model/travelsManagement.php";

      $myparticipateTravel = myparticipateTravel($userID);

      $checklist = checklistForMyTravel();

      require "view/myTravel.php";
  }
  else
  {
      $_POST["loginMessage"] = 0;
      require "view/login.php";
  }
}

/**
 * This function is designed to manage login request
 * @param $loginRequest : contain login fields required to authenticate the user
 */
function login($loginRequest, $redirect)
{
    //If a login request was submitted
    if (isset($loginRequest['inputEmail']) && isset($loginRequest['inputUserPsw']))
    {
        //Extract login parameters
        $email = $loginRequest['inputEmail'];
        $userPsw = $loginRequest['inputUserPsw'];

        try
        {
            require_once "model/usersManagement.php";
            //Check if user/psw are matching with the database
            $userId = isLoginCorrect($email, $userPsw);
        }
        catch (ErrorDbAccess $e)
        {
            home("Erreur","Notre site est en maintenance, merci pour votre compréhension");
            exit();
        }

        if ($userId)
        {
            createSession($email, $userId);

            $_GET['loginError'] = false;
            header("Location:?action=".$redirect);
            exit();
        }
        //If the user/psw doesn't match, login form appears again
        else
        {
            $_GET['loginError'] = true;
            $action = "login";
            require "view/login.php";
            exit();
        }
    }
    //The user hasn't filled the form yet
    else
    {
        $action = "login";
        require "view/login.php";
        exit();
    }
}


/**
 * This function is designed to display the register page or register the user if the inputs are filled
 * @param $registerRequest : contain register fields required to test and create the user
 */
function register($registerRequest)
{
    //If a register request was submitted
    if (isset($registerRequest['inputEmail']) && isset($registerRequest['inputUserPsw']) && isset($registerRequest['inputUserPswRepeat']))
    {

        //Extract register parameters
        $email = $registerRequest['inputEmail'];
        $userPsw = $registerRequest['inputUserPsw'];
        $userPswRepeat = $registerRequest['inputUserPswRepeat'];

        if ($userPsw == $userPswRepeat)
        {
            try
            {
                require_once "model/usersManagement.php";
                $userId = registerNewAccount($email, $userPsw);
            }
            catch (ErrorDbAccess $e)
            {
                home("<br><br><br><br>Erreur","Notre site est en maintenance, merci pour votre compréhension");
                exit();
            }

            if ($userId)
            {
                createSession($email, $userId);

                $_GET['registerError'] = false;
                $action = "home";
                home();
                exit();
            }
            else{
              $_GET['registerError'] = true;
              $action = "register";
              require "view/register.php";
              exit();
            }
        }
        //If submitted passwords doesn't match or email already exist
        else
        {
            $_GET['registerError'] = true;
            $action = "register";
            require "view/register.php";
            exit();
        }
    }
    else
    {
        $action = "register";
        require "view/register.php";
        exit();
    }
}

function profil()
{
  if(isset($_SESSION["userId"]))
  {
      require_once "model/travelsManagement.php";

      $vendorAds = dataFromVendor($_SESSION["userId"]);

      require "view/profil.php";
  }
  else
  {
      $_POST["loginMessage"] = 5;
      require "view/login.php";
  }
}

/**
 * This function is designed to create a new user session
 * Also store user's rents if there is any in the database
 * @param $email : Email address to store in session
 * @param $userId : User unique id address to store in session
 */
function createSession($email, $userId)
{
    $_SESSION['email'] = $email;
    $_SESSION['userId'] = $userId;
}


/**
 * This function is designed to manage logout request
 */
function logout()
{
    $_SESSION = array();
    session_destroy();

    $action = "home";
    home();
    exit();
}

function changeUserEmail($email)
{
    require_once 'model/usersManagement.php';
    if(userModifyEmail($_SESSION["userId"],$email)){
      $_SESSION["email"] = $email;

      profil();
    }
    else{
      $_POST["profilMessage"] = 7;
      profil();
    }


}

function changeUserPassword($oldPws, $newPsw,$newPswBis)
{
    if($newPsw == $newPswBis){
      require_once 'model/usersManagement.php';

      if(userModifyPassword($_SESSION["userId"],$oldPws,$newPsw))
      {
          $_POST["profilMessage"] = 0;
      }
      else
      {
          $_POST["profilMessage"] = 9;
      }
    }
    else{
      $_POST["profilMessage"] = 9;
    }
    profil();
}

function deleteAccount($userId){

    require_once 'model/usersManagement.php';

    if(deleteThisAccount($userId))
    {
        $_POST["profilMessage"] = 0;
        unset($_SESSION["userId"]);
        home();
    }
    else
    {
        $_POST["profilMessage"] = 10;
        profil();
    }

}

function participate($userID,$travelID){

  require_once 'model/usersManagement.php';

  if(isset($_SESSION["userId"]))
  {
      require_once "model/travelsManagement.php";

      participateToATravel($userID,$travelID);

      $myparticipateTravel = myparticipateTravel($userID);

      header("Location:?action=myTravelHistory");
      exit();
  }
  else
  {
      $_POST["loginMessage"] = 5;
      require "view/login.php";
  }

}

//region Email functions
function sendMailFunction($to, $fromName, $fromEmail, $replyName, $replyEmail, $mailObject, $mailMessage)
{
  //$to, $fromName, $fromEmail, $replyName, $replyEmail, $mailObject, $mailMessage

    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
    {
        $passage_ligne = "\r\n";
    }
    else
    {
        $passage_ligne = "\n";
    }

    //=====Déclaration des messages au format texte et au format HTML.
    $message_txt = "";
    $message_html = "<html><body>".$emailInfo["mailMessage"]."</body></html>";
    //==========

    //=====Création de la boundary
    $boundary = "-----=".md5(rand());
    //==========

    //=====Définition du sujet.
    $sujet = $mailObject;
    //=========

    //=====Création du header de l'e-mail.
    $header = "From: ".$fromName."<".$fromEmail.">".$passage_ligne;
    $header.= "Reply-to: ".$replyName."<".$replyEmail.">".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
    //==========

    //=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    //=====Ajout du message au format texte.
    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_txt.$passage_ligne;
    //==========
    $message.= $passage_ligne."--".$boundary.$passage_ligne;
    //=====Ajout du message au format HTML
    $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_html.$passage_ligne;
    //==========
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    //==========

    //=====Envoi de l'e-mail.
    mail($mail,$sujet,$message,$header);
}

function contactEmail($userInfo){

    sendMailFunction("keanu.trosset@cpnv.ch", $userInfo["userName"], $userInfo["userEmail"], $userInfo["userName"], $userInfo["userEmail"], "HotelplanEnMieux - ContactForm", $userInfo["userMessage"]);
    header("Location:?action=contact");
}
