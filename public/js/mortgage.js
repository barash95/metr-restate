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
