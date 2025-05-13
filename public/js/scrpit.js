
document.addEventListener("DOMContentLoaded", function () {
    const loginModal = document.getElementById("login-modal");
    const registerModal = document.getElementById("register-modal");
    const closeLogin = document.getElementById("close-login");
    const closeRegister = document.getElementById("close-register");
    const loginForm = document.getElementById("login-form");
    const registerForm = document.getElementById("register-form");
    const registerButton = document.getElementById("btn-registrar");
    const loginButton = document.getElementById("btn-iniciar");

    // Asegurar que los modales existen antes de manipularlos
    if (loginModal) loginModal.style.display = "none";
    if (registerModal) registerModal.style.display = "none";

    // Mostrar modal solo si no se ha visto antes
    if (loginModal && !localStorage.getItem("loginVisto")) {
        setTimeout(() => {
            loginModal.style.display = "flex";
            localStorage.setItem("loginVisto", "true");
        }, 4000);
    }

    // Eventos para abrir y cerrar modales
    if (loginButton) {
        loginButton.addEventListener("click", function (e) {
            e.preventDefault();
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


    if(loginButton) {
        loginButton.addEventListener("click", function(e){
            e.preventDefault();
            if (registerModal) registerModal.style.display = "none";
            if (loginModal) loginModal.style.display = "flex";
        })
    }

    if (closeRegister) {
        closeRegister.addEventListener("click", function () {
            if (registerModal) registerModal.style.display = "none";
        });
    }

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

    
    // Validar y enviar login
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const email = loginForm.querySelector("[name='email']").value.trim();
            const password = loginForm.querySelector("[name='password']").value.trim();

            if (!email || !password) {
                toastr.error("Todos los campos son obligatorios.");
                return;
            }

            const formData = new FormData(loginForm);

            fetch("login.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    toastr.success(data.message);
                    if (loginModal) loginModal.style.display = "none";
                    setTimeout(() => window.location.reload(), 2500);
                } else {
                    toastr.error(data.message);
                }
            })
            .catch(error => {
                toastr.error("Hubo un problema con la solicitud.");
                console.error("Error:", error);
            });
        });
    }

        
        if (registerForm) {
            registerForm.addEventListener("submit", async function(e) {
                e.preventDefault();
                
                // Deshabilitar botón para evitar múltiples envíos
                const submitBtn = registerForm.querySelector("[type='submit']");
                submitBtn.disabled = true;
                
                try {
                    // Obtener valores de los campos
                    const formData = new FormData(registerForm);
                    const nombre = formData.get('nombre').trim();
                    const telefono = formData.get('telefono').trim();
                    const email = formData.get('email').trim();
                    const password = formData.get('password').trim();
                    
                    // Validaciones básicas
                    if (!nombre || !telefono || !email || !password) {
                        throw new Error("Todos los campos son obligatorios");
                    }
    
                    // Enviar datos al servidor
                    const response = await fetch("registro.php", {
                        method: "POST",
                        body: formData
                    });
    
                    // Verificar si la respuesta es JSON válido
                    const text = await response.text();
                    let data;
                    try {
                        data = JSON.parse(text);
                    } catch {
                        throw new Error("Respuesta no válida del servidor");
                    }
    
                    // Manejar respuesta
                    if (data.status === "success") {
                        // Mostrar toastr y luego redirigir
                        toastr.success(data.message, "", {
                            timeOut: 2500,
                            onHidden: function() {
                                window.location.href = "index.php";
                            }
                        });
                    } else {
                        throw new Error(data.message || "Error en el registro");
                    }
                } catch (error) {
                    toastr.error(error.message);
                    console.error("Error en registro:", error);
                } finally {
                    submitBtn.disabled = false;
                }
        });
        }

        
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



//Seccion de reseñas
document.getElementById("formReseña").addEventListener("submit", function(event) {
    event.preventDefault(); // Evita el refresco de la página

    // Obtener valores del formulario
    let nombre = document.getElementById("nombre").value;
    let calificacion = document.getElementById("calificacion").value;
    let comentario = document.getElementById("comentario").value;

    // Convertir calificación en estrellas
    let estrellas = "★".repeat(calificacion) + "☆".repeat(5 - calificacion);

    // Crear un nuevo div para la reseña
    let nuevaReseña = document.createElement("div");
    nuevaReseña.classList.add("col-md-4");
    nuevaReseña.innerHTML = `
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">${nombre}</h5>
                <p class="text-warning mb-1">${estrellas}</p>
                <p class="card-text">${comentario}</p>
            </div>
        </div>
    `;

    // Agregar la reseña al contenedor de reseñas
    document.getElementById("listaReseñas").appendChild(nuevaReseña);

    // Limpiar el formulario
    document.getElementById("formReseña").reset();
});

//filtro por precio
function updatePrice() {
    let priceRange = document.getElementById("priceRange");
    let priceValue = document.getElementById("priceValue");
    priceValue.textContent = priceRange.value + " COP";
}

document.getElementById("priceRange").addEventListener("input", function() {
    let maxPrice = this.value;
    document.getElementById("priceValue").textContent = maxPrice + " COP";

    document.querySelectorAll(".product").forEach(function(product) {
        let productPrice = parseInt(product.getAttribute("data-price"));
        if (productPrice > maxPrice) {
            product.style.display = "none";
        } else {
            product.style.display = "block";
        }
    });
});



