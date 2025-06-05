var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 25,
    loop: true,
    centeredSlides: true, // Mantén esto solo para pantallas grandes
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        // Para pantallas grandes (a partir de 900px), muestra 3 slides
        900: {
            slidesPerView: 3, 
            spaceBetween: 10, // Espacio entre los slides para pantallas grandes
            centeredSlides: true, // Solo centrado en pantallas grandes
        },
        // Para pantallas medianas (a partir de 768px), muestra 2 slides
        768: {
            slidesPerView: 2,
            spaceBetween: 20, // Espacio entre los slides para pantallas medianas
            centeredSlides: false, // Desactiva el centrado en pantallas medianas
        },
        // Para pantallas pequeñas (menos de 768px), muestra 1 slide
        0: {
            slidesPerView: 1,
            spaceBetween: 10, // Menor espacio entre los slides
            centeredSlides: false, // Desactiva el centrado en pantallas pequeñas
        }
    }
});

// Scroll al carrusel
    const btnScroll = document.getElementById('scroll-to-carrusel');
    const carrusel = document.getElementById('seccion-carrusel');

    btnScroll.addEventListener('click', function(e) {
        e.preventDefault();
        carrusel.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    });