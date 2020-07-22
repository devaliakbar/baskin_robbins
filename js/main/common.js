var getResponce = async (path, passedMethod, passedBody) => {
  var response;
  if (passedMethod == "POST") {
    response = await fetch(path, {
      method: "POST",
      headers: {
        token: getCookie("token"),
      },
      body: JSON.stringify(passedBody),
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
  var responceText = await response.text();
  try {
    var jsonResponce = JSON.parse(responceText);
  } catch (err) {
    console.log(err);
    return { status: "FAILED", success: false };
  }

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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var getAllRegions = async () => {
  var regions = await getResponce("api/get_regions.php");

  if (regions == undefined) {
    return;
  }

  if (!regions.success) {
    if (regions.status == "EMPTY") {
      return;
    }
    return alert("Failed to get regions");
  }

  fillRegion(regions.regions);
};

var fillRegion = (regions) => {
  $("#region").empty();
  jQuery("#region").append("<option value='' selected=''></option>");
  for (var i = 0; i < regions.length; i++) {
    $("#region").append(
      $("<option></option>").attr("value", regions[i]).text(regions[i])
    );
  }
};

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var getLocations = async () => {
  $("#location").empty();
  jQuery("#location").append("<option value='' selected=''></option>");
  $("#parlor").empty();
  jQuery("#parlor").append("<option value='' selected=''></option>");

  var selectedRegion = $("#region").val();
  if (selectedRegion == "") {
    return;
  }

  var locations = await getResponce(
    "api/get_locations.php?region=" + selectedRegion
  );

  if (locations == undefined) {
    return;
  }

  if (!locations.success) {
    if (locations.status == "EMPTY") {
      return;
    }
    return alert("Failed to get locations");
  }

  fillLocation(locations.locations);
};

var fillLocation = (locations) => {
  $("#location").empty();
  jQuery("#location").append("<option value='' selected=''></option>");
  for (var i = 0; i < locations.length; i++) {
    $("#location").append(
      $("<option></option>").attr("value", locations[i]).text(locations[i])
    );
  }
};

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var getParlors = async () => {
  $("#parlor").empty();
  jQuery("#parlor").append("<option value='' selected=''></option>");

  var selectedRegion = $("#region").val();
  if (selectedRegion == "") {
    return;
  }

  var selectedLocations = $("#location").val();
  if (selectedLocations == "") {
    return;
  }

  var parlors = await getResponce(
    "api/get_parlors.php?region=" +
      selectedRegion +
      "&location=" +
      selectedLocations
  );

  if (parlors == undefined) {
    return;
  }

  if (!parlors.success) {
    if (parlors.status == "EMPTY") {
      return;
    }
    return alert("Failed to get locations");
  }

  fillParlors(parlors.parlors);
};

var fillParlors = (parlors) => {
  $("#parlor").empty();
  jQuery("#parlor").append("<option value='' selected=''></option>");
  for (var i = 0; i < parlors.length; i++) {
    $("#parlor").append(
      $("<option></option>").attr("value", parlors[i]).text(parlors[i])
    );
  }
};

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var formatDate = (date) => {
  var dateSplit = date.split("/");
  return dateSplit[0] + "-" + dateSplit[1] + "-" + dateSplit[2];
};

var format2Date = (date) => {
  if (date == "0000-00-00") {
    return "";
  }
  var dateSplit = date.split("-");
  return dateSplit[0] + "/" + dateSplit[1] + "/" + dateSplit[2];
};
