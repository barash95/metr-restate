$(document).ready(function() {
  $('.btn-like').click(function(){
    var fav = Cookies.get('favorites');
    if (!fav){
      Cookies.set('favorites', $(this).attr('data-id'));
      $(this).addClass("add-favorites");
      if(!Cookies.get('favorites-com')){
      $('.like-span').text(1);
      }
    } else {
      var ids = fav.split(';');
      var nid = $(this).attr('data-id');
      var pos = ids.indexOf(nid);
      if (pos == -1){
        ids.push(nid);
        $(this).removeClass("add-favorites");
      }else{
        ids.splice(pos, 1);
        $(this).addClass("add-favorites");
      }
      $('.like-span').text(ids.length);
      Cookies.set('favorites', ids.join(';'));
    }
  });

  $('.like-com').click(function(){
    var fav_com = Cookies.get('favorites-com');
    if (!fav_com){
      Cookies.set('favorites-com', $(this).attr('data-id'));
      $(this).addClass("add-favorites");
      if(!Cookies.get('favorites')){
        //$('.like-span').text(1);
      }
    } else {
      var ids = fav_com.split(';');
      var nid = $(this).attr('data-id');
      var pos = ids.indexOf(nid);
      if (pos == -1){
        ids.push(nid);
        $(this).removeClass("add-favorites");
      }else{
        ids.splice(pos, 1);
        $(this).addClass("add-favorites");
      }
      //$('.like-span').text(ids.length);
      Cookies.set('favorites-com', ids.join(';'));
    }
  });

  var fav = Cookies.get('favorites');
  if (fav){
    var ids = fav.split(';');
    ids.forEach(function(id) {
      $('.btn-like[data-id='+id+']').addClass("add-favorites");
    });
    $('.like-span').text(ids.length);
  }

  var fav_com = Cookies.get('favorites-com');
  if (fav_com){
    var ids_com = fav_com.split(';');
    ids_com.forEach(function(id) {
      $('.like-com[data-id='+id+']').addClass("add-favorites");
    });
  }

 // $('.like-span').text(ids.length + ids_com.length);*/
});