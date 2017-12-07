<?php
    session_start();

    include('db.php');
    include('status_code.php');
    include('get_user_data.php');

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $q = "SELECT * FROM user WHERE (userName LIKE '" . $user . "' OR userEmail LIKE '" . $user . "');";

    $resQ    = queryRes($q);
    $numRows = mysqli_num_rows($resQ);

    $response = array();

    if($numRows == 0):
      $response = getStatusCode(2);
      echo json_encode($response);
      return false;
    endif;

    while($res = mysqli_fetch_array($resQ)):
        if($res['password'] == MD5($pass)):
            $_SESSION['loginP'] = 1;
            $_SESSION['idUser'] = $res['idUser'];
            $response = getStatusCode(1);
            $user = getUserData();
            $response[0]['data'] = $user;
        else:
          $response = getStatusCode(2);
        endif;
    endwhile;

    echo json_encode($response);
?>
