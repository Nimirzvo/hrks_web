/*-----------------------------------------------------------------------------------
/*
/* Custom JS
/*
-----------------------------------------------------------------------------------*/
	  
/* Start Document */
jQuery(document).ready(function() {
	
/* ---------------------------------------------------------------------- */
/* Loader
/* ---------------------------------------------------------------------- */		
            $(document).ready(function(){
                $(".fakeloader").fakeLoader({
                    timeToHide:1200,
                    bgColor:"#2183bd",
                    spinner:"spinner5"
                });
            });
	
/* ---------------------------------------------------------------------- */
/* Sticky Header
/* ---------------------------------------------------------------------- */	
      $('.header').semisticky({
        offsetLimit: $('.top').outerHeight(),
      })
	
/* ---------------------------------------------------------------------- */
/* Yamm Dropdown-menu
/* ---------------------------------------------------------------------- */	
      $(function() {
        window.prettyPrint && prettyPrint()
        $(document).on('click', '.yamm .dropdown-menu', function(e) {
          e.stopPropagation()
        })
      })

/* ---------------------------------------------------------------------- */
/* Owl Carousel
/* ---------------------------------------------------------------------- */	
    var owl = $("#owl-demo");
 
      $("#owl-demo").owlCarousel({
        autoPlay: false,
        items : 6,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
		pagination: false,
        slideSpeed : 600,
        rewindSpeed : 1000
      });
 
    // Custom Navigation Events
    $(".next").click(function(){
    owl.trigger('owl.next');
    })
    $(".prev").click(function(){
    owl.trigger('owl.prev');
    })
	
      $("#testimonial-carousel").owlCarousel({
        autoPlay: 4600,
        items : 1,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3]
      });			

/*----------------------------------------------------*/
/*	Camera Slider
/*----------------------------------------------------*/
		jQuery(function(){
			
			jQuery('#camera_wrap_1').camera({
	            height: '39%',
            	pagination: false,
				thumbnails: false,
				loader: 'none'
			});

		});
		
/*----------------------------------------------------*/
/*	Progress Bar
/*----------------------------------------------------*/
	jQuery('.progress_block .progress div').each(function() {
		var w = jQuery(this).attr('data-level');
		jQuery(this).animate({width : w + '%'}, 500);
	});

/* ---------------------------------------------------------------------- */
/* ISOTOPE FUNCTION - FILTER PORTFOLIO FUNCTION
/* ---------------------------------------------------------------------- */	

	$(window).load(function(){
		$portfolio = $('.portfolio-items');
		$portfolio.isotope({
			itemSelector : 'li',
			layoutMode : 'fitRows'
		});
		$portfolio_selectors = $('.portfolio-filter >li>a');
		$portfolio_selectors.on('click', function(){
			$portfolio_selectors.removeClass('active');
			$(this).addClass('active');
			var selector = $(this).attr('data-filter');
			$portfolio.isotope({ filter: selector });
			return false;
		});
	});	

/* ---------------------------------------------------------------------- */
/* Parallax Effect
/* ---------------------------------------------------------------------- */

	$('#intro').parallax("50%", 0.3);
	$('#intro_2').parallax("50%", 0.3);
	
/*----------------------------------------------------*/
/*	Google Map
/*----------------------------------------------------*/
					jQuery('#map_canvas').gMap({
						maptype: 'ROADMAP',
						scrollwheel: false,
						zoom: 18,
						markers: [
							{
								address: 'Sidney', // Your Adress Here
								html: '',
								popup: false,
							}
						],
					});

	
/* End Document */
});