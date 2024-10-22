// Событие нажатия гамбургера
$(function() {
  let menu = $('.menu__outer');
  $('.menu__toggle').bind('click', function() {
    menu.toggleClass('menu__open');
    return false;
  })
})

// Отправка сообщения на почту
$(document).ready(function() {
  // E-mail Ajax Send
  $('form').submit(function() {
    var th = $(this);
    $.ajax({
      type: 'POST',
      url: 'validation/mail.php',
      data: th.serialize()
    }).done(function() {
      alert('Сообщение отправлено');
      setTimeout(function() {
        // Done Functions
        th.trigger('reset');
      }, 1000);
    });
    return false;
  });
});

// Загрузка страницы
window.addEventListener('load', () => {
  setTimeout(() => {
    document.querySelector('.loader').classList.add('loader--hidden');
  }, 2000);
});

// Слайдер компаний
const job = new Swiper('.job', {
  spaceBetween: 30,
  slidesPerView: 2,
  loop: true,

  autoplay: {
    delay: 2000
  },

  breakpoints: {
    640: {
      slidesPerView: 4,
    },
    1200: {
      slidesPerView: 6,
    }
  },

  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev'
  }
});

// Анимация в фокусе
new WOW().init();

// Слайдер работников
const workers = new Swiper(".worker", {
  effect: "cards",
  grabCursor: true
});

// Создание parallax в положении мыши
const mouse = new THREE.Vector2();
const target = new THREE.Vector2();
const windowHalf = new THREE.Vector2(window.innerWidth / 2, window.innerHeight / 2);

// Положение 3D модели шара
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(50, window.innerWidth / window.innerHeight, 1, 0);
const renderer = new THREE.WebGLRenderer({ alpha: true });
document.addEventListener( 'mousemove', onMouseMove, false )
renderer.setClearColor(0x000000, 0);
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);

// Создание 3D модели шара
const geometry = new THREE.SphereGeometry(1.5, 15, 15);
const material = new THREE.MeshBasicMaterial({ 
  wireframe: true, 
  color: 0xffc105
});
const object = new THREE.Mesh(geometry, material);
scene.add(object);
object.position.set(2, 0, 0);
camera.position.z = 5;

// Вызов parallax в положении мыши
function onMouseMove( event ) {
	mouse.x = ( event.clientX - windowHalf.x );
	mouse.y = ( event.clientY - windowHalf.x );
}

// Анимация 3D модели шара
function animate() {
  requestAnimationFrame(animate);

  target.x = ( 1 - mouse.x ) * 0.00008;
  target.y = ( 1 - mouse.y ) * 0.00008;

  camera.rotation.x += 0.05 * ( target.y - camera.rotation.x );
  camera.rotation.y += 0.05 * ( target.x - camera.rotation.y );

  object.rotation.x += 0.0008;
  object.rotation.y += 0.002;

  renderer.render(scene, camera);
};
animate();

// Событие наведения dropdown меню
function showHide() {
	let menu = document.getElementById('menu');
  menu.classList.toggle('hidden');
}

// Событие фильтра вакансий
function filterList() {
  let input, filter, box, div, search, i, txtValue;
  input = document.getElementById('input');
  filter = input.value.toUpperCase();
  box = document.getElementById('job');
  div = box.getElementsByClassName('job__item');

  for (i = 0; i < div.length; i++) {
    search = div[i].getElementsByClassName('search')[0];
    txtValue = search.textContent || search.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      div[i].style.display = '';
    } else {
      div[i].style.display = 'none';
    }
  }
}
