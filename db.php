<?php
    date_default_timezone_set('America/Mexico_City');

    function connectionDB()
    {
        $con = mysqli_connect('localhost', 'root', '', 'p_twitter');
        mysqli_set_charset($con, "utf8");
        return $con;
    }

    function queryRes($query)
    {
        $con = connectionDB();
        $res  = mysqli_query($con, $query);
        mysqli_close($con);
        return $res;
    }
?>
