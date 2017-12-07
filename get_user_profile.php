<?php
include('db.php');
include('get_user_data.php');
include('status_code.php');

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);
$idUser = $data['idUser'];

$user = getUserData($idUser);
$response = getStatusCode(1);
$response[0]['data'] = $user;

echo json_encode($response);

?>
