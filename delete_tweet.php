<?php
include('db.php');
include('status_code.php');

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);
$idTweet = $data['idTweet'];

$queryDelete = "DELETE FROM tweet WHERE (idTweet = " . $idTweet . ");";
$resQ = queryRes($queryDelete);

$response = getStatusCode(1);

echo json_encode($response);

?>
