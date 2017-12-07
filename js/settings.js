function loadSettings() {
  for (let i = 0; i < photos.length; i++) {
    photos[i].src = localStorage.getItem('photo');
  }

  email.value = localStorage.getItem('email');
  user.value = localStorage.getItem('username');
}

function saveSettings() {
  var data = new FormData(formLogin);

  sendAjax(formLogin, data).then(function(response) {
    if (response[0].status == 1) {
      showMessage(successMsg, "¡Se ha actualizado la información correctamente!");
      setTimeout(function() {
        saveUserData(response[0].data);
        window.location.reload();
      }, 1000);
    } else if (response[0].status == 3) {
      showMessage(errorMsg, "¡Las contraseñas no coinciden!");
    } else if (response[0].status == 6) {
      showMessage(errorMsg, "Error al subir el fichero.");
    } else if (response[0].status == 7) {
      showMessage(errorMsg, "¡Faltan campos por completar!");
    } else if (response[0].status == 8) {
      showMessage(errorMsg, "¡La contraseña está equivocada!");
    } else if (response[0].status == 9) {
      showMessage(errorMsg, "La contraseña debe contener al menos 6 caracteres.");
    } else if (response[0].status == 10) {
      showMessage(errorMsg, "¡Las contraseñas son iguales!");
    }

    goToTop();
  });

  return false;
}

function deleteAccount() {
  var ans = confirm('¿Estás seguro de querer eliminar tu cuenta?');

  if (ans) {
    var user = {
      idUser: localStorage.getItem('idUser')
    };

    sendAjax('POST', './delete_account.php', JSON.stringify(user)).then(function(response) {
      if (response[0].status == 1) {
        showMessage(successMsg, "Tu cuenta ha sido eliminada");
        logout();

        setTimeout(function() {
          window.location = 'login.php';
        }, 1000);
      }
    });
  }
}
