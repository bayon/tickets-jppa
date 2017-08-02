// paginator.js works in conjuntion with the PHP Paginator.class.php and the pagination view.
function refresh(){
	$(location).attr('href',"<?php BASE_URL?>?c="+controller+"&m=paginate&page=1&limit=100&where=");
}

$('.th_link').click(function(){
     	var text;
    	text = this.id;
		var orderby =  " "+text+" ASC " ; 
		//exceptions
		if(text == 'likes' || text == 'date'){
			orderby =  " "+text+" DESC " ; 
		}
		$(location).attr('href',"<?php BASE_URL?>?c="+controller+"&m=paginate&page=1&limit=100&orderby="+orderby);
	});
$( ".th_link" ).mouseover(function() {
   console.log(this.id);
   $(this).addClass('paginator_highlight');
});
$( ".th_link" ).mouseout(function() {
   console.log(this.id);
   $(this).removeClass('paginator_highlight');
});

function panel_slide_in() {
		var options = {
			duration : 300,
			easing : 'easeInQuad'
		};
		$('.paginator_details_content').animate({
			left : '0%',
			opacity:1

		}, $.extend(true, {}, options, {
			complete : function() {
				console.log('callback complete');
				panelAnimationCallback();
			}
		}));
};
	
function panel_slide_out() {
		var options = {
			duration : 300,
			easing : 'easeOutQuad'
		};
		$('.paginator_details_content').animate({
			left : '-100%',
			opacity:1

		}, $.extend(true, {}, options, {
			complete : function() {
				console.log('callback complete');
				panelAnimationCallback();
			}
		}));
};

function panel_slide_in_right() {
		var options = {
			duration : 300,
			easing : 'easeInQuad'
		};
		$('.paginator_create_content').animate({
			left : '25%',
			opacity:1

		}, $.extend(true, {}, options, {
			complete : function() {
				console.log('callback complete');
				panelAnimationCallback();
			}
		}));
};
	
function panel_slide_out_right() {
		var options = {
			duration : 300,
			easing : 'easeOutQuad'
		};
		$('.paginator_create_content').animate({
			left : '100%',
			opacity:1

		}, $.extend(true, {}, options, {
			complete : function() {
				console.log('callback complete');
				panelAnimationCallback();
			}
		}));
};
	
function panelAnimationCallback() {
		console.log('panel animationCallback ');
		//panelStatus = -panelStatus;
}