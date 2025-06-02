$(document).ready(function() {
  $('.slider').slick({
    slidesToShow: 5,
    slidesToScroll: 2,
    autoplay: true,
    autoplaySpeed: 3000,
    touchThreshold:10,
    centerMode: true,
    responsive:[{
      breakpoint: 768,
      settings: {
          slidesToShow:3,
      }
    }],
    variableWidth: true
  });
  $('.slider2', $(this)).slick({
    slidesToShow: 5,
    slidesToScroll: 2,
    autoplay: true,
    autoplaySpeed: 3000,
    touchThreshold:10,
    centerMode: true,
    responsive:[{
      breakpoint: 768,
      settings: {
          slidesToShow:3,
      }
    }],
    variableWidth: true
  });
});