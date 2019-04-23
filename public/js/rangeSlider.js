//RANGE price-range
var $range = $(".price-range"),
    instance,
    min = 1.5,
    max = 25;
	

$range.ionRangeSlider({
    grid: true,
	type: "single",
    min: min,
    max: max,
    from: 10,
	postfix: ' млн. р.',
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
	postfix: ' %'

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
	postfix: ' лет'
});

instance = $time.data("ionRangeSlider");



