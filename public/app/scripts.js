$(document).ready(function(){
  $('.burger__trigger').click(function(){
    $('.mobile__menu').toggleClass('mobile__menu--active');
  });
  $('a').click(function(){
    $('.menu-hide').removeClass('show');
    $('.menu-tab').removeClass('active');
  });

  // Теги для формы
  $(".appeal__form__tags").tagsinput('items')
});
