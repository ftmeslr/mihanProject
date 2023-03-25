function setCookie(cname, cvalue, exdays = 30) {
  const d = new Date();
  d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return false;
}
function AddTobasket(row) {
  var basket = getCookie("mfoolad_basket");
  if (!basket || typeof basket != "string") {
    basket = JSON.stringify([]);
  }
  basket = JSON.parse(basket);
  basket.push(row);
  setCookie("mfoolad_basket", JSON.stringify(basket));
}
$(function () {
  //add to  basket
  $(".addtobasket").click(function(e){
    e.preventDefault();
    if($(this).data("pid")){
      var cnt = 1;
      if($("#weightWant").length > 0){ cnt = $("#weightWant").val(); }
      var row = {prod:$(this).data("pid"),count:cnt}
      if($(".form-check-input").length > 0){
        var attrs = [];
        var childs = $(".form-check-input:checked");
        for(i=0;i<childs.length;i++){
          attrs.push({key:childs.eq(i).attr("name"),val:childs.eq(i).val()});
        }
        row['attrs'] = attrs;
      }
      AddTobasket(row);
      alert("محصول به سبد خرید شما افزوده شد")
    }
  })

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

  //Like
  $(document).on("click",".likeit",function(e){
    e.preventDefault();
    if($(this).data("pid")){
      $.post(ajax_url,{action:"likeit",pid:$(this).data("pid")});
      $(this).addClass("liked");
    }
  })
});

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
if (oneWeek) {
  oneWeek.onclick = function () {
    oneWeek.classList.add("activeTimeScale");
    oneMounth.classList.remove("activeTimeScale");
    threeMounth.classList.remove("activeTimeScale");
  };
}

var oneMounth = document.getElementById("oneMounth");
if (oneMounth) {
  oneMounth.onclick = function () {
    oneWeek.classList.remove("activeTimeScale");
    oneMounth.classList.add("activeTimeScale");
    threeMounth.classList.remove("activeTimeScale");
  };
}

var threeMounth = document.getElementById("threeMounth");
if (threeMounth) {
  threeMounth.onclick = function () {
    oneWeek.classList.remove("activeTimeScale");
    oneMounth.classList.remove("activeTimeScale");
    threeMounth.classList.add("activeTimeScale");
  };
}

var myModal = document.getElementById("myModal");
var myInput = document.getElementById("myInput");
if (myModal) {
  myModal.addEventListener("shown.bs.modal", function () {
    myInput.focus();
  });
}

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
}  const select1 = document.getElementById("select1");
const select2 = document.getElementById('select2');
const select3 = document.getElementById('select3');
const loading = false

function updateSelectOneValues() {

  output = select1.value;

  switch (output) {
    case "76.0":
      select2.value = "80";
      select3.value = "-";
      break;

    case "80.7":
      select2.value = "85";
      select3.value = "-";
      break;

    case "85.5":
      select2.value = "90";
      select3.value = "-";
      break;

    case "90.2":
      select2.value = "95";
      select3.value = "-";
      break;

    case "96.0":
      select2.value = "101";
      select3.value = "-";
      break;

    case "102":
      select2.value = "107";
      select3.value = "-";
      break;

    case "107":
      select2.value = "113";
      select3.value = "-";
      break;

    case "114":
      select2.value = "120";
      select3.value = "-";
      break;

    case "121":
      select2.value = "127";
      select3.value = "-";
      break;

    case "127":
      select2.value = "134";
      select3.value = "-";
      break;

    case "135":
      select2.value = "142";
      select3.value = "-";
      break;

    case "143":
      select2.value = "150";
      select3.value = "0.4";
      break;
    case "150":
      select2.value = "158";
      select3.value = "2.5";
      break;
    case "158":
      select2.value = "166";
      select3.value = "4.6";
      break;
    case "174":
      select2.value = "183";
      select3.value = "8.7";
      break;
    case "182":
      select2.value = "192";
      select3.value = "10.7";
      break;
    case "191":
      select2.value = "201";
      select3.value = "12.6";
      break;
    case "200":
      select2.value = "211";
      select3.value = "14.5";
      break;
    case "209":
      select2.value = "220";
      select3.value = "16.4";
      break;
    case "219":
      select2.value = "230";
      select3.value = "18.2";
      break;
    case "228":
      select2.value = "240";
      select3.value = "20.3";
      break;
    case "238":
      select2.value = "250";
      select3.value = "22.2";
    break;
      case "247":
        select2.value = "260";
        select3.value = "23.9";
      break;
    case "257":
        select2.value = "271";
        select3.value = "25.6";
      break;
    case "268":
          select2.value = "282";
          select3.value = "27.1";
      break;
    case "278":
          select2.value = "293";
          select3.value = "28.7";
      break;
    case "289":
        select2.value = "304";
        select3.value = "30.1";
      break;
    case "299":
        select2.value = "315";
        select3.value = "31.5";
      break;
    case "311":
        select2.value = "327";
        select3.value = "33.0";
      break;
    case "322":
        select2.value = "339";
        select3.value = "30.1";
      break;
    case "334":
        select2.value = "352";
        select3.value = "35.9";
      break;
    case "346":
        select2.value = "364";
        select3.value = "37.3";
      break;
    case "358":
        select2.value = "377";
        select3.value = "38.6";
      break;
    case "371":
        select2.value = "391";
        select3.value = "40.0";
      break;
    case "384":
        select2.value = "404";
        select3.value = "41.3";
      break;
    case "398":
        select2.value = "419";
        select3.value = "42.6";
      break;
    case "411":
        select2.value = "433";
        select3.value = "43.9";
      break;
    case "451":
        select2.value = "480";
        select3.value = "47.6";
      break;
    case "472":
        select2.value = "497";
        select3.value = "48.9";
      break;
    case "488":
        select2.value = "514";
        select3.value = "50.0";
      break;
    case "505":
        select2.value = "532";
        select3.value = "51.2";
      break;
    case "523":
        select2.value = "550";
        select3.value = "42.4";
      break;
    case "542":
        select2.value = "570";
        select3.value = "53.5";
      break;
    case "561":
        select2.value = "590";
        select3.value = "54.7";
      break;
    case "580":
        select2.value = "610";
        select3.value = "55.8";
      break;
    case "600":
        select2.value = "632";
        select3.value = "56.9";
      break;
    case "622":
        select2.value = "655";
        select3.value = "58.0";
      break;
      
    default:
      select2.value = "-";
      select3.value = "-";
  }

}

