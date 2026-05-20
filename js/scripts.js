window.addEventListener("DOMContentLoaded", (event) => {

  document.querySelector('#loader').classList.add('hidden')

  AOS.init({once: true});

  // Navbar shrink function
  var navbarShrink = function () {
    const navbarCollapsible = document.body.querySelector("#mainNav");
    if (!navbarCollapsible) {
      return;
    }
    if (window.scrollY === 0) {
      navbarCollapsible.classList.remove("navbar-shrink");
    } else {
      navbarCollapsible.classList.add("navbar-shrink");
    }
  };

  // Shrink the navbar
  navbarShrink();

  // Shrink the navbar when page is scrolled
  document.addEventListener("scroll", navbarShrink);

  // Activate Bootstrap scrollspy on the main nav element
  const mainNav = document.body.querySelector("#mainNav");
  if (mainNav) {
    new bootstrap.ScrollSpy(document.body, {
      target: "#mainNav",
      rootMargin: "0px 0px -40%",
    });
  }

  // Collapse responsive navbar when toggler is visible
  const navbarToggler = document.body.querySelector(".navbar-toggler");
  const responsiveNavItems = [].slice.call(
    document.querySelectorAll("#navbarResponsive .nav-link")
  );
  responsiveNavItems.map(function (responsiveNavItem) {
    responsiveNavItem.addEventListener("click", () => {
      if (window.getComputedStyle(navbarToggler).display !== "none") {
        navbarToggler.click();
      }
    });
  });

  const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
  );
  const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
  );
  
    var swiper = new Swiper(".mySwiper",
    {
      spaceBetween: 0,
      speed: 3000,
      direction: 'horizontal',
      autoplay: { delay: 0 },
      loop: true,
      slidesPerView: 1,
      freeMode: true,
      breakpoints: {
        640: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 5,
        },
      }
    });
  var swiperCamaras = new Swiper(".swiper-camaras",
    {
      spaceBetween: 0,
      direction: 'horizontal',
      autoplay: { delay: 1500 },
      loop: true,
      slidesPerView: 1,
      freeMode: true,
      effect: 'fade'
    });
    
      var swiperRepuestos = new Swiper(".swiper-repuestos",
    {
      spaceBetween: 0,
      direction: 'horizontal',
      autoplay: { delay: 1500 },
      loop: true,
      slidesPerView: 1,
      freeMode: true,
      effect: 'fade'
    });
  var swiperAires = new Swiper(".swiper-aires",
    {
      spaceBetween: 0,
      direction: 'horizontal',
      autoplay: { delay: 1500 },
      loop: true,
      slidesPerView: 1,
      freeMode: true,
      effect: 'fade'
    });
    
});
