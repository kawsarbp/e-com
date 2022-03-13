$(document).ready(function () {
    /*check admin passsword*/
    $("#current_password").keyup(function () {
        var current_password = $("#current_password").val();
        // alert(current_password);
        $.ajax({
            type: 'post',
            url: '/admin/check-current-password',
            data:{current_password:current_password},
            success:function (response) {
                // alert(response);

                if(response == "false")
                {
                    $("#check_current_pwd").html("<font color=red>Wrong password</font>")
                }else if (response == "true")
                {
                    $("#check_current_pwd").html("<font color=green>Password Match</font>")
                }
            },error:function () {
                alert('Error');
            }
        })
    })
})
