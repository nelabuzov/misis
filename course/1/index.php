<?php
	require_once 'db.php';

	// Условие если вошел пользователь
	if (isset($_COOKIE['account'])) {
		$cookie = $_COOKIE['account'];

		// Проверка наличия админа
		$stmt = $pdo -> prepare("SELECT * FROM admin WHERE email = ?");
		$stmt -> execute([$cookie]);
		$admins = $stmt -> fetch();

		// Проверка наличия работодателя
		$stmt = $pdo -> prepare("SELECT * FROM employers WHERE email = ?");
		$stmt -> execute([$cookie]);
		$employers = $stmt -> fetch();

		// Проверка наличия соискателя
		$stmt = $pdo -> prepare("SELECT * FROM applicants WHERE email = ?");
		$stmt -> execute([$cookie]);
		$applicants = $stmt -> fetch();
	}
?>

<!DOCTYPE html>
<html lang='ru'>

<head>
	<meta charset='UTF-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>WORKFLOW - поиск персонала и публикация вакансий</title>

	<!-- SEO -->
	<meta name='description' content='Работа со всей России'>
	<meta name='keywords' content='Работа, Персонал, Вакансии, Профессия, Деньги'>
	<meta name='author' content='thelabuzov'>
	<meta name='copyright' content='Дмитрий Лабузов'>
	<meta property='og:title' content='WORKFLOW - поиск персонала и публикация вакансий'>
	<meta property='og:description' content='Работа со всей России'>
	<meta property='og:image' content='images/content/promo.png'>
	<meta property='og:site_name' content='WORKFLOW - поиск персонала и публикация вакансий'>
	<meta name='twitter:site' content='thelabuzov'>
	<meta name='twitter:title' content='WORKFLOW - поиск персонала и публикация вакансий'>
	<meta name='twitter:description' content='Работа со всей России'>
	<meta name='twitter:image' content='images/content/promo.png'>

	<!-- Подключение внешних объектов -->
  <link rel='shortcut icon' href='images/tools/favicon.ico' type='image/x-icon'>
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css'>
	<link rel='stylesheet' href='assets/css/animate.css'>
	<link rel='stylesheet' href='dist/style.css'>
</head>

