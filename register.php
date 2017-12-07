<?php
    include('db.php');
    include('status_code.php');
    define('SITE_ROOT', realpath(dirname(__FILE__)));

    $name      = $_POST['name'];
    $last_name  = $_POST['last_name'];
    $email     = strtolower($_POST['email']);
    $age       = $_POST['age'];
    $user      = $_POST['user'];
    $pass      = $_POST['pass'];

    // Date Type format ↓   (Year-month-day Hour:minutes:seconds am/pm)
    //                      (Y → four digits / y → two last digits)
    //                      (H → 24 hours clock / h → 12 hours clock)
    // $date = date('Y-m-d H:i:s a');
    $registerDate = date('Y-m-d');

    $queryUser = "
        SELECT *
        FROM user
        WHERE (userName LIKE '" . $user . "');";
    $queryMail = "
        SELECT *
        FROM user
        WHERE (userEmail LIKE '" . $email . "');";

    $numRowsMail = mysqli_num_rows(queryRes($queryMail));
    $numRowsUser = mysqli_num_rows(queryRes($queryUser));

    $response = array();

    if ($numRowsMail > 0):
        $response = getStatusCode(4);
        echo json_encode($response);
        return false;
    elseif ($numRowsUser > 0):
        $response = getStatusCode(5);
        echo json_encode($response);
        return false;
    else:
        $queryInsert = "
            INSERT INTO user (userName, userEmail, password, name, lastName, age, registerDate)
            VALUES ('". $user . "', '" . $email . "', MD5('" . $pass . "'), '" . $name . "', '" . $last_name. "', " . $age . ", '" . $registerDate . "');";

        if (is_uploaded_file($_FILES['profile_photo']['tmp_name'])):
            $pathName     = "img/profile_photos/";
            $extension    = substr($_FILES['profile_photo']['name'], -3);
            $fileName     = $user . '.' . $extension;
            $fileFullPath = $pathName . $fileName;

            if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], SITE_ROOT . '/' . $fileFullPath)):
                $queryInsert = "
                    INSERT INTO user (userName, userEmail, password, name, lastName, age, registerDate, photo)
                    VALUES ('". $user . "', '" . $email . "', MD5('" . $pass . "'), '" . $name . "', '" . $last_name. "', " . $age . ", '" . $registerDate . "', '" . $fileFullPath . "');";
            else:
                $response = getStatusCode(6);
                echo json_encode($response);
                return false;
            endif;
        endif;

        $resQ = queryRes($queryInsert);
        $response = getStatusCode(1);
        echo json_encode($response);
    endif;

?>
