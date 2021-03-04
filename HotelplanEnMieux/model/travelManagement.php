<?php
/**
 * Author   : keanu.trosset@cpnv.ch
 * Project  : PreTPI HotelplanEnMieux
 * Created  : 04.03.2021
 *
 * Git source  : [https://github.com/keanutrosset/HotelplanEnMieux]
 *
 */

function createUserRent($rents, $userId)
{
    $strSeparator = '\'';

    $snowsQuery = 'SELECT MAX(noRent) FROM rents';

    require_once 'model/dbConnector.php';
    $numRent = executeQuerySelect($snowsQuery)[0][0];

    $newRentNumber = $numRent + 1;

    $actDate = date("Y-m-d");

    require_once "model/snowsManager.php";
    foreach($rents as $oneSnow)
    {
        $userSnow = getSnowId($oneSnow["code"]);

        $endDate = date("Y-m-d", strtotime($actDate. ' + '.$oneSnow["nbD"].' days'));

        $insertLeasingQuery  = 'INSERT INTO rents (`idSnow`, `idUser`, `noRent`, `qty`, `startLocation`, `endLocation`, `status`) VALUES (';
        $insertLeasingQuery .= $userSnow.','.$userId.','.$newRentNumber.','.$oneSnow["qty"].','.$strSeparator.$actDate.$strSeparator.','.$strSeparator.$endDate.$strSeparator.','.$strSeparator.'En cours'.$strSeparator.')';

        executeQueryInsert($insertLeasingQuery);
    }
}
