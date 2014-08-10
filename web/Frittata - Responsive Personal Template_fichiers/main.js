var items;

function validate_email(email)
{
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}


function init_map()
{
	var mapOptions = {
		zoom: 15,
		streetViewControl: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
		center: new google.maps.LatLng(-37.81261128155935,144.96260404586792) // Replace these coordinates with yours
  }
  var map = new google.maps.Map(document.getElementById('map'), mapOptions);
  var image = 'images/gmap_default.png';
  var myLatLng = new google.maps.LatLng(-37.81261128155935,144.96260404586792); // Replace these coordinates with yours
  var beachMarker = new google.maps.Marker({
  	map: map,
  	position: myLatLng
  });
}


function load_map()
{
 	var script = document.createElement("script");
 	script.type = "text/javascript";
 	script.src = "https://maps.googleapis.com/maps/api/js?sensor=false&callback=init_map";
 	document.body.appendChild(script);
}


$(function()
{
	/**/
	/* portfolio slideshow */
	/**/
	$(document).on('click', '.item-portfolio .next, .item-portfolio-details .next', function()
	{
		active = $(this).siblings('div').find('.active');
		if( active.next('img').length )
			active.next().addClass('active').siblings().removeClass('active');
		else
			active.siblings('img:first-child').addClass('active').siblings().removeClass('active');
	})
	
	$(document).on('click', '.item-portfolio .prev, .item-portfolio-details .prev', function()
	{
		active = $(this).siblings('div').find('.active');
		if( active.prev('img').length )
			active.prev().addClass('active').siblings().removeClass('active');
		else
			active.siblings('img:last-child').addClass('active').siblings().removeClass('active');
	});
	
	
	/**/
	/* email item */
	/**/
	$('#item-email i').on('click', function()
	{
		$('#item-email').addClass('active');
		$('#item-email [name="name"]').focus();
	});
	
	$('#item-email button[type="button"]').on('click', function()
	{
		$('#item-email').removeClass('active');
	});
	
	$('#item-email form').on('submit', function()
	{
		if( $('#item-email button').text() == 'Ok' )
		{
			$('#item-email').removeClass('active');
		}
		else
		{
			if( $('#item-email input[name="name"]').val() == '' )
			{
				$('#item-email input[name="name"]').focus();
				$('#item-email .error').text('You must enter your name!');
				return false;
			}
			if( $('#item-email input[name="email"]').val() == '' )
			{
				$('#item-email input[name="email"]').focus();
				$('#item-email .error').text('You must enter your email!');
				return false;
			}
			if( !validate_email($('#item-email input[name="email"]').val()) )
			{
				$('#item-email input[name="email"]').focus();
				$('#item-email .error').text('You must enter valid email!');
				return false;
			}
			if( $('#item-email [name="message"]').val() == '' )
			{
				$('#item-email [name="message"]').focus();
				$('#item-email .error').text('You must enter message!');
				return false;
			}
			
			$.ajax(
			{
				url: 'email.php',
				type: 'POST',
				data: { name: $('#item-email [name="name"]').val(), from: $('#item-email [name="email"]').val(), message: $('#item-email [name="message"]').val() }
			}).done(function()
			{
				$('#item-email .error').text('');
				$('#item-email button[type="submit"]').hide();
				$('#item-email .success').text('Your message sent!');
				$('#item-email input, #item-email textarea').attr('readonly', true);
			});			
		}
		
		return false;		
	});
	
	/**/
	/* map item */
	/**/
	$('#item-map i').on('click', function()
	{
		$('#item-map').addClass('active');
	});
	$('#item-map span').on('click', function()
	{
		$('#item-map').removeClass('active');
	});
});


