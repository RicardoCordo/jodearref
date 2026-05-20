document.addEventListener('DOMContentLoaded', () => {

    //hero slider

    const sliderWrapper = document.querySelector('.hero-slider');
    const slides = document.querySelectorAll('.hero-slide');

    if (sliderWrapper && slides) {
        let currentIndex = 0;
        const totalSlides = slides.length;

        function updateSliderPosition() {
            sliderWrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
            slides.forEach(slide => slide.style.transform = 'translateY(-1rem)')
            slides.forEach(slide => slide.style.opacity = 0.5)
            slides[currentIndex].style.transform = 'translateY(0)';
            slides[currentIndex].style.opacity = 1;
        }


        setInterval(() => {
            currentIndex = (currentIndex < totalSlides - 1) ? currentIndex + 1 : 0;
            updateSliderPosition();
        }, 5000);

        // Initial position
        updateSliderPosition();

    }






    // cards carousel

    const carousel_button_left = document.querySelector('.carousel-button.left-button')
    const carousel_button_right = document.querySelector('.carousel-button.right-button')
    const cards_container = document.querySelector('.cards-container')
    const carousel_wrapper = document.querySelector('.carousel-wrapper')
    const cards = document.querySelectorAll('.cards-container>a>.card')

    const wrapperWidth = carousel_wrapper?.clientWidth;
    const cardsLength = cards?.length;
    const cardWidth = cards[0]?.clientWidth;
    const gap = (cards_container?.clientWidth - (cardsLength * cardWidth)) / cardsLength

    const scrollWidth = cardWidth + gap;


    let lastCardVisible = wrapperWidth / scrollWidth
    let firstCardVisible = 1
    const maxTranslation = (cardsLength - lastCardVisible) * -scrollWidth
    const translateBy = wrapperWidth;
    let translated = 0;

    if (carousel_button_left && carousel_button_right && cards_container) {
        carousel_button_right.addEventListener('click', () => {
            if ((translated - translateBy) < maxTranslation) {
                cards_container.style.transform = `translatex(${maxTranslation}px)`
                translated = maxTranslation;
                carousel_button_right.classList.add('hidden')
            }
            else {
                cards_container.style.transform = `translatex(${translated -= translateBy}px)`
                carousel_button_left.classList.remove('hidden')
            }
        })
        carousel_button_left.addEventListener('click', () => {
            if ((translated + translateBy) > 0) {
                cards_container.style.transform = `translatex(${0}px)`
                translated = 0;
                carousel_button_left.classList.add('hidden')
            }
            else {
                carousel_button_right.classList.remove('hidden')
                cards_container.style.transform = `translatex(${translated += translateBy}px)`
            }
        })
    }


    // featured products slider

    const featuredProductSliderWrapper = document.querySelector('.featured-products-slider');
    const featuredProductSlides = document.querySelectorAll('.featured-product-slide');

    if (featuredProductSliderWrapper && featuredProductSlides) {
        let currentFeaturedProductIndex = 0;
        const totalFeaturedProductSlides = featuredProductSlides.length;

        function updateFeaturedProductsSliderPosition() {
            featuredProductSliderWrapper.style.transform = `translateX(-${currentFeaturedProductIndex * 100}%)`;
        }


        setInterval(() => {
            currentFeaturedProductIndex = (currentFeaturedProductIndex < totalFeaturedProductSlides - 1) ? currentFeaturedProductIndex + 1 : 0;
            updateFeaturedProductsSliderPosition();
        }, 5000);

        // Initial position
        updateFeaturedProductsSliderPosition();

    }

    // Product filters button

    const originalBtn = document.querySelector('.wc-block-product-filters__open-overlay:not(.argytec)')
    const newBtn = document.querySelector('.wc-block-product-filters__open-overlay.argytec')

    if (originalBtn && newBtn) {
        newBtn.addEventListener('click', () => {
            originalBtn.click()
        })
    }


    const jodear_checkout_form_billing_city_label = document.querySelector('label[for="billing-city"]')
    const jodear_checkout_form_shipping_city_label = document.querySelector('label[for="shipping-city"]')

    if (jodear_checkout_form_billing_city_label) {
        jodear_checkout_form_billing_city_label.innerText = "Localidad";
    }
    if (jodear_checkout_form_shipping_city_label) {
        jodear_checkout_form_shipping_city_label.innerText = "Localidad";
    }


})