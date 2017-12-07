<?php
session_start();

function getUserData()
{
  if(func_num_args() > 0) {
    $idUser = func_get_arg(0);
    $q     = "SELECT * FROM user WHERE (idUser = " . $idUser . ");";
  }
  else {
    $q     = "SELECT * FROM user WHERE (idUser = " . $_SESSION['idUser'] . ");";
  }

  $resQ  = queryRes($q);
  $resQD = mysqli_fetch_array($resQ);

  $registerMonth = date_format(date_create($resQD['registerDate']),"m");
  $registerYear  = date_format(date_create($resQD['registerDate']),"Y");

  $month = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");

  $registerDate = "Se unió en " . $month[date($registerMonth) - 1] . " del " . date($registerYear);

  $user = array(
    'idUser' => $resQD['idUser'],
    'username' => $resQD['userName'],
    'email' => $resQD['userEmail'],
    'name' => $resQD['name'],
    'lastName' => $resQD['lastName'],
    'age' => $resQD['age'],
    'registerDate' => $registerDate,
    'photo' => $resQD['photo']
  );

  return $user;
}

?>
