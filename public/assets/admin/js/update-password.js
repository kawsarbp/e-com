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
    /*update product attribute Status*/
    $(".updateAttributeStatus").click(function () {
        var status = $(this).text();
        var attribute_id = $(this).attr("attribute_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-attribute-status',
            data: {status: status, attribute_id: attribute_id},
            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#attribute-" + attribute_id).html("<a class='updateAttributeStatus'  href='javascript:void (0)'>Inactive</a>");
                } else if (resp['status'] == 1) {
                    $("#attribute-" + attribute_id).html("<a class='updateAttributeStatus'  href='javascript:void (0)'>Active</a>");
                }
            }, error: function () {
                alert("Error");
            }
        });
    });
    /*update product Image Status*/
    $(".updateImageStatus").click(function () {
        var status = $(this).text();
        var image_id = $(this).attr("image_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-image-status',
            data: {status: status, image_id: image_id},
            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#image-" + image_id).html("<a class='updateImageStatus'  href='javascript:void (0)'>Inactive</a>");
                } else if (resp['status'] == 1) {
                    $("#image-" + image_id).html("<a class='updateImageStatus'  href='javascript:void (0)'>Active</a>");
                }
            }, error: function () {
                alert("Error");
            }
        });
    });
    /*update Brand Status*/
    $(".updateBrandStatus").click(function () {
        var status = $(this).children("i").attr("status");
        var brand_id = $(this).attr("brand_id");
        $.ajax({
            type: 'post',
            url: '/admin/update-brand-status',
            data: {status: status, brand_id: brand_id},
            success: function (resp) {
                if (resp['status'] == 0) {
                    $("#brand-" + brand_id).html('<i class="fa fa-toggle-off" aria-hidden="true" status="Inactive"></i>');
                } else if (resp['status'] == 1) {
                    $("#brand-" + brand_id).html('<i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i>');
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
    /*Products Attributes add remove script*/
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div style="margin-top: 5px;"> <input type="text" name="size[]" required="" style="width: 100px;" value="" placeholder="Size" /> <input type="text" name="sku[]" required="" style="width: 100px;" value="" placeholder="Sku" /> <input type="text" name="price[]" style="width: 100px;" required="" value="" placeholder="Price" /> <input type="text" name="stock[]" required="" style="width: 100px;" value="" placeholder="Stock" /> <a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

});
