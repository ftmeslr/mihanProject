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

var swiper = new Swiper("#experts", {
  slidesPerView: 1,
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
function getOption() {
  selectElement = document.getElementById("select1");
  output = selectElement.value;
  console.log(output);

  switch (output) {
    case "76.0":
      document.getElementById("test1").innerHTML = "80";
      document.getElementById("test2").innerHTML = "-";
      break;

    case "80.7":
      document.getElementById("test1").innerHTML = "85";
      document.getElementById("test2").innerHTML = "-";
      break;

    case "85.5":
      document.getElementById("test1").innerHTML = "90";
      document.getElementById("test2").innerHTML = "-";
      break;

    case "90.2":
      document.getElementById("test1").innerHTML = "95";
      document.getElementById("test2").innerHTML = "-";
      break;

    case "96.0":
      document.getElementById("test1").innerHTML = "101";
      document.getElementById("test2").innerHTML = "-";
      break;

    case "102":
      document.getElementById("test1").innerHTML = "107";
      document.getElementById("test2").innerHTML = "-";
      break;

    case "107":
      document.getElementById("test1").innerHTML = "113";
      document.getElementById("test2").innerHTML = "-";
      break;

    case "114":
      document.getElementById("test1").innerHTML = "120";
      document.getElementById("test2").innerHTML = "-";
      break;

    case "121":
      document.getElementById("test1").innerHTML = "127";
      document.getElementById("test2").innerHTML = "-";
      break;

    case "127":
      document.getElementById("test1").innerHTML = "134";
      document.getElementById("test2").innerHTML = "-";
      break;

    case "135":
      document.getElementById("test1").innerHTML = "142";
      document.getElementById("test2").innerHTML = "-";
      break;

    case "143":
      document.getElementById("test1").innerHTML = "150";
      document.getElementById("test2").innerHTML = "0.4";
      break;
    case "150":
      document.getElementById("test1").innerHTML = "158";
      document.getElementById("test2").innerHTML = "2.5";
      break;
    case "143":
      document.getElementById("test1").innerHTML = "1231";
      document.getElementById("test2").innerHTML = "123sad1";
      break;
    case "158":
      document.getElementById("test1").innerHTML = "175";
      document.getElementById("test2").innerHTML = "6.7";
      break;
    case "174":
      document.getElementById("test1").innerHTML = "183";
      document.getElementById("test2").innerHTML = "8.7";
      break;
    case "182":
      document.getElementById("test1").innerHTML = "192";
      document.getElementById("test2").innerHTML = "10.7";
      break;
    case "191":
      document.getElementById("test1").innerHTML = "201";
      document.getElementById("test2").innerHTML = "12.6";
      break;
    case "200":
      document.getElementById("test1").innerHTML = "211";
      document.getElementById("test2").innerHTML = "14.5";
      break;
    case "209":
      document.getElementById("test1").innerHTML = "220";
      document.getElementById("test2").innerHTML = "16.4";
      break;
    case "219":
      document.getElementById("test1").innerHTML = "230";
      document.getElementById("test2").innerHTML = "18.2";
      break;
    case "228":
      document.getElementById("test1").innerHTML = "240";
      document.getElementById("test2").innerHTML = "20.3";
      break;
    case "238":
      document.getElementById("test1").innerHTML = "250";
      document.getElementById("test2").innerHTML = "22.2";
      break;

    default:
      document.getElementById("test1").innerHTML = "-";
      document.getElementById("test2").innerHTML = "-";
  }
}


function decrement(){
  if(Number(document.getElementById('weightWant').value) <= 0) {
    return;
  }
  document.getElementById('weightWant').value = Number(document.getElementById('weightWant').value) - 1
}
function increment(){
  document.getElementById('weightWant').value = Number(document.getElementById('weightWant').value) + 1
}