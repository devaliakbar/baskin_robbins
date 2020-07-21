var getResponce = async (path, passedMethod, passedBody) => {
  var response;
  if (passedMethod == "POST") {
    response = await fetch(path, {
      method: "POST",
      headers: {
        token: getCookie("token"),
      },
      body: JSON.stringify({ passedBody }),
    });
  } else {
    response = await fetch(path, {
      method: "GET",
      headers: {
        token: getCookie("token"),
      },
    });
  }

  if (response.status != 200) {
    return { status: "FAILED", success: false };
  }

  var jsonResponce = JSON.parse(await response.text());

  if (jsonResponce.status == "USER") {
    return logOut();
  }

  return jsonResponce;
};

var logOut = async () => {
  setCookie("token", "", 365);
  setCookie("type", "", 365);
  window.location.replace("login.php");
};

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(";");
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
  var expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
