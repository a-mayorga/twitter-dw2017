<?php
    session_start();
    include('db.php');

    if(!isset($_SESSION['loginP'])):
        if($_SESSION['loginP'] != 1):
            header('location:login.php');
        endif;
    endif;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Twitter</title>
        <link rel="stylesheet" href="css/search.css">
    </head>
    <body>
        <nav id="nav-index">
            <div id="nav-left">
                <a href="profile.php">
                    <img src="img/icons/user32.png" alt="">
                </a>
                <a href="index.php">
                    <img src="img/icons/home32.png" alt="">
                </a>
                <a href="emergency.php">
                    <img src="img/icons/emergency32.png" alt="">
                </a>
                <a href="settings.php">
                    <img src="img/icons/settings32.png" alt="">
                </a>
                <a href="logout.php">
                    <img src="img/icons/logout32.png" alt="">
                </a>
            </div>
            <div id="nav-center">
                <a href="index.php">
                    <img src="img/logo20.png" alt="">
                </a>
            </div>
            <div id="nav-right">
                <form action="search.php" method="get">
                    <input type="text" name="search" placeholder="Buscar" maxlength="25">
                </form>
                <a href="profile.php">
                    <img id="profile_photo" src="#">
                </a>
            </div>
        </nav>

        <div id="flex-div">
            <div class="container" id="container-follow">
                <div id="header-follow">
                    <p>A quién seguir</p>
                </div>
                <div id="users"></div>
            </div>

            <div class="container" id="container-hashtag">
                <div id="header-hashtag">
                    <p id="hashtag-text">Hashtag: </p>
                </div>
                <div id="tweets"></div>
            </div>
        </div>
    <script src="js/misc.js" charset="utf-8"></script>
    <script src="js/search.js" charset="utf-8"></script>
    <script>
      window.addEventListener('load', loadProfilePhoto, true);
      window.addEventListener('load', loadSearch, true);
    </script>
    </body>
</html>
