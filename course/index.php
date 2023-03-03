<?php
	require_once "db.php";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../images/tools/favicon.ico" type="image/x-icon">
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
				transform: translateX(-65%);
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
				<a href="admin">Профиль</a>
				<a href="exit.php">Выход</a>
			</div>
		</div>
	<?php endif ?>

	<header class="header">
		<div class="header__inner container">
			<a class="logo" href="#">Work<span>Flow</span></a>

			<nav class="menu">
				<ul>
					<li><a href="#about">О сервисе</a></li>
					<li><a href="#feedback">Помощь</a></li>
					<li>
						<a href="employer.php">Вакансии</a>
					</li>
					<li>
						<a href="applicant.php">Соискатели</a>
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

	<section class="hero">
		<div class="container">
			<div class="hero__inner">
				<h1>Работа найдется для каждого</h1>
				<p class="subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere delectus molestias ad vel
					quibusdam fugiat
					cum, voluptates esse, quasi corrupti quidem optio repellat beatae et.</p>
			</div>
		</div>
	</section>

	<section class="job container">
		<div class="job__inner">

			<a class="job__item" href="job/frontend.php">
				<h3 class="job__title">Frontend Разработчик</h3>
				<p class="job__subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, molestias?</p>
			</a>

			<a class="job__item" href="job/frontend.php">
				<h3 class="job__title">Backend Разработчик</h3>
				<p class="job__subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, molestias?</p>
			</a>

			<a class="job__item" href="job/frontend.php">
				<h3 class="job__title">Fullstack Разработчик</h3>
				<p class="job__subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, molestias?</p>
			</a>

			<a class="job__item" href="job/frontend.php">
				<h3 class="job__title">UI/UX Дизайнер</h3>
				<p class="job__subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, molestias?</p>
			</a>

			<a class="job__item" href="job/frontend.php">
				<h3 class="job__title">Системный Администратор</h3>
				<p class="job__subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, molestias?</p>
			</a>

			<a class="job__item" href="job/frontend.php">
				<h3 class="job__title">Разработчик Видеоигр</h3>
				<p class="job__subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, molestias?</p>
			</a>

			<a class="job__item" href="job/frontend.php">
				<h3 class="job__title">Team Lead</h3>
				<p class="job__subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, molestias?</p>
			</a>

		</div>
	</section>

	<section class="about container" id="about">
		<div class="about__inner">
			<h2>О сервисе</h2>
			<p>
				Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere delectus molestias ad vel quibusdam fugiat cum,
				voluptates esse, quasi corrupti quidem optio repellat beatae et. Lorem ipsum dolor sit amet consectetur
				adipisicing elit. Facere delectus molestias ad vel quibusdam fugiat cum, voluptates esse, quasi corrupti quidem
				optio repellat beatae et.
			</p>
			<p>
				Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere delectus molestias ad vel quibusdam fugiat cum,
				voluptates esse, quasi corrupti quidem optio repellat beatae et. Lorem ipsum dolor sit amet consectetur
				adipisicing elit. Facere delectus molestias ad vel quibusdam fugiat cum, voluptates esse, quasi corrupti quidem
				optio repellat beatae et.
			</p>
		</div>
	</section>

	<section class="feedback" id="feedback">
		<div class="container">
			<h2>Мы поможем</h2>
		</div>
		<div class="feedback__inner">
			<div class="feedback__bg"></div>

			<form action="feedback.php" method="POST">
				<input type="text" name="name" placeholder="Имя">
				<input type="text" name="email" placeholder="Почта *" required>
				<textarea name="text" placeholder="Сообщение *" required></textarea>
				<button type="submit">Отправить</button>
			</form>
		</div>
	</section>

	<footer>© 2023 WORKFLOW. Все права защищены. Разработан <a href="https://thelabuzov.github.io">THELABUZOV</a></footer>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js"></script>
</body>

</html>