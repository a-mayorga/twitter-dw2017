<?php
    session_start();
    include('db.php');
    include('status_code.php');

    $cleanedTweet = preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', ' ', $_POST['tweet']);
    $auxString    = preg_replace('/\s+/', ' ', $cleanedTweet);

    $idUser    = $_SESSION['idUser'];
    $tweet     = $cleanedTweet;
    $type      = $_POST['emergency_type'];
    $tweetDate = date('Y-m-d');
    $tweetHour = date('H:i:s');

    $queryInsert = "
        INSERT INTO tweet (idUser, type, tweet, date, hour)
        VALUES (". $idUser . ", '" . $type . "', '" . $tweet . "', '" . $tweetDate . "', '" . $tweetHour . "');";
    $resQ = queryRes($queryInsert);

    $response = getStatusCode(1);

    echo json_encode($response);
?>
