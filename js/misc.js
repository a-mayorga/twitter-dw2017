var name = document.getElementById('name');
var lastName = document.getElementById('last_name');
var email = document.getElementById('email');
var age = document.getElementById('age');
var user = document.getElementById('user');
var pass = document.getElementById('pass');
var profilePhoto = document.getElementById('profile_photo');
var passConf = document.getElementById('pass_conf');
var formLogin = document.getElementById('form-login');
var formTweet = document.getElementById('new-tweet');
var registerDate = document.getElementById('date');
var photos = document.getElementsByClassName('profile_photo');
var tweets = document.getElementById('tweets');
var errorMsg = document.querySelector('#error-div label');
var successMsg = document.querySelector('#success-div label');

function sendAjax(...args) {
  return new Promise(function(resolve, reject) {
    var response;
    var ajaxRequest = new XMLHttpRequest();

    if(args.length < 3) {
      if (typeof args[0] == 'object') {
        ajaxRequest.open(args[0].method, args[0].action);
        ajaxRequest.send(args[1]);
        ajaxRequest.onreadystatechange = function() {
          if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
            response = JSON.parse(ajaxRequest.responseText);
            resolve(response);
          }
        }
      } else if (typeof args[0] == 'string') {
        ajaxRequest.open(args[0], args[1]);
        ajaxRequest.send();
        ajaxRequest.onreadystatechange = function() {
          if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
            response = JSON.parse(ajaxRequest.responseText);
            resolve(response);
          }
        }
      }
    }
    else {
      ajaxRequest.open(args[0], args[1]);
      ajaxRequest.setRequestHeader("Content-Type", "application/json");
      ajaxRequest.send(args[2]);
      ajaxRequest.onreadystatechange = function() {
        if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
          response = JSON.parse(ajaxRequest.responseText);
          // console.log(ajaxRequest.responseText);
          resolve(response);
        }
      }
    }
  });
}

function validateTweetType(type) {
  var emergency = "";

  switch (type) {
    case '1':
    emergency = 'Donación';
      break;
    case '2':
    emergency = 'Servicios públicos';
      break;
    case '3':
    emergency = 'Desastres naturales';
      break;
    case '4':
    emergency = 'Alerta Amber';
      break;
  }

  return emergency;
}

function validateTweet(e) {
  var input = e.target;
  var tweet = input.value;
  var tweetBtn = document.getElementById('tweetBtn');

  if (tweet.length > 0 && tweet != '') {
    tweetBtn.removeAttribute('disabled');
    tweetBtn.style.cursor = 'pointer';
    tweetBtn.style.background = '#1DA1F2';
  } else {
    tweetBtn.setAttribute('disabled', true);
    tweetBtn.style.cursor = 'not-allowed';
    tweetBtn.style.background = '#344';
  }
}

function getUrlParameter(param) {
  var tmp = param.split('&');
  var parameter = tmp[0].split("=");
  return parameter[1];
}

function showMessage(element, message) {
  successMsg.classList.remove('show-msg');
  errorMsg.classList.remove('show-msg');
  element.innerHTML = message;
  element.classList.add('show-msg');
}

function follow(idUser) {
  var user = {
    idFollowed: idUser
  };

  sendAjax('POST', './follow.php', JSON.stringify(user)).then(function(response) {
    if (response[0].status == 1) {
      var followBtn = document.getElementById('follow-btn');
      followBtn.innerHTML = "Siguiendo";
      followBtn.setAttribute('disabled', true);
      followBtn.style.cursor = "not-allowed";
    } else if (response[0].status == 11) {
      alert('Ya sigues a este usuario');
    }
  });
}

function loadProfilePhoto() {
  profilePhoto.src = localStorage.getItem('photo');
}

function goToTop() {
  if (window.scrollY != 0) {
    setTimeout(function() {
      window.scrollTo(0, window.scrollY - 30);
      goToTop();
    }, 15);
  }
}
