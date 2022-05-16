const swiper = new Swiper('.swiper', {
  navigation: {
    nextEl: '.arrows__item--next',
    prevEl: '.arrows__item--prev',
  },

  keyboard: {
    enabled: true,
    onlyInViewport: false,
    pageUpDown: true,
  },

  simulateTouch: true,
  grabCursor: true,
  spaceBetween: 20,
  slidesPerView: 'auto',
  slidesPerGroup: 1,

  // mousewheel: {
  //   sensitivity: 1,
  //   eventsTarget: ".swiper-slide"
  // },

  watchOverflow: true,

  speed: 600,


  breakpoints: {
    768: {
      slidesPerGroup: 2,
    }
  }

});


//set cookie

const cookies_box = document.getElementById('cookies_box'),
cookies_button = document.getElementById('cookies_button');

cookies_button.addEventListener('click',function(){
  document.cookie = "CookieBy=EniseyConsulting; expires="+ new Date(2023, 0, 1).toUTCString();

  // document.cookie = "Name=John; max-age="+60*60*24*30;
  // document.cookie = "LastName=Deo; max-age="+60*60*24*30;

  if(document.cookie){
    cookies_box.classList.add('hide');
  }
})

function getCookieName(name){
  var r = document.cookie.match("\\b" + name + "=([^;]*)\\b");
  return r ? r[1]:'';
}

var getCookieName = getCookieName('CookieBy');

if(getCookieName == 'EniseyConsulting') {
  cookies_box.classList.add('hide');
}


//disabled button in form

let tel = document.getElementById('form_tel');
let formBtn = document.getElementById('button_contacts');

formBtn.setAttribute('disabled', true);

tel.oninput = function(tel){
  let length = this.value.length
  if (length <=16 && length >= 11){
    formBtn.removeAttribute('disabled');
  }else{
    formBtn.setAttribute('disabled', true);
  }
}

