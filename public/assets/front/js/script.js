$(document).ready(function () {
    /*sort*/
    $('#sort').on('change', function () {
        var sort = $(this).val();
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var url = $('#url').val();
        $.ajax({
            url: url,
            method: "post",
            data: {
                fabric: fabric,
                sleeve: sleeve,
                pattern: pattern,
                fit: fit,
                occasion: occasion,
                sort: sort,
                url: url
            },
            success: function (data) {
                $('.filter_products').html(data);
            }
        });
    });
    /*filter*/
    /*fabric*/
    $(".fabric").on('click', function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $('#sort option:selected').val();
        var url = $('#url').val();
        $.ajax({
            url: url,
            method: "post",
            data: {
                fabric: fabric,
                sleeve: sleeve,
                pattern: pattern,
                fit: fit,
                occasion: occasion,
                sort: sort,
                url: url
            },
            success: function (data) {
                $('.filter_products').html(data);
            }
        });
    });
    /*sleeve*/
    $(".sleeve").on('click', function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $('#sort option:selected').val();
        var url = $('#url').val();
        $.ajax({
            url: url,
            method: "post",
            data: {
                fabric: fabric,
                sleeve: sleeve,
                pattern: pattern,
                fit: fit,
                occasion: occasion,
                sort: sort,
                url: url
            },
            success: function (data) {
                $('.filter_products').html(data);
            }
        });
    });
    /*pattern*/
    $(".pattern").on('click', function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $('#sort option:selected').val();
        var url = $('#url').val();
        $.ajax({
            url: url,
            method: "post",
            data: {
                fabric: fabric,
                sleeve: sleeve,
                pattern: pattern,
                fit: fit,
                occasion: occasion,
                sort: sort,
                url: url
            },
            success: function (data) {
                $('.filter_products').html(data);
            }
        });
    });
    /*fit*/
    $(".fit").on('click', function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $('#sort option:selected').val();
        var url = $('#url').val();
        $.ajax({
            url: url,
            method: "post",
            data: {
                fabric: fabric,
                sleeve: sleeve,
                pattern: pattern,
                fit: fit,
                occasion: occasion,
                sort: sort,
                url: url
            },
            success: function (data) {
                $('.filter_products').html(data);
            }
        });
    });
    /*occasion*/
    $(".occasion").on('click', function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $('#sort option:selected').val();
        var url = $('#url').val();
        $.ajax({
            url: url,
            method: "post",
            data: {
                fabric: fabric,
                sleeve: sleeve,
                pattern: pattern,
                fit: fit,
                occasion: occasion,
                sort: sort,
                url: url
            },
            success: function (data) {
                $('.filter_products').html(data);
            }
        });
    });

    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function () {
            filter.push($(this).val());
        });
        return filter;

    }

    /*product price change*/
    $('#getPrice').change(function () {
        var size = $(this).val();
        if (size == "") {
            alert('Please Select Size');
            return false;
        }
        var product_id = $(this).attr('product-id');
        $.ajax({
            url: '/get-product-price',
            data: {size: size, product_id: product_id},
            type: 'post',
            success: function (response) {
                if (response['discount'] > 0) {
                    $('.getAttrPrice').html("<del>Rs." + response['product_price'] + "</del> Rs." + response['final_price']);
                } else {
                    $('.getAttrPrice').html("Rs." + response['product_price']);
                }
            }, error: function () {
                alert("Error");
            }
        });
    });
    /*cart page cart qty update*/
    $(document).on('click', '.btnItemUpdate', function () {
        /*qty minus*/
        if ($(this).hasClass('qtyMinus')) {
            var quantity = $(this).prev().val();
            if (quantity <= 1) {
                alert("Item Quantity Must be 1 or Greater!")
                return false;
            } else {
                new_qty = parseInt(quantity) - 1;
            }
        }
        /*qty plus*/
        if ($(this).hasClass('qtyPlus')) {
            var quantity = $(this).prev().prev().val();
            new_qty = parseInt(quantity) + 1;
        }
        // alert(new_qty);
        var cartid = $(this).data('cartid');
        // alert(cartid);
        $.ajax({
            data: {"cartid": cartid, "qty": new_qty},
            url: '/update-cart-item-qty',
            type: 'post',
            success: function (response) {
                // alert(response.status);
                if (response.status == false) {
                    alert(response.message);
                }
                $(".totalCartItems").html(response.totalCartItems);
                $("#AppendCartItems").html(response.view);
            }, error: function () {
                alert("Error");
            }
        });
    });

    /*cart item delete*/
    $(document).on('click', '.btnItemDelete', function () {
        var cartid = $(this).data('cartid');
        var result = confirm('Want to delete this Cart Item ?');
        if (result) {
            $.ajax({
                data: {"cartid": cartid},
                url: '/delete-cart-item',
                type: 'post',
                success: function (response) {
                    $(".totalCartItems").html(response.totalCartItems);
                    $("#AppendCartItems").html(response.view);
                }, error: function () {
                    alert("Error");
                }
            });
        }
    });
    /*user registration form validation*/
    $("#registerForm").validate({
        rules: {
            name: "required",
            mobile: {
                required: true,
                minlength: 11,
                maxlength: 11,
                digits: true
            },
            email: {
                required: true,
                email: true,
                remote: "check-email"
            },
            password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            name: "Please enter your name",
            mobile: {
                required: "Please enter a Mobile",
                minlength: "Your mobile must 11 characters"
            },
            email: {
                required: "Please Enter you e-mail",
                email: "Please enter your valid e-mail",
                remote: "E-mail already exists"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long"
            }
        }
    });

    /*user registration form validation*/
    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            email: {
                required: "Please Enter you e-mail",
                email: "Please enter your valid e-mail",
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long"
            }
        }
    });
    /*forgot password validation*/
    $("#forgotPasswordForm").validate({
        rules: {
            email: {
                required: true,
                email: true,
            }
        },
        messages: {
            email: {
                required: "Please Enter you e-mail",
                email: "Please enter your valid e-mail",
            }
        }
    });
    /*account Form validation*/
    $("#accountForm").validate({
        rules: {
            name: "required",
            mobile: {
                required: true,
                minlength: 11,
                maxlength: 11,
                digits: true
            }
        },
        messages: {
            name: "Please enter your name",
            mobile: {
                required: "Please enter a Mobile",
                minlength: "Your mobile must 11 characters"
            }
        }
    });

    /*Password change Form validation*/
    $("#updatePasswordForm").validate({
        rules: {
            current_password: {
                required: true,
                minlength: 6,
                maxlength: 20
            }, new_password: {
                required: true,
                minlength: 6,
                maxlength: 20
            }, confirm_password: {
                required: true,
                minlength: 6,
                maxlength: 20,
                equalTo: "#new_password"
            },
        }
    });
    /*update user password*/
    $("#current_password").keyup(function () {
        var current_password = $(this).val();
        $.ajax({
            type: 'post',
            url: '/check-user-password',
            data: {current_password: current_password},
            success: function (response) {
                // alert(response);
                if (response == 'false') {
                    $('#checkPwd').html("<font color='red'>Wrong Password<font>");
                } else if (response == 'true') {
                    $('#checkPwd').html("<font color='green'>Correct Password<font>");
                }
            }, error: function () {
                alert("Error");
            }
        });
    })
    /*apply coupon*/
    $("#ApplyCoupon").submit(function () {
        var user = $(this).attr("user");
        if (user == 1) {

        } else {
            alert('Please Apply To login Coupon!');
            return false;
        }
        var code = $('#code').val();
        $.ajax({
            type: 'post',
            data: {code: code},
            url: '/apply-coupon',
            success: function (response) {
                if (response.messages != "") {
                    alert(response.message);
                }
                $(".totalCartItems").html(response.totalCartItems);
                $("#AppendCartItems").html(response.view);
                if (response.couponAmount >= 0) {
                    $(".couponAmount").text("Rs." + response.couponAmount);
                } else {
                    $(".couponAmount").text("Rs.0");
                }
                if (response.grand_total >= 0) {
                    $(".grand_total").text("Rs." + response.grand_total);
                }
            }, error: function () {
                alert("Error");
            }
        });

    });

});
