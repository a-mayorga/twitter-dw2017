function loadTimeline() {
  tweets.innerHTML = "";

  sendAjax('GET', './get_tweets.php').then(function(response) {
    if (response.length > 0) {
      for (let i = 0; i < response.length; i++) {
        var type = validateTweetType(response[i].type);
        var info;
        var deleteBtn = "";

        if (response[i].type == 0) {
          info = "<p class='tweet-inf extra-info' style='margin-left: 2px;'>" + response[i].date + "</p>";
        } else {
          info = "<p class='tweet-inf extra-info' style='margin-left: 2px;'>" + response[i].date + " • </p>";
        }

        if (response[i].idUser == localStorage.getItem('idUser')) {
          deleteBtn = "<div id='delete-tweet'><img src='img/icons/delete32.png' onclick='deleteTweet(" + response[i].idTweet + ")' /></div>";
        }

        tweets.innerHTML += "<div id='tweet'><div id='tweet-photo'>" +
          "<a href='profile.php?user=" + response[i].idUser + "'>" +
          "<img src=" + response[i].photo + "></a></div>" +
          "<div style='width: 80%'><div id='tweet-info'>" +
          "<a href='profile.php?user=" + response[i].idUser + "'>" +
          "<p class='tweet-inf'>" + response[i].name + " " + response[i].lastName + "</p></a>" +
          "<p class='tweet-inf extra-info'>@" + response[i].username + " • </p>" +
          info +
          "<p class='tweet-inf extra-info' style='margin-left: 2px; color: red;'>" + type + "</p></div>" +
          "<div id='tweet-content'><p>" + response[i].tweet + "</p></div></div>" +
          deleteBtn;
      }
    } else {
      tweets.innerHTML = "<div id='no-tweet'><p>Aún no hay Tweets publicados.</p></div>";
    }
  });
}

function loadUserTweets(user) {
  var newTweet = document.getElementById('new-tweet-container');
  var newTweetBtn = document.getElementById('new-tweet-btn');

  document.querySelector('#profile-photo img').src = user.photo;
  document.getElementById('name').innerHTML = user.name + ' ' + user.lastName;
  document.getElementById('user').innerHTML = '@' + user.username;
  document.getElementById('date').innerHTML = user.registerDate;

  if (user.idUser == localStorage.getItem('idUser')) {
    newTweet.style.display = "block";
    newTweetBtn.style.display = "block";
  }

  sendAjax('POST', './get_user_tweets.php', JSON.stringify(user)).then(function(response) {
    if (response.length > 0) {
      for (let i = 0; i < response.length; i++) {
        var type = validateTweetType(response[i].type);
        var info;
        var deleteBtn = "";

        if (response[i].type == 0) {
          info = "<p class='tweet-inf extra-info' style='margin-left: 2px;'>" + response[i].date + "</p>";
        } else {
          info = "<p class='tweet-inf extra-info' style='margin-left: 2px;'>" + response[i].date + " • </p>";
        }

        if (user.idUser == localStorage.getItem('idUser')) {
          deleteBtn = "<div id='delete-tweet'><img src='img/icons/delete32.png' onclick='deleteTweet(" + response[i].idTweet + ")' /></div>";
        }

        tweets.innerHTML += "<div id='tweet'><div id='tweet-photo'>" +
          "<img src=" + user.photo + "></div>" +
          "<div style='width: 90%'><div id='tweet-info'>" +
          "<p class='tweet-inf'>" + user.name + " " + user.lastName + "</p>" +
          "<p class='tweet-inf extra-info'>@" + user.username + " • </p>" +
          info +
          "<p class='tweet-inf extra-info' style='margin-left: 2px; color: red;'>" + type + "</p></div>" +
          "<div id='tweet-content'><p>" + response[i].tweet + "</p></div></div>" +
          deleteBtn;
      }
    } else {
      tweets.innerHTML = "<div id='no-tweet'><p>Aún no hay Tweets publicados.</p></div>";
    }
  });
}

function loadEmergencyTweets() {
  tweets.innerHTML = "";

  sendAjax('GET', './get_emergency_tweets.php').then(function(response) {
    if (response.length > 0) {
      for (let i = 0; i < response.length; i++) {
        var type = validateTweetType(response[i].type);
        var deleteBtn = "";

        if (response[i].idUser == localStorage.getItem('idUser')) {
          deleteBtn = "<div id='delete-tweet'><img src='img/icons/delete32.png' onclick='deleteTweet(" + response[i].idTweet + ")' /></div>";
        }

        tweets.innerHTML += "<div id='tweet'><div id='tweet-photo'>" +
          "<a href='profile.php?user=" + response[i].idUser + "'>" +
          "<img src=" + response[i].photo + "></a></div>" +
          "<div style='width: 90%'><div id='tweet-info'>" +
          "<a href='profile.php?user=" + response[i].idUser + "'>" +
          "<p class='tweet-inf'>" + response[i].name + " " + response[i].lastName + "</p></a>" +
          "<p class='tweet-inf extra-info'>@" + response[i].username + " • </p>" +
          "<p class='tweet-inf extra-info' style='margin-left: 2px;'>" + response[i].date + " • </p>" +
          "<p class='tweet-inf extra-info' style='color: red; margin-left: 2px;'>" + type + "</p></div>" +
          "<div id='tweet-content'><p>" + response[i].tweet + "</p></div></div>" +
          deleteBtn;
      }
    } else {
      tweets.innerHTML = "<div id='no-tweet'><p>Aún no hay Tweets publicados.</p></div>";
    }
  });
}

function postTweet() {
  var data = new FormData(formTweet);

  sendAjax(formTweet, data).then(function(response) {
    if (response[0].status == 1) {
      window.location.reload();
    } else {
      alert('No se pudo crear el tweet');
    }
  });

  return false;
}

function deleteTweet(idTweet) {
  var response = confirm('¿Estás seguro de querer eliminar este tweet?');

  if (response) {
    var tweet = {
      idTweet: idTweet
    };

    sendAjax('POST', './delete_tweet.php', JSON.stringify(tweet)).then(function(response) {
      if (response[0].status == 1) {
        window.location.reload();
      } else {
        alert('No se pudo eliminar el tweet');
      }
    });
  }

}
