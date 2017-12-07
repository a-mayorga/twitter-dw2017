<?php
session_start();
include('db.php');

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);
$searchUser = $data['searchTerm'];

$cleanedTweet = preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', ' ', $data['searchTerm']);
$auxString    = preg_replace('/\s+/', '', $cleanedTweet);
$searchHashtag = "#" . $auxString;

$qFollow = "SELECT *
            FROM user
            WHERE (idUser != " . $_SESSION['idUser'] . " AND (name LIKE '%" . $searchUser . "%' OR lastName LIKE '%" . $searchUser . "%' OR userName LIKE '%" . $searchUser . "%')) AND idUser NOT IN (SELECT idUserFollowed FROM follow WHERE idUserFollows = " . $_SESSION['idUser'] . ");";
$resQF   = queryRes($qFollow);

$qHastag = "SELECT u.idUser, u.userName, u.name, u.lastName, u.photo, t.tweet
            FROM user AS u, tweet AS t
            WHERE (t.tweet LIKE '%" . $searchHashtag . "%' AND u.idUser = t.idUser);";

$resQH   = queryRes($qHastag);

$response = array();
$users = array();
$tweets = array();

$numRows = mysqli_num_rows($resQF);
if($numRows > 0):
    while($resQDF = mysqli_fetch_array($resQF)):
      array_push($users, array(
        'idUser' => $resQDF['idUser'],
        'photo' => $resQDF['photo'],
        'name' => $resQDF['name'],
        'lastName' => $resQDF['lastName'],
        'username' => $resQDF['userName']
      ));
    endwhile;
endif;

$numRows = mysqli_num_rows($resQH);
if($numRows > 0):
    while($resQDH = mysqli_fetch_array($resQH)):
      array_push($tweets, array(
        'idUser' => $resQDH['idUser'],
        'photo' => $resQDH['photo'],
        'name' => $resQDH['name'],
        'lastName' => $resQDH['lastName'],
        'username' => $resQDH['userName'],
        'tweet' => $resQDH['tweet'],
      ));
      endwhile;
endif;

$response[0]['users'] = $users;
$response[0]['tweets'] = $tweets;

echo json_encode($response);

?>
