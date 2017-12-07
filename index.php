<?php
    session_start();

    if (!isset($_SESSION['loginP'])):
        if ($_SESSION['loginP'] != 1):
            header('location:login.php');
        endif;
    endif;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Inicio</title>
        <link rel="stylesheet" href="css/index.css">
        <link href="img/favicon.png" rel="shortcut icon" type="image/x-icon" />
    </head>
    <body>

        <nav id="nav-index">
            <div id="nav-left">
                <a href="profile.php">
                    <img src="img/icons/user32.png" alt="">
                </a>
                <a id="active-btn">
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

        <div class="container">
            <div id="header-new-tweet">
                <p>Redactar un nuevo Tweet</p>
            </div>
            <form id="new-tweet" action="tweet.php" method="post" onsubmit="return postTweet()">
                <div>
                    <textarea name="tweet" id="tweetM" maxlength="140" placeholder="¿Qué está pasando?" onkeyup="validateTweet(event)"></textarea>
                </div>
                <div>
                    <button type="submit" name="button" id="tweetBtn" disabled>Twittear</button>
                </div>
            </form>
        </div>

        <div class="container">
            <div id="header-tweets">
                <p>Tweets</p>
            </div>
            <div id="tweets"></div>
            <div id="footer-tweets">
                <a style="color: #77757F; cursor: pointer;" onclick="goToTop()">Volver arriba</a>
            </div>
        </div>

        <div id="new-tweet-btn" style="border: 3px solid #CFCFCF; opacity: .75;">
            <a href="#header-new-tweet">
                <img src="img/icons/new32.png" alt="">
            </a>
        </div>
    <script src="js/misc.js" charset="utf-8"></script>
    <script src="js/credentials.js" charset="utf-8"></script>
    <script src="js/tweets.js" charset="utf-8"></script>
    <script>
      window.addEventListener('load', loadProfilePhoto, true);
      window.addEventListener('load', loadTimeline, true);
    </script>
    </body>
</html>
