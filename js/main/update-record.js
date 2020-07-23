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