$(window).load(function()
{
	/**/
	/* isotope */
	/**/
	items = $('.page');
	items.isotope({
		itemSelector : '.item',
		masonry: {columnWidth: 240},
		filter: '.item-visible, .item-avatar, .item-nav, .item-wellcome',
		getSortData: { sort: function($elem) {return parseInt( $elem.data('sort') || 4 );} },    
		sortBy: 'sort'
	});
	$(window).bind('hashchange', function(event)
	{
		var hashOptions = window.location.hash ? $.deparam.fragment(window.location.hash, true) : {};
		var id = hashOptions['id'] || 0;
		var page = hashOptions['page'] || 'home';
		var filter = '.item-visible';
		
		if( hashOptions['page'] )
			page = hashOptions['page'];
		
		$('#item-nav a[href="#page=' + page + '"]').addClass('active').parent().siblings().find('a').removeClass('active');
		
		if( page == 'home' )
		{
			 filter = '.item-visible';
		}
		else if( page == 'skills' )
		{
			 filter = '.item-skill';
		}
		else if( page == 'portfolio' )
		{
			 filter = '.item-portfolio';
			 if( id )
			 {
			 	filter = '#item-portfolio' + id;
			 	elem = $(filter);
			 	console.log(elem);
			 	if( elem.prevAll('.item-portfolio-details').length )
			 	{
			 		id = elem.prevAll('.item-portfolio-details').eq(0).attr('id');
			 		$('#item-next').attr('href', '#page=portfolio&id=' + id.substr(14));
			 		filter += ', #item-next';
			 	}
			 	if( elem.nextAll('.item-portfolio-details').length )
			 	{
			 		id = elem.nextAll('.item-portfolio-details').eq(0).attr('id');
			 		$('#item-prev').attr('href', '#page=portfolio&id=' + id.substr(14));
			 		filter += ', #item-prev';
			 	}
			 	filter += ', #item-back-portfolio';
			 }
		}
		else if( page == 'reviews' )
		{
			 filter = '.item-review';
		}
		else if( page == 'blog' )
		{
			 filter = '.item-post';
			 if( id )
			 {
			 	filter = '#item-post' + id;
			 	elem = $(filter);
			 	if( elem.prevAll('.item-post-details').length )
			 	{
			 		id = elem.prevAll('.item-post-details').eq(0).attr('id');
			 		$('#item-newer').attr('href', '#page=blog&id=' + id.substr(9));
			 		filter += ', #item-newer';
			 	}
			 	if( elem.nextAll('.item-post-details').length )
			 	{
			 		id = elem.nextAll('.item-post-details').eq(0).attr('id');
			 		$('#item-older').attr('href', '#page=blog&id=' + id.substr(9));
			 		filter += ', #item-older';
			 	}
			 	filter += ', #item-back-blog';
			 }
		}
		else if( page == 'contacts' )
		{
			 filter = '.item-social';
		}
		
		items.isotope({
			filter: '.item-avatar, .item-nav, .item-wellcome, ' + filter
		});
	}).trigger('hashchange');	
	
	
	/**/
	/* load more */
	/**/
	$('#load-more-works').on('click', function()
	{
		page = $(this).data('page');
		loader = $('#load-more-works');
			
		if( !page )
			return false;
		
		$.get('ajax/portfolio-page' + page + '.html').done(function(data)
		{
			items.isotope('insert', $(data));
			loader.data('page', ++page);
			
			$.get('ajax/portfolio-page' + page + '.html').fail(function()
			{
				loader.removeClass('item-portfolio');
				$(window).trigger('hashchange');
			});
		}).fail(function()
		{
			loader.removeClass('item-portfolio');
			$(window).trigger('hashchange');
		});
		
		return false;
	});	
	
	$('#load-more-posts').on('click', function()
	{
		page = $(this).data('page');
		loader = $('#load-more-posts');
			
		if( !page )
			return false;
		
		$.get('ajax/blog-page' + page + '.html?a').done(function(data)
		{
			items.isotope('insert', $(data));
			loader.data('page', ++page);
			
			$.get('ajax/blog-page' + page + '.html').fail(function()
			{
				loader.removeClass('item-post');
				$(window).trigger('hashchange');
			});
		}).fail(function()
		{
			loader.removeClass('item-post');
			$(window).trigger('hashchange');
		});
		
		return false;
	});
	
	
	/**/
	/* loader */
	/**/
	$('#loader').fadeOut('fast', function()
	{
		$('#bg').fadeIn('fast');
		$('#page').addClass('loaded');
	});
	
	
	/**/
	/* map */
	/**/
	load_map();
	
	
	/**/
	/* images load */
	/**/
	$('img').each(function()
	{
		if( $(this).data('src') )
			$(this).attr('src', $(this).data('src'));
	});
});