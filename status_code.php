<?php

function getStatusCode($status) {
  $response = array();
  array_push($response, array(
    'status' => $status
  ));

  return $response;
}

?>
