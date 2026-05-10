/*=============== SHOW MENU ===============*/
const navMenu = document.getElementById('nav-menu'),
      navToggle = document.getElementById('nav-toggle'),
      navClose = document.getElementById('nav-close')

/*===== MENU SHOW =====*/
if(navToggle){
    navToggle.addEventListener('click', () =>{
        navMenu.classList.add('show-menu')
    })
}

/*===== MENU HIDDEN =====*/
if(navClose){
    navClose.addEventListener('click', () =>{
        navMenu.classList.remove('show-menu')
    })
}

/*=============== REMOVE MENU MOBILE ===============*/
const navLink = document.querySelectorAll('.nav__link')

const linkAction = () =>{
    const navMenu = document.getElementById('nav-menu')

    if(navMenu){
        navMenu.classList.remove('show-menu')
    }
}

navLink.forEach(n => n.addEventListener('click', linkAction))

/*=============== SWIPER HOME ===============*/
const swiperHome = new Swiper('.home__swiper', {
    loop: true,
    slidesPerView: 'auto',
    grabCursor: true,

    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
})

/*=============== CHANGE BACKGROUND HEADER ===============*/
const bgHeader = () =>{
    const header = document.getElementById('header')

    if(header){
        window.scrollY >= 50
            ? header.classList.add('bg-header')
            : header.classList.remove('bg-header')
    }
}

const testimonialSwiperElement = document.querySelector('.testimonial__swiper')

if(testimonialSwiperElement){

    new Swiper('.testimonial__swiper', {

        loop: true,
        rewind: false,

        grabCursor: true,
        centeredSlides: false,

        slidesPerView: 1,
        spaceBetween: 24,

        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        breakpoints: {

            768: {
                slidesPerView: 2,
            },

            1200: {
                slidesPerView: 3,
            }

        }
    })
}


/*=============== REVIEW MODAL ===============*/
const reviewCards = document.querySelectorAll('.review-modal-trigger')
const reviewModal = document.getElementById('reviewModal')

const reviewModalImg = document.getElementById('reviewModalImg')
const reviewModalName = document.getElementById('reviewModalName')
const reviewModalRating = document.getElementById('reviewModalRating')
const reviewModalText = document.getElementById('reviewModalText')

const reviewModalClose = document.getElementById('reviewModalClose')

reviewCards.forEach(card => {

    card.addEventListener('click', () => {

        reviewModalImg.src = card.dataset.photo
        reviewModalName.textContent = card.dataset.name
        reviewModalRating.textContent = `⭐ ${card.dataset.rating}/5`
        reviewModalText.textContent = card.dataset.review

        reviewModal.classList.add('show-modal')
    })

})

/* CLOSE MODAL */
reviewModalClose.addEventListener('click', () => {
    reviewModal.classList.remove('show-modal')
})

/* CLOSE WHEN CLICK OUTSIDE */
reviewModal.addEventListener('click', (e) => {

    if(e.target.classList.contains('review-modal__overlay')){
        reviewModal.classList.remove('show-modal')
    }

})







/*=============== SHOW SCROLL UP ===============*/
const scrollUp = () =>{
    const scrollUp = document.getElementById('scroll-up')

    if(scrollUp){
        window.scrollY >= 350
            ? scrollUp.classList.add('show-scroll')
            : scrollUp.classList.remove('show-scroll')
    }
}

window.addEventListener('scroll', scrollUp)

/*=============== SCROLL SECTIONS ACTIVE LINK ===============*/
const sections = document.querySelectorAll('section[id]')

const scrollActive = () =>{
    const scrollDown = window.scrollY

    sections.forEach(current =>{
        const sectionHeight = current.offsetHeight,
              sectionTop = current.offsetTop - 58,
              sectionId = current.getAttribute('id'),
              sectionClass = document.querySelector('.nav__menu a[href*="' + sectionId + '"]')

        if(sectionClass){

            if(scrollDown > sectionTop && scrollDown <= sectionTop + sectionHeight){
                sectionClass.classList.add('active-link')
            }else{
                sectionClass.classList.remove('active-link')
            }

        }
    })
}

window.addEventListener('scroll', scrollActive)

/*=============== DARK LIGHT THEME ===============*/
const themeButton = document.getElementById('theme-button')
const darkTheme = 'dark-theme'
const iconTheme = 'ri-sun-fill'

/*===== PREVIOUSLY SELECTED THEME =====*/
const selectedTheme = localStorage.getItem('selected-theme')
const selectedIcon = localStorage.getItem('selected-icon')

/*===== CURRENT THEME =====*/
const getCurrentTheme = () =>
    document.body.classList.contains(darkTheme) ? 'dark' : 'light'

const getCurrentIcon = () =>
    themeButton && themeButton.classList.contains(iconTheme)
        ? 'ri-moon-fill'
        : 'ri-sun-fill'

/*===== APPLY SAVED THEME =====*/
if(selectedTheme && themeButton){

    document.body.classList[selectedTheme === 'dark' ? 'add' : 'remove'](darkTheme)

    themeButton.classList[selectedIcon === 'ri-moon-fill'
        ? 'add'
        : 'remove'](iconTheme)
}

/*===== THEME BUTTON CLICK =====*/
if(themeButton){

    themeButton.addEventListener('click', () =>{

        document.body.classList.toggle(darkTheme)
        themeButton.classList.toggle(iconTheme)

        localStorage.setItem('selected-theme', getCurrentTheme())
        localStorage.setItem('selected-icon', getCurrentIcon())
    })
}

/*=============== SCROLL REVEAL ANIMATION ===============*/
const sr = ScrollReveal({
    origin: 'top',
    distance: '60px',
    duration: 2000,
    delay: 300,
    // reset: true,
})

sr.reveal(`.home__container, .testimonial__container, .footer__container`)
sr.reveal(`.home__title`, {delay: 600})
sr.reveal(`.home__description`, {delay: 900})
sr.reveal(`.home__data .button`, {delay: 1200})
sr.reveal(`.destination__card`, {interval: 100})
sr.reveal(`.gallery__card`, {interval: 100})
sr.reveal(`.join__data`, {origin: 'left'})
sr.reveal(`.join__img`, {origin: 'right'})

/*=============== PREMIUM HERO SWIPER ===============*/
const premiumHeroElement = document.querySelector('.hero-premium__swiper')

if(premiumHeroElement){

    new Swiper(".hero-premium__swiper", {

        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 3,
        loop: true,
        speed: 1500,
        spaceBetween: -15,
        allowTouchMove: true,

        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 180,
            modifier: 1.4,
            slideShadows: false,
            scale: .82,
        },

        navigation: {
            nextEl: ".hero-premium-next",
            prevEl: ".hero-premium-prev",
        },

        breakpoints: {

            0: {
                slidesPerView: 1.4,
                spaceBetween: -15,
            },

            768: {
                slidesPerView: 3,
                spaceBetween: -15,
            }

        }
    })
}
