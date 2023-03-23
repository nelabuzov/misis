<?php
	require_once 'db.php';

	if (isset($_COOKIE['account'])) {
		$cookie = $_COOKIE['account'];

		$stmt = $pdo -> prepare('SELECT * FROM admin WHERE email = ?');
		$stmt -> execute([$cookie]);
		$admin = $stmt -> fetchAll();

		$stmt = $pdo -> prepare('SELECT * FROM employers WHERE email = ?');
		$stmt -> execute([$cookie]);
		$employers = $stmt -> fetchAll();
	
		$stmt = $pdo -> prepare('SELECT * FROM applicants WHERE email = ?');
		$stmt -> execute([$cookie]);
		$applicants = $stmt -> fetchAll();
	}

	$stmt = $pdo -> query('SELECT * FROM employers');
	$employers_all = $stmt -> fetchAll();

	$stmt = $pdo -> query('SELECT * FROM employers_job');
	$employers_job = $stmt -> fetchAll();
?>

<!DOCTYPE html>
<html lang='ru'>

<head>
	<meta charset='UTF-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>Work Flow - поиск персонала и публикация вакансий</title>

  <link rel='shortcut icon' href='images/tools/favicon.ico' type='image/x-icon'>
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
				<p>Нет аккаунта? <a href='employer.php#popup-signup'>Зарегистрироваться</a></p>
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
				<p>Уже зарегистрированы? <a href="employer.php#popup-login">Войти</a></p>
			</div>

		</div>
	</div>

	<?php else: ?>
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

			li:has(.btn__account) {
				display: none;
			}
		</style>

		<div class='account__outer container'>
			<div class='account' onclick='showHide()'>
				<img src='images/tools/user.svg' alt='user' loading='lazy'>

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

	<header class='header'>
		<div class="menu__top">
			<div class='header__inner container'>
				<a class='logo' href='index.php'>Work<span>Flow</span></a>

				<input type='text' placeholder='Специальность / Регион' id='input' onkeyup='filterList()'>

				<div class='menu__outer'>
					<a href="#" class="menu__toggle">☰</a>
					<nav class="menu__box">
						<ul>
							<li>
								<a href='index.php#about'>О сервисе</a>
								<a href='index.php#feedback'>Обратная связь</a>
							</li>
							<li>
								<a class='menu--active' href='#'>Работодатели</a>
								<a href='applicant.php'>Соискатели</a>
							</li>
							<li>
								<input type='text' placeholder='Специальность / Регион' id='input' onkeyup='filterList()'>
							</li>
							<li>
								<a class='btn btn__account' href='employer.php#popup-login'>Вход
									<img src='images/tools/account.svg' alt='account' loading='lazy'>
								</a>
								<a class='btn btn__account' href='employer.php#popup-signup'>Регистрация
									<img src='images/tools/account.svg' alt='account' loading='lazy'>
								</a>
							</li>
						</ul>
					</nav>
				</div>

				<div class='btns'>
					<a class='btn btn__account' href='employer.php#popup-login'>Вход
						<img src='images/tools/account.svg' alt='account' loading='lazy'>
					</a>
					<a class='btn btn__account' href='employer.php#popup-signup'>Регистрация
						<img src='images/tools/account.svg' alt='account' loading='lazy'>
					</a>
				</div>
			</div>
		</div>

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
						<a class='menu--active' href='#'>Работодатели</a>
					</li>
					<li>
						<a href='applicant.php'>Соискатели</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>

	<main class='container'>
		<section class='data'>
			<div class='job' id='job'>

				<?php foreach($employers_all as $key => $employer): ?>

					<?php foreach($employers_job as $job): ?>
						<div class='job__item'>
							<div class='demand'><?= $job['price'] ?> руб.</div>
							<h3><?= $employer['name'] ?></h3>
							<div class='demand'><?= $job['experience'] ?> год опыта</div>
							<div class='search'><?= $job['job'] ?> (<?= $employer['region'] ?>)</div>
							<p><?= $job['description'] ?></p>

							<div>
								<a class='btn' href='mailto:<?= $employer['email'] ?>'><?= $employer['email'] ?></a>
								<a class='btn' href='tel:<?= $employer['phone_number'] ?>'><?= $employer['phone_number'] ?></a>
							</div>
						</div>
					<?php endforeach ?>

				<?php endforeach ?>

    	</div>
		</section>
	</main>

	<footer>© 2023 WORKFLOW. Все права защищены. Разработан <a href='https://thelabuzov.github.io'>THELABUZOV</a></footer>

	<script src='https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js'></script>
	<script src='dist/script.js'></script>
</body>

</html>
