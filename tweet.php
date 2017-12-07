<?php
    session_start();
    include('db.php');
    include('status_code.php');

    $cleanedTweet = preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', ' ', $_POST['tweet']);
    $auxString    = preg_replace('/\s+/', ' ', $cleanedTweet);

    $idUser    = $_SESSION['idUser'];
    $tweet     = $cleanedTweet;
    $tweetDate = date('Y-m-d');
    $tweetHour = date('H:i:s');

    $queryInsert = "
        INSERT INTO tweet (idUser, tweet, date, hour)
        VALUES (". $idUser . ", '" . $tweet . "', '" . $tweetDate . "', '" . $tweetHour . "');";
    $resQ = queryRes($queryInsert);

    $response = getStatusCode(1);

    echo json_encode($response);
?>
