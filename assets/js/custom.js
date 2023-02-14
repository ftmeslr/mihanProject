// Header -> Search box opener
$("header #searchIcon #searchIconTrigger").click(function () {
  if ($(this).hasClass("active")) {
    $(this).removeClass("active");
    $(this).parent().find("form").fadeOut();
  } else {
    $(this).addClass("active");
    $(this).parent().find("form").fadeIn();
  }
});
// Header -> Search box opener

// Index -> priceList swiperJs
var swiper = new Swiper("#priceListSwiper", {
  slidesPerView: 4,
  spaceBetween: 30,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});
// Index -> priceList swiperJs

function readMore() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    //   btnText.innerHTML = "مطالعه بیشتر";
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    //   btnText.innerHTML = "مطالعه بیشتر";
    moreText.style.display = "inline";
  }
}
