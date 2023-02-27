<?php
  require_once "../db.php";

  $stmt = $pdo -> query("select * from messages");
  $messages = $stmt -> fetchAll();

  $stmt = $pdo -> query("select * from works");
  $works = $stmt -> fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../assets/css/lightgallery.css">
	<link rel="stylesheet" href="../assets/css/lg-transitions.css">
	<link rel="stylesheet" href="../dist/style.css">
	<script defer src="../dist/script.js"></script>
  <script defer src="assets/js/lightgallery.min.js"></script>
  <title>Страница Пользователя</title>
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

		<a href="index.php">
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

  <main class="container">
    <section class="message">
      <h2>Сообщения</h2>

      <table class="message__table" border="1">
        <tr>
          <th>#</th>
          <th>Имя</th>
          <th>Email</th>
          <th>Текст</th>
          <th>Дата и время</th>
        </tr>

        <?php foreach ($messages as $key => $message) : ?>
          <tr>
            <td><?= $key + 1 ?></td>
            <td><?= htmlspecialchars($message['name']) ?></td>
            <td><?= htmlspecialchars($message['email']) ?></td>
            <td><?= htmlspecialchars($message['text']) ?></td>
            <td><?= $message['created_at'] ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </section>

    <section class="portfolio">

      <div class="portfolio__content">
        <h2>Портфолио</h2>

        <div>
          <a class="btn" href="add.php">Добавить</a>
          <a class="btn" href="remove.php?id=<?= $work['id'] ?>">Удалить</a>
        </div>
      </div>

      <div id="lightgallery" class="gallery">
          <?php foreach ($works as $work) : ?>
            <a class="img-wrapper" data-sub-html="<?= $work['name'] ?>" href="http://misis/course/<?= $work['file_path'] ?>">
              <img src="http://misis/course/<?= $work['file_path'] ?>" alt="<?= $work['name'] ?>">
            </a>
          <?php endforeach; ?>
      </div>
    </section>
  </main>

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