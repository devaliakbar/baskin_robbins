$("#login").click(function async() {
  var username = $("#username").val().trim();
  var password = $("#password").val().trim();
  if (username == "" || password == "") {
    return alert("Please enter username and password");
  }
  login(username, password);
});

var login = async (username, password) => {
  const response = await fetch("api/login.php", {
    method: "POST",
    body: JSON.stringify({ username, password }),
  });

  if (response.status == 200) {
    var jsonResponce = await response.json();
    if (jsonResponce["success"]) {
      //SAVE TOKEN
      setCookie("token", jsonResponce["token"], 365);
      setCookie("type", jsonResponce["type"], 365);
      location.replace("index.php");
    } else {
      alert("Invalid Username or Password");
    }
  } else {
    alert("Failed To Connect");
  }
};
