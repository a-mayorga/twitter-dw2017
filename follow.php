<?php
    session_start();
    include('db.php');
    include('status_code.php');

    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);

    $follows  = $_SESSION['idUser'];
    $followed = $data['idFollowed'];
    $q       = "SELECT * FROM follow WHERE (idUserFollows = " . $follows . " AND idUserFollowed = " . $followed . ");";
    $resQ    = queryRes($q);
    $numRows = mysqli_num_rows($resQ);

    $response = array();

    if($numRows > 0):
      $response = getStatusCode(11);
      echo json_encode($response);
      return false;
    else:
        $queryInsertFollow = "INSERT INTO follow (idUserFollows, idUserFollowed)
                              VALUES (". $follows . ", " . $followed . ");";
        $resQ = queryRes($queryInsertFollow);

        $response = getStatusCode(1);
    endif;

    echo json_encode($response);

?>
