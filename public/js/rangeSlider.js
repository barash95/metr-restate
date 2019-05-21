//RANGE price-range
var $range = $(".price-range"),
    instance,
    min = 1,
    max = 25;
	

$range.ionRangeSlider({
    grid: true,
	type: "single",
    min: min,
    max: max,
    from: $('#cost')[0].innerText/1000000,
	postfix: ' млн. р.',
    onChange: function (obj) {
        getTotal();
    },
});

instance = $range.data("ionRangeSlider");




//RANGE payment-range
var $payment = $(".payment-range"),
    instance,
    min = 10,
    max = 95;

$payment.ionRangeSlider({
    grid: true,
	type: "single",
    min: min,
    max: max,
    from: 30,
	postfix: ' %',
    onChange: function (obj) {
        getTotal();
    },

});

instance = $payment.data("ionRangeSlider");


//RANGE payment-range
var $time = $(".time-range"),
    instance,
    min = 5,
    max = 30;

$time.ionRangeSlider({
    grid: true,
	type: "single",
    min: min,
    max: max,
    from: 15,
	postfix: ' лет',
    onChange: function (obj) {
        getTotal();
    },
});

instance = $time.data("ionRangeSlider");


function changePercent(pr) {
    $('#percent')[0].textContent = pr;
    getTotal();
}

$(document).ready(function () {
    changePercent($('#percent').text().replace(/,/, '.'));
})

function getTotal() {
    cost = $range.val() * 1000000 * ((100 - $payment.val()) / 100);
    percent = $('#percent').text().replace(/,/, '.');
    total = (cost + (cost * percent / 100) * $time.val()) / ($time.val() * 12);
    $('#total')[0].textContent = Math.ceil(total);
}

