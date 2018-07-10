/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *	// update the viewport, in case the window size has changed
 *	viewport = updateViewportDimensions();
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function


/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

  var $ = $;

  var latestNews = $(".latestNews")[0];
  if(latestNews){
    var latestNewsCloseButton = $(".latestNewsCloseButton")[0];
    latestNews.style.marginTop = "-" + latestNews.offsetHeight + "px";
    latestNewsCloseButton.addEventListener("click", function(){ 
      latestNews.style.marginTop = "-" + latestNews.offsetHeight + "px";
      latestNews.classList.toggle("show"); 
      latestNewsCloseButton.classList.toggle("show"); 
      if(latestNewsCloseButton.classList.contains("show")){
        latestNewsCloseButton.innerHTML = "hide";
      } else{
        window.setTimeout(function(){latestNewsCloseButton.innerHTML = "Latest News!";},300);
      }
    });
    if( $("body")[0].classList.contains("home") ){
      window.setTimeout(function(){
        if(!latestNews.classList.contains("stopAutoOpen")){
          latestNews.classList.add("show"); 
          latestNewsCloseButton.classList.add("show");

          if(latestNewsCloseButton.classList.contains("show")){
            latestNewsCloseButton.innerHTML = "hide";
          } else{
            window.setTimeout(function(){latestNewsCloseButton.innerHTML = "Latest News!";},300);
          }
        }
      }, 1500);
    }
  }


  if( $('#table_filters') ){
    var target_table_id = $('#table_filters').data('targetTable');
    if( target_table_id && $('#'+target_table_id) ){
      var $table = $('#'+target_table_id);
      $table.find('.empty_note').hide();


      var $filters = $('#table_filters').find('select');
      $filters.on("change", filter_options );
      var $checkboxes = $('#table_filters').find('input[type="checkbox"]');
      $checkboxes.on("change", filter_options );


      function filter_options(){
        var selector_string = "";
        $filters.each(function(){
          if( this.value && this.value !== '-1' )
            selector_string += "[data-"+this.id+"='"+this.value+"']";
        });
        $checkboxes.each(function(){
          if( this.checked )
            selector_string += "[data-"+this.id+"='true']";
        })
        $table.find('tr').hide();
        $table.find('.empty_note').hide();

        $to_show = $table.find('tr'+selector_string);
        if( $to_show.length > 0 )
          $table.find('tr'+selector_string).show();
        else
          $table.find('.empty_note').show();
      }
      var urlAnchor = window.location.hash.substr(1);
      if( $filters.find('option[value="'+urlAnchor+'"]')){
        $filters.find('option[value="'+urlAnchor+'"]').parent().val(urlAnchor);
      }
      filter_options();
    }
  }



  if( $('#contact_us_form') && AJAX_URL ){

    var is_sending = false;
    var failure_message = 'Error submitting inquiry. Please report bug to "Jack@CreativeCoding.com"';

    $('#contact_again').click(function(){
      $('.contact_form_wrapper').removeClass('sent');
    });

    $('#contact_us_form').submit(function (e) {
      if (is_sending || !validateInputs()) {
        return false;
      }
      e.preventDefault();
      var $this = $(this);

      var $target = $('#contact_us_form > select[name="target"]').val() || $('#contact_us_form > select[name="target"]').children()[0].value;
      var $additional_args = '';
      if( !$('#contact_us_form > select[name="target"]').val() ){
        $additional_args += '&target=' + $target + '&subject=none';
      } else{
        $additional_args += '&subject=' + encodeURIComponent($('#contact_us_form > select[name="target"] > option[selected]')[0].innerHTML);
      }
      $.ajax({
        url : AJAX_URL + "?" + $this.serialize() + $additional_args,
        type : 'post',
        data : { 'action' : 'send_contact_email' },
        beforeSend : function () {
          $('.contact_form_wrapper').addClass('sending');
          is_sending = true;
        },
        error : function(xhr) {
          handleFormError();
        },
        success : function (data) {
          $('.contact_form_wrapper').removeClass('sending');
          is_sending = false;
          if ( data && data.trim() && JSON.parse(data).status === 'success' ) {
            var old_name = $('input[name="name"]').val();
            var old_email = $('input[name="email"]').val();
            $('#contact_us_form')[0].reset();
            $('input[name="name"]').val(old_name);
            $('input[name="email"]').val(old_email);
            $('.contact_form_wrapper').addClass('sent');
          } else {
            handleFormError();
          }
        }
      });
    });
 
    function handleFormError () {
      $('.contact_form_wrapper').removeClass('sending');
      is_sending = false; // Reset the is_sending var so they can try again...
      alert(failure_message);
    }

    function validateInputs () {
      var $name = $('#contact_us_form > input[name="name"]').val();
      var $email = $('#contact_us_form > input[name="email"]').val();
      var $message = $('#contact_us_form > textarea[name="message"]').val();
      if (!$name || !$email || !$message) {
        alert('Before sending, please make sure to provide your name, email, and message.');
        return false;
      }
      return true;
    }

  }


  //navbar magic!
  /*
  var $nav_menu_items = $('#menu-mainnavigation > .menu-item');
  if( $nav_menu_items.length > 0 ){
    var spacer_pos_id = Math.floor( $nav_menu_items.length / 2 );
    $nav_menu_items.each(function(){
      $this = $(this);
      if( $nav_menu_items.index($this) < spacer_pos_id ){
      }else{
        $this.addClass('post_nav_magic_spacer_wrapper');
      }
    });
    $("#menu-mainnavigation > .menu-item:nth-child(" + (spacer_pos_id) + ")").after("<li class='magic_nav_spacer'></li>");
  }
  */

  if( $(window).scrollTop() < 5 ) {
    $('#container').removeClass("browsing");
  }
  else {
    $('#container').addClass("browsing");
  }

  $(window).scroll(function(){ 
    if( $(window).scrollTop() < 5 ) {
      $('#container').removeClass("browsing");
    }
    else {
      $('#container').addClass("browsing");
    }

  });

  /*
   * Let's fire off the gravatar function
   * You can remove this if you don't need it
  */
  loadGravatars();

  $(function() {
    $('a[href*="#"]:not([href="#"])').click(function() {
      var latestNews = $(".latestNews")[0];
      if(latestNews){
	      latestNews.classList.add('stopAutoOpen');
	      latestNews.classList.remove("show");
        latestNewsCloseButton.classList.remove("show");
	      window.setTimeout(function(){latestNewsCloseButton.innerHTML = "Latest News!";},300);
      }

      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          $('html, body').animate({
            scrollTop: target.offset().top
          }, 1000);
          return false;
        }
      }
    });
    $('.openNavButton').click(function() {
      $('.openNavButton').addClass("hide");
      $('.nav').addClass("show");
    });
  });


  var tryCopy = function(e){
    var clicked_element = e.target;
    if(!e.target)
      return false;
    var success = document.execCommand('copy');
    if(success){
      documant.getElementsByClassName("copy_textarea");
    }
  }




  //Mouse over detect for subnav

  $all_subnavs = $('.sub-menu');

  $all_subnavs.each(function(){
    $this = $(this);
    $this.mouseenter(function(){
      $this = $(this);
      $this.parent('.menu-item').addClass('hover');
    });
    $this.mouseleave(function(){
      $this = $(this);
      $this.parent('.menu-item').removeClass('hover');
    });
  });



}); /* end of as page load scripts */