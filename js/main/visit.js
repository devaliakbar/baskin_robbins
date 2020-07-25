var query;
var dvrDetails = [];
var networkCabelDetails = [];
var cameraDetails = [];
var tvDetails = [];

$(document).ready(async function () {
  $("#attachment").hide();

  const urlParams = new URLSearchParams(window.location.search);
  query = urlParams.get("q");

  await getAllRegions();

  if (query != null && query != "") {
    $("#heading").html("Record");
    loadPrevious(query);
  } else {
    location.replace("index.php");
  }
});

var loadPrevious = async (id) => {
  var visit = await getResponce("api/get_visit_details.php?id=" + id);

  if (visit == undefined) {
    return;
  }
  if (!visit.success) {
    if (visit.status == "EMPTY") {
      return location.replace("index.php");
    }
    return alert("Failed to get fetch");
  }

  $("#date").val(format2Date(visit.visitDetails.date));
  $("#region").val(visit.visitDetails.region);

  await getLocations();
  $("#location").val(visit.visitDetails.location);

  await getParlors();
  $("#parlor").val(visit.visitDetails.parlor);

  $("#comment").val(visit.visitDetails.comment);
  $("#verified_by").val(visit.visitDetails.verifiedBy);
  $("#verified_date").val(format2Date(visit.visitDetails.verifiedDate));
  $("#checked_by").val(visit.visitDetails.checkedBy);
  $("#checked_date").val(format2Date(visit.visitDetails.checkedDate));
  $("#approved_by").val(visit.visitDetails.approvedBy);
  $("#approved_date").val(format2Date(visit.visitDetails.approvedDate));

  $("#parlour_code").val(visit.visitDetails.parlorCode);
  $("#Latitude").val(visit.visitDetails.lat);
  $("#Longitude").val(visit.visitDetails.lon);

  if (visit.visitDetails.dvrDetailsList != undefined) {
    dvrDetails = visit.visitDetails.dvrDetailsList;
  }
  if (visit.visitDetails.networkCabelDetailsList != undefined) {
    networkCabelDetails = visit.visitDetails.networkCabelDetailsList;
  }
  if (visit.visitDetails.cameraDetailsList != undefined) {
    cameraDetails = visit.visitDetails.cameraDetailsList;
  }
  if (visit.visitDetails.tvDetailsList != undefined) {
    tvDetails = visit.visitDetails.tvDetailsList;
  }

  fillDvrTable();
  fillNetworkCabelTable();
  fillCameraTable();
  fillTVTable();

  isInputValued();

  if (visit.visitDetails.documentPath != "") {
    $("#attachment").attr("href", visit.visitDetails.documentPath);
    $("#attachment").show();
  }
};

var fillTVTable = () => {
  jQuery(".tv-table").empty();
  for (var i = 0; i < tvDetails.length; i++) {
    var appendRow =
      " <tr><td>" +
      (i + 1) +
      "</td> <td>" +
      tvDetails[i].networkPoint +
      "</td><td>" +
      tvDetails[i].status +
      "</td><td>" +
      tvDetails[i].remark +
      "</td><td>" +
      tvDetails[i].suggestions +
      "</td></tr>";

    jQuery(".tv-table").append(appendRow);
  }
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
      "</td></tr>";

    jQuery(".camera-table").append(appendRow);
  }
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
      "</td></tr>";

    jQuery(".network-cabel-table").append(appendRow);
  }
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
      "</td></tr>";
    jQuery(".dvr-table").append(appendRow);
  }
};

var editVisit = () => {
  window.location = "add-record.php?q=" + query;
};

var deleteVisit = async () => {
  var confirmDelete = confirm("Are you sure,do you want to delete ?");

  if (!confirmDelete) {
    return;
  }

  var deleteResponce = await getResponce("api/delete_visit.php", "POST", {
    id: query,
  });

  if (deleteResponce == undefined) {
    return;
  }

  if (!deleteResponce.success) {
    return alert("Failed To Delete");
  }

  var documentPath = $("#attachment").attr("href");

  if (documentPath != "#" || documentPath != "") {
    await getResponce("api/delete_document.php", "POST", {
      fileName: documentPath,
    });
  }

  alert("Successfully deleted");

  location.replace("index.php");
};
