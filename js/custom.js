jQuery(document).ready(function ($) {
    $('.main-navigation').meanmenu();
    $('#myCarousel').carousel({
        interval: 4000
    });


         var owl = $(".sponser-slider");
              owl.owlCarousel({
              items:1,
              loop:false,
              nav:false,
              autoplay:true,
              autoplayTimeout:4000,
              fallbackEasing: 'easing',
              transitionStyle : "fade",
              dots:false,
              autoplayHoverPause:true,
              responsive:{
                  0:{
                      items:1
                  },
                  480:{
                      items:1
                  },
                  580:{
                      items:2
                  },
                  1000:{
                      items:4
                  }
              }
              
              });



});