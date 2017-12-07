function loadUserProfile() {
  var user;
  var urlParam = window.location.search.substr(1);
  var profileParam = getUrlParameter(urlParam);

  if(profileParam != undefined) {
    var profile = {
      idUser: profileParam
    };

    sendAjax('POST', './get_user_profile.php', JSON.stringify(profile)).then(function(response) {
      user = response[0].data;
      loadUserTweets(user);
    });
  }
  else {
    user = {
      idUser: localStorage.getItem('idUser'),
      name: localStorage.getItem('name'),
      lastName: localStorage.getItem('lastName'),
      username: localStorage.getItem('username'),
      registerDate: localStorage.getItem('registerDate'),
      photo: localStorage.getItem('photo')
    };

    loadUserTweets(user);
  }
}
