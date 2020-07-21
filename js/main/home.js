var page = 0;

$(document).ready(function () {
  //GETTING ALL REGIONS FOR FILTER
  getAllRegions();
  //AFTER FETCHING REGION, FETCHING REGIONS
  fetchVisits();

  $("#from_date").change(async function () {
    setUpFilterAndGetVisits();
  });

  $("#to_date").change(async function () {
    setUpFilterAndGetVisits();
  });

  $("#region").change(async function () {
    await getLocations();
    setUpFilterAndGetVisits();
  });

  $("#location").change(async function () {
    await getParlors();
    setUpFilterAndGetVisits();
  });

  $("#parlor").change(function () {
    setUpFilterAndGetVisits();
  });
});

var setUpFilterAndGetVisits = () => {
  var filter = "?page=1";
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

  if (!visits.success) {
    if (visits.status == "EMPTY") {
      return showEmpty();
    }
    return alert("FAILED");
  }
  page = visits.page;
  console.log(page);
  fillVisitTable(visits.visits);
};

var fillVisitTable = (visits) => {
  jQuery(".visits-table").empty();
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
    appendRaw += "<td><i class='fa fa-eye' aria-hidden='true'></i></td></tr>";
    jQuery(".visits-table").append(appendRaw);
  }
};

var showEmpty = () => {
  jQuery(".visits-table").empty();
};
