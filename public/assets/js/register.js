$(document).ready(function() {

  $(function() {
    $(".select").dropdown({
      "autoinit": ".select"
    });
    $(".select").dropdown({
      "dropdownClass": "my-dropdown",
      "optionClass": "my-option awesome"
    });
  });

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $("form").submit(function(e) {
    e.preventDefault();
    var formData = $('#registerForm').serialize();
    var Firstname = $("#firstname");
    var Lastname = $("#lastname");
    var Email = $("#email");
    var Username = $("#username");
    var Password = $("#password");
    var confirmPassword = $("#confirm-password");

    if (Firstname.val() == '' && Lastname.val() == '' && Email.val() == '' && Username.val() == '' && Password.val() == '' && confirmPassword.val() == '') {
      WebuiPopovers.show('#firstname', ({
        content: 'نام وارد نشده است',
        placement: 'right',
        animation: 'pop',
        multi: 'false',
        trigger: 'manual'
      }));
      WebuiPopovers.show('#lastname', ({
        content: 'نام خانوادگی وارد نشده است',
        placement: 'left',
        animation: 'pop',
        multi: 'false',
        trigger: 'manual'
      }));
      WebuiPopovers.show('#email', ({
        content: ' ایمیل وارد نشده است',
        placement: 'top',
        animation: 'pop',
        multi: 'false',
        trigger: 'manual'
      }));
      WebuiPopovers.show('#username', ({
        content: 'نام کاربری وارد نشده است',
        animation: 'pop',
        multi: 'false',
        trigger: 'manual'
      }));
      WebuiPopovers.show('#password', ({
        content: 'گذر واژه وارد نشده است',
        animation: 'pop',
        multi: 'false',
        trigger: 'manual'
      }));
      WebuiPopovers.show('#confirm-password', ({
        content: 'تکرار گذر واژه وارد نشده است',
        animation: 'pop',
        multi: 'false',
        trigger: 'manual'
      }));
      $('#firstname').focus(function() {
        WebuiPopovers.hide("#firstname");
      });
      $('#lastname').focus(function() {
        WebuiPopovers.hide("#lastname");
      });
      $('#email').focus(function() {
        WebuiPopovers.hide("#email");
      });
      $('#username').focus(function() {
        WebuiPopovers.hide("#username");
      });
      $('#password').focus(function() {
        WebuiPopovers.hide("#password");
      });
      $('#confirm-password').focus(function() {
        WebuiPopovers.hide("#confirm-password");
      });
      return false;
    } else if (Firstname.val() == '') {
      WebuiPopovers.show('#firstname', ({
        content: 'نام وارد نشده است',
        placement: 'right',
        animation: 'pop',
        multi: 'false',
        trigger: 'manual'
      }));
      $('#firstname').focus(function() {
        WebuiPopovers.hide("#firstname");
      });
      return false;
    } else if (Lastname.val() == '') {
      WebuiPopovers.show('#lastname', ({
        content: 'نام خانوادگی وارد نشده است',
        placement: 'left',
        animation: 'pop',
        multi: 'false',
        trigger: 'manual'
      }));
      $('#lastname').focus(function() {
        WebuiPopovers.hide("#lastname");
      });
      return false;
    } else if (Email.val() == '') {
      WebuiPopovers.show('#email', ({
        content: ' ایمیل وارد نشده است',
        placement: 'top',
        animation: 'pop',
        multi: 'false',
        trigger: 'manual'
      }));
      $('#email').focus(function() {
        WebuiPopovers.hide("#email");
      });
      return false;
    } else if (Username.val() == '') {
      WebuiPopovers.show('#username', ({
        content: 'نام کاربری وارد نشده است',
        animation: 'pop',
        trigger: 'manual'
      }));
      $('#username').focus(function() {
        WebuiPopovers.hide("#username");
      });
      return false;
    } else if (Password.val() == '') {
      WebuiPopovers.show('#password', ({
        content: 'گذر واژه وارد نشده است',
        animation: 'pop',
        trigger: 'manual'
      }));
      $('#password').focus(function() {
        WebuiPopovers.hide("#password");
      });
      return false;
    } else if (confirmPassword.val() == '') {
      WebuiPopovers.show('#confirm-password', ({
        content: 'تکرار گذر واژه وارد نشده است',
        animation: 'pop',
        multi: 'false',
        trigger: 'manual'
      }));
      $('#confirm-password').focus(function() {
        WebuiPopovers.hide("#confrim-password");
      });
      return false;
    }else if ( confirmPassword.val() != Password.val()){
      WebuiPopovers.show('#password', ({
        content: 'گذرواژه یکسان نیستند',
        animation: 'pop',
        trigger: 'manual'
      }));
      $('#password').focus(function() {
        WebuiPopovers.hide("#password");
      });
      WebuiPopovers.show('#confirm-password', ({
        content: 'گذرواژه یکسان نیستند',
        animation: 'pop',
        multi: 'false',
        trigger: 'manual'
      }));
      $('#confirm-password').focus(function() {
        WebuiPopovers.hide("#confrim-password");
      });
      return false;
    }


    $.ajax({
      type: "POST",
      url: "http://localhost:8000/register",
      data: formData,
      success: function(data) {
        if (data.fail) {
          $(".not-found div").slideDown(1000, function() {
            $(".not-found div").css("padding", "0.1px 0");
            setTimeout(function() {
              $(".not-found div").slideUp(1000);
            }, 3000);
          });
        }
      },
      error: function() {
        $(".not-found div").slideDown(1000, function() {
            $(".not-found div").css("padding", "0.1px 0");
            setTimeout(function() {
              $(".not-found div").slideUp(1000);
            }, 3000);
          });
      }
    });

  });
});
