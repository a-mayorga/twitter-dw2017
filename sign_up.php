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
        <title>Regístrate</title>
        <link rel="stylesheet" href="css/sign_up.css">
        <link href="img/favicon.png" rel="shortcut icon" type="image/x-icon" />
    </head>
    <body>
        <a href="login.php">
            <div id="back-btn" style="border: 3px solid #CFCFCF; opacity: .75;">
                <img class="animation" src="img/icons/back32.png" alt="">
            </div>
        </a>
        <div id="header-form-login">
            <p>Únete a Twitter</p>
        </div>
        <form id="form-login" method="post" action="register.php" onsubmit="return signUp()">
            <img src="img/logo20.png">
            <label>
                <input type="text" name="name" id="name" placeholder="Nombre(s)" maxlength="60">
            </label>
            <label>
                <input type="text" name="last_name" id="last_name" placeholder="Apellido(s)" maxlength="60">
            </label>
            <label>
                <input type="text" name="email" id="email" placeholder="Correo electrónico" maxlength="60">
            </label>
            <label>
                <input type="number" name="age" id="age" placeholder="Edad" min="1" max="80">
            </label>
            <label>
                <input type="text" name="user" id="user" placeholder="Nombre de usuario" maxlength="16">
            </label>
            <label>
                <input type="password" name="pass" id="pass" placeholder="Contraseña">
            </label>
            <label>
                <input type="password" name="pass_conf" id="pass_conf" placeholder=" Verificar contraseña">
            </label>
            <label>
                <input type="file" name="profile_photo" id="profile_photo" accept="image/jpeg, image/png, image/gif">
            </label>
            <!-- <p id="photo-title">Foto de perfil</p>
            <label>
                <img src="img/profile_photos/default_user.jpg" alt="">
                <input type="file" name="profile_photo" accept="image/jpeg, image/png, image/gif">
            </label> -->
            <button type="submit" style="background-color: #1DA1F2;">
                Regístrate
            </button>
        </form>
        <div id="error-div"><label></label></div>
        <div id="success-div"><label></label></div>
    <script src="js/misc.js" charset="utf-8"></script>
    <script src="js/credentials.js" charset="utf-8"></script>
    </body>
</html>