function updateSelectTwoValues() {
  output2 = select2.value;
  
  switch (output2) {
    case "80":
      select1.value = "76.0";
      select3.value = "-";
      break;

    case "85":
      select1.value = "80.7";
      select3.value = "-";
      break;

    case "90":
      select1.value = "85.5";
      select3.value = "-";
      break;

    case "95":
      select1.value = "90.2";
      select3.value = "-";
      break;

    case "101":
      select1.value = "96.0";
      select3.value = "-";
      break;

    case "107":
      select1.value = "102";
      select3.value = "-";
      break;

    case "113":
      select1.value = "107";
      select3.value = "-";
      break;

    case "120":
      select1.value = "114";
      select3.value = "-";
      break;

    case "127":
      select1.value = "121";
      select3.value = "-";
      break;

    case "134":
      select1.value = "127";
      select3.value = "-";
      break;

    case "142":
      select1.value = "135";
      select3.value = "-";
      break;

    case "150":
      select1.value = "143";
      select3.value = "0.4";
      break;
    case "158":
      select1.value = "150";
      select3.value = "2.5";
      break;
    case "166":
      select1.value = "158";
      select3.value = "4.6";
      break;
    case "175":
      select1.value = "166";
      select3.value = "6.7";
      break;
    case "183":
      select1.value = "174";
      select3.value = "8.7";
      break;
    case "192":
      select1.value = "182";
      select3.value = "10.7";
      break;
    case "201":
      select1.value = "191";
      select3.value = "12.6";
      break;
    case "211":
      select1.value = "200";
      select3.value = "14.5";
      break;
    case "220":
      select1.value = "209";
      select3.value = "16.4";
      break;
    case "230":
      select1.value = "219";
      select3.value = "18.2";
      break;
    case "240":
      select1.value = "228";
      select3.value = "20.3";
      break;
    case "250":
      select1.value = "238";
      select3.value = "22.2";
      break;
    case "260":
        select1.value = "247";
        select3.value = "23.9";
      break;

    case "271":
        select1.value = "257";
        select3.value = "25.6";
      break;
    case "282":
        select1.value = "268";
        select3.value = "27.1";
      break;
    case "293":
        select1.value = "278";
        select3.value = "28.7";
      break;
    case "304":
        select1.value = "289";
        select3.value = "30.1";
      break;
    case "315":
        select1.value = "299";
        select3.value = "31.5";
      break;
    case "327":
        select1.value = "311";
        select3.value = "33.0";
      break;
    case "339":
        select1.value = "322";
        select3.value = "34.5";
      break;
    case "352":
        select1.value = "334";
        select3.value = "35.9";
      break;
    case "364":
        select1.value = "346";
        select3.value = "37.3";
      break;
    case "377":
        select1.value = "358";
        select3.value = "38.6";
      break;
    case "391":
        select1.value = "371";
        select3.value = "40.0";
      break;
    case "404":
        select1.value = "384";
        select3.value = "41.3";
      break;
    case "419":
        select1.value = "398";
        select3.value = "42.6";
      break;
    case "433":
        select1.value = "411";
        select3.value = "43.9";
      break;
    case "448":
        select1.value = "426";
        select3.value = "45.1";
      break;
    case "464":
        select1.value = "411";
        select3.value = "46.4";
      break;
    case "480":
        select1.value = "451";
        select3.value = "47.6";
      break;
    case "497":
        select1.value = "472";
        select3.value = "48.9";
      break;
    case "514":
        select1.value = "488";
        select3.value = "50.0";
      break;
    case "532":
        select1.value = "505";
        select3.value = "51.2";
      break;
    case "550":
        select1.value = "523";
        select3.value = "42.4";
      break;
    case "570":
        select1.value = "542";
        select3.value = "43.5";
      break;
    case "590":
        select1.value = "561";
        select3.value = "54.7";
      break;
    case "610":
        select1.value = "580";
        select3.value = "55.8";
      break;
    case "632":
        select1.value = "600";
        select3.value = "56.9";
      break;
    case "655":
        select1.value = "622";
        select3.value = "58.0";
      break;
    default:
      select1.value = "-";
      select3.value = "-";
  }

 

}

