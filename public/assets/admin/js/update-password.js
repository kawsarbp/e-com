$(document).ready(function () {
    /*check admin passsword*/
    $("#current_password").keyup(function () {
        var current_password = $("#current_password").val();
        // alert(current_password);
        $.ajax({
            type: 'post',
            url: '/admin/check-current-password',
            data: {current_password: current_password},
            success: function (response) {
                // alert(response);

                if (response == "false") {
                    $("#check_current_pwd").html("<font color=red>Wrong password</font>")
                } else if (response == "true") {
                    $("#check_current_pwd").html("<font color=green>Password Match</font>")
                }
            }, error: function () {
                alert('Error');
            }
        })
    });
    /*update section Status*/
    $(".updateSectionStatus").click(function () {
        var status = $(this).text();
        var section_id = $(this).attr("section_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-section-status',
            data: {status: status, section_id: section_id},
            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#section-" + section_id).html("<a class='updateSectionStatus'  href='javascript:void (0)'>Inactive</a>");
                } else if (resp['status'] == 1) {
                    $("#section-" + section_id).html("<a class='updateSectionStatus'  href='javascript:void (0)'>Active</a>");
                }
            }, error: function () {
                alert("Error");
            }
        });
    });

    /*update category Status*/
    $(".updateCategoryStatus").click(function () {
        var status = $(this).text();
        var category_id = $(this).attr("category_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-category-status',
            data: {status: status, category_id: category_id},
            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#category-" + category_id).html("<a class='updateCategoryStatus'  href='javascript:void (0)'>Inactive</a>");
                } else if (resp['status'] == 1) {
                    $("#category-" + category_id).html("<a class='updateCategoryStatus'  href='javascript:void (0)'>Active</a>");
                }
            }, error: function () {
                alert("Error");
            }
        });
    });
    /*update products Status*/
    $(".updateProductStatus").click(function () {
        var status = $(this).text();
        var product_id = $(this).attr("product_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-product-status',
            data: {status: status, product_id: product_id},
            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#product-" + product_id).html("<a class='updateProductStatus'  href='javascript:void (0)'>Inactive</a>");
                } else if (resp['status'] == 1) {
                    $("#product-" + product_id).html("<a class='updateProductStatus'  href='javascript:void (0)'>Active</a>");
                }
            }, error: function () {
                alert("Error");
            }
        });
    });
    /*append categories lavel*/
    $('#section_id').change(function () {
        var section_id = $(this).val();
        $.ajax({
            type: 'post',
            url: '/admin/append-categories-level',
            data: {section_id: section_id},
            success: function (resp) {
                $('#appendCategoriesLevel').html(resp);
            }, error: function () {
                alert('Error');
            }
        });
    });
    /*confirm delete*/

    /*$(".confirmDelete").click(function () {
        var name = $(this).attr("name");
        if (confirm("Are you sure to Delete this " + name + "?")) {
            return true;
        } else {
            return false;
        }
    });*/

    /*sweetAlert*/
    $(".confirmDelete").click(function () {
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                /*Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )*/
                /*{{url('admin/delete-category/'.$categories->id)}}"*/
                window.location.href = "/admin/delete-"+record+"/"+recordid;
            }
        });

    });


});
