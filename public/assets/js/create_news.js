$(document).ready(function() {
  $('.n-tag').focus(function() {
    $('#label').addClass('add-label');
  });
  $('.user-interact').hover(function() {
    $('.user-interact h3').animate({
      padding: "0 270px"
    }, "slow");
  }, function() {
    $('.user-interact h3').animate({
      padding: "0 0px"
    }, "slow");
  });

  $(function() {
    $(".select").dropdown({
      "autoinit": ".select"
    });
    $(".select").dropdown({
      "dropdownClass": "my-dropdown",
      "optionClass": "my-option awesome"
    });
  });
});
