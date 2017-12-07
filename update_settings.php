<?php
    session_start();
    include('db.php');
    include('get_user_data.php');
    include('status_code.php');
    define('SITE_ROOT', realpath(dirname(__FILE__)));

    $q     = "SELECT * FROM user WHERE (idUser = " . $_SESSION['idUser'] . ");";
    $resQ  = queryRes($q);
    $resQD = mysqli_fetch_array($resQ);

    $email     = $_POST['email'];
    $user      = $_POST['user'];

    $response;

    if(is_uploaded_file($_FILES['profile_photo']['tmp_name'])):
        $pathName     = "img/profile_photos/";
        $extension    = substr($_FILES['profile_photo']['name'], -3);
        $fileName     = $user . '.' . $extension;
        $fileFullPath = $pathName . $fileName;

        if(move_uploaded_file($_FILES['profile_photo']['tmp_name'], SITE_ROOT . '/' . $fileFullPath)):
            $qUpdate = "UPDATE user
                        SET photo = '" . $fileFullPath . "'
                        WHERE idUser = " . $resQD['idUser'] . ";";
            $resQ = queryRes($qUpdate);
        else:
            $response = getStatusCode(6);
            echo json_encode($response);
            return false;
        endif;
    endif;

    $pass      = $_POST['pass'];
    $new_pass  = $_POST['new_pass'];
    $pass_conf = $_POST['pass_conf'];

    if($pass != "" || $new_pass != "" || $pass_conf != ""):
        if($pass != "" && $new_pass != "" && $pass_conf != ""):
            if($pass != "" && MD5($pass) == $resQD['password']):
                if(strlen($new_pass) >= 6):
                    if(MD5($pass) != MD5($new_pass)):
                        if(MD5($new_pass) == MD5($pass_conf)):
                            $qUpdate = "UPDATE user
                                        SET password = '" . MD5($new_pass) . "',
                                        userEmail = '" . $email . "', userName = '" . $user. "'
                                        WHERE idUser = " . $resQD['idUser'] . ";";
                            $resQ = queryRes($qUpdate);
                            $response = getStatusCode(1);
                        else:
                          $response = getStatusCode(3);
                        endif;
                    else:
                      $response = getStatusCode(10);
                    endif;
                else:
                  $response = getStatusCode(9);
                endif;
            else:
              $response = getStatusCode(8);
            endif;
        else:
          $response = getStatusCode(7);
        endif;
    else:
      $qUpdate = "UPDATE user
                  SET userEmail = '" . $email . "', userName = '" . $user. "'
                  WHERE idUser = " . $_SESSION['idUser'] . ";";
      $resQ = queryRes($qUpdate);
      $response = getStatusCode(1);
    endif;

    $user = getUserData();
    $response[0]['data'] = $user;

    echo json_encode($response);
?>
