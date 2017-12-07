<?php
session_start();
include('db.php');

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);
$idUser = $data['idUser'];

if($idUser != $_SESSION['idUser']) {
  $qTweet = "SELECT * FROM tweet WHERE (idUser = " . $idUser . ") ORDER BY date DESC, hour DESC;";
}
else {
  $qTweet = "SELECT * FROM tweet WHERE (idUser = " . $_SESSION['idUser'] . ") ORDER BY date DESC, hour DESC;";
}

$resQT  = queryRes($qTweet);

$monthT = array("ene.", "feb.", "mar.", "abr.", "may.", "jun.", "jul.", "ago.", "sep.", "oct.", "nov.", "dic.");

$tweets = array();

$numRows = mysqli_num_rows($resQT);
if($numRows > 0):
    while($resQDT = mysqli_fetch_array($resQT)):
      $tweetDay   = date_format(date_create($resQDT['date']), "d");
      $tweetMonth = date_format(date_create($resQDT['date']), "m");
      $tweetYear  = date_format(date_create($resQDT['date']), "Y");

      $tweetDate = $tweetDay . " " . $monthT[date($tweetMonth) - 1] . " " . date($tweetYear);

      array_push($tweets, array(
        'idUser' => $resQDT['idUser'],
        'idTweet' => $resQDT['idTweet'],
        'type' => $resQDT['type'],
        'tweet' => $resQDT['tweet'],
        'date' => $tweetDate
      ));
    endwhile;
endif;

echo json_encode($tweets);
?>
