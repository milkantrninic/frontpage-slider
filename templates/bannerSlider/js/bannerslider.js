var swiper = new Swiper(".bannerslider", {
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

jQuery(function() {
  jQuery('.swiper-slide').on('mouseover', function() {
      swiper.autoplay.stop();
  });

  jQuery('.swiper-slide').on('mouseout', function() {
      swiper.autoplay.start();
  });
});