<?php
session_start();

include('db.php');

$qTL     = "SELECT DISTINCT u.idUser, u.userName, u.name, u.lastName, u.photo, t.idTweet, t.type, t.tweet, t.date, t.hour
            FROM user AS u, tweet AS t
            WHERE (t.idUser = u.idUser AND t.type != 0)
            ORDER BY t.date DESC, t.hour DESC;";

$resQTL  = queryRes($qTL);

$monthT = array("ene.", "feb.", "mar.", "abr.", "may.", "jun.", "jul.", "ago.", "sep.", "oct.", "nov.", "dic.");

$numRows = mysqli_num_rows($resQTL);

$tweets = array();

if ($numRows > 0):
    while ($resQDTL = mysqli_fetch_array($resQTL)):
      $tweetDay   = date_format(date_create($resQDTL['date']), "d");
      $tweetMonth = date_format(date_create($resQDTL['date']), "m");
      $tweetYear  = date_format(date_create($resQDTL['date']), "Y");

      $tweetDate = $tweetDay . " " . $monthT[date($tweetMonth) - 1] . " " . date($tweetYear);

      array_push($tweets, array(
        'idUser' => $resQDTL['idUser'],
        'username' => $resQDTL['userName'],
        'name' => $resQDTL['name'],
        'lastName' => $resQDTL['lastName'],
        'photo' => $resQDTL['photo'],
        'idTweet' => $resQDTL['idTweet'],
        'type' => $resQDTL['type'],
        'tweet' => $resQDTL['tweet'],
        'date' => $tweetDate
      ));
    endwhile;
endif;

echo json_encode($tweets);
?>
