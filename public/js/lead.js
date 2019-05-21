function callMe() {
    if ($("#phone").val() > '' && $('#name').val() > '') {
        console.log('lead in progress');
        $('#order-form-wrapper').show();
        $.ajax({
            type: "POST",
            url: "/orders/add",
            data: $('#order-form').serialize(),
            success: function (msg) {
                $('#order-form').html("<div class=\"alert alert-success\">Ваша заявка принята!<strong></div>");
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {

            }
        });
    };
}