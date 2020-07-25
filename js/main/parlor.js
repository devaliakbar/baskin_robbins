var page = 0;
var expenses;
var id;

$(document).ready(function () {
  fetchExpenses();

  $("#from_date").change(async function () {
    page = 0;
    setUpFilterAndGetExpenses();
  });

  $("#to_date").change(async function () {
    page = 0;
    setUpFilterAndGetExpenses();
  });

  $("#name").keyup(function () {
    page = 0;
    setUpFilterAndGetExpenses();
  });
});

var setUpFilterAndGetExpenses = () => {
  var filter = "?page=" + (+page + 1);
  var fromDate = $("#from_date").val().trim();
  if (fromDate != "") {
    filter += "&from_date=" + formatDate(fromDate);

    var toDate = $("#to_date").val().trim();
    if (toDate != "") {
      filter += "&to_date=" + formatDate(toDate);
    }
  }

  var name = $("#name").val().trim();
  if (name != "") {
    filter += "&name=" + name;
  }
  fetchExpenses(filter);
};

var fetchExpenses = async (filter = "?page=1") => {
  var expenseResponce = await getResponce("api/get_all_expenses.php" + filter);

  if (expenseResponce == undefined) {
    return;
  }

  if (expenseResponce.page != +page + 1) {
    return;
  }

  if (!expenseResponce.success) {
    if (expenseResponce.status == "EMPTY") {
      if (page > 0) {
        return;
      }
      return showEmpty();
    }
    return alert("FAILED");
  }
  page = expenseResponce.page;
  if (page == 1) {
    jQuery(".expense-table").empty();
  }

  expenses = expenseResponce.expenses;
  fillExpenseTable();
};

var fillExpenseTable = () => {
  for (var i = 0; i < expenses.length; i++) {
    var appendRaw = " <tr>";
    appendRaw += "<td>" + expenses[i].date + "</td>";
    appendRaw += "<td>" + expenses[i].name + "</td>";
    appendRaw += "<td>" + expenses[i].description + "</td>";
    appendRaw += "<td>" + expenses[i].amount + "</td>";
    appendRaw += "<td>" + expenses[i].amount + "</td>";
    appendRaw += "<td>" + expenses[i].amount + "</td>";

    if (getCookie("type") != "2") {
      appendRaw +=
        "<td><i onclick='editExpense(" +
        expenses[i].id +
        "," +
        i +
        ")' class='fa fa-edit' aria-hidden='true'></i></td>";
    }

    if (getCookie("type") == "0") {
      appendRaw +=
        "<td><i onclick='deleteExpense(" +
        expenses[i].id +
        ")' class='fa fa-trash' aria-hidden='true'></i></td>";
    }

    appendRaw += "</tr>";

    jQuery(".expense-table").append(appendRaw);
  }
};

var showEmpty = () => {
  jQuery(".expense-table").empty();
};

var deleteExpense = async (idOfSelected) => {
  var confirmForDelete = confirm("Are you sure, do you want to delete ?");
  if (!confirmForDelete) {
    return;
  }
  var deleteResponce = await getResponce("api/delete_expense.php", "POST", {
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

var editExpense = (idOfSelected, index) => {
  id = idOfSelected;

  $("#date").val(format2Date(expenses[index].date));
  $("#user_name").val(expenses[index].name);
  $("#description").val(expenses[index].description);
  $("#amount").val(expenses[index].amount);

  isInputValued();

  $("#exampleModalLong").modal("show");
};

var clearAll = () => {
  id = undefined;

  $("#date").val("");
  $("#user_name").val("");
  $("#description").val("");
  $("#amount").val("");
};

var saveExpense = async () => {
  var date = $("#date").val().trim();
  var name = $("#user_name").val().trim();
  var description = $("#description").val().trim();
  var amount = $("#amount").val().trim();

  if (amount == "" || amount <= 0 || date == "") {
    return alert("Please enter 'amount' and 'date'");
  }

  var saveExpenseStatus;

  if (id == undefined) {
    saveExpenseStatus = await getResponce("api/add_expense.php", "POST", {
      date: date,
      name: name,
      description: description,
      amount: amount,
    });
  } else {
    saveExpenseStatus = await getResponce("api/update_expense.php", "POST", {
      id: id,
      date: date,
      name: name,
      description: description,
      amount: amount,
    });
  }

  if (saveExpenseStatus == undefined) {
    return;
  }

  if (!saveExpenseStatus.success) {
    return alert("Failed To Save");
  }
  alert("Successfully saved");
  location.reload();
};
