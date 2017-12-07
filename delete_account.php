<?php
session_start();
include('db.php');
include('status_code.php');

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);
$idUser = $data['idUser'];

$queryDelete = "DELETE FROM user WHERE (idUser = " . $idUser . ");";
$resQ = queryRes($queryDelete);

$response = getStatusCode(1);

session_destroy();

echo json_encode($response);

?>