function updateSelectThreeValues() {
  output3 = select3.value;
  switch (output3) {
   
    case "0.4":
      select2.value = "150";
      select1.value = "143";
      break;
    case "2.5":
      select2.value = "158";
      select1.value = "150";
      break;
    case "4.6":
      select2.value = "166";
      select1.value = "158";
      break;
    case "6.7":
      select2.value = "175";
      select1.value = "166";
      break;
    case "8.7":
      select2.value = "183";
      select1.value = "174";
      break;
    case "10.7":
      select2.value = "192";
      select1.value = "182";
      break;
    case "12.6":
      select2.value = "201";
      select1.value = "191";
      break;
    case "14.5":
      select2.value = "211";
      select1.value = "200";
      break;
    case "16.4":
      select2.value = "220";
      select1.value = "209";
      break;
    case "18.2":
      select2.value = "230";
      select1.value = "219";
      break;
    case "20.3":
      select2.value = "240";
      select1.value = "228";
      break;
    case "22.2":
      select2.value = "250";
      select1.value = "238";
      break;
    case "23.9":
      select2.value = "260";
      select1.value = "247";
      break;
      case "27.1":
        select2.value = "282";
        select1.value = "268";
        break;
    case "28.7":
        select2.value = "293";
        select1.value = "278";
        break;
    case "22.2":
        select2.value = "250";
        select1.value = "238";
        break;
    case "23.9":
        select2.value = "260";
        select1.value = "247";
      break;
    case "25.6":
        select2.value = "271";
        select1.value = "257";
      break;
    case "27.1":
        select2.value = "282";
        select1.value = "268";
      break;
      case "28.7":
        select2.value = "293";
        select1.value = "278";
      break;
      case "28.7":
        select2.value = "293";
        select1.value = "278";
      break;
      case "28.7":
        select2.value = "293";
        select1.alue = "278";
      break;
      case "28.7":
        select2.value = "293";
        select1.value = "178";
      break;
      case "30.1":
        select2.value = "304";
        select1.value = "289";
      break;
      case "31.5":
        select2.value = "315";
        select1.value = "299";
      break;
      case "33.0":
        select2.value = "327";
        select1.value = "311";
      break;
      case "34.5":
        select2.value = "339";
        select1.value = "322";
      break;
      case "35.9":
        select2.value = "352";
        select1.value = "334";
      break;
      case "37.3":
        select2.value = "364";
        select1.value = "346";
      break;
      case "38.6":
        select2.value = "377";
        select1.value = "358";
      break;
      case "40.0":
        select2.value = "391";
        select1.value = "371";
      break;
      case "41.3":
        select2.value = "404";
        select1.value = "384";
      break;
      case "42.6":
        select2.value = "419";
        select1.value = "398";
      break;
      case "43.9":
        select2.value = "433";
        select1.value = "411";
      break;
      case "45.1":
        select2.value = "448";
        select1.value = "426";
      break;
      case "46.4":
        select2.value = "464";
        select1.value = "441";
      break;
      case "47.6":
        select2.value = "480";
        select1.value = "451";
      break;
      case "48.9":
        select2.value = "497";
        select1.value = "472";
      break; 
      case "50.0":
        select2.value = "514";
        select1.value = "488";
      break;
      case "51.2":
        select2.value = "523";
        select1.value = "505";
      break;
      case "42.4":
        select2.value = "550";
        select1.value = "523";
      break;
      case "53.5":
        select2.value = "570";
        select1.value = "542";
      break;
      case "54.7":
        select2.value = "590";
        select1.value = "561";
      break;
      case "55.8":
        select2.value = "610";
        select1.value = "580";
      break;
      case "56.9":
        select2.value = "632";
        select1.value = "600";
      break;
      case "58.0":
        select2.value = "655";
        select1.value = "622";
      break;

    default:
      select2.value = "-";
      select1.value = "-";
  }
}

function decrement() {
  if (Number(document.getElementById("weightWant").value) <= 0) {
    return;
  }
  document.getElementById("weightWant").value =
    Number(document.getElementById("weightWant").value) - 1;
}
function increment() {
  document.getElementById("weightWant").value =
    Number(document.getElementById("weightWant").value) + 1;
}

// copy text

function copyText() {
  const input = document.getElementById("myInput"); // replace "myInput" with the ID of your input field
  console.log(input);

  navigator.clipboard.writeText(input.value);
}
