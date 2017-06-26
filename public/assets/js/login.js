$(document).ready(function(){

    $(".select").dropdown({ "autoinit" : ".select" });
    $(".select").dropdown({ "dropdownClass": "my-dropdown", "optionClass": "my-option awesome" });

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $("form").submit(function(e){


        e.preventDefault();
        var formData = $('#loginForm').serialize();

        var Username = $("#username");
        var Password = $("#password");

        if ( Username.val() == '' && Password.val() == ''){
            WebuiPopovers.show('#username',({content:'نام کاربری وارد نشده است',animation:'pop',multi:'false',trigger:'manual'}));
            WebuiPopovers.show('#password',({content:'گذر واژه وارد نشده است',animation:'pop',multi:'false',trigger:'manual'}));
            $('#username').focus(function(){
                WebuiPopovers.hide("#username");
            });
            $('#password').focus(function(){
                WebuiPopovers.hide("#password");
            });
            return false;
        }
        else if ( Username.val() == ''){
            WebuiPopovers.show('#username',({content:'نام کاربری وارد نشده است',animation:'pop',trigger:'manual'}));
            $('#username').focus(function(){
                WebuiPopovers.hide("#username");
            });
            return false;
        }
        else if ( Password.val() == '' ){
            WebuiPopovers.show('#password',({content:'گذر واژه وارد نشده است',animation:'pop',trigger:'manual'}));
            $('#password').focus(function(){
                WebuiPopovers.hide("#password");
            });
            return false;
        }

        $.ajax({
            url: 'http://localhost:8000/login',
            type: 'POST',
            dataType: 'JSON',
            data: formData,
        })
        .done(function(data) {
            if (data.fail){
                $(".not-found div").slideDown(1000,function(){
                    $(".not-found div").css("padding","0.1px 0");
                    setTimeout(function() {
                        $(".not-found div").slideUp(1000);
                    }, 3000);
                });
            }
        })
        .fail(function(data) {
            $(".not-found div").slideDown(1000,function(){
                    $(".not-found div").css("padding","0.1px 0");
                    setTimeout(function() {
                        $(".not-found div").slideUp(1000);
                    }, 3000);
                });
        });
    });
});
