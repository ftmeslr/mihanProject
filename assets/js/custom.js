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

var flexRadioDefault1 = document.getElementById("flexRadioDefault1").value;
console.log(flexRadioDefault1);

function test() {
  var label = document.querySelector(
    'input[name="flexRadioDefault"]:checked'
  ).nextElementSibling;
  var label2 = document.querySelectorAll('input[name="flexRadioDefault"]');

  for (var i = 0; i < label2.length; i++) {
    var test = label2[i];
    test.nextElementSibling.style.color = "black";
    test.nextElementSibling.style.border = "1px solid #fff";
    test.nextElementSibling.style.backgroundColor = "#f5f6f7";
  }

  label.style.border = "1px solid red";
  label.style.color = "red";
  label.style.backgroundColor = "#fff";

  console.log(label2);
}

function test2() {
  var label = document.querySelector(
    'input[name="flexRadioDefault"]:checked'
  ).nextElementSibling;
  var label2 = document.querySelectorAll('input[name="flexRadioDefault"]');

  for (var i = 0; i < label2.length; i++) {
    var test = label2[i];
    test.nextElementSibling.style.color = "black";
    test.nextElementSibling.style.border = "1px solid #fff";
    test.nextElementSibling.style.backgroundColor = "#f5f6f7";
  }

  label.style.border = "1px solid red";
  label.style.color = "red";
  label.style.backgroundColor = "#fff";

  console.log(label2);
}

var oneWeek = document.getElementById("oneWeek");
oneWeek.onclick = function () {
  oneWeek.classList.add("activeTimeScale");
  oneMounth.classList.remove("activeTimeScale");
  threeMounth.classList.remove("activeTimeScale");
};

var oneMounth = document.getElementById("oneMounth");
oneMounth.onclick = function () {
  oneWeek.classList.remove("activeTimeScale");
  oneMounth.classList.add("activeTimeScale");
  threeMounth.classList.remove("activeTimeScale");
};

var threeMounth = document.getElementById("threeMounth");
threeMounth.onclick = function () {
  oneWeek.classList.remove("activeTimeScale");
  oneMounth.classList.remove("activeTimeScale");
  threeMounth.classList.add("activeTimeScale");
};

var myModal = document.getElementById("myModal");
var myInput = document.getElementById("myInput");

myModal.addEventListener("shown.bs.modal", function () {
  myInput.focus();
});

function submitForCalculateWeight() {
  var regex = /^[0-9]+$/;
  var width = document.getElementById("width").value;
  var height = document.getElementById("height").value;
  var length = document.getElementById("length").value;

  if (!width.match(regex) || !height.match(regex) || !length.match(regex)) {
    document.getElementById("errorForCalculateWeight").innerHTML =
      "مقادیر ورودی را به درستی وارد کنید";
  } else {
    document.getElementById("errorForCalculateWeight").innerHTML = "";
    let weight = (length * height * width * 7.85) / 1000;
    document.getElementById("weight").innerHTML = weight.toFixed(2);
  }
}
