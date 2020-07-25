//  left panel  //
$(document).ready(function () {
  $("[data-class]").click(function () {
    updateNavbarClass($(this).attr("data-class"));
  });
  updateNavbarClass("fixed-left");

  if ($("main").hasClass("login")) {
    $("body").addClass("login-page");
  }
});
$('#inputfile').on('change',function(){
  //get the file name
  var fileName = $(this).val();
  //replace the "Choose a file" label
  $(this).siblings('.custom-file-label').html(fileName);
})
function updateNavbarClass(className) {
  $("nav")
    .removeClass(function (index, css) {
      return (css.match(/(^|\s)fixed-\S+/g) || []).join(" ");
    })
    .addClass(className);
}
// end left panel //

// datetimepicker //
$(".form_date").datetimepicker({
  language: "en",
  weekStart: 1,
  todayBtn: 1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 2,
  minView: 2,
  forceParse: 0,
});
$(".form_time").datetimepicker({
  language: "en",
  weekStart: 1,
  todayBtn: 1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 1,
  minView: 0,
  maxView: 1,
  forceParse: 0,
});
// $('.datetimepicker').datetimepicker();

jQuery(".startDate").datetimepicker({
  format: "Y/m/d",
  onShow: function (ct) {
    this.setOptions({
      maxDate: jQuery(".endDate").val() ? jQuery(".endDate").val() : false,
    });
  },
  timepicker: false,
});
jQuery(".endDate").datetimepicker({
  format: "Y/m/d",
  onShow: function (ct) {
    this.setOptions({
      minDate: jQuery(".startDate").val() ? jQuery(".startDate").val() : false,
    });
  },
  timepicker: false,
});
$(".dateOnly").datetimepicker({
  timepicker: false,
  format: "d.m.Y",
});
$(".timeOnly").datetimepicker({
  datepicker: false,
  format: "H:i",
});
// end datetimepicker //

//table to excel
$(function () {
  $(".exportToExcel").click(function () {
    $(".table2excel").table2excel({
      exclude: ".noExl",
      name: "Excel Document Name",
    });
  });
});

$(".frm-con-tag input, .frm-con-tag textarea").keyup(function () {
  if ($(this).val() != "") {
    $(this).closest(".frm-con-tag").addClass("valued");
  } else {
    $(this).closest(".frm-con-tag").removeClass("valued");
  }
});

$(".frm-con-tag select").click(function () {
  if ($(this).val() != "") {
    $(this).closest(".frm-con-tag").addClass("valued");
  } else {
    $(this).closest(".frm-con-tag").removeClass("valued");
  }
});

$(".select-mail-or-phone input").change(function () {
  if ($(this).is(":checked")) {
    if ($(this).val() == "mobile") {
      $(".mail-or-phone").addClass("mobileOnly");
    }

    if ($(this).val() == "email") {
      $(".mail-or-phone").removeClass("mobileOnly");
    }
  }
});

function isInputValued(){
  $(".frm-con-tag select,.frm-con-tag input, .frm-con-tag textarea").each(function(){
    if ($(this).val() != "") {
      $(this).closest(".frm-con-tag").addClass("valued");
    } else {
      $(this).closest(".frm-con-tag").removeClass("valued");
    }
  });
}



var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
  'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
  'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
  'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
  'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
  'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
  'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
  'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
  'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
];

$('#region, #location').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'states',
  source: substringMatcher(states)
});