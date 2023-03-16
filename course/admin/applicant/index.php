<?php
  require_once '../../db.php';

	if (isset($_COOKIE['account'])) {
		$email = $_COOKIE['account'];

		$stmt = $pdo -> prepare("SELECT * FROM applicants WHERE email = ?");
		$stmt -> execute([$email]);
		$applicants = $stmt -> fetchAll();
	}

	$stmt = $pdo -> query("SELECT * FROM applicants_job");
  $applicants_job = $stmt -> fetchAll();

  $stmt = $pdo -> query("SELECT * FROM works");
  $works = $stmt -> fetchAll();
?>

<!DOCTYPE html>
<html lang='ru'>
<head>
	<meta charset='UTF-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>Страница Пользователя</title>

  <link rel='shortcut icon' href='../../images/tools/favicon.ico' type='image/x-icon'>
	<link rel='stylesheet' href='../../assets/css/lightgallery.min.css'>
	<link rel='stylesheet' href='../../assets/css/lg-transitions.min.css'>
	<link rel='stylesheet' href='../../dist/style.css'>
</head>

<body>
	<div id='popup' class='overlay'>
		<a class='cancel' href='index.php'></a>
		<div class='popup'>
			<a class='close' href='index.php'>&times;</a>

			<div class='popup__inner form'>
				<form action='portfolio/add.php' method='post' enctype='multipart/form-data'>
					<h2>Добавление работы</h2>

					<label for='name'>Название:
						<input id='name' name='name' type='text' placeholder='Название' required>
					</label>
					<label for='file_path'>Путь:
						<input id='file_path' name='file_path' type='file' required>
					</label>

					<br>

					<input type='submit' value='Добавить'>
      	</form>
			</div>
		</div>
	</div>

	<?php
		if (($_COOKIE['account'] ?? '') === ''):
	?>

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

		<div class='account' onclick='showHide()'>
			<img src='../../images/tools/user.svg' alt='user'>
			<?= $_COOKIE['account'] ?>

			<div class='account__menu hidden' id='menu'>
					<a href='index.php'>Профиль</a>
				<a href='../../exit.php'>Выход</a>
			</div>
		</div>
	<?php endif ?>

	<header class='header'>
		<div class='header__inner container'>
			<a class='logo' href='../../index.php'>Work<span>Flow</span></a>

			<nav class='menu'>
				<ul>
					<li><a href='../../index.php#about'>О сервисе</a></li>
					<li><a href='../../index.php#feedback'>Помощь</a></li>
					<li>
						<a href='../../employer.php'>Вакансии</a>
					</li>
					<li>
						<a href='../../applicant.php'>Соискатели</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>

  <main class='container'>
		<section>
			<h2>Соискатель</h2>

			<div class='data'>
				<form class='edit' action='edit.php' method='post' enctype='multipart/form-data'>
					<table class='data__table' border='1'>
						<tr>
							<th>Полное имя</th>
							<th>Регион</th>
							<th>Опыт</th>
							<th>Дата рождения</th>
							<th>Почта</th>
							<th>Пароль</th>
							<th>Телефон</th>
							<th>Действие</th>
						</tr>

						<?php foreach ($applicants as $key => $applicant) : ?>
							<tr>
								<td><input name='full_name' type='text' placeholder='Введите текст' value='<?php echo $applicant['full_name'] ?>'></td>
								<td><input name='region' type='text' placeholder='Введите текст' value='<?php echo $applicant['region'] ?>'></td>
								<td><input name='experience' type='number' placeholder='Введите число' value='<?php echo $applicant['experience'] ?>'></td>
								<td><input name='birthday' type='date' placeholder='Введите дату' value='<?php echo $applicant['birthday'] ?>'></td>
								<td><input name='email' type='email' placeholder='Введите почту' value='<?php echo $applicant['email'] ?>'></td>
								<td><input name='password' type='password' placeholder='Введите пароль' value='<?php echo $applicant['password'] ?>'></td>
								<td><input name='phone_number' type='tel' placeholder='Введите номер' value='<?php echo $applicant['phone_number'] ?>'></td>

								<td class='data__btns'>
									<input class='btn' type='submit' name='applicants' value='Редактировать'>
									<a class='btn btn__row btn--del' href='delete.php?id=<?= $applicant['id'] ?>'>Удалить</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</table>
				</form>
			</div>
		</section>

		<section>
			<form action='vacancy/add.php' method='post' enctype='multipart/form-data'>
				<h2>Создание вакансии</h2>

				<label for='price'>Зарплата:
        	<input id='price' name='price' type='number' placeholder='Введите число'>
				</label>
				<label for='job'>Специальность:
					<input id='job' name='job' type='text' placeholder='Введите текст'>
				</label>
				<label for='description'>Описание:
					<textarea id='description' name='description' placeholder='Введите текст'></textarea>
				</label>

				<br>

        <input type='submit' name='applicants_job' value='Опубликовать'>
      </form>
		</section>

		<section class='data'>
			<div class='job'>
        <?php foreach ($applicants_job as $job) : ?>
          <div class='job__item'>
						<div class='price'><?= $job['price'] ?> руб.</div>
						<h2><?= $applicant['full_name'] ?></h2>
						<div class='search'><?= $job['job'] ?> (<?= $applicant['region'] ?>)</div>
						<p><?= $job['description'] ?></p>

						<div>
							<a class='btn' href='mailto:<?= $applicant['email'] ?>'><?= $applicant['email'] ?></a>
							<a class='btn' href='tel:<?= $applicant['phone_number'] ?>'><?= $applicant['phone_number'] ?></a>
						</div>

						<a class='btn btn__job btn--del' href='vacancy/delete.php?id=<?= $job['id'] ?>'>Удалить</a>
          </div>
        <?php endforeach; ?>
    	</div>
		</section>

  	<section class='data portfolio'>
    	<div id='lightgallery' class='gallery'>
        <?php foreach ($works as $work) : ?>
          <div>
						<a class='img-wrapper' data-sub-html='<?= $work['name'] ?>' href='http://misis/course/<?= $work['file_path'] ?>'>
            	<img src='http://misis/course/<?= $work['file_path'] ?>' alt='<?= $work['name'] ?>'>
          	</a>
						<a class='btn btn__work btn--del' href='portfolio/delete.php?id=<?= $work['id'] ?>'>Удалить</a>
					</div>
        <?php endforeach; ?>
    	</div>

    	<div class='portfolio__content'>
      	<h2>Портфолио</h2>

      	<div>
					<a class='btn' href='index.php#popup'>Добавить</a>
      	</div>
    	</div>
  	</section>
  </main>

  <footer>© 2023 WORKFLOW. Все права защищены. Разработан <a href='https://thelabuzov.github.io'>THELABUZOV</a></footer>

	<script src='https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js'></script>
  <script src='../assets/js/lightgallery.min.js'></script>
	<script src='../dist/script.js'></script>
</body>
</html>