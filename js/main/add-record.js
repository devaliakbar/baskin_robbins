var dvrDetails = [];
var networkCabelDetails = [];
var cameraDetails = [];

$(document).ready(function () {
  $("#heading").html("Add Record");

  getAllRegions();

  $("#region").change(function () {
    getLocations();
  });

  $("#location").change(function () {
    getParlors();
  });
});

var addDvr = () => {
  var noOfChannels = $("#no_of_channels").val().trim();
  var brand = $("#dvr_brand").val().trim();
  var availability = $("#record_availability").val().trim();
  var hddCapacity = $("#hdd_capacity").val().trim();
  var remark = $("#dvr_remark").val().trim();
  var suggestions = $("#dvr_suggestion").val().trim();

  if (noOfChannels == "" || availability == "") {
    return alert("Please enter 'number of channels' and 'availability status'");
  }

  dvrDetails.push({
    noChannels: noOfChannels,
    brand: brand,
    availability: availability,
    hddCapacity: hddCapacity,
    remark: remark,
    suggestions: suggestions,
  });

  $("#no_of_channels").val("");
  $("#dvr_brand").val("");
  $("#record_availability").val("");
  $("#hdd_capacity").val("");
  $("#dvr_remark").val("");
  $("#dvr_suggestion").val("");

  fillDvrTable();
};

var fillDvrTable = () => {
  jQuery(".dvr-table").empty();
  for (var i = 0; i < dvrDetails.length; i++) {
    var appendRow =
      " <tr><td>" +
      (i + 1) +
      "</td><td>" +
      dvrDetails[i].noChannels +
      "</td><td>" +
      dvrDetails[i].brand +
      "</td><td>" +
      dvrDetails[i].availability +
      "</td><td>" +
      dvrDetails[i].hddCapacity +
      "</td><td>" +
      dvrDetails[i].remark +
      "</td><td>" +
      dvrDetails[i].suggestions +
      "</td><td><i onclick='removeDvrRow(" +
      i +
      ")' class='fa fa-trash' aria-hidden='true'></i></td></tr>";
    jQuery(".dvr-table").append(appendRow);
  }
};

var removeDvrRow = (index) => {
  dvrDetails.splice(index, 1);
  fillDvrTable();
};

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var addNetworkCabel = () => {
  var networkPoint = $("#network_point").val().trim();
  var status = $("#network_status").val().trim();
  var suggestions = $("#network_suggestions").val().trim();
  if (networkPoint == "" || status == "") {
    return alert("Please enter 'Network point' and 'status'");
  }

  networkCabelDetails.push({
    networkPoint: networkPoint,
    status: status,
    suggestions: suggestions,
  });

  $("#network_point").val("");
  $("#network_status").val("");
  $("#network_suggestions").val("");

  fillNetworkCabelTable();
};

var fillNetworkCabelTable = () => {
  jQuery(".network-cabel-table").empty();
  for (var i = 0; i < networkCabelDetails.length; i++) {
    var appendRow =
      " <tr><td>" +
      (i + 1) +
      "</td> <td>" +
      networkCabelDetails[i].networkPoint +
      "</td><td>" +
      networkCabelDetails[i].status +
      "</td><td>" +
      networkCabelDetails[i].suggestions +
      "</td><td><i onclick='removeNetworkCabelRow(" +
      i +
      ")' class='fa fa-trash' aria-hidden='true'></i></td></tr>";

    jQuery(".network-cabel-table").append(appendRow);
  }
};

var removeNetworkCabelRow = (index) => {
  networkCabelDetails.splice(index, 1);
  fillNetworkCabelTable();
};

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var addCamera = () => {
  var type = $("#camera_type").val().trim();
  var brand = $("#camera_brand").val().trim();
  var count = $("#camera_count").val().trim();
  var status = $("#camera_status").val().trim();
  var remark = $("#camera_remark").val().trim();
  var ip = $("#camera_ip").val().trim();
  var suggestions = $("#camera_suggestion").val().trim();

  if (type == "" || status == "") {
    return alert("Please enter 'Network point' and 'status'");
  }

  cameraDetails.push({
    type: type,
    brand: brand,
    count: count,
    status: status,
    remark: remark,
    ip: ip,
    suggestions: suggestions,
  });

  // $("#camera_type").val("");
  // $("#camera_brand").val("");
  // $("#camera_count").val("");
  // $("#camera_status").val("");
  // $("#camera_remark").val("");
  // $("#camera_ip").val("");
  // $("#camera_suggestion").val("");

  fillCameraTable();
};

var fillCameraTable = () => {
  jQuery(".camera-table").empty();
  for (var i = 0; i < cameraDetails.length; i++) {
    var appendRow =
      " <tr><td>" +
      (i + 1) +
      "</td> <td>" +
      cameraDetails[i].type +
      "</td><td>" +
      cameraDetails[i].brand +
      "</td><td>" +
      cameraDetails[i].count +
      "</td><td>" +
      cameraDetails[i].status +
      "</td><td>" +
      cameraDetails[i].remark +
      "</td><td>" +
      cameraDetails[i].ip +
      "</td><td>" +
      cameraDetails[i].suggestions +
      "</td><td><i onclick='removeCameraRow(" +
      i +
      ")' class='fa fa-trash' aria-hidden='true'></i></td></tr>";

    jQuery(".camera-table").append(appendRow);
  }
};

var removeCameraRow = (index) => {
  cameraDetails.splice(index, 1);
  fillCameraTable();
};
