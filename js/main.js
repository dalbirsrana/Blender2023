
// const observer = new IntersectionObserver( (entries) => {
//   entries.forEach( (entry) => {

//     if (entry.isIntersecting) {
//       entry.target.classList.add('show');
//     } else {
//       // entry.target.classList.remove('show');
//     }
//   }); 
// });

// const hiddenEls = document.querySelectorAll('.hidden');
// hiddenEls.forEach( function (el) {
//   return observer.observe(el);
// } );

jQuery(document).ready(function($){

  var windowHeight = $(window).height();
  var windowScrollPosTop = $(window).scrollTop();
  var windowScrollPosBottom = windowHeight + windowScrollPosTop; 

  $.fn.revealOnScroll = function(buffer=0) {
    return this.each(function(){
      var objectOffset = $(this).offset();
      var objectOffsetTop = objectOffset.top + buffer;
      if (! $(this).hasClass("show")) {
        if (windowScrollPosBottom > objectOffsetTop) {
          $(this).addClass("show");
        }
      }  
    });
  }
  // To Reveal Hero transition on load
  $(".hidden").revealOnScroll();
  $(window).scroll(function() {
    windowHeight = $(window).height();
    windowScrollPosTop = $(window).scrollTop();
    windowScrollPosBottom = windowHeight + windowScrollPosTop;
    var buffer = 120;
    $(".hidden").revealOnScroll(buffer);
  });



  //Trigger Sticky Header and Table resize on window resize and scroll
  $(window).on('resize scroll', function(){
    stickyHeader(); 
    tableSize();
  });

  // STICKY HEADER
  // var $scrollCheck = 0;
  var stickyHeader = function(){
    var $scrollTop = $(window).scrollTop();
    if ($scrollTop >= 30) {
      $('#masthead').addClass('sticky');
      // $scrollCheck = $scrollTop;      
    } else {
      $('#masthead').removeClass('sticky'); 
      // $scrollCheck = $scrollTop; 
    }
  }
  stickyHeader();

  // MOBILE TABLE FIX
  var tableFix = function(){
    $('table').each(function(){
      if(!$(this).hasClass('nofix')){
        $(this).wrap("<div class='table-overflow'></div>");
        $(this).parent().after('<div class="arrow">Scroll to view </div>');
      }
    });
  }
  tableFix();
  var tableSize = function(){   
    $('div.table-overflow').each(function(){
      var $width = $(this).width();
      var $scrollWidth = this.scrollWidth - 1;
      if ($scrollWidth > $width) {
        $(this).addClass('show');
      } else {
        $(this).removeClass('show');
      }
    });
  }
  tableSize();



  // ACCORDION 
  (function(){
    $('.accordion .title').on('click touch', function(){
      var panel = $(this).parent();

      if ( panel.attr( "aria-expanded" ) !== "true" ) {
        panel.attr( "aria-expanded", "true" );
        $(this).siblings('.content').slideDown();
      } else {
        panel.attr( "aria-expanded", "false" );
        $(this).siblings('.content').slideUp();
      }
    });
  })();




  $('form.signup-form').on('click touch', function(){
    $('.grecaptcha-badge').addClass('show');
  });

    $("form.signup-form").submit ( function(e) {

        e.preventDefault();
        var $message = $(this).next('.signup-message'); // Variable for selecting appropriate signup message
        $message.empty().hide();
      
        var $this = $(this);
      
        grecaptcha.ready(function() {                                                  // Call the V3 Recaptcha system
          grecaptcha.execute($recaptcha_site_key, {action: 'submit'}).then(function(token) {
            
            document.getElementById('recaptchaResponse1').value = token; // Call this on hidden recpatcha element in the form

            // Add the below for each unique recaptcha element you have
            var recaptchaResponse2 = document.getElementById('recaptchaResponse2') || {};
            if (recaptchaResponse2) recaptchaResponse2.value = token;
      
            // ORIGINAL AJAX CODE GOES HERE      
            var $form = $this,
                formData = $form.serialize(),
                formUrl = $form.attr('action'),
                formMethod = $form.attr('method');

                formData += '&action=set_form';
   
            $.ajax({
              url: cpm_object.ajax_url,
              type: formMethod,
              dataType: 'json',
              data: formData,
              success: function(data){ 

                if (typeof data === 'string') {
                  data = jQuery.parseJSON(data);
                }               

                switch(data.SUCCESS){
                case 'false':
                  $form.show();
                  $message.empty().hide().fadeIn('slow').append(data.CONFIRMATION);
                  break;
                case 'true':
                  $form.hide();
                  $('.grecaptcha-badge').removeClass('show');
                  $message.empty().hide().fadeIn('slow').append(data.CONFIRMATION);
                  break;
                }
              },
              error: function (data) {
                  console.log("error");
              }

            });
          });
        });
      return false;
      });



  //MOBILE MENU
  $('.menu-button-container').on('click touch', function(e){
    e.stopPropagation();

    if ( $('#menu-toggle').prop('checked') ) {
      $('#masthead').removeClass('open');
      $(this).siblings('#menu-toggle').attr("aria-expanded","false");
    } else{
      $('#masthead').addClass('open');
      $(this).siblings('#menu-toggle').attr("aria-expanded","true");
    }

  });


  $('.main-menu .menu-item-has-children > a').on('click touch', function(e) {

    if ( $('.main-navigation .menu-button-container').css('display') != 'none') {
      e.preventDefault();

      if($(this).parent('.menu-item-has-children').hasClass("active")) {
        $('.menu-item-has-children').removeClass('active').children('ul').slideUp(300);
      } else {
        $('.menu-item-has-children').removeClass('active').children('ul').slideUp(300);
        $(this).parent('.menu-item-has-children').addClass('active');
        $(this).siblings('ul').slideDown(300);
      }
    }
  });
  //hidding mobile menu on Hash update or no link change
  $('header .sub-menu a').on('click touch', function() {
    $(this).parents('.menu-item-has-children').removeClass('active');
    $('#menu-toggle').prop('checked', false);
  });



  // Tiny Slider initialization on Home page: Portfolio section
  if ( $("#slider-discover").length > 0 ) {
    var slider = tns({
      container: '#slider-discover',
      slideBy: 'page',
      autoplay: true,
      autoplayTimeout: 9000,
      autoplayButtonOutput: false,
      // autoplayHoverPause: true,
      controls: true,
      controlsPosition: "bottom",
      controlsText: [" ", " "],
      preventScrollOnTouch: 'force',
      nav: true,
      mouseDrag: true,
      loop: true,
      items: 1,
      navContainer: "#slider-discover-links"
    });

  }


  // Tiny Slider initialization on Community page:  Property Images
  if ( $("#slider_property_pictures").length > 0 ) {

    var slider_2 = tns({
      container: '#slider_property_pictures',
      slideBy: 'page',
      autoplay: false,
      controls: false,
      nav: false,
      items: 1,
      preventScrollOnTouch: 'force',
      responsive: {
        768: {
          // disable slider on large viewport
          disable: true
        }
      }
    });

    slider_2.events.on('transitionEnd', function(info) {
      $('#property_pictures_counter span').text(info.displayIndex);
    });

  }



   // Tiny Slider initialization on Careers page: Testimonials
   if ( $("#slider_testimonials").length > 0 ) {
    var slider_3 = tns({
      container: '#slider_testimonials',
      slideBy: 'page',
      autoplay: false,
      controls: false,
      nav: true,
      navPosition: 'bottom',
      items: 1,
      preventScrollOnTouch: 'force'
    });
  }



  //Fancybox event handler
  Fancybox.bind(document.getElementById("gallery_wrap"), "[data-fancybox]", { });


});









( function(){
	// MODAL
	const openSearch = document.querySelector(".popup-link");
	const closeSearch = document.querySelector("#search-popup .close");
	const dialog = document.querySelector("#search-popup");

	function openCheck(dialog) {
		if (dialog.open) {
			console.log("Dialog open");
		} else {
			console.log("Dialog closed");
		}
	}

	  openSearch.addEventListener('click', function (e) {
		e.preventDefault();
		openCheck(dialog);
		dialog.showModal();
		
	  });
	  closeSearch.addEventListener("click", () => {
		dialog.close();
		openCheck(dialog);
	  });

} )();


  