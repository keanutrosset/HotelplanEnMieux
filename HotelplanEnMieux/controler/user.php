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

    $homePageFlag = true;
    require "view/home.php";
    exit();
}


/**
 * This function is designed to manage login request
 * @param $loginRequest : contain login fields required to authenticate the user
 */
function login($loginRequest)
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
            $action = "home";
            home();
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
                home("Erreur","Notre site est en maintenance, merci pour votre compréhension");
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
        }
        //If submitted passwords doesn't match
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
  require "view/profil.php";
  exit();
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
