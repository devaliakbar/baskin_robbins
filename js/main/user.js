var users;

$(document).ready(function () {
  fetchUsers();
});

var fetchUsers = async () => {
  var usersResponce = await getResponce("api/get_all_users.php");

  if (usersResponce == undefined) {
    return;
  }

  if (!usersResponce.success) {
    return alert("FAILED");
  }

  users = usersResponce.users;
  fillUsersTable();
};

var fillUsersTable = () => {
  for (var i = 0; i < users.length; i++) {

    var type = "All";

    if (users[i].type == 1) {
      type = "Only Edit";
    }

    if (users[i].type == 2) {
      type = "Only View";
    }

    var appendRaw = " <tr>";
    appendRaw += "<td>" + users[i].name + "</td>";
    appendRaw += "<td>" + users[i].username + "</td>";
    appendRaw += "<td>" + type + "</td>";
    appendRaw +=
      "<td><i onclick='editUser(" +
      users[i].id +
      "," +
      i +
      ")' class='fa fa-edit' aria-hidden='true'></i></td></tr>";
    jQuery(".user-table").append(appendRaw);
  }
};

var addUser = async () => {
  name = $("#name").val().trim();
  username = $("#username").val().trim();
  password = $("#password").val().trim();
  type = $("input[name=mode]:checked").val();

  if (name == "" || username == "" || password == "") {
    return alert("Please enter every field");
  }

  if (password.length < 6) {
    return alert("Password length must be greater than 6");
  }

  if (password.length > 50) {
    return alert("Password length must be less than 50");
  }

  var saveUserStatus = await getResponce("api/create_user.php", "POST", {
    fullName: name,
    username: username,
    password: password,
    type: type,
  });

  if (saveUserStatus == undefined) {
    return;
  }

  if (!saveUserStatus.success) {
    if (saveUserStatus.status == "EXIST") {
      return alert("Username is already used");
    }

    return alert("Failed To Save");
  }
  alert("Successfully created");
  location.reload();
};

var editUser = (idOfUser, index) => {
  $("#userModify").modal("show");

  $("#mname").val(users[index].name);
  $("#musername").val(users[index].username);

  $("input[name=mmode][value='" + users[index].type + "']").prop(
    "checked",
    true
  );
  isInputValued();
};

var changePassword =async () => {
var password = prompt("Enter the new password");
password = password.trim()
 if (password.length < 6) {
    return alert("Password length must be greater than 6");
  }

  if (password.length > 50) {
    return alert("Password length must be less than 50");
  }

username = $("#musername").val();

 var saveUserPassword = await getResponce("api/change_password.php", "POST", {
    username: username,
    password: password,
  });

  if (saveUserPassword == undefined) {
    return;
  }

  if (!saveUserPassword.success) {
    return alert("Failed To Save");
  }
  alert("Successfully changed");
  location.reload();

};

var savePrivilege = async () => {
  username = $("#musername").val();
  type = $("input[name=mmode]:checked").val();

if(username == "admin"){
 return alert("Can\'t change admin privilege");
}


  var saveUserStatus = await getResponce("api/update_user.php", "POST", {
    username: username,
    type: type,
  });

  if (saveUserStatus == undefined) {
    return;
  }

  if (!saveUserStatus.success) {
    return alert("Failed To Save");
  }
  alert("Successfully changed");
  location.reload();
};