<body>
	<!-- Загрузка страницы -->
	<div class='loader'>
		<svg width='200' height='200' viewBox='0 0 100 100'>
			<polyline class='line' points='0,0 100,0 100,100' stroke-width='10' fill='none'></polyline>
			<polyline class='line' points='0,0 0,100 100,100' stroke-width='10' fill='none'></polyline>
			<polyline class='line line__animation' points='0,0 100,0 100,100' stroke-width='10' fill='none'></polyline>
			<polyline class='line line__animation' points='0,0 0,100 100,100' stroke-width='10' fill='none'></polyline>
		</svg>
	</div>

	<!-- Условие для гостя -->
	<?php
		if(($_COOKIE['account'] ?? '') === ''):
	?>

	<!-- Попап для входа -->
	<div id='popup-login' class='overlay'>
		<a class='cancel' href='#'></a>
		<div class='popup'>
			<a class='close' href='#'>&times;</a>

			<div id='login'>
				<h2>Вход</h2>
				<form action='validation/login.php' method='post'>
					<input type='text' class='form-control' name='text' id='text' placeholder='Введите псевдоним или почту *' required>
					<input type='password' class='form-control' name='password' id='password' placeholder='Введите пароль *' required>
					<button type='submit' class='btn'>Вход</button>
				</form>
				<p>Нет аккаунта? <a href='index.php#popup-signup'>Зарегистрироваться</a></p>
			</div>

		</div>
	</div>

	<!-- Попап для регистрации -->
	<div id='popup-signup' class='overlay'>
		<a class='cancel' href='#'></a>
		<div class='popup'>
			<a class='close' href='#'>&times;</a>

			<div id='signup'>
				<h2>Регистрация</h2>
				<form action='validation/signup.php' method='post'>
					<input type='text' class='form-control' name='nickname' id='nickname' placeholder='Введите псевдоним *' required>
					<input type='email' class='form-control' name='email' id='email' placeholder='Введите почту *' required>
					<input type='password' class='form-control' name='password' id='password' placeholder='Введите пароль *' required>
					<input type='password' class='form-control' name='cpassword' id='cpassword' placeholder='Повторите пароль *' required>
          <div>
          	<label for='employer'><input type='radio' name='category' id='employer' value='1' checked>Работодатель</label>
						<label for='applicant'><input type='radio' name='category' id='applicant' value='2'>Соискатель</label>
					</div>
					<button type='submit' class='btn'>Регистрация</button>
				</form>
				<p>Уже зарегистрированы? <a href="index.php#popup-login">Войти</a></p>
			</div>

		</div>
	</div>

	<!-- Условие для пользователя -->
	<?php else: ?>
		<!-- Выравнивание кнопки пользователя -->
		<style>
			.account {
				display: inline-flex;
				align-items: center;
				position: absolute;
				right: 0;
				z-index: 2;
				font-weight: 700;
				margin-right: 100px;
				padding: 17px 0;
				cursor: pointer;
			}

			.account__menu {
				background-color: var(--white);
				position: absolute;
				top: 77px;
				right: 0;
				transition: var(--transition-min);
				border-radius: 0 0 10px 10px;
			}

			.account__menu a {
				display: block;
				padding: 0 20px;
				margin: 20px 0;
			}

			.btn__account {
				display: none;
			}
		</style>

		<!-- Кнопка пользователя -->
		<div class='account__outer container'>
			<div class='account' onclick='showHide()'>
				<img src='images/tools/user.svg' alt='user' loading='lazy'>

				<!-- Ссылка типа профиля -->
				<div class='account__menu hidden' id='menu'>

					<?php if($employers): ?>
						<a href='account/employers/index.php'>Профиль</a>

					<?php elseif($applicants): ?>
						<a href='account/applicants/index.php'>Профиль</a>

					<?php else: ?>
						<a href='account/admin/index.php'>Профиль</a>

					<?php endif ?>

					<a href='exit.php'>Выход</a>
				</div>
			</div>
		</div>
	<?php endif ?>

	<!-- Шапка -->
	<header class='header__outer header'>
		<div class="menu__top">
			<div class='header__inner container'>
				<a class='logo' href='#'>Work<span>Flow</span></a>

				<!-- Гамбургер -->
				<div class='menu__outer'>
					<a href="#" class="menu__toggle">☰</a>

					<!-- Меню гамбургера -->
					<nav class="menu__box">
						<ul>
							<li>
								<a href='index.php#about'>О сервисе</a>
								<a href='index.php#feedback'>Обратная связь</a>
							</li>
							<li>
								<a href='employer.php'>Работодатели</a>
								<a href='applicant.php'>Соискатели</a>
							</li>
							<li>
								<a class='btn btn__account' href='index.php#popup-login'>Вход
									<img src='images/tools/account.svg' alt='account' loading='lazy'>
								</a>
								<a class='btn btn__account' href='index.php#popup-signup'>Регистрация
									<img src='images/tools/account.svg' alt='account' loading='lazy'>
								</a>
							</li>
						</ul>
					</nav>
				</div>

				<!-- Кнопки для аккаунта -->
				<div class='btns'>
					<a class='btn btn__account' href='index.php#popup-login'>Вход
						<img src='images/tools/account.svg' alt='account' loading='lazy'>
					</a>
					<a class='btn btn__account' href='index.php#popup-signup'>Регистрация
						<img src='images/tools/account.svg' alt='account' loading='lazy'>
					</a>
				</div>
			</div>
		</div>

		<!-- Нижнее меню шапки -->
		<div class='menu'>
			<nav class='header__inner container'>
				<ul>
					<li>
						<a href='index.php#about'>О сервисе</a>
					</li>
					<li>
						<a href='index.php#feedback'>Обратная связь</a>
					</li>
					<li>
						<a href='employer.php'>Работодатели</a>
					</li>
					<li>
						<a href='applicant.php'>Соискатели</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>

	<!-- Заглавная секция -->
	<section class='hero'>
		<div class='container'>
			<div class='hero__inner'>
				<div>
					<h1>Работа со <span>всей</span> России</h1>
					<p>
						Экономические возможности во всероссийской рабочей площадке, где компании всех размеров и независимые таланты со всего мира встречаются, чтобы добиться невероятных результатов
					</p>
				</div>
			</div>
		</div>

		<!-- Волна для перехода -->
		<div class="wave">
			<div class="wave__inner"></div>
		</div>
	</section>

	<!-- Слайдер компаний -->
	<section class='slider container'>
		<h2>Работают с нами</h2>

		<div class='job__slider'>
			<div class='swiper job'>
				<div class='swiper-wrapper'>
					<!-- Элемент слайдера компаний -->
					<a class='swiper-slide job__item' href='https://google.com' target='_blank'>
						<div>
							<img class='job__image' src='images/tools/google.svg' alt='google' loading='lazy'>
							<p>Google</p>
						</div>
					</a>

					<!-- Элемент слайдера компаний -->
					<a class='swiper-slide job__item' href='https://netflix.com' target='_blank'>
						<div>
							<img class='job__image job__image--wide' src='images/tools/netflix.svg' alt='netflix' loading='lazy'>
							<p>Netflix</p>
						</div>
					</a>

					<!-- Элемент слайдера компаний -->
					<a class='swiper-slide job__item' href='https://instagram.com' target='_blank'>
						<div>
							<img class='job__image' src='images/tools/instagram.svg' alt='instagram' loading='lazy'>
							<p>Instagram</p>
						</div>
					</a>

					<!-- Элемент слайдера компаний -->
					<a class='swiper-slide job__item' href='https://facebook.com' target='_blank'>
						<div>
							<img class='job__image' src='images/tools/facebook.svg' alt='facebook' loading='lazy'>
							<p>Facebook</p>
						</div>
					</a>

					<!-- Элемент слайдера компаний -->
					<a class='swiper-slide job__item' href='https://britishcouncil.org' target='_blank'>
						<div>
							<img class='job__image job__image--wide' src='images/tools/british-council.svg' alt='british-council' loading='lazy'>
							<p>British Council</p>
						</div>
					</a>

					<!-- Элемент слайдера компаний -->
					<a class='swiper-slide job__item' href='https://twitter.com' target='_blank'>
						<div>
							<img class='job__image' src='images/tools/twitter.svg' alt='twitter' loading='lazy'>
							<p>Twitter</p>
						</div>
					</a>

					<!-- Элемент слайдера компаний -->
					<a class='swiper-slide job__item' href='https://google.com' target='_blank'>
						<div>
							<img class='job__image' src='images/tools/google.svg' alt='google' loading='lazy'>
							<p>Google</p>
						</div>
					</a>

					<!-- Элемент слайдера компаний -->
					<a class='swiper-slide job__item' href='https://netflix.com' target='_blank'>
						<div>
							<img class='job__image job__image--wide' src='images/tools/netflix.svg' alt='netflix' loading='lazy'>
							<p>Netflix</p>
						</div>
					</a>

					<!-- Элемент слайдера компаний -->
					<a class='swiper-slide job__item' href='https://instagram.com' target='_blank'>
						<div>
							<img class='job__image' src='images/tools/instagram.svg' alt='instagram' loading='lazy'>
							<p>Instagram</p>
						</div>
					</a>

					<!-- Элемент слайдера компаний -->
					<a class='swiper-slide job__item' href='https://facebook.com' target='_blank'>
						<div>
							<img class='job__image' src='images/tools/facebook.svg' alt='facebook' loading='lazy'>
							<p>Facebook</p>
						</div>
					</a>

					<!-- Элемент слайдера компаний -->
					<a class='swiper-slide job__item' href='https://britishcouncil.org' target='_blank'>
						<div>
							<img class='job__image job__image--wide' src='images/tools/british-council.svg' alt='british-council' loading='lazy'>
							<p>British Council</p>
						</div>
					</a>

					<!-- Элемент слайдера компаний -->
					<a class='swiper-slide job__item' href='https://twitter.com' target='_blank'>
						<div>
							<img class='job__image' src='images/tools/twitter.svg' alt='twitter' loading='lazy'>
							<p>Twitter</p>
						</div>
					</a>
				</div>

				<!-- Переключатели слайдера компаний -->
				<div class='swiper-button-prev'></div>
				<div class='swiper-button-next'></div>
			</div>
		</div>
	</section>

	<!-- Описание сервиса -->
	<section class='description container' id='about'>
		<div class='description__inner'>
			<h2>О сервисе</h2>
			<p>
				WORKFLOW это площадка для подбора работодателей и соискателей, объединяющая пользователей со всей России. Работодатели могут нанимать соискателей для выполнения работы в различных областях, как разработка программного обеспечения, написание текстов и тому подобные, а соискатели устроится на перспективную работу
			</p>
		</div>

		<!-- Слайдер работников -->
		<div class='swiper worker wow animate__animated animate__slideInRight'>
			<div class='swiper-wrapper'>
				<!-- Элемент слайдера работников -->
				<div class='swiper-slide worker__item'>
					<img src='images/content/banners/user-1.png' alt='banner-user-1' loading='lazy'>
					<div class='worker__stars'>
						<img src='images/tools/star.svg' alt='star-1' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-2' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-3' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-4' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-5' loading='lazy'>
					</div>
				</div>

				<!-- Элемент слайдера работников -->
				<div class='swiper-slide worker__item'>
					<img src='images/content/banners/user-2.png' alt='banner-user-2' loading='lazy'>
					<div class='worker__stars'>
						<img src='images/tools/star.svg' alt='star-1' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-2' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-3' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-4' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-5' loading='lazy'>
					</div>
				</div>

				<!-- Элемент слайдера работников -->
				<div class='swiper-slide worker__item'>
					<img src='images/content/banners/user-3.png' alt='banner-user-3' loading='lazy'>
					<div class='worker__stars'>
						<img src='images/tools/star.svg' alt='star-1' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-2' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-3' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-4' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-5' loading='lazy'>
					</div>
				</div>

				<!-- Элемент слайдера работников -->
				<div class='swiper-slide worker__item'>
					<img src='images/content/banners/user-4.png' alt='banner-user-4' loading='lazy'>
					<div class='worker__stars'>
						<img src='images/tools/star.svg' alt='star-1' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-2' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-3' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-4' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-5' loading='lazy'>
					</div>
				</div>

				<!-- Элемент слайдера работников -->
				<div class='swiper-slide worker__item'>
					<img src='images/content/banners/user-5.png' alt='banner-user-5' loading='lazy'>
					<div class='worker__stars'>
						<img src='images/tools/star.svg' alt='star-1' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-2' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-3' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-4' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-5' loading='lazy'>
					</div>
				</div>

				<!-- Элемент слайдера работников -->
				<div class='swiper-slide worker__item'>
					<img src='images/content/banners/user-6.png' alt='banner-user-6' loading='lazy'>
					<div class='worker__stars'>
						<img src='images/tools/star.svg' alt='star-1' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-2' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-3' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-4' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-5' loading='lazy'>
					</div>
				</div>

				<!-- Элемент слайдера работников -->
				<div class='swiper-slide worker__item'>
					<img src='images/content/banners/user-7.png' alt='banner-user-7' loading='lazy'>
					<div class='worker__stars'>
						<img src='images/tools/star.svg' alt='star-1' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-2' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-3' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-4' loading='lazy'>
						<img src='images/tools/star.svg' alt='star-5' loading='lazy'>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Секция обратной связи -->
	<section class='feedback__outer' id='feedback'>
		<h2>Обратная связь</h2>

		<section class='feedback'>
			<!-- Интерактивная карта -->
			<iframe src='https://yandex.ru/map-widget/v1/?um=constructor%3A1a16b812f78421035c4bd25ac085af5fc4b42684b9a6442c70bc9730ebfe2212&amp;source=constructor' loading='lazy'></iframe>

				<!-- Форма -->
			<div class='feedback__inner'>
				<form action='index.php' method='post'>
					<input type="hidden" name='project_name' value='WORKFLOW'>
					<input type="hidden" name='admin_email' value='pozetiv4ik171@yandex.ru'>
					<input type="hidden" name='form_subject' value='Обратная связь'>

					<input type='text' name='Имя' placeholder='Имя'>
					<input type='text' name='Почта' placeholder='Почта *' required>
					<textarea name='Сообщение' placeholder='Сообщение *' required></textarea>
					<button type='submit'>Отправить</button>
				</form>
			</div>
		</section>
	</section>

	<!-- Подвал -->
	<footer>© 2023 WORKFLOW. Все права защищены. Разработан <a href='https://thelabuzov.github.io'>THELABUZOV</a></footer>

	<!-- Скрипты -->
	<script src='https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js'></script>
	<script src='https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js'></script>
	<script src='assets/js/wow.min.js'></script>
	<script src='dist/script.js'></script>
</body>

</html>
