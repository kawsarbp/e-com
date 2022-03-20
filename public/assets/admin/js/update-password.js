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
    });
    /*update section*/
    $(".updateSectionStatus").click(function () {
        var status = $(this).text();
        var section_id = $(this).attr("section_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-section-status',
            data: {status:status,section_id:section_id},
            success:function (resp) {
                if(resp['status']==0)
                {
                    $("#section-"+section_id).html("<a class='updateSectionStatus'  href='javascript:void (0)'>Inactive</a>");
                }else if(resp['status']==1)
                {
                    $("#section-"+section_id).html("<a class='updateSectionStatus'  href='javascript:void (0)'>Active</a>");
                }
            },error:function () {
                alert("Error");
            }
        });
    });
});
