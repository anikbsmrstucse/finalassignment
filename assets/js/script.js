(function ($) {
  "use script";

  // WOW JS
  new WOW().init();
  // Scroll Area
  $(document).ready(function () {
    $(".scroll-area").click(function () {
      $("html").animate(
        {
          scrollTop: 0,
        },
        700
      );
      return false;
    });
    $(window).on("scroll", function () {
      var a = $(window).scrollTop();
      if (a > 400) {
        $(".scroll-area").slideDown(300);
      } else {
        $(".scroll-area").slideUp(200);
      }
    });
  });

  /*---slider activation---*/
  var $slider = $(".hero-lider-full");
  if ($slider.length > 0) {
    $slider.owlCarousel({
      loop: true,
      nav: false,
      autoplay: true,
      dots: false,
      autoplayTimeout: 8000,
      items: 1,
      nav: true,
      navText: [
        '<span class="hero-slider-nav"><i class="fas fa-arrow-left"></i></span>',
        '<span class="hero-slider-nav"><i class="fas fa-arrow-right"></i></span>',
      ],
    });
  }

  /*---slider activation---*/
  var $Testimonialslider = $(".testimonial-item-full");
  if ($Testimonialslider.length > 0) {
    $Testimonialslider.owlCarousel({
      loop: true,
      nav: false,
      autoplay: true,
      dots: true,
      autoplayTimeout: 8000,
      items: 3,
      nav: false,
      responsive: {
        0: {
          items: 1,
        },
        400: {
          items: 1,
        },
        767: {
          items: 2,
        },
        991: {
          items: 3,
        },
      },
    });
  }

  $(".project-item  a.zoom").magnificPopup({
    type: "image",
    gallery: {
      enabled: true,
    },
  });

  // Sticky Menu
  $(document).ready(function () {
    $(window).on("scroll", function () {
      var scroll = $(window).scrollTop();
      if (scroll < 150) {
        $(".header-bottom").removeClass("sticky");
      } else {
        $(".header-bottom").addClass("sticky");
      }
    });
  });

  // Counter
  $(".counter").counterUp({
    delay: 4,
    time: 2000,
  });

  function basicmap() {
    // Basic options for a simple Google Map
    // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
    var mapOptions = {
      // How zoomed in you want the map to start at (always required)
      zoom: 11,
      scrollwheel: false,
      // The latitude and longitude to center the map (always required)
      center: new google.maps.LatLng(40.67, -73.94), // New York
      // This is where you would paste any style found on Snazzy Maps.
      styles: [
        {
          featureType: "water",
          elementType: "geometry",
          stylers: [{ color: "#e9e9e9" }, { lightness: 17 }],
        },
        {
          featureType: "landscape",
          elementType: "geometry",
          stylers: [{ color: "#f5f5f5" }, { lightness: 20 }],
        },
        {
          featureType: "road.highway",
          elementType: "geometry.fill",
          stylers: [{ color: "#ffffff" }, { lightness: 17 }],
        },
        {
          featureType: "road.highway",
          elementType: "geometry.stroke",
          stylers: [{ color: "#ffffff" }, { lightness: 29 }, { weight: 0.2 }],
        },
        {
          featureType: "road.arterial",
          elementType: "geometry",
          stylers: [{ color: "#ffffff" }, { lightness: 18 }],
        },
        {
          featureType: "road.local",
          elementType: "geometry",
          stylers: [{ color: "#ffffff" }, { lightness: 16 }],
        },
        {
          featureType: "poi",
          elementType: "geometry",
          stylers: [{ color: "#f5f5f5" }, { lightness: 21 }],
        },
        {
          featureType: "poi.park",
          elementType: "geometry",
          stylers: [{ color: "#dedede" }, { lightness: 21 }],
        },
        {
          elementType: "labels.text.stroke",
          stylers: [
            { visibility: "on" },
            { color: "#ffffff" },
            { lightness: 16 },
          ],
        },
        {
          elementType: "labels.text.fill",
          stylers: [
            { saturation: 36 },
            { color: "#333333" },
            { lightness: 40 },
          ],
        },
        { elementType: "labels.icon", stylers: [{ visibility: "off" }] },
        {
          featureType: "transit",
          elementType: "geometry",
          stylers: [{ color: "#f2f2f2" }, { lightness: 19 }],
        },
        {
          featureType: "administrative",
          elementType: "geometry.fill",
          stylers: [{ color: "#fefefe" }, { lightness: 20 }],
        },
        {
          featureType: "administrative",
          elementType: "geometry.stroke",
          stylers: [{ color: "#fefefe" }, { lightness: 17 }, { weight: 1.2 }],
        },
      ],
    };
    // Get the HTML DOM element that will contain your map
    // We are using a div with id="map" seen below in the <body>
    var mapElement = document.getElementById("contact-map");

    // Create the Google Map using our element and options defined above
    var map = new google.maps.Map(mapElement, mapOptions);

    // Let's also add a marker while we're at it
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(40.67, -73.94),
      map: map,
      title: "Cryptox",
    });
  }
  if ($("#contact-map").length != 0) {
    google.maps.event.addDomListener(window, "load", basicmap);
  }
  
})(jQuery);
