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

			<div class="popup__inner">
				<h2>Регистрация</h2>
				<form action="validation/signup.php" method="post">
					<input type="email" class="form-control" name="email" id="email" placeholder="Введите почту">
					<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль">
					<button type="submit" class="btn">Регистрация</button>
				</form>
			</div>

			<div class="popup__inner">
				<h2>Вход</h2>
				<form action="validation/login.php" method="post">
					<input type="email" class="form-control" name="email" id="email" placeholder="Введите почту">
					<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль">
					<button type="submit" class="btn">Вход</button>
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

  <section class="worker container">
    <div class="worker__text">
      <h1>Frontend Developer</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, dignissimos cum. Amet iste quo totam ducimus
        itaque cumque quia eius possimus at doloremque. Impedit, dolores. Molestias corrupti est sequi veritatis.</p>
    </div>
    <img src="images/content/job/job.png" alt="frontend">
  </section>

  <section class="company">
    <div class="company__inner">

      <p class="company__text">
        Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON&nbsp;Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON&nbsp;Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON&nbsp;Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON
      </p>

      <p class="company__text company__text--reverse">
        Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON&nbsp;Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON&nbsp;Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON&nbsp;Tinkoff&nbsp;Yandex&nbsp;VK&nbsp;OZON
      </p>
    </div>
  </section>

  <footer class="footer container">
    <p>© 2023 WORKFLOW. Все права защищены. Разработан THELABUZOV</p>
  </footer>
</body>

</html>