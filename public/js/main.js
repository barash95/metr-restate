//load
$(window).on('load', function () {
	$preloader = $('#loader'),
	  $loader = $preloader.find('#cube-loader');
	$loader.fadeOut();
	$preloader.delay(350).fadeOut('slow');
	$('body').removeClass('js-loading');
});



//scroll	
$(document).ready(function(){
    $("#scroll-a").on("click", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top + 40}, 500);
    });
});


/*MENU*/
$(document).on("ready", function () {
    $("#menu-main .cd-nav-trigger").click(function () {
        $("#menu-main").toggleClass("menu-open");
		$(".nav-bar").toggleClass("open-menu");
		$('#menu-main .bar').toggleClass('animate');
		$("body").toggleClass("open-menu");
    });
	
});



$(document).scroll(function () {
	var WinTop = $(window).scrollTop();
	var docHeight = $(window).height();

	$('.fadeEl').each(function () {
		var topIn = $(this).offset().top -docHeight * 0.80 ; 
		if (WinTop > topIn) {
			$(this).addClass('anim');
		}
	});
	
	$('.js-animation').each(function () {
		var topIn = $(this).offset().top -docHeight * 0.80 ; 
		if (WinTop > topIn) {
			$(this).addClass('start-animation');
		}
	});
});


$(document).ready(function(){
	$(".select .select_header").click(function(){
		$(".select").removeClass('open');
		$(this).parent().addClass('open');
		$(".open .select_body").slideToggle();
		
		$(".open .select_body li").click(function(){
			$('.open .select_header span').text($(this).text());
			
			
			var selectcla=$(this).attr( 'id' );
			$('#select-1').removeClass();
			$('#select-2').removeClass();
			$('#select-3').removeClass();
			$('#select-1').addClass(selectcla);
			$('#select-2').addClass(selectcla);
			$('#select-3').addClass(selectcla);
			
			
			$(".open .select_body").slideUp();
			$(".select").removeClass('open');
			
			
		});
	});		
})

$(document).ready(function(){
	$(".product_block .favorites").click(function(){
		$(this).toggleClass('add-favorites');
	})
})


//modal
$('.modal-block').on('click', function(){
	var	id =  this.id;
  $(".modal[data-id='#"+id+"']").toggleClass('open');
  $(".modal-ov").show("slow");
  $("body").addClass("open-hidden");
  
});

$(".close").click(function () {
	$(".modal-content").addClass('zoom');
	$(".modal-content.zoom").css({'transform':'translateY(-100%)'});
	$(".modal-ov").hide("slow");
	$("#profit-calculator .sel-tree").removeClass('none');
	function func() {
		$(".modal").removeClass("open");
		$("body").removeClass("open-hidden");
		$(".modal-content").removeClass('zoom');
		$(".modal-content").css({'transform':'translateY(0)'});
	}
	setTimeout(func, 300);
	
});