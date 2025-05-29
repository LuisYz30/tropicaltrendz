
document.addEventListener("DOMContentLoaded", function () {
    const loginModal = document.getElementById("login-modal");
    const registerModal = document.getElementById("register-modal");
    const closeLogin = document.getElementById("close-login");
    const closeRegister = document.getElementById("close-register");
    const registerButton = document.getElementById("btn-registrar");
    const loginButton = document.getElementById("btn-iniciar");
    const botonesAgregarCarrito = document.querySelectorAll(".abrir-login-modal");
    const enlaceLogin = document.getElementById("btn-iniciar-enlace");
    const enlaceRegistro = document.getElementById("btn-registro-enlace");

    botonesAgregarCarrito.forEach((boton) => {
        boton.addEventListener("click", function (e) {
            e.preventDefault();
            localStorage.setItem("redirectAfterLogin", window.location.href); // 👈 También aquí
            if (loginModal) loginModal.style.display = "flex";
        });
    });

    if (loginModal) loginModal.style.display = "none";
    if (registerModal) registerModal.style.display = "none";

    if (loginModal && !localStorage.getItem("loginVisto")) {
        setTimeout(() => {
            loginModal.style.display = "flex";
            localStorage.setItem("loginVisto", "true");
        }, 4000);
    }

    if (loginButton) {
        loginButton.addEventListener("click", function (e) {
            e.preventDefault();
            if (registerModal) registerModal.style.display = "none";
            if (loginModal) loginModal.style.display = "flex";
        });
    }

    if (closeLogin) {
        closeLogin.addEventListener("click", function () {
            if (loginModal) loginModal.style.display = "none";
            localStorage.setItem("loginVisto", "true");
        });
    }

    if (registerButton) {
        registerButton.addEventListener("click", function (e) {
            e.preventDefault();
            if (loginModal) loginModal.style.display = "none";
            if (registerModal) registerModal.style.display = "flex";
        });
    }

    if (closeRegister) {
        closeRegister.addEventListener("click", function () {
            if (registerModal) registerModal.style.display = "none";
        });
    }

    if (enlaceRegistro) {
        enlaceRegistro.addEventListener("click", function (e) {
            e.preventDefault();
            if (loginModal) loginModal.style.display = "none";
            if (registerModal) registerModal.style.display = "flex";
        });
    }

    if (enlaceLogin) {
        enlaceLogin.addEventListener("click", function (e) {
            e.preventDefault();
            if (registerModal) registerModal.style.display = "none";
            if (loginModal) loginModal.style.display = "flex";
        });
    }

    //transicion navbar cuando se hace scroll
    window.addEventListener('scroll', function () {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 10) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });


    // Configurar Toastr
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "2500",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

// Video desvaneciendo al hacer scroll
// Escuchamos el evento de scroll de la ventana
window.addEventListener('scroll', function() {
    
    // Seleccionamos el video que queremos desvanecer
    var video = document.querySelector('.banner-video');
    
    // Obtenemos cuántos píxeles hemos hecho scroll desde arriba
    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    // Definimos a partir de qué punto empieza el desvanecimiento
    var fadeStart = 0;
    
    // Definimos hasta qué punto el video se desvanece completamente
    // Aquí usamos el 50% de la altura visible de la pantalla
    var fadeUntil = window.innerHeight * 0.5;

    // Inicializamos la opacidad en 1 (totalmente visible)
    var opacity = 1;

    // Lógica para cambiar la opacidad según el scroll
    if (scrollTop <= fadeStart) {
        // Si no hemos hecho scroll o estamos muy arriba, el video está totalmente visible
        opacity = 1;
    } else if (scrollTop <= fadeUntil) {
        // Si estamos entre fadeStart y fadeUntil, calculamos gradualmente la opacidad
        opacity = 1 - (scrollTop - fadeStart) / (fadeUntil - fadeStart);
    } else {
        // Si pasamos de fadeUntil, el video ya no es visible
        opacity = 0;
    }

    // Aplicamos la opacidad calculada al video
    video.style.opacity = opacity;
});

});    

//CARRUSEL
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