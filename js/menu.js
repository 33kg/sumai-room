jquery(function(){
	var $menu = $('#slide_menu'), // スライドインするメニューを指定
	$menuBtn = $('#button,.closeBtn'), // トリガーとなるボタンを指定
	$wrap = $('#container'),
    menuWidth = $menu.outerWidth();

    $menuBtn.on('click', function(){
    $wrap.toggleClass('open');
        if($wrap.hasClass('open')){
            $wrap.animate({'left' : menuWidth }, 300);
            $menu.animate({'left' : 0 }, 300);                    
        } else {
            $wrap.animate({'left' : 0 }, 300);
            $menu.animate({'left' : -menuWidth }, 300);      
        }
    });


    $('#btn-1').click(function() { $('#pref-1').toggle();  })

}); 