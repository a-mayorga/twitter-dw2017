function loadSearch() {
  var users = document.getElementById('users');
  var tweets = document.getElementById('tweets');
  var hashtag = document.getElementById('hashtag-text');

  var urlParam = window.location.search.substr(1);
  var searchTerm = getUrlParameter(urlParam);

  if(searchTerm != undefined) {
    var search = {
      searchTerm: searchTerm
    };

    hashtag.innerHTML += " " + searchTerm;

    sendAjax('POST', './search_func.php', JSON.stringify(search)).then(function(response) {
      if(response[0].users.length > 0) {
        for(let i = 0; i < response[0].users.length; i ++) {
          users.innerHTML += "<div id='follow'><div id='follow-photo'>" +
                             "<a href='profile.php?user=" + response[0].users[i].idUser + "'>" +
                             "<img src='" + response[0].users[i].photo + "'></a></div>" +
                             "<div id='information'><div id='user-info'>" +
                             "<a href='profile.php?user=" + response[0].users[i].idUser + "'>" +
                             "<p class='tweet-inf follow-inf'>" + response[0].users[i].name + " " + response[0].users[i].lastName + "</p></a>" +
                             "<a href='profile.php?user=" + response[0].users[i].idUser + "'>" +
                             "<p class='follow-inf extra-info'>@" + response[0].users[i].username + "</p></a></div>" +
                             "<div id='follow-content'>" +
                             "<button id='follow-btn' style='background: #FFF; color: #1B95E0; cursor: pointer' onclick='follow(" + response[0].users[i].idUser + ")'>Seguir</button></div></div></div>";
        }
      }
      else {
        users.innerHTML = "<div id='no-user'>" +
                          "<p>No se encontraron usuarios a los que puedas seguir.</p>" +
                          "</div>";
      }

      if(response[0].tweets.length > 0) {
        for(let i = 0; i < response[0].tweets.length; i++) {
          tweets.innerHTML += "<div id='hashtag'>" +
                              "<div id='hashtag-photo'>" +
                              "<a href='profile.php?user=" + response[0].tweets[i].idUser + "'>" +
                              "<img src='" + response[0].tweets[i].photo + "'>" +
                              "</a>" +
                              "</div>" +
                              "<div>" +
                              "<div id='user-info'>" +
                              "<a href='profile.php?user=" + response[0].tweets[i].idUser  + "'>" +
                              "<p class='tweet-inf hashtag-inf'>" + response[0].tweets[i].name + " " + response[0].tweets[i].lastName + "</p>" +
                              "</a>" +
                              "<a href='profile.php?user=" + response[0].tweets[i].idUser + "'>" +
                              "<p class='hashtag-inf extra-info-h'>@" + response[0].tweets[i].username + "</p>" +
                              "</a>" +
                              "</div>" +
                              "<div id='hashtag-content'>" +
                              "<p>" + response[0].tweets[i].tweet + "</p>" +
                              "</div>" +
                              "</div>" +
                              "</div>";
        }
      }
      else {
        tweets.innerHTML = "<div id='no-user'>" +
                            "<p>No se encontraron tweets relacionados con: " + searchTerm + ".</p>" +
                            "</div>";
      }
    });
  }
  else {
    window.location = "index.php";
  }
}
