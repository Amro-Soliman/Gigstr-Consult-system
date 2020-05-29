<?php
include('../Private/functions.php');
require_once('../Classes/db.php');


if(isset($_GET['data'])) {
    $params = array();
   // echo $params;

parse_str($_GET['data'], $params);

$firstName = $params['firstName'] ?? '';
$lastName = $params['lastName'] ?? '';
$email = $params['email'] ??'';
$password =$params['password'] ?? '';
$companyName =$params['companyName'] ?? '';
$companyAdress =$params['companyAdress'] ?? '';
$tel = $params['tel'] ?? '';
$userName = $params['userName'] ?? '';
$oNumber = $params['oNumber'] ?? '';

}

if(isset($params['oNumber'])){
if(oNumber_exists($params['oNumber'])) {
    $var = find_company_by_oNumber($params['oNumber']);
    $cn = "<a href=" ."clientProfile.php?id=$var[id]>" . "$var[companyName]" . "</a>" ;
    header('Content-Type: application/json');

    $response = json_encode(array('code' => 200, "message" => "Success", "name" => $cn));
    echo $response;
     


    }else{
        header('Content-Type: application/json');
 addClient($params["firstName"],$params["lastName"], $params["email"], $params["password"], $params["companyName"], $params["companyAdress"], $params["tel"], $params["userName"], $params["oNumber"] );

        $response = array('code' => 400, "message" => "Failed");
    $jsonResponse = json_encode($response);
    echo $jsonResponse;

}}
