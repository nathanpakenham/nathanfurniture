$(document).ready(function() {
    $(".product__thumbnail").on("click", function () {
        var parent = $(this).data('parent');
        $(".product__image").hide();
        $('.product__image[data-id="' + parent + '"]').show();
    });

    $(".product__tablink").on('click', function () {
        link = $(this).data('link');
        $('.tabactive').removeClass('tabactive');
        $(this).addClass('tabactive')
        $('.product__tabcontent').hide();
        $("#"+link).show();
    });
});

function getVariant()
{
    $("#variant").val('');

    var q = $("#quantity").val();
    var p = $("#prodid").val();
    var params = 'p=' + encodeURIComponent(p);

    if (q > 1) {
        params += '&q=' + encodeURIComponent(q);
    }

    for (var i = 1; i <= 3; i++) {
        v = '';
        if ($("[name=variant"+i+"]").prop("type") == "radio") {
            v = $("input:radio[name=variant"+i+"]:checked").val();
        }

        if ($("[name=variant"+i+"]").is("select")) {
            v = $("[name=variant"+i+"] :selected").val();
        }

        if (v) {
            params += '&v' + i + '=' + encodeURIComponent(v);
        }
    }

    $.ajax({
        url: '/ajax/getvariant',
        method: 'GET',
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        data: params,
        dataType: 'json'
    }).done(function (data) {
        $("#variant1").html(data.variant1);
        $("#variant2").html(data.variant2);
        $("#variant3").html(data.variant3);
        $("#varianttext").html(data.varianttext);
        $("#stockmessage").html(data.stockmessage);
        $("#prodid").val(data.prodid);
        $("#variant").val(data.code);
    });
}
