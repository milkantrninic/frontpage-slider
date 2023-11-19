const fsNumbers = [];
const favProductsSwiper = document.querySelectorAll('.fav-products-swiper');
favProductsSwiper.forEach(slide => {
  fsNumbers.push(slide.dataset.fpnumber);
});
favProductsSwiper.forEach((slide, index) => {
  const swiper = new Swiper(slide, {

    slidesPerView: 2,
    spaceBetween: 0,
    pagination: {
      el: ".fp-swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 0,
      },
      768: {
        slidesPerView: 4,
        spaceBetween: 0,
      },
      1024: {
        slidesPerView: 5,
        spaceBetween: 0,
      },
    },
    navigation: {
      nextEl: `.owl-next-${fsNumbers[index]}`,
      prevEl: `.owl-prev-${fsNumbers[index]}`,
    },
  });
});

