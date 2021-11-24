$(window).on('load', () => {
  const page404 = document.querySelector('.error404');

  if (page404) {
    // 404 page
    document.querySelector('.cont_principal').className =
      'cont_principal cont_error_active';
  }
});
