var swiper = new Swiper(".advertisement-slider", {
    // slidesPerView: 4,
    // spaceBetween: 30,
    loop: true,
    // navigation: {
    //   nextEl: ".swiper-button-next",
    //   prevEl: ".swiper-button-prev",
    // },
    autoplay: {
        delay: 1000,
        disableOnInteraction: false,
    },
    breakpoints: {
        // when window width is <= 576px
        576: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        // when window width is <= 768px
        768: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        // when window width is <= 992px
        992: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
        // when window width is <= 1200px
        1200: {
            slidesPerView: 4,
            spaceBetween: 40,
        },
        // Add more breakpoints as needed
    },
});
