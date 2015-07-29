/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
        $('#mainNavigation').on('show.bs.collapse', function () {
          // When Main Navigation toggle switch is clicked
          var $header = $('#mainHeader');
          $header.addClass('menu-visible');
          $('body').addClass('noscroll');
          $header.find('.mainNavigation-toggle').removeClass('glyphicon-menu-hamburger').addClass('glyphicon-remove');
        });

        $('#mainNavigation').on('hidden.bs.collapse', function () {
          // When Main Navigation is completely collapsed
          var $header = $('#mainHeader');
          $header.removeClass('menu-visible');
          $('body').removeClass('noscroll');
          $header.find('.mainNavigation-toggle').removeClass('glyphicon-remove').addClass('glyphicon-menu-hamburger');
        });
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
        $('.acf-map').each(function(){
      		render_map( $(this) );
      	});
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
        $(window).scroll(function(){
          var scroll = $(window).scrollTop();

          if(scroll >= 162) {
            $('body').removeClass('home').addClass('home-scrolled');
          } else {
            $('body').removeClass('home-scrolled').addClass('home');
          }
        });
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  function lightenDarkenColor(col, amt) {

    var usePound = false;

    if (col[0] === "#") {
      col = col.slice(1);
      usePound = true;
    }

    var num = parseInt(col,16);

    var r = (num >> 16) + amt;

    if (r > 255) {
      r = 255;
    } else if (r < 0) {
      r = 0;
    }

    var b = ((num >> 8) & 0x00FF) + amt;

    if (b > 255) {
      b = 255;
    } else if (b < 0) {
      b = 0;
    }

    var g = (num & 0x0000FF) + amt;

    if (g > 255) {
      g = 255;
    } else if (g < 0) {
      g = 0;
    }

    return (usePound?"#":"") + (g | (b << 8) | (r << 16)).toString(16);

  }


  /*
  *  render_map
  *
  *  This function will render a Google Map onto the selected jQuery element
  *
  *  @type	function
  *  @date	8/11/2013
  *  @since	4.3.0
  *
  *  @param	$el (jQuery element)
  *  @return	n/a
  */

  function render_map( $el ) {

  	// var
  	var $markers = $el.find('.marker');

  	// vars
  	var args = {
  		zoom		: 15,
  		center		: new google.maps.LatLng(0, 0),
  		mapTypeId	: google.maps.MapTypeId.ROADMAP
  	};

  	// create map
  	var map = new google.maps.Map( $el[0], args);

  	// add a markers reference
  	map.markers = [];
    // add an infowindows reference
    map.infowindows = [];

  	// add markers
  	$markers.each(function(){
    	add_marker( $(this), map );
  	});

  	// center map
  	center_map( map );

    //map.markers
    google.maps.event.addListener(map, "click", function(event) {
      close_infowindows( map );
    });

    var mcOptions = {gridSize: 30, maxZoom: 9};
    var markerCluster = new MarkerClusterer(map, map.markers, mcOptions);

  }

  /*
  *  add_marker
  *
  *  This function will add a marker to the selected Google Map
  *
  *  @type	function
  *  @date	8/11/2013
  *  @since	4.3.0
  *
  *  @param	$marker (jQuery element)
  *  @param	map (Google Map object)
  *  @return	n/a
  */

  function add_marker( $marker, map ) {

  	// var
  	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

    var pinColor = $marker.attr('data-pincolor');
    var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor);

    // var MAP_PIN = 'M0-165c-27.618 0-50 21.966-50 49.054C-50-88.849 0 0 0 0s50-88.849 50-115.946C50-143.034 27.605-165 0-165z';
    var pinIcon = {
      anchor: new google.maps.Point(6.27,22),
      path: 'M6.3,22c0.2-3.1,1.9-8.1,4.3-11.2c1.3-1.7,2-3.4,2-4.4C12.6,2.9,9.8,0,6.3,0h0C2.8,0,0,2.9,0,6.4 c0,1,0.6,2.7,2,4.4C4.4,13.9,6.1,18.9,6.3,22L6.3,22z',
      fillColor: pinColor,
      fillOpacity: 1,
      scale: 1.25,
      strokeColor: lightenDarkenColor(pinColor,-30),
      strokeWeight: 1.5
    };

  	// create marker
  	var marker = new google.maps.Marker({
  		position	: latlng,
  		map			: map,
      icon: pinIcon,
  	});

  	// add to array
  	map.markers.push( marker );

  	// if marker contains HTML, add it to an infoWindow
  	if( $marker.html() )
  	{
  		// create info window
  		var infowindow = new google.maps.InfoWindow({
  			content		: $marker.html()
  		});

      map.infowindows.push( infowindow );

  		// show info window when marker is clicked
  		google.maps.event.addListener(marker, 'click', function() {
        close_infowindows( map );
  			infowindow.open( map, marker );

  		});
  	}

  }

  /*
  *  center_map
  *
  *  This function will center the map, showing all markers attached to this map
  *
  *  @type	function
  *  @date	8/11/2013
  *  @since	4.3.0
  *
  *  @param	map (Google Map object)
  *  @return	n/a
  */

  function center_map( map ) {

  	// vars
  	var bounds = new google.maps.LatLngBounds();

  	// loop through all markers and create bounds
  	$.each( map.markers, function( i, marker ){

  		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

  		bounds.extend( latlng );

  	});

  	// only 1 marker?
  	if( map.markers.length === 1 )
  	{
  		// set center of map
  	    map.setCenter( bounds.getCenter() );
  	    map.setZoom( 15 );
  	}
  	else
  	{
  		// fit to bounds
  		map.fitBounds( bounds );
  	}

  }

  /*
  *  close_infowindows
  *
  *  This function will close all the open infowindows
  *
  *  @type  function
  *  @date  7/23/2015
  *
  *  @param	map (Google Map object)
  *  @return  n/a
  */
  function close_infowindows( map ) {
    for( var i = 0; i < map.infowindows.length; i++ ) {
      map.infowindows[i].close();
    }
  }

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
