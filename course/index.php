<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="dist/style.css">
	<script defer src="dist/script.js"></script>
	<title>Workflow | Поиск для работы</title>
</head>

<body>
	<?php
		if($_COOKIE['account'] == ''):
	?>

	<div id="popup" class="overlay">
		<a class="cancel" href="#"></a>
		<div class="popup">
			<a class="close" href="#">&times;</a>

			<h2>Регистрация</h2>
			<form action="validation/check.php" method="post">
				<input type="email" class="form-control" name="email" id="email" placeholder="Введите почту">
				<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль">
				<button type="submit" class="btn">Регистрация</button>
			</form>

			<h2>Вход</h2>
			<form action="validation/auth.php" method="post">
				<input type="email" class="form-control" name="email" id="email" placeholder="Введите почту">
				<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль">
				<button type="submit" class="btn">Вход</button>
			</form>
		</div>
	</div>

	<?php else: ?>
		<?=$_COOKIE['account']?>
		<a href="exit.php">
			<img src="images/tools/user.svg" alt="user">
		</a>
	<?php endif ?>

	<header class="header">
		<div class="header__inner container">
			<a class="logo" href="index.html">Work<span>flow</span></a>

			<nav class="menu">
				<ul>
					<li><a href="#">О сервисе</a></li>
					<li><a href="#">Помощь</a></li>
					<li><input type="text" placeholder="Поиск"></li>
					<li>
						<a class="btn" href="#popup">Вход
							<img src="images/tools/account.svg" alt="account/user.svg">
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>

	<section class="hero">
		<div class="container">
			<div class="hero__inner">
				<h1>Работа мечты здесь</h1>
				<p class="subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere delectus molestias ad vel
					quibusdam fugiat
					cum, voluptates esse, quasi corrupti quidem optio repellat beatae et.</p>
			</div>
		</div>
	</section>

	<section class="job container">
		<div class="job__inner">

			<a class="job__item" href="job.html">
				<h3 class="job__title">Frontend Developer</h3>
				<p class="job__subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, molestias?</p>
			</a>

			<a class="job__item" href="job.html">
				<h3 class="job__title">Backend Developer</h3>
				<p class="job__subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, molestias?</p>
			</a>

			<a class="job__item" href="job.html">
				<h3 class="job__title">Fullstack Developer</h3>
				<p class="job__subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, molestias?</p>
			</a>

			<a class="job__item" href="job.html">
				<h3 class="job__title">UI/UX Designer</h3>
				<p class="job__subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, molestias?</p>
			</a>

			<a class="job__item" href="job.html">
				<h3 class="job__title">Frontend Developer</h3>
				<p class="job__subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, molestias?</p>
			</a>

			<a class="job__item" href="job.html">
				<h3 class="job__title">Backend Developer</h3>
				<p class="job__subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, molestias?</p>
			</a>

			<a class="job__item" href="job.html">
				<h3 class="job__title">Fullstack Developer</h3>
				<p class="job__subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, molestias?</p>
			</a>

			<a class="job__item" href="job.html">
				<h3 class="job__title">UI/UX Designer</h3>
				<p class="job__subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, molestias?</p>
			</a>

		</div>
	</section>

	<section class="about container">
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

	<section class="feedback">
		<div class="container">
			<h2>Мы поможем</h2>
		</div>
		<div class="feedback__inner">
			<div class="feedback__bg"></div>

			<form action="#" method="POST">
				<label for="name">Введите имя:
					<input type="text" id="name" name="name" placeholder="Имя">
				</label>
				<label for="email">Введите почту:
					<input type="text" id="email" name="email" placeholder="Почта">
				</label>
				<label for="message">Введите сообщение:
					<textarea id="message" name="message" placeholder="Сообщение"></textarea>
				</label>
			</form>
		</div>
	</section>

	<footer class="footer container">
		<p>© 2023 WORKFLOW. Все права защищены. Разработан THELABUZOV</p>
	</footer>
</body>

</html>