var parlors;
var id;

$(document).ready(async function () {
  getAllRegions();
  fetchParlors();
  $("#region").change(function () {
    getLocations();
    setUpFilterAndFetch();
  });

  $("#location").change(function () {
    setUpFilterAndFetch();
  });
});

var setUpFilterAndFetch = () => {
  var filter = "?page=1";

  var region = $("#region").val().trim();
  if (region != "") {
    filter += "&region=" + region;

    var location = $("#location").val().trim();
    if (location != "") {
      filter += "&location=" + location;
    }
  }
  fetchParlors(filter);
};

var fetchParlors = async (filter = "") => {
  if (filter == "") {
    regionsList = [];
    locationsList = [];
  }

  var responce = await getResponce("api/get_all_parlors.php" + filter);

  if (responce == undefined) {
    return;
  }

  if (!responce.success) {
    if (responce.status == "EMPTY") {
      return showEmpty();
    }
    return alert("FAILED");
  }

  parlors = responce.parlors;
  fillParlorTable(filter);
};

var fillParlorTable = (filter) => {
  jQuery(".parlor-table").empty();

  for (var i = 0; i < parlors.length; i++) {
    if (filter == "") {
      regionsList.push(parlors[i].region);
      locationsList.push(parlors[i].location);
    }

    var appendRaw = " <tr>";
    appendRaw += "<td>" + parlors[i].region + "</td>";
    appendRaw += "<td>" + parlors[i].location + "</td>";
    appendRaw += "<td>" + parlors[i].parlor + "</td>";
    appendRaw += "<td>" + parlors[i].parlorCode + "</td>";
    appendRaw += "<td>" + parlors[i].lat + "</td>";
    appendRaw += "<td>" + parlors[i].lon + "</td>";

    if (getCookie("type") != "2") {
      appendRaw +=
        "<td><i onclick='editParlor(" +
        parlors[i].id +
        "," +
        i +
        ")' class='fa fa-edit' aria-hidden='true'></i></td>";
    }

    if (getCookie("type") == "0") {
      appendRaw +=
        "<td><i onclick='deleteParlor(" +
        parlors[i].id +
        ")' class='fa fa-trash' aria-hidden='true'></i></td>";
    }

    appendRaw += "</tr>";

    jQuery(".parlor-table").append(appendRaw);
  }

  if (filter == "") {
    $("#add_location").typeahead(
      {
        hint: true,
        highlight: true,
        minLength: 1,
      },
      {
        name: "locationsList",
        source: substringMatcher(locationsList),
      }
    );

    $("#add_region").typeahead(
      {
        hint: true,
        highlight: true,
        minLength: 1,
      },
      {
        name: "regionsList",
        source: substringMatcher(regionsList),
      }
    );
  }
};

var showEmpty = () => {
  jQuery(".parlor-table").empty();
};

var clearAll = () => {
  id = undefined;
  $("#add_region").val("");
  $("#add_location").val("");
  $("#add_parlor").val("");
  $("#add_parlorCode").val("");
  $("#add_lat").val("");
  $("#add_lon").val("");
};

var deleteParlor = async (idOfSelected) => {
  var confirmForDelete = confirm("Are you sure, do you want to delete ?");
  if (!confirmForDelete) {
    return;
  }
  var deleteResponce = await getResponce("api/delete_parlor.php", "POST", {
    id: idOfSelected,
  });

  if (deleteResponce == undefined) {
    return;
  }

  if (!deleteResponce.success) {
    return alert("Failed To Delete");
  }
  alert("Successfully deleted");
  location.reload();
};

var editParlor = (idOfSelected, index) => {
  id = idOfSelected;
  $("#add_region").val(parlors[index].region);
  $("#add_location").val(parlors[index].location);
  $("#add_parlor").val(parlors[index].parlor);
  $("#add_parlorCode").val(parlors[index].parlorCode);
  $("#add_lat").val(parlors[index].lat);
  $("#add_lon").val(parlors[index].lon);
  isInputValued();
  $("#exampleModalLong").modal("show");
};

var saveParlor = async () => {
  var region = $("#add_region").val().trim();
  var pLocation = $("#add_location").val().trim();
  var parlor = $("#add_parlor").val().trim();
  var parlorCode = $("#add_parlorCode").val().trim();
  var lat = $("#add_lat").val().trim();
  var lon = $("#add_lon").val().trim();

  if (
    region == "" ||
    pLocation == "" ||
    parlor == "" ||
    parlorCode == "" ||
    lat == "" ||
    lon == ""
  ) {
    return alert("Please enter every fields");
  }

  var saveStatus;

  if (id == undefined) {
    saveStatus = await getResponce("api/add_parlor.php", "POST", {
      region: region,
      location: pLocation,
      parlor: parlor,
      parlorCode: parlorCode,
      lat: lat,
      lon: lon,
    });
  } else {
    saveStatus = await getResponce("api/update_parlor.php", "POST", {
      id: id,
      region: region,
      location: pLocation,
      parlor: parlor,
      parlorCode: parlorCode,
      lat: lat,
      lon: lon,
    });
  }

  if (saveStatus == undefined) {
    return;
  }

  if (!saveStatus.success) {
    return alert("Failed To Save");
  }
  alert("Successfully saved");
  location.reload();
};

//TYPEHEAD
var substringMatcher = function (strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;
    matches = [];
    substrRegex = new RegExp(q, "i");
    $.each(strs, function (i, str) {
      if (substrRegex.test(str)) {
        matches.push(str);
      }
    });
    cb(matches);
  };
};

var substringMatcher2 = function (strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;
    matches = [];
    substrRegex = new RegExp(q, "i");
    $.each(strs, function (i, str) {
      if (substrRegex.test(str)) {
        matches.push(str);
      }
    });
    cb(matches);
  };
};

var regionsList = [];
var locationsList = [];
