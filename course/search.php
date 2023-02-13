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
		if (($_COOKIE['account'] ?? '') === ''):
	?>

	<div id="popup" class="overlay">
		<a class="cancel" href="#"></a>
		<div class="popup">
			<a class="close" href="#">&times;</a>

			<div class="popup__inner" id="login">
				<h2>Вход</h2>
				<form action="validation/login.php" method="post">
					<input type="email" class="form-control" name="email" id="email" placeholder="Введите почту">
					<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль">

					<div class="popup__btns">
						<button type="submit" class="btn">Вход</button>
						<button class="btn" onclick="next()">Регистрация</button>
					</div>
				</form>
			</div>

		</div>
	</div>

	<div id="popup" class="overlay">
		<a class="cancel" href="#"></a>
		<div class="popup">
			<a class="close" href="#">&times;</a>

			<div class="popup__inner" id="signup">
				<h2>Регистрация</h2>
				<form action="validation/signup.php" method="post">
					<input type="email" class="form-control" name="email" id="email" placeholder="Введите почту">
					<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль">

					<div class="popup__btns">
						<button type="submit" class="btn">Регистрация</button>
						<button class="btn" onclick="prev()">Вход</button>
					</div>
				</form>
			</div>

		</div>
	</div>

	<?php else: ?>
		<style>
			.account {
				position: absolute;
				top: 20px;
				right: 820px;
				z-index: 5;
			}

			.account__inner {
				display: inline-flex;
				align-items: center;
				font-weight: 700;
				margin-right: 20px;
			}

			.btn {
				display: none;
			}
		</style>

		<div class="account">
			<div class="account__inner">
				<?=$_COOKIE['account']?>
				<img src="images/tools/user.svg" alt="user">
			</div>

			<a href="exit.php">
				Выход
			</a>
		</div>
	<?php endif ?>

	<header class="header">
		<div class="header__inner container">
			<a class="logo" href="index.php">Work<span>flow</span></a>

			<nav class="menu">
				<ul>
					<li><a href="#">О сервисе</a></li>
					<li><a href="#">Помощь</a></li>
					<li><input type="text" placeholder="Поиск"></li>
					<li>
						<a class="btn" href="#popup">Аккаунт
							<img src="images/tools/account.svg" alt="account/user.svg">
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>

	<main class="search container">
		<aside class="aside">
			<label for="view" class="aside__box">
				<h3>Исключения:</h3>
				<input type="text" id="view" name="view" placeholder="Введите что исключить">
			</label>

			<div class="aside__box">
				<h3>Опыт работы:</h3>
				<label for="one"><input type="checkbox" id="one" name="exp" value="0">Без опыта</label>
				<label for="two"><input type="checkbox" id="two" name="exp" value="1-2">1-2 года</label>
				<label for="three"><input type="checkbox" id="three" name="exp" value="3-4">3-4 года</label>
				<label for="four"><input type="checkbox" id="four" name="exp" value="3-4">Более 4 лет</label>
			</div>

			<div class="aside__box">
				<h3>Занятость:</h3>
				<label for="one"><input type="checkbox" id="one" name="exp" value="0">Подработка</label>
				<label for="two"><input type="checkbox" id="two" name="exp" value="1-2">Полный день</label>
				<label for="three"><input type="checkbox" id="three" name="exp" value="3-4">Частичная занятось</label>
			</div>
		</aside>

		<article class="article">
			<div class="article__box">
				<h2>Frontend Разработчик</h2>
				<p>
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, vero minima distinctio vitae ad molestiae excepturi ducimus fuga doloremque exercitationem asperiores, et earum temporibus. Cupiditate nesciunt similique quibusdam ratione facere.
				</p>
			</div>

			<div class="article__box">
				<h2>Frontend Разработчик</h2>
				<p>
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, vero minima distinctio vitae ad molestiae excepturi ducimus fuga doloremque exercitationem asperiores, et earum temporibus. Cupiditate nesciunt similique quibusdam ratione facere.
				</p>
			</div>

			<div class="article__box">
				<h2>Frontend Разработчик</h2>
				<p>
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, vero minima distinctio vitae ad molestiae excepturi ducimus fuga doloremque exercitationem asperiores, et earum temporibus. Cupiditate nesciunt similique quibusdam ratione facere.
				</p>
			</div>
		</article>
	</main>

	<footer class="footer container">
		<p>© 2023 WORKFLOW. Все права защищены. Разработан THELABUZOV</p>
	</footer>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js"></script>
</body>