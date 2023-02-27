<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../dist/style.css">
  <script defer src="../dist/script.js"></script>
  <title>Workflow | Frontend Разработчик</title>
	<style>
		body {
			overflow-x: hidden;
		}
	</style>
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
				<form action="../validation/login.php" method="post">
					<input type="email" class="form-control" name="email" id="email" placeholder="Введите почту">
					<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль">

					<div class="popup__btns">
						<button type="submit" class="btn">Вход</button>
					</div>
				</form>
			</div>

			<div class="popup__inner" id="signup">
				<h2>Регистрация</h2>
				<form action="../validation/signup.php" method="post">
					<input type="email" class="form-control" name="email" id="email" placeholder="Введите почту">
					<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль">

					<div class="popup__btns">
						<button type="submit" class="btn">Регистрация</button>
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

			.btn__account {
				display: none;
			}
		</style>

		<a href="../admin">
			<div class="account">
				<div class="account__inner">
					<?=$_COOKIE['account']?>
					<img src="../images/tools/user.svg" alt="user">
				</div>

				<a href="../exit.php">
					Выход
				</a>
			</div>
		</a>
	<?php endif ?>

	<header class="header">
		<div class="header__inner container">
			<a class="logo" href="../index.php">Work<span>flow</span></a>

			<nav class="menu">
				<ul>
					<li><a href="../#about">О сервисе</a></li>
					<li><a href="../#feedback">Помощь</a></li>
					<li>
						<input type="text" placeholder="Поиск">
						<a class="btn__search" href="../search.php">
							<img src="../images/tools/search.svg" alt="search">
						</a>
					</li>
					<li>
						<a class="btn btn__account" href="#popup">Аккаунт
							<img src="../images/tools/account.svg" alt="account/user.svg">
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>

  <section class="worker container">
    <div class="worker__text">
      <h1>Frontend Developer</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, dignissimos cum. Amet iste quo totam ducimus
        itaque cumque quia eius possimus at doloremque. Impedit, dolores. Molestias corrupti est sequi veritatis.</p>
    </div>
    <img src="../images/content/job/frontend.png" alt="frontend">
  </section>

  <section class="company">
    <div class="company__inner">

      <p class="company__text">
        Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON&nbsp;Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON&nbsp;Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON&nbsp;Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON&nbsp;Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON
      </p>

      <p class="company__text company__text--reverse">
        Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON&nbsp;Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON&nbsp;Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON&nbsp;Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON&nbsp;Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON
      </p>
    </div>
  </section>

  <footer class="footer">
		<div class="footer__inner">
			<div class="container">
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
		</div>

		<p>© 2023 WORKFLOW. Все права защищены. Разработан THELABUZOV</p>
	</footer>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js"></script>
</body>

</html>