var swiper = new Swiper(".home3-slider", {
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    centeredSlides: true,
        autoplay: {
          delay: 2500,
          disableOnInteraction: true,
        },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
$(function() {
  $('.swiper-slide').on('mouseover', function() {
    swiper.autoplay.stop();
  });
  
  $('.swiper-slide').on('mouseout', function() {
    swiper.autoplay.start();
  });
    
});