/* [ header - lang ]
 * ------------------------- */
$(document).ready(function () {
  $(".gnav_sub-lang > div").click(function () {
      $(this).next("ul").toggleClass("active");
  });
});




$('.menubtn').on('click',function(){
  $('.menubtn span').toggleClass('active');
  $('.sp-gnav').fadeToggle();
});





/* [ fv - slider ]
 * ------------------------- */
const swiper = new Swiper('.fv01 .swiper', {
  loop: true,
  loopAdditionalSlides: 1,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  autoplay: {
    delay: 4000,
    stopOnLastSlide: false,
    disableOnInteraction: false,
    reverseDirection: false
  },
  speed: 4000,
});

jQuery(document).ready(function($) {
  $('#scroll-to-plugins').on('click', function(e) {
      e.preventDefault(); 
      
      $('html, body').animate({
          scrollTop: $('#plugins_in_store').offset().top
      }, 500); 
  });
});

jQuery(document).ready(function($) {
  
  $('#scroll-to-colors').on('click', function(e) {
      e.preventDefault(); 

      $('html, body').animate({
          scrollTop: $('#colors_in_store').offset().top
      }, 500); 
  });
});

jQuery(document).ready(function($) {
  $('#scroll-to-plugins-sp').on('click', function(e) {
      e.preventDefault(); 
      
      $('html, body').animate({
          scrollTop: $('#plugins_in_store').offset().top
      }, 500); 
  });
});

jQuery(document).ready(function($) {
  
  $('#scroll-to-colors-sp').on('click', function(e) {
      e.preventDefault(); 

      $('html, body').animate({
          scrollTop: $('#colors_in_store').offset().top
      }, 500); 
  });
});