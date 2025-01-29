jQuery(function ($) {
  $(document).ready(function () {
    const $carrousel = $(".auto-carrousel-bar__inner ul");
    const $items = $carrousel.find("li");
    const itemWidth = $items.outerWidth(true);
    const carrouselWidth = $carrousel.parent().outerWidth(true);
    let scrollAmount = 0;

    // Calcular el número de clones necesarios para llenar el ancho del contenedor
    const itemsPerScreen = Math.ceil(carrouselWidth / itemWidth);
    const totalItems = $items.length;

    // Clonar los elementos para crear un efecto de bucle infinito
    for (let i = 0; i < itemsPerScreen; i++) {
      $items.each(function () {
        const $clone = $(this).clone();
        $carrousel.append($clone);
      });
    }

    function scrollCarrousel() {
      scrollAmount += 1;
      if (scrollAmount >= itemWidth) {
        $carrousel.append($carrousel.find("li:first"));
        scrollAmount = 0;
      }
      $carrousel.css("transform", `translateX(-${scrollAmount}px)`);
      requestAnimationFrame(scrollCarrousel);
    }

    scrollCarrousel();

    // Inicializar bs-swipe para el logos slider
    var swiper = new Swiper(".logoSwiper", {
      slidesPerView: 4,
      grabCursor: true,
      loop: true,
      spaceBetween: 30,
      centeredSlides: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        640: {
          slidesPerView: 5,
          spaceBetween: 10,
          centeredSlides: false,
        },
      },
    });

    //Scroll Down
    const $masthead = $("#masthead");

    $(window).on("scroll", function () {
      if ($(this).scrollTop() > 0) {
        $masthead.addClass("scrolled");
      } else {
        $masthead.removeClass("scrolled");
      }
    });

    // Iterar sobre todas las etiquetas de categoría con el atributo data-color
    $(".category-badge a").each(function () {
      // Obtener el color de la categoría desde data-color
      var color = $(this).data("color");

      // Aplicar el color al texto
      $(this).css("color", color);

      // Crear un color de fondo más claro utilizando un filtro CSS
      $(this).css({
        "background-color": color,
      });
    });
  });
}); // jQuery End
