<?php
    session_start();
    if(isset($_SESSION['loginP'])):
        header('location:index.php');
    endif;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Twitter</title>
        <link rel="stylesheet" href="css/login.css">
        <link href="img/favicon.png" rel="shortcut icon" type="image/x-icon" />
    </head>
    <body>
        <div id="header-form-login">
            <p>Inicie sesión en Twitter</p>
        </div>
        <form id="form-login" method="post" action="session.php" onsubmit="return login()">
            <img src="img/logo20.png">
            <label>
                <input type="text" name="user" id="user" placeholder="Correo o usuario">
            </label>
            <label>
                <input type="password" name="pass" id="pass" placeholder="Contraseña">
            </label>
            <button type="submit" style="background-color: #1DA1F2;">
                Iniciar sesión
            </button>
        </form>
        <div id="div-signin">
            <label>¿No tienes una cuenta?</label>
            <a href="sign_up.php">
                Regístrate »
            </a>
        </div>
        <div id="error-div"><label></label></div>
        <div id="success-div"><label></label></div>
    <script src="js/misc.js" charset="utf-8"></script>
    <script src="js/credentials.js" charset="utf-8"></script>
    </body>
</html>
