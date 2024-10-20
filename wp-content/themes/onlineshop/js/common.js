/* [ header - lang ]
 * ------------------------- */
$(document).ready(function () {
  $(".gnav_sub-lang > div").click(function () {
      $(this).next("ul").toggleClass("active");
  });
});

$(document).ready(function () {
  $(".gnav_sub-lang-black > div").click(function () {
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


/* [plugins or colors toggle button] 
  --------------------*/

jQuery(document).ready(function($) {
  const $buttons = $('.switch-button-case');
  const $switchButton = $('.switch-button'); 
  const $originalShopList = $('.your-custom-class');

  $buttons.on('click', function() {
      $buttons.removeClass('active-case'); 
      $(this).addClass('active-case'); 

      $originalShopList.addClass('your-custom-class-not-active');

      if ($(this).hasClass('left')) {
          $switchButton.removeClass('cursor-center cursor-right').addClass('cursor-left'); 
      } else if ($(this).hasClass('center')) {
          $switchButton.removeClass('cursor-left cursor-right').addClass('cursor-center'); 
      } else if ($(this).hasClass('right')) {
          $switchButton.removeClass('cursor-left cursor-center').addClass('cursor-right'); 
      }

  });
});

$(document).ready(function() {

  $('.accordion_area_sub_title_div.vol1').on('click', function() {
    var $target = $('.accordion_area_sub_div_box.vol1');

    $target.slideToggle(500);

    $(this).toggleClass('accordion_title_close');
    $target.toggleClass('accordion_box_close');
  });
});

$(document).ready(function() {

  $('.accordion_area_sub_title_div.vol2').on('click', function() {
    var $target = $('.accordion_area_sub_div_box.vol2');

    $target.slideToggle(500);

    $(this).toggleClass('accordion_title_close');
    $target.toggleClass('accordion_box_close');
  });
});

$(document).ready(function() {

  $('.accordion_area_sub_title_div.vol3').on('click', function() {
    var $target = $('.accordion_area_sub_div_box.vol3');

    $target.slideToggle(500);

    $(this).toggleClass('accordion_title_close');
    $target.toggleClass('accordion_box_close');
  });
});

$(document).ready(function() {

  $('.accordion_area_sub_title_div.vol4').on('click', function() {
    var $target = $('.accordion_area_sub_div_box.vol4');

    $target.slideToggle(500);

    $(this).toggleClass('accordion_title_close');
    $target.toggleClass('accordion_box_close');
  });
});


  
  
