function login() {
  if (user.value != "" || pass.value != "") {
    var data = new FormData(formLogin);

    sendAjax(formLogin, data).then(function(response) {
      if (response[0].status == 1) {
        saveUserData(response[0].data);
        window.location = "index.php";
      } else if (response[0].status == 2) {
        showMessage(errorMsg, "¡Los datos son incorrectos!");
      }
    });
  } else {
    showMessage(errorMsg, "Debes completar todos los campos");
  }

  return false;
}

function logout() {
  localStorage.removeItem('idUser');
  localStorage.removeItem('username');
  localStorage.removeItem('email');
  localStorage.removeItem('name');
  localStorage.removeItem('lastName');
  localStorage.removeItem('age');
  localStorage.removeItem('registerDate');
  localStorage.removeItem('photo');
}

function signUp() {
  if (name.value != "" && lastName.value != "" && email.value != "" && age.value != "" && user.value != "" && pass.value != "" && passConf.value != "") {
    if (pass.value.length >= 6) {
      if (pass.value == passConf.value) {
        var data = new FormData(formLogin);

        sendAjax(formLogin, data).then(function(response) {
          if (response[0].status == 1) {
            showMessage(successMsg, "Cuenta creada con éxito");
            setTimeout(function() {
              window.location = "login.php";
            }, 1500);
          } else if (response[0].status == 4) {
            showMessage(errorMsg, "El correo electrónico ya está en uso.");
          } else if (response[0].status == 5) {
            showMessage(errorMsg, "El nombre de usuario ya está en uso.");
          } else if (response[0].status == 6) {
            showMessage(errorMsg, "Error al subir el fichero");
          }
        });
      } else {
        showMessage(errorMsg, "¡Las contraseñas no coinciden!");
      }
    } else {
      showMessage(errorMsg, "La contraseña debe contener al menos 6 caracteres.");
    }
  } else {
    showMessage(errorMsg, "Debes completar todos los campos.");
  }

  return false;
}

function saveUserData(data) {
  localStorage.setItem('idUser', data.idUser);
  localStorage.setItem('username', data.username);
  localStorage.setItem('email', data.email);
  localStorage.setItem('name', data.name);
  localStorage.setItem('lastName', data.lastName);
  localStorage.setItem('age', data.age);
  localStorage.setItem('registerDate', data.registerDate);
  localStorage.setItem('photo', data.photo);
}
