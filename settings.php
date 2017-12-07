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
        <title>Ajustes</title>
        <link rel="stylesheet" href="css/settings.css">
        <link href="img/favicon.png" rel="shortcut icon" type="image/x-icon" />
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
                <a id="active-btn">
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
        <div id="error-div"><label>¡Faltan campos por completar!</label></div>
        <div id="success-div"><label></label></div>

        <div id="header-form-login">
            <p>Configuración</p>
        </div>
        <form id="form-login" action="update_settings.php" method="post" onsubmit="return saveSettings()">
            <p>Información de Usuario</p>
            <label>
                <p>Correo electrónico</p>
                <input type="text" name="email" maxlength="60" id="email">
            </label>
            <label>
                <p>Nombre de usuario</p>
                <input type="text" name="user" maxlength="16" id="user">
            </label>
            <p id="photo-title">Foto de perfil</p>
            <label>
                <img class="profile_photo" src="#">
                <input type="file" name="profile_photo" accept="image/jpeg, image/png, image/gif">
            </label>
            <p>Contraseña</p>
            <label>
                <p>Contraseña actual</p>
                <input type="password" name="pass">
            </label>
            <label>
                <p>Nueva contraseña</p>
                <input type="password" name="new_pass">
            </label>
            <label>
                <p>Verificar contraseña</p>
                <input type="password" name="pass_conf">
            </label>
            <button type="submit" style="margin-left: calc((100% / 2) - 80px); width: 160px; background-color: #58DFC6;">
                Guardar
            </button>
        </form>
        <div id="footer-form-login">
            <p onclick="deleteAccount()">Eliminar cuenta</p>
        </div>
    <script src="js/misc.js" charset="utf-8"></script>
    <script src="js/settings.js" charset="utf-8"></script>
    <script src="js/credentials.js" charset="utf-8"></script>
    <script>
      window.addEventListener('load', loadProfilePhoto, true);
      window.addEventListener('load', loadSettings, true);
    </script>
    </body>
</html>
