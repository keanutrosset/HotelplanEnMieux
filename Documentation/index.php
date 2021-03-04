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
 * This function is designed to execute a query received as parameter
 * @param $query : must be correctly build for sql (syntaxis) but the protection against sql injection will be done there
 * @throws ErrorDbAccess : Raise if database connexion fail
 * @return array|null : get the query result (can be null)
 * Source : http://php.net/manual/en/pdo.prepare.php
 */
    $query="SELECT * FROM loguser";
    $queryResult = null;

    $dbConnexion = openDBConnexion();//open database connexion
    if ($dbConnexion != null)
    {
        $statement = $dbConnexion->prepare($query);//prepare query
        $statement->execute();//execute query
        $queryResult = $statement->fetchAll();//prepare result for client
    }
    $dbConnexion = null;//close database connexion

    print_r($queryResult);


/**
 * This function is designed to insert value in database
 * @param $query
 * @throws ErrorDbAccess : Raise if database connexion fail
 * @return bool|null : $statement->execute() return true is the insert was successful
 */
 $query="INSERT INTO hotelplanenmieux.loguser (`ID`, `email`, `passwordHash`) VALUES (:id, :email, :password)";

    $queryResult = null;

    $id = '16';
    $email = 'asfasfa';
    $password = 'fdhfh';

    $dbConnexion = openDBConnexion();//open database connexion
    if ($dbConnexion != null)
    {
        $statement = $dbConnexion->prepare($query);//prepare query
        $statement->bindParam(':id', $id);//execute query
        $statement->bindParam(':email', $email);//execute query
        $statement->bindParam(':password',$password);//execute query
        $queryResult = $statement->execute();//execute query
    }
    $dbConnexion = null;//close database connexion


/**
 * This function is designed to manage the database connexion. Closing will be not proceeded there. The client is responsible of this.
 * @throws ErrorDbAccess : Raise if database connexion fail
 * @return PDO|null
 * Source : http://php.net/manual/en/pdo.construct.php
 */
function openDBConnexion()
{
    $tempDbConnexion = null;

    $sqlDriver = 'mysql';
    $hostname = 'localhost';
    $port = 3306;
    $charset = 'utf8';
    $dbName = 'hotelplanenmieux';
    $userName = 'TPIuser';
    $userPwd = 'Pa$$w0rd';
    $dsn = $sqlDriver . ':host=' . $hostname . ';dbname=' . $dbName . ';port=' . $port . ';charset=' . $charset;

    $tempDbConnexion = new PDO($dsn, $userName, $userPwd);
    /*try
    {
        $tempDbConnexion = new PDO($dsn, $userName, $userPwd);
    }

    catch (PDOException $exception)
      {
        require_once "errorDbAccess.php";
        throw new errorDbAccess;
      }*/
    return $tempDbConnexion;
}
