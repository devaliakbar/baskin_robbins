var page = 0;

$(document).ready(function () {
  //GETTING ALL REGIONS FOR FILTER
  getAllRegions();
  //AFTER FETCHING REGION, FETCHING REGIONS
  fetchVisits();

  $("#from_date").change(async function () {
    page = 0;
    setUpFilterAndGetVisits();
  });

  $("#to_date").change(async function () {
    page = 0;
    setUpFilterAndGetVisits();
  });

  $("#region").change(async function () {
    await getLocations();
    page = 0;
    setUpFilterAndGetVisits();
  });

  $("#location").change(async function () {
    await getParlors();
    page = 0;
    setUpFilterAndGetVisits();
  });

  $("#parlor").change(function () {
    page = 0;
    setUpFilterAndGetVisits();
  });
});

var setUpFilterAndGetVisits = () => {
  var filter = "?page=" + (+page + 1);
  var fromDate = $("#from_date").val().trim();
  if (fromDate != "") {
    filter += "&from_date=" + formatDate(fromDate);

    var toDate = $("#to_date").val().trim();
    if (toDate != "") {
      filter += "&to_date=" + formatDate(toDate);
    }
  }

  var region = $("#region").val().trim();
  if (region != "") {
    filter += "&region=" + region;

    var location = $("#location").val().trim();
    if (location != "") {
      filter += "&location=" + location;

      var parlor = $("#parlor").val().trim();
      if (parlor != "") {
        filter += "&parlor=" + parlor;
      }
    }
  }
  fetchVisits(filter);
};

var fetchVisits = async (filter = "?page=1") => {
  var visits = await getResponce("api/get_all_visits.php" + filter);

  if (visits == undefined) {
    return;
  }

  if (visits.page != +page + 1) {
    return;
  }

  if (!visits.success) {
    if (visits.status == "EMPTY") {
      if (page > 0) {
        return;
      }
      return showEmpty();
    }
    return alert("FAILED");
  }
  page = visits.page;
  if (page == 1) {
    jQuery(".visits-table").empty();
  }
  fillVisitTable(visits.visits);
};

var fillVisitTable = (visits) => {
  for (var i = 0; i < visits.length; i++) {
    var appendRaw = " <tr>";
    appendRaw += "<td>" + visits[i].date + "</td>";
    appendRaw += "<td>" + visits[i].visitedTime + "</td>";
    appendRaw += "<td>" + visits[i].parlor + "</td>";
    appendRaw += "<td>" + visits[i].location + "</td>";
    appendRaw += "<td>" + visits[i].region + "</td>";
    appendRaw += "<td>" + visits[i].verifiedBy + "</td>";
    appendRaw += "<td>" + visits[i].checkedBy + "</td>";
    appendRaw += "<td>" + visits[i].approvedBy + "</td>";
    appendRaw +=
      "<td><i onclick='showVisit(" +
      visits[i].id +
      ")' class='fa fa-eye' aria-hidden='true'></i></td></tr>";
    jQuery(".visits-table").append(appendRaw);
  }
};

var showEmpty = () => {
  jQuery(".visits-table").empty();
};

var showVisit = (visitId) => {
  window.location = "visit.php?q=" + visitId;
};
