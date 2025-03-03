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

    // Inicializar bs-swipe para el distributors slider
    var swiper = new Swiper(".distributorsSwiper", {
      slidesPerView: 1,
      loop: false,
      spaceBetween: 30,
      centeredSlides: true,
      pagination: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });

    // Inicializar bs-swipe para el logos slider
    var swiper = new Swiper(".timelineSwiper", {
      slidesPerView: 1,
      grabCursor: true,
      loop: false,
      spaceBetween: 30,
      centeredSlides: false,
      pagination: false,
      breakpoints: {
        1200: {
          slidesPerView: 3,
          spaceBetween: 10,
        },

        993: {
          slidesPerView: 2,
        },
      },
    });

    // Inicializar counterUp
    $(".info-number-counter--numer").each(function () {
      var counter = $(this);
      var targetNumber = counter.data("target-number");
      var currentNumber = 0;
      var increment = targetNumber / 100; // Ajustar el divisor para controlar la velocidad

      function updateCounter() {
        currentNumber += increment;
        if (currentNumber >= targetNumber) {
          currentNumber = targetNumber;
          counter.text("+" + Math.floor(currentNumber));
        } else {
          counter.text("+" + Math.floor(currentNumber));
          requestAnimationFrame(updateCounter);
        }
      }

      updateCounter();
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
    // Manejar la selección de medidas
    $(".product-medidas__item").on("click", function () {
      var attribute = $(this).data("attribute");
      var value = $(this).data("value");

      // Actualizar el selector oculto
      $('select[name="attribute_' + attribute + '"]')
        .val(value)
        .trigger("change");

      // Marcar el elemento seleccionado
      $(this).siblings().removeClass("selected");
      $(this).addClass("selected");
    });

    // Manejar la selección de colores
    $(".product-colors__item").on("click", function () {
      var attribute = $(this).data("attribute");
      var value = $(this).data("value");

      // Actualizar el selector oculto
      $('select[name="attribute_' + attribute + '"]')
        .val(value)
        .trigger("change");

      // Marcar el elemento seleccionado
      $(this).siblings().removeClass("selected");
      $(this).addClass("selected");
    });

    // Disparar el cambio de variación cuando se seleccionan todos los atributos
    $(".variations_form").on(
      "woocommerce_variation_select_change",
      function () {
        $(this).trigger("check_variations");
      }
    );

    // Manejar el filtro de etiquetas de productos
    function filterProducts() {
      var tags = [];
      $('input[name="product_tag[]"]:checked').each(function () {
        tags.push($(this).val());
      });

      $.ajax({
        url: woocommerce_params.ajax_url,
        type: "GET",
        data: {
          action: "filter_products_by_tags",
          tags: tags,
        },
        success: function (response) {
          $(".products").html(response);
        },
        error: function (xhr, status, error) {
          console.log("AJAX Error: " + status + " - " + error);
        },
      });
    }

    // Manejar el filtro de etiquetas de productos al hacer clic en una opción
    $("#product-tag-filter-form").on(
      "change",
      'input[name="product_tag[]"]',
      function () {
        filterProducts();
      }
    );

    $("#toggle-sidebar").on("click", function () {
      $("#sidebar-panel").toggle();
    });
  });
}); // jQuery End
