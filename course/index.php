<?php
	require_once 'db.php';

	if (isset($_COOKIE['account'])) {
		$cookie = $_COOKIE['account'];

		$stmt = $pdo -> prepare("SELECT * FROM admin WHERE email = ?");
		$stmt -> execute([$cookie]);
		$admins = $stmt -> fetch();

		$stmt = $pdo -> prepare("SELECT * FROM employers WHERE email = ?");
		$stmt -> execute([$cookie]);
		$employers = $stmt -> fetch();

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
	<!-- <meta name='keywords' content='Работа, Персонал, Вакансии, Профессия, Занятие'> -->
	<meta name='author' content='thelabuzov'>
	<meta name='copyright' content='Дмитрий Лабузов'>
	<meta property='og:title' content='WORKFLOW - поиск персонала и публикация вакансий'>
	<meta property='og:description' content='Работа со всей России'>
	<!-- <meta property='og:image' content='./images/promo.webp'> -->
	<meta property='og:site_name' content='WORKFLOW - поиск персонала и публикация вакансий'>
	<meta name='twitter:site' content='thelabuzov'>
	<meta name='twitter:title' content='WORKFLOW - поиск персонала и публикация вакансий'>
	<meta name='twitter:description' content='Работа со всей России'>
	<!-- <meta name='twitter:image' content='./images/promo.webp'> -->

	<!-- Подключения -->
  <link rel='shortcut icon' href='images/tools/favicon.ico' type='image/x-icon'>
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css'>
	<link rel='stylesheet' href='assets/animate.min.css'>
	<link rel='stylesheet' href='dist/style.css'>
</head>

<body>
	<div class='loader'>
		<svg width='200' height='200' viewBox='0 0 100 100'>
			<polyline class='line' points='0,0 100,0 100,100' stroke-width='10' fill='none'></polyline>
			<polyline class='line' points='0,0 0,100 100,100' stroke-width='10' fill='none'></polyline>
			<polyline class='line line__animation' points='0,0 100,0 100,100' stroke-width='10' fill='none'></polyline>
			<polyline class='line line__animation' points='0,0 0,100 100,100' stroke-width='10' fill='none'></polyline>
		</svg>
	</div>

	<?php
		if(($_COOKIE['account'] ?? '') === ''):
	?>

	<div id='popup-login' class='overlay'>
		<a class='cancel' href='#'></a>
		<div class='popup'>
			<a class='close' href='#'>&times;</a>

			<div id='login'>
				<h2>Вход</h2>
				<form action='validation/login.php' method='post'>
					<input type='text' class='form-control' name='text' id='text' placeholder='Введите псевдоним или почту' required>
					<input type='password' class='form-control' name='password' id='password' placeholder='Введите пароль' required>
					<button type='submit' class='btn'>Вход</button>
				</form>
				<p>Нет аккаунта? <a href='index.php#popup-signup'>Зарегистрироваться</a></p>
			</div>

		</div>
	</div>

	<div id='popup-signup' class='overlay'>
		<a class='cancel' href='#'></a>
		<div class='popup'>
			<a class='close' href='#'>&times;</a>

			<div id='signup'>
				<h2>Регистрация</h2>
				<form action='validation/signup.php' method='post'>
					<input type='text' class='form-control' name='nickname' id='nickname' placeholder='Введите псевдоним' required>
					<input type='email' class='form-control' name='email' id='email' placeholder='Введите почту' required>
					<input type='password' class='form-control' name='password' id='password' placeholder='Введите пароль' required>
					<input type='password' class='form-control' name='cpassword' id='cpassword' placeholder='Повторите пароль' required>
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

	<?php else: ?>
		<style>
			.account {
				display: inline-flex;
				align-items: center;
				position: absolute;
				left: 50%;
				z-index: 2;
				font-weight: 700;
				transform: translateX(-50%);
				padding: 17px 0;
				cursor: pointer;
			}

			.account img {
				margin-right: 5px;
			}

			.account__menu {
				background-color: var(--white);
				position: absolute;
				top: 78px;
				left: 0;
				z-index: -1;
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

		<div class='account' onclick='showHide()'>
			<img src='images/tools/user.svg' alt='user' loading='lazy'>
			<?= $_COOKIE['account'] ?>

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
	<?php endif ?>

	<header class='header'>
		<div class='header__inner container'>
			<a class='logo' href='#'>Work<span>Flow</span></a>

			<nav class='menu'>
				<ul>
					<li><a href='index.php#about'>О сервисе</a></li>
					<li><a href='index.php#feedback'>Обратная связь</a></li>
					<li>
						<a href='employer.php'>Работодатели</a>
					</li>
					<li>
						<a href='applicant.php'>Соискатели</a>
					</li>
					<li>
						<a class='btn btn__account' href='index.php#popup-login'>Вход
							<img src='images/tools/account.svg' alt='account' loading='lazy'>
						</a>
					</li>
					<li>
						<a class='btn btn__account' href='index.php#popup-signup'>Регистрация
							<img src='images/tools/account.svg' alt='account' loading='lazy'>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>

	<section class='hero'>
		<div class='container'>
			<div class='hero__inner'>
				<div>
					<h1>Работа со <span>всей</span> россии</h1>
					<p class='subtitle'>
						Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere delectus molestias ad vel quibusdam fugiat cum, voluptates esse, quasi corrupti quidem optio repellat beatae et.
					</p>
				</div>
			</div>
		</div>

		<div class="wave">
			<div class="wave__inner"></div>
		</div>
	</section>

	<section class='container'>
		<div class='job__slider'>
			<div class='swiper job'>
				<div class='swiper-wrapper'>
					<a class='swiper-slide job__item' href='https://google.com' target='_blank'>
						<img class='job__image' src='images/tools/google.svg' alt='google' loading='lazy'>
						<p>Google</p>
					</a>

					<a class='swiper-slide job__item' href='https://netflix.com' target='_blank'>
						<img class='job__image job__image--wide' src='images/tools/netflix.svg' alt='netflix' loading='lazy'>
						<p>Netflix</p>
					</a>

					<a class='swiper-slide job__item' href='https://instagram.com' target='_blank'>
						<img class='job__image' src='images/tools/instagram.svg' alt='instagram' loading='lazy'>
						<p>Instagram</p>
					</a>

					<a class='swiper-slide job__item' href='https://facebook.com' target='_blank'>
						<img class='job__image' src='images/tools/facebook.svg' alt='facebook' loading='lazy'>
						<p>Facebook</p>
					</a>

					<a class='swiper-slide job__item' href='https://britishcouncil.org' target='_blank'>
						<img class='job__image job__image--wide' src='images/tools/british-council.svg' alt='british-council' loading='lazy'>
						<p>British Council</p>
					</a>

					<a class='swiper-slide job__item' href='https://twitter.com' target='_blank'>
						<img class='job__image' src='images/tools/twitter.svg' alt='twitter' loading='lazy'>
						<p>Twitter</p>
					</a>

					<a class='swiper-slide job__item' href='https://google.com' target='_blank'>
						<img class='job__image' src='images/tools/google.svg' alt='google' loading='lazy'>
						<p>Google</p>
					</a>

					<a class='swiper-slide job__item' href='https://netflix.com' target='_blank'>
						<img class='job__image job__image--wide' src='images/tools/netflix.svg' alt='netflix' loading='lazy'>
						<p>Netflix</p>
					</a>

					<a class='swiper-slide job__item' href='https://instagram.com' target='_blank'>
						<img class='job__image' src='images/tools/instagram.svg' alt='instagram' loading='lazy'>
						<p>Instagram</p>
					</a>

					<a class='swiper-slide job__item' href='https://facebook.com' target='_blank'>
						<img class='job__image' src='images/tools/facebook.svg' alt='facebook' loading='lazy'>
						<p>Facebook</p>
					</a>

					<a class='swiper-slide job__item' href='https://britishcouncil.org' target='_blank'>
						<img class='job__image job__image--wide' src='images/tools/british-council.svg' alt='british-council' loading='lazy'>
						<p>British Council</p>
					</a>

					<a class='swiper-slide job__item' href='https://twitter.com' target='_blank'>
						<img class='job__image' src='images/tools/twitter.svg' alt='twitter' loading='lazy'>
						<p>Twitter</p>
					</a>
				</div>

				<div class='swiper-button-prev'></div>
				<div class='swiper-button-next'></div>
			</div>
		</div>
	</section>

	<section class='description container' id='about'>
		<div>
			<h2>О сервисе</h2>
			<p>
				Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatum voluptas perferendis cupiditate! At vero molestiae sint, voluptates adipisci eius fugit odit itaque aliquid deserunt illum aperiam rem debitis voluptas esse eveniet quam ut quo laudantium sit est nesciunt! Aperiam at harum ullam, modi alias dicta eius hic, itaque ut debitis quo dolorem! Architecto fuga et hic quo accusamus aperiam reprehenderit exercitationem perferendis, perspiciatis sint ad id, nulla veniam in mollitia, rerum cupiditate enim ipsa quasi nemo porro consectetur quis doloribus ut. Voluptatem eveniet obcaecati, officiis excepturi debitis velit veniam doloremque repudiandae rerum omnis quo provident fugit dolore ex molestias laborum?
			</p>
		</div>

		<div class='swiper worker wow animate__animated animate__slideInRight'>
			<div class='swiper-wrapper'>
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

	<section class='container'>
		<h2>Обратная связь</h2>

		<section class='feedback' id='feedback'>
			<iframe src='https://yandex.ru/map-widget/v1/?um=constructor%3A1a16b812f78421035c4bd25ac085af5fc4b42684b9a6442c70bc9730ebfe2212&amp;source=constructor' width='1100' height='600' frameborder='0' loading='lazy'></iframe>

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

	<footer>© 2023 WORKFLOW. Все права защищены. Разработан <a href='https://thelabuzov.github.io'>THELABUZOV</a></footer>

	<script src='https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js'></script>
	<script src='https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js'></script>
	<script src='assets/wow.min.js'></script>
	<script src='dist/script.js'></script>
	<script>
		new WOW().init();

		$(document).ready(function() {
			//E-mail Ajax Send
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
	</script>
</body>

</html>
