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
		</aside>

		<article class="article">
			<div class="article__box">
				<div class="price">35 000 - 44 000 руб.</div>
				<h2>Frontend Разработчик</h2>
				<div class="region">Yandex (Воронеж)</div>

				<p>
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, vero minima distinctio vitae ad molestiae excepturi ducimus fuga doloremque exercitationem asperiores, et earum temporibus. Cupiditate nesciunt similique quibusdam ratione facere.
				</p>
				<div>
					<a href="job.php" class="btn">Откликнуться</a>
					<a href="#" class="btn">Показать контакты</a>
				</div>
			</div>

			<div class="article__box">
				<div class="price">35 000 - 44 000 руб.</div>
				<h2>Frontend Разработчик</h2>
				<div class="region">Yandex (Воронеж)</div>

				<p>
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, vero minima distinctio vitae ad molestiae excepturi ducimus fuga doloremque exercitationem asperiores, et earum temporibus. Cupiditate nesciunt similique quibusdam ratione facere.
				</p>
				<div>
					<a href="job.php" class="btn">Откликнуться</a>
					<a href="#" class="btn">Показать контакты</a>
				</div>
			</div>

			<div class="article__box">
				<div class="price">35 000 - 44 000 руб.</div>
				<h2>Frontend Разработчик</h2>
				<div class="region">Yandex (Воронеж)</div>

				<p>
					Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, vero minima distinctio vitae ad molestiae excepturi ducimus fuga doloremque exercitationem asperiores, et earum temporibus. Cupiditate nesciunt similique quibusdam ratione facere.
				</p>
				<div>
					<a href="job.php" class="btn">Откликнуться</a>
					<a href="#" class="btn">Показать контакты</a>
				</div>
			</div>
		</article>
	</main>

	<footer class="footer container">
		<div class="footer__inner">

			<!-- Footer Content -->
			<div class="footer__content">
				<div class="footer__box">
					<h3>Новости и статьи</h3>
					<nav>
						<ul>
							<li>
								<a href="#">Новости рынка HR</a>
							</li>
							<li>
								<a href="#">Жизнь в компании</a>
							</li>
							<li>
								<a href="#">ИТ-проекты</a>
							</li>
							<li>
								<a href="#">Рейтинг работодателей России</a>
							</li>
						</ul>
					</nav>
				</div>

				<div class="footer__box">
					<h3>Молодым специалистам</h3>
					<nav>
						<ul>
							<li>
								<a href="#">Карьера для молодых специалистов</a>
							</li>
							<li>
								<a href="#">Школа программистов</a>
							</li>
							<li>
								<a href="#">Школа продактов</a>
							</li>
						</ul>
					</nav>
				</div>

				<div class="footer__box">
						<h3>Новости и статьи</h3>
						<nav>
							<ul>
								<li>
									<a href="#">Новости рынка HR</a>
								</li>
								<li>
									<a href="#">Жизнь в компании</a>
								</li>
								<li>
									<a href="#">ИТ-проекты</a>
								</li>
								<li>
									<a href="#">Рейтинг работодателей России</a>
								</li>
							</ul>
						</nav>
					</div>

					<div class="footer__box">
						<h3>Молодым специалистам</h3>
						<nav>
							<ul>
								<li>
									<a href="#">Карьера для молодых специалистов</a>
								</li>
								<li>
									<a href="#">Школа программистов</a>
								</li>
								<li>
									<a href="#">Школа продактов</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- / Footer Content -->

				<!-- Footer Content -->
				<div class="footer__content">
					<div class="footer__box">
						<h3>Новости и статьи</h3>
						<nav>
							<ul>
								<li>
									<a href="#">Новости рынка HR</a>
								</li>
								<li>
									<a href="#">Жизнь в компании</a>
								</li>
								<li>
									<a href="#">ИТ-проекты</a>
								</li>
								<li>
									<a href="#">Рейтинг работодателей России</a>
								</li>
							</ul>
						</nav>
					</div>

					<div class="footer__box">
						<h3>Молодым специалистам</h3>
						<nav>
							<ul>
								<li>
									<a href="#">Карьера для молодых специалистов</a>
								</li>
								<li>
									<a href="#">Школа программистов</a>
								</li>
								<li>
									<a href="#">Школа продактов</a>
								</li>
							</ul>
						</nav>
					</div>

					<div class="footer__box">
							<h3>Новости и статьи</h3>
							<nav>
								<ul>
									<li>
										<a href="#">Новости рынка HR</a>
									</li>
									<li>
										<a href="#">Жизнь в компании</a>
									</li>
									<li>
										<a href="#">ИТ-проекты</a>
									</li>
									<li>
										<a href="#">Рейтинг работодателей России</a>
									</li>
								</ul>
							</nav>
						</div>

						<div class="footer__box">
							<h3>Молодым специалистам</h3>
							<nav>
								<ul>
									<li>
										<a href="#">Карьера для молодых специалистов</a>
									</li>
									<li>
										<a href="#">Школа программистов</a>
									</li>
									<li>
										<a href="#">Школа продактов</a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
				<!-- / Footer Content -->

			</div>
		</div>

		<p>© 2023 WORKFLOW. Все права защищены. Разработан THELABUZOV</p>
	</footer>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js"></script>
</body>