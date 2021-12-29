//on click signup hide loginnd show registeration screen
$(document).ready(function () {
  $("#signup").click(function () {
    $("#first").slideUp("slow", function () {
      $("#second").slideDown("slow");
    });
  });
});

//on click signin hide registration nd show login form
$(document).ready(function () {
  $("#signin").click(function () {
    $("#second").slideUp("slow", function () {
      $("#first").slideDown("slow");
    });
  });
});
