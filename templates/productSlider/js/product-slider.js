const psNumbers = [];
const preporucujeSlides = document.querySelectorAll('.preporucujeSlide');
preporucujeSlides.forEach(slide => {
  psNumbers.push(slide.dataset.psnumber);
});
preporucujeSlides.forEach((slide, index) => {
  const swiper = new Swiper(slide, {
    navigation: {
      nextEl: `.owl-next-${psNumbers[index]}`,
      prevEl: `.owl-prev-${psNumbers[index]}`,
    },
  });
});

const gridNumbers = [];
const gridSlide = document.querySelectorAll('.gridSlide');
gridSlide.forEach(slide => {
  gridNumbers.push(slide.dataset.psnumber);
});
gridSlide.forEach((slide, index) => {
    const swiper = new Swiper(slide, {
      slidesPerView: 2,
      spaceBetween: 10,
      navigation: {
        nextEl: `.owl-next-${gridNumbers[index]}`,
        prevEl: `.owl-prev-${gridNumbers[index]}`,
      },
      
      breakpoints: {
        500: {
          slidesPerView: 2,
          spaceBetween: 0,
          
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 0,
         
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 0,
          grid: {
            rows: 2,
          },
        },
      },
    });

    // Add event listeners to your custom navigation buttons
    document.querySelector(`.owl-prev-${gridNumbers[index]}`).addEventListener('click', () => {
      swiper.slidePrev();
    });

    document.querySelector(`.owl-next-${gridNumbers[index]}`).addEventListener('click', () => {
      swiper.slideNext();
    });
});

