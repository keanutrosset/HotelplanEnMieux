<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : PreTPI HotelplanEnMieux
 * Created  : 04.03.2021
 *
 * Git source  : [https://github.com/keanutrosset/HotelplanEnMieux]
 *
 */


/**
 * This function is designed to verify user's login
 * @param $email
 * @param $userPsw
 * @throws ErrorDbAccess : Raise if database connexion fail
 * @return bool : true only if the user and psw match the database. In all other cases will be false
 */
function isLoginCorrect($email, $userPsw)
{
    $result = false;

    $strSeparator = '\'';
    $loginQuery = 'SELECT passwordHash, ID FROM loguser WHERE email = '.$strSeparator.$email.$strSeparator;

    require_once 'model/dbConnector.php';
    $queryResult = executeQuerySelect($loginQuery);

    if (count($queryResult) == 1)
    {
        $passwordHash = $queryResult[0]['passwordHash'];
        if(password_verify($userPsw, $passwordHash))
        {
            $result = $queryResult[0]["ID"];
        }
        else
        {
            $result = false;
        }
    }

    return $result;
}
function userModifyEmail($idUser, $MailToModify)
{
  $result = false;

  $strSeparator = '\'';

  $mailToModifyQuery = 'UPDATE loguser SET `email` = :email WHERE ID = :id';
  $mailToModifyData = array(":email"=>$MailToModify, ":id" => $idUser);

  require_once 'model/dbConnector.php';
  $queryResult = executeQueryInsert($mailToModifyQuery,$mailToModifyData);

  return $result;

}

function userModifyPassword($idUser, $OldPsw, $NewPsw)
{
  $result = false;

  $strSeparator = '\'';

  $pswVerifyQuery = 'SELECT passwordHash FROM loguser WHERE ID = '.$strSeparator.$idUser.$strSeparator;

  require_once 'model/dbConnector.php';
  $pswVerify = executeQuerySelect($pswVerifyQuery);

  if(password_verify($OldPsw, $pswVerify[0]["passwordHash"]))
  {
      $NewPsw = password_hash($NewPsw, PASSWORD_DEFAULT);

      $registerQuery = 'UPDATE loguser SET `passwordHash` = :password WHERE ID = :id ';
      $registerData = array(":password"=>$NewPsw, ":id"=>$idUser);

      $queryResult = executeQueryInsert($registerQuery,$registerData);

      return true;
  }
  else
  {
      return false;
  }

}

/**
 * This function is designed to register a new account
 * @param $email
 * @param $userPsw
 * @throws ErrorDbAccess : Raise if database connexion fail
 * @return bool|null
 */
function registerNewAccount($email, $userPsw)
{
    $result = false;

    $strSeparator = '\'';

    $registerTest = 'SELECT email FROM loguser WHERE email = '.$strSeparator.$email.$strSeparator;
    require_once 'model/dbConnector.php';
    $queryTest = executeQuerySelect($registerTest);

    if($queryTest == null){

      $pswHash = password_hash($userPsw, PASSWORD_DEFAULT);

      $registerQuery = 'INSERT INTO loguser (`email`, `passwordHash`) VALUES (:email, :password)';
      $registerData = array(":email"=>$email,":password"=>$pswHash);

      /*require_once 'model/dbConnector.php';*/
      $queryResult = executeQueryInsert($registerQuery,$registerData);

      $registerQuery2 = 'SELECT ID FROM loguser WHERE email = '.$strSeparator.$email.$strSeparator;

      $queryResult2 = executeQuerySelect($registerQuery2);

      if($queryResult and $queryResult2){
          $result = $queryResult2[0]["ID"];
      }
      else
      {
          $result = false;
      }

      return $result;
    }

    else{

      $result = false;
      return $result;
    }

}

function deleteThisAccount($userId){

  $result = false;

  $deleteAccountQuery = 'DELETE FROM loguser WHERE ID = :id';
  $deleteAccountData = array(":id" => $userId);

  print_r("<br><br><br><br><br><br>");
  print_r($deleteAccountData);
  print_r($deleteAccountQuery);

  require_once 'model/dbConnector.php';
  $result = executeQueryInsert($deleteAccountQuery,$deleteAccountData);

  return $result;

}
