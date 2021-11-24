$(window).on('load', () => {
  $(document).ready(function () {
    AOS.init({
      // offset: 0,
      // delay: 0
    });
  });

  $('.header__hamburder__open').on('click', function () {
    $(this).addClass('active');
    $('.header__nav').addClass('active');
    $('body').addClass('navShoved');
    $('html').addClass('navShoved');
  });

  $('.header__hamburder__exit').on('click', function () {
    $(this).removeClass('active');
    $('.header__nav').removeClass('active');
    $('body').removeClass('navShoved');
    $('html').removeClass('navShoved');
  });

  $('main').on('click', function () {
    $('.hamburger').removeClass('active');
    $('.header__nav').removeClass('active');
    $('body').removeClass('navShoved');
    $('html').removeClass('navShoved');
  });

  const header = document.querySelector('.header');
  let navTopPosition;
  if (header) {
    navTopPosition = header.offsetTop;
  }

  window.addEventListener('scroll', function (e) {
    let scrollPosition = window.scrollY;
    if (+scrollPosition > 10) {
      if (!header.classList.contains('scrolled')) {
        header.classList.add('scrolled');
      }
    } else {
      header.classList.remove('scrolled');
    }
  });
});
