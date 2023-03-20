<?php
	require_once 'db.php';

	if (isset($_COOKIE['account'])) {
		$cookie = $_COOKIE['account'];

		$stmt = $pdo -> prepare("SELECT * FROM admin WHERE email = ?");
		$stmt -> execute([$cookie]);
		$admin = $stmt -> fetchAll();

		$stmt = $pdo -> prepare("SELECT * FROM employers WHERE email = ?");
		$stmt -> execute([$cookie]);
		$employers = $stmt -> fetchAll();
	
		$stmt = $pdo -> prepare("SELECT * FROM applicants WHERE email = ?");
		$stmt -> execute([$cookie]);
		$applicants = $stmt -> fetchAll();
	}

	$stmt = $pdo -> query("SELECT * FROM applicants");
	$applicants = $stmt -> fetchAll();

	$stmt = $pdo -> query("SELECT * FROM applicants_job");
	$applicants_job = $stmt -> fetchAll();
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
	<?php
		if(($_COOKIE['account'] ?? '') === ''):
	?>

	<div id='popup' class='overlay'>
		<a class='cancel' href='#'></a>
		<div class='popup'>
			<a class='close' href='#'>&times;</a>

			<div class='popup__inner' id='login'>
				<h2>Вход</h2>
				<form action='validation/login.php' method='post'>
					<input type='email' class='form-control' name='email' id='email' placeholder='Введите почту' required>
					<input type='password' class='form-control' name='password' id='password' placeholder='Введите пароль' required>
					<button type='submit' class='btn'>Вход</button>
				</form>
			</div>

			<div class='popup__inner' id='signup'>
				<h2>Регистрация</h2>
				<form action='validation/signup.php' method='post'>
					<input type='email' class='form-control' name='email' id='email' placeholder='Введите почту' required>
					<input type='password' class='form-control' name='password' id='password' placeholder='Введите пароль' required>
					<input type='password' class='form-control' name='cpassword' id='cpassword' placeholder='Повторите пароль' required>
          <div>
          	<label for='employer'><input type='radio' name='category' id='employer' value='1' checked>Работодатель</label>
						<label for='applicant'><input type='radio' name='category' id='applicant' value='2'>Соискатель</label>
					</div>
					<button type='submit' class='btn'>Регистрация</button>
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
				transform: translateX(-210%);
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

		<div class='account' onclick='showHide()'>
			<img src='images/tools/user.svg' alt='user'>
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
			<a class='logo' href='index.php'>Work<span>Flow</span></a>

			<nav class='menu'>
				<ul>
					<li><a href='index.php#about'>О сервисе</a></li>
					<li><a href='index.php#feedback'>Помощь</a></li>
					<li>
						<a href='employer.php'>Работодатели</a>
					</li>
					<li>
						<a class='menu--active' href='applicant.php'>Соискатели</a>
					</li>
					<li>
						<input type='text' placeholder='Специальность / Регион' id='input' onkeyup='filterList()'>
					</li>
					<li>
						<a class='btn btn__account' href='applicant.php#popup'>Аккаунт
							<img src='images/tools/account.svg' alt='account'>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>

	<main class='container'>
		<section class='data'>
			<div class='job' id='job'>

				<?php foreach($applicants as $key => $applicant): ?>

					<?php foreach($applicants_job as $job): ?>
						<div class='job__item'>
							<div class='demand'><?= $job['price'] ?> руб.</div>
							<h2><?= $applicant['full_name'] ?></h2>
							<div class='demand'><?= $job['experience'] ?> год опыта</div>
							<div class='search'><?= $job['job'] ?> (<?= $applicant['region'] ?>)</div>
							<p><?= $job['description'] ?></p>

							<div>
								<a class='btn' href='mailto:<?= $applicant['email'] ?>'><?= $applicant['email'] ?></a>
								<a class='btn' href='tel:<?= $applicant['phone_number'] ?>'><?= $applicant['phone_number'] ?></a>
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