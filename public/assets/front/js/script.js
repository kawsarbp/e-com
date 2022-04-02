$(document).ready(function () {
    /*sort*/
    $('#sort').on('change',function () {
        var sort = $(this).val();
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var url = $('#url').val();
        $.ajax({
            url:url,
            method:"post",
            data: {fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function (data) {
                $('.filter_products').html(data);
            }
        });
    });
    /*filter*/
    /*fabric*/
    $(".fabric").on('click',function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $('#sort option:selected').val();
        var url = $('#url').val();
        $.ajax({
            url:url,
            method:"post",
            data: {fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function (data) {
                $('.filter_products').html(data);
            }
        });
    });
    /*sleeve*/
    $(".sleeve").on('click',function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $('#sort option:selected').val();
        var url = $('#url').val();
        $.ajax({
            url:url,
            method:"post",
            data: {fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function (data) {
                $('.filter_products').html(data);
            }
        });
    });
    /*pattern*/
    $(".pattern").on('click',function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $('#sort option:selected').val();
        var url = $('#url').val();
        $.ajax({
            url:url,
            method:"post",
            data: {fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function (data) {
                $('.filter_products').html(data);
            }
        });
    });
    /*fit*/
    $(".fit").on('click',function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $('#sort option:selected').val();
        var url = $('#url').val();
        $.ajax({
            url:url,
            method:"post",
            data: {fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function (data) {
                $('.filter_products').html(data);
            }
        });
    });
    /*occasion*/
    $(".occasion").on('click',function () {
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattern = get_filter('pattern');
        var fit = get_filter('fit');
        var occasion = get_filter('occasion');
        var sort = $('#sort option:selected').val();
        var url = $('#url').val();
        $.ajax({
            url:url,
            method:"post",
            data: {fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
            success:function (data) {
                $('.filter_products').html(data);
            }
        });
    });

    function get_filter(class_name) {
        var filter = [];
        $('.'+class_name+':checked').each(function () {
            filter.push($(this).val());
        });
        return filter;

    }

});
