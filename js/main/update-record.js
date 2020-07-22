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
  $("#verified_date").val(visit.visitDetails.verifiedDate);
  $("#checked_by").val(visit.visitDetails.checkedBy);
  $("#checked_date").val(visit.visitDetails.checkedDate);
  $("#approved_by").val(visit.visitDetails.approvedBy);
  $("#approved_date").val(visit.visitDetails.approvedDate);

  dvrDetails = visit.visitDetails.dvrDetailsList;
  networkCabelDetails = visit.visitDetails.networkCabelDetailsList;
  cameraDetails = visit.visitDetails.cameraDetailsList;
  tvDetails = visit.visitDetails.tvDetailsList;

  fillDvrTable();
  fillNetworkCabelTable();
  fillCameraTable();
  fillTVTable();
};
