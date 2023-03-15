<?php
	require_once "db.php";

	if (isset($_COOKIE['account'])) {
		$email = $_COOKIE['account'];

		$stmt = $pdo -> prepare('SELECT * FROM admin WHERE email = ?');
		$stmt -> execute([$email]);
		$admin = $stmt -> fetch();

		$stmt = $pdo -> prepare('SELECT * FROM employer WHERE email = ?');
		$stmt -> execute([$email]);
		$employer = $stmt -> fetch();
	
		$stmt = $pdo -> prepare('SELECT * FROM applicant WHERE email = ?');
		$stmt -> execute([$email]);
		$applicant = $stmt -> fetch();
	}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="images/tools/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="dist/style.css">
	<script defer src="dist/script.js"></script>
	<title>Work Flow - поиск персонала и публикация вакансий</title>
</head>

<body>
	<?php
		if (($_COOKIE['account'] ?? '') === ''):
	?>

	<div id="popup" class="overlay">
		<a class="cancel" href="#"></a>
		<div class="popup">
			<a class="close" href="#">&times;</a>

			<div class="popup__inner" id="login">
				<h2>Вход</h2>
				<form action="validation/login.php" method="post">
					<input type="email" class="form-control" name="email" id="email" placeholder="Введите почту" required>
					<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль" required>
					<button type="submit" class="btn">Вход</button>
				</form>
			</div>

			<div class="popup__inner" id="signup">
				<h2>Регистрация</h2>
				<form action="validation/signup.php" method="post">
					<input type="email" class="form-control" name="email" id="email" placeholder="Введите почту" required>
					<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль" required>
          <div>
          	<label for="employer"><input type="radio" name="category" id="employer" value="1" checked>Работодатель</label>
						<label for="applicant"><input type="radio" name="category" id="applicant" value="2">Соискатель</label>
					</div>
					<button type="submit" class="btn">Регистрация</button>
				</form>
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
				transform: translateX(-170%);
				/* transform: translateX(-210%); */
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
				transition: .3s;
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

		<div class="account" onclick="showHide()">
			<img src="images/tools/user.svg" alt="user">
			<?=$_COOKIE['account']?>

			<div class="account__menu hidden" id="menu">

				<?php if ($employer): ?>
					<a href="admin/employer.php">Профиль</a>

				<?php elseif ($applicant): ?>
					<a href="admin/applicant.php">Профиль</a>

				<?php else: ?>
					<a href="admin">Профиль</a>

				<?php endif ?>

				<a href="exit.php">Выход</a>
			</div>
		</div>
	<?php endif ?>

	<header class="header">
		<div class="header__inner container">
			<a class="logo" href="./">Work<span>Flow</span></a>

			<nav class="menu">
				<ul>
					<li><a href="./#about">О сервисе</a></li>
					<li><a href="./#feedback">Помощь</a></li>
					<li>
						<a href="#">Вакансии</a>
					</li>
					<li>
						<a href="applicant.php">Соискатели</a>
					</li>
					<li>
						<input type="text" placeholder="Специальность" id="input" onkeyup="filterList()">
					</li>
					<li>
						<a class="btn btn__account" href="#popup">Аккаунт
							<img src="images/tools/account.svg" alt="account">
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>

	<main class="search container">
		<!-- <aside class="aside">
			<label for="view" class="aside__box">
				<h3>Исключения:</h3>
				<input type="text" id="view" name="view" placeholder="Введите что исключить">
			</label>

			<div class="aside__box">
				<h3>Опыт работы:</h3>
				<label for="exp-one"><input type="checkbox" id="exp-one" name="exp" value="0">Без опыта</label>
				<label for="exp-two"><input type="checkbox" id="exp-two" name="exp" value="1-2">1-2 года</label>
				<label for="exp-three"><input type="checkbox" id="exp-three" name="exp" value="3-4">3-4 года</label>
				<label for="exp-four"><input type="checkbox" id="exp-four" name="exp" value="3-4">Более 4 лет</label>
			</div>

			<div class="aside__box">
				<h3>Занятость:</h3>
				<label for="work-one"><input type="checkbox" id="work-one" name="work" value="part">Подработка</label>
				<label for="work-two"><input type="checkbox" id="work-two" name="work" value="full">Полный день</label>
				<label for="work-three"><input type="checkbox" id="work-three" name="work" value="period">Частичная занятось</label>
			</div>

			<div class="aside__box">
				<h3>Регион:</h3>
				<label for="geo-one"><input type="checkbox" id="geo-one" name="geo" value="moskow">Москва</label>
				<label for="geo-two"><input type="checkbox" id="geo-two" name="geo" value="belgorod">Белгород</label>
				<label for="geo-three"><input type="checkbox" id="geo-three" name="geo" value="kursk">Курск</label>
				<label for="geo-four"><input type="checkbox" id="geo-four" name="geo" value="voronezh">Воронеж</label>
				<label for="geo-five"><input type="checkbox" id="geo-five" name="geo" value="stary-oskol">Старый Оскол</label>
			</div>
		</aside> -->

		<article class="article" id="article">
			<div class="article__box">
				<div class="price">50 000 - 55 000 руб.</div>
				<h2>Frontend Разработчик</h2>
				<div class="search">Yandex (Москва)</div>
				<p>
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, vero minima distinctio vitae ad molestiae excepturi ducimus fuga doloremque exercitationem asperiores, et earum temporibus. Cupiditate nesciunt similique quibusdam ratione facere.
				</p>
				<div>
					<!-- <a href="job/frontend.php" class="btn">Откликнуться</a> -->
					<a href="tel:88005553535">+7 (800) 555-35-35</a>
				</div>
			</div>

			<div class="article__box">
				<div class="price">35 000 - 45 000 руб.</div>
				<h2>Backend Разработчик</h2>
				<div class="search">МИСиС (Старый Оскол)</div>
				<p>
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, vero minima distinctio vitae ad molestiae excepturi ducimus fuga doloremque exercitationem asperiores, et earum temporibus. Cupiditate nesciunt similique quibusdam ratione facere.
				</p>
				<div>
					<!-- <a href="job/frontend.php" class="btn">Откликнуться</a> -->
					<a href="tel:82004688000">+7 (200) 468-80-00</a>
				</div>
			</div>

			<div class="article__box">
				<div class="price">50 000 - 75 000 руб.</div>
				<h2>Fullstack Разработчик</h2>
				<div class="search">Microsoft (Воронеж)</div>
				<p>
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, vero minima distinctio vitae ad molestiae excepturi ducimus fuga doloremque exercitationem asperiores, et earum temporibus. Cupiditate nesciunt similique quibusdam ratione facere.
				</p>
				<div>
					<!-- <a href="job/frontend.php" class="btn">Откликнуться</a> -->
					<a href="tel:89006663333">+7 (900) 666-33-33</a>
				</div>
			</div>
		</article>
	</main>

	<footer>© 2023 WORKFLOW. Все права защищены. Разработан <a href="https://thelabuzov.github.io">THELABUZOV</a></footer>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js"></script>
</body>