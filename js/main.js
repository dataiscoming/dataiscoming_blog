/*-----------------------------------------------------------------------------------
/*
/* Main JS
/*
-----------------------------------------------------------------------------------*/  

(function($) {

	/*---------------------------------------------------- */
	/* Preloader
	------------------------------------------------------ */ 
  	$(window).load(function() {

   	// will first fade out the loading animation 
    	$("#status").fadeOut("slow"); 

    	// will fade out the whole DIV that covers the website. 
    	$("#preloader").delay(500).fadeOut("slow").remove();      

  	}) 

  	/*----------------------------------------------------*/
  	/* Backstretch
  	/*----------------------------------------------------*/

  	if($("html").hasClass('ie8')) {
  		$("#hero").backstretch("images/hero-bg.jpg");  	
  		$("#page-title").backstretch("images/hero-bg.jpg");	
  	} 

   /*----------------------------------------------------*/
  	/* FitText Settings
  	------------------------------------------------------ */
  	setTimeout(function() {

   	$('#page-title h1').fitText(1, { minFontSize: '38px', maxFontSize: '54px' });

  	}, 100);


	/*----------------------------------------------------*/
	/* Adjust Primary Navigation Background Opacity
	------------------------------------------------------*/
   $(window).on('scroll', function() {

		var h = $('header').height();
		var y = $(window).scrollTop();
      var header = $('#main-header');

	   if ((y > h + 30 ) && ($(window).outerWidth() > 768 ) ) {
	      header.addClass('opaque');
	   }
      else {
         if (y < h + 30) {
            header.removeClass('opaque');
         }
         else {
            header.addClass('opaque');
         }
      }

	});

   /*-----------------------------------------------------*/
	/* Alert Boxes
  	-------------------------------------------------------*/
	$('.alert-box').on('click', '.close', function() {
	  $(this).parent().fadeOut(500);
	});	


   /*-----------------------------------------------------*/
  	/* Mobile Menu
   ------------------------------------------------------ */  
   var menu_icon = $("<span class='menu-icon'></span>");
  	var toggle_button = $("<a>", {                         
                        id: "toggle-btn", 
                        html : "<span class='menu-text'>Menu</span>",
                        title: "Menu",
                        href : "#" } 
                        );
  	var nav_wrap = $('nav#nav-wrap')
  	var nav = $("ul#nav");  
   
   /* if JS is enabled, remove the two a.mobile-btns 
  	and dynamically prepend a.toggle-btn to #nav-wrap */
  	nav_wrap.find('a.mobile-btn').remove(); 
  	toggle_button.append(menu_icon); 
   nav_wrap.prepend(toggle_button); 

  	toggle_button.on("click", function(e) {
   	e.preventDefault();
    	nav.slideToggle("fast");     
  	});

  	if (toggle_button.is(':visible')) nav.addClass('mobile');
  	$(window).resize(function() {
   	if (toggle_button.is(':visible')) nav.addClass('mobile');
    	else nav.removeClass('mobile');
  	});

  	$('ul#nav li a').on("click", function() {      
   	if (nav.hasClass('mobile')) nav.fadeOut('fast');      
  	});


  	/*----------------------------------------------------*/
  	/* Smooth Scrolling and  Highlight the current section in the navigation bar
  	------------------------------------------------------ */

	function checkActiveSection()
	{
		var fromTop = jQuery(window).scrollTop() ;
		jQuery('.section').each(function(){
			var sectionOffset = jQuery(this).offset() ;
			if ( sectionOffset.top <= fromTop )
			{
				jQuery('#nav-wrap li').removeClass('current') ;
				jQuery('#nav-wrap li[data-id="'+jQuery(this).data('id')+'"]').addClass('current') ;
            
			}
		}) ;
	}

	jQuery(window).scroll(checkActiveSection) ;
	jQuery(document).ready(checkActiveSection) ;
	jQuery('#nav-wrap li a').click(function(e){
		var idSectionGoto = jQuery(this).closest('li').data('id') ;
		$('html, body').stop().animate({
		scrollTop: jQuery('.section[data-id="'+idSectionGoto+'"]').offset().top
		}, 300,function(){
			checkActiveSection() ;
		});
		e.preventDefault() ;
	}) ;

   /*----------------------------------------------------*/
  	/* Flexslider
  	/*----------------------------------------------------*/
  	$(window).load(function() {  		

	  	$('#hero-slider').flexslider({
	   	namespace: "flex-",
	      controlsContainer: ".flex-container",
	      animation: 'fade',
	      controlNav: true,
	      directionNav: false,
	      smoothHeight: true,
	      slideshowSpeed: 7000,
	      animationSpeed: 600,
	      randomize: false
	   });	   

   });

 
	/*----------------------------------------------------*/
	/*	contact form
	------------------------------------------------------*/

   $('form#contactForm button.submit').on('click', function() {

      $('#image-loader').fadeIn();

      var contactFname = $('#contactForm #contactFname').val();
      var contactLname = $('#contactForm #contactLname').val();
      var contactEmail = $('#contactForm #contactEmail').val();
      var contactSubject = $('#contactForm #contactSubject').val();
      var contactMessage = $('#contactForm #contactMessage').val();

      var data = 'contactFname=' + contactFname  + '&contactLname=' + contactLname + 
                 '&contactEmail=' + contactEmail + '&contactSubject=' + contactSubject + 
                 '&contactMessage=' + contactMessage;

      $.ajax({

	      type: "POST",
	      url: "inc/sendEmail.php",
	      data: data,
	      success: function(msg) {

            // Message was sent
            if (msg == 'OK') {
               $('#image-loader').fadeOut();
               $('#message-warning').hide();
               $('#contactForm').fadeOut();
               $('#message-success').fadeIn();   
            }
            // There was an error
            else {
               $('#image-loader').fadeOut();
               $('#message-warning').html(msg);
	            $('#message-warning').fadeIn();
            }

	      }

      });
      return false;
   });


	/*-----------------------------------------------------*/
  	/* Back to top
   ------------------------------------------------------ */ 
	var pxShow = 300; // height on which the button will show
	var fadeInTime = 400; // how slow/fast you want the button to show
	var fadeOutTime = 400; // how slow/fast you want the button to hide
	var scrollSpeed = 300; // how slow/fast you want the button to scroll to top. can be a value, 'slow', 'normal' or 'fast'

   // Show or hide the sticky footer button
	jQuery(window).scroll(function() {

		if (jQuery(window).scrollTop() >= pxShow) {
			jQuery("#go-top").fadeIn(fadeInTime);
		} else {
			jQuery("#go-top").fadeOut(fadeOutTime);
		}

	}); 


})(jQuery);