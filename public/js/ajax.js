var link = {
    '/favorites' : 'inside-page',
    '/contacts' : 'inside-page',
    '/about' : 'inside-page',
    '/flat/view/' : 'header-smoll product_header',
    '/flat' : 'inside-page choce-p',
    '/commertial' : 'inside-page choce-p',
    '/map' : 'inside-page',
    '/complex/view/' : 'header-smoll',
    '/commertial/view/' : 'header-smoll product_header',
};
var header = {
    '/favorites' : 'favorites',
    '/contacts' : 'contact',
    '/about' : 'about',
    '/flat/view/' : 'flat_view',
    '/flat' : 'flat_index',
    '/commertial' : 'com_index',
    '/map' : 'map',
    '/complex/view/' : 'complex_view',
    '/complex' : 'complex_index',
    '/commertial/view/' : 'com_view',
}


function getAjax(url) {
    $.get("/"+url, {
        ajax: true,
    }, function (data) {
        $('#main').removeClass();
        $('#main').addClass(link[url]);
        $('#ajax_cont').html(data);
        var stateObj = { foo: "bar" };
        history.pushState(stateObj, "page 2", "contacts");
    });
}