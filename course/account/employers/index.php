<?php
  require_once '../../db.php';

	if (isset($_COOKIE['account'])) {
		$cookie = $_COOKIE['account'];

		$stmt = $pdo -> prepare("SELECT * FROM employers WHERE email = ?");
		$stmt -> execute([$cookie]);
		$employers = $stmt -> fetchAll();
	}

	$stmt = $pdo -> query("SELECT * FROM employers_job");
  $employers_job = $stmt -> fetchAll();
?>

<!DOCTYPE html>
<html lang='ru'>
<head>
	<meta charset='UTF-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Страница Пользователя</title>

  <link rel='shortcut icon' href='../../images/tools/favicon.ico' type='image/x-icon'>
	<link rel='stylesheet' href='../../assets/css/lightgallery.css'>
	<link rel='stylesheet' href='../../assets/css/lg-transitions.css'>
	<link rel='stylesheet' href='../../dist/style.css'>
</head>
<body>
	<?php
		if(($_COOKIE['account'] ?? '') === ''):
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
				transition: var(--transition);
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
						<a href='../../employer.php'>Работодатели</a>
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
      <h2>Работодатель</h2>

      <div class='data'>
        <form action='edit.php' method='post' enctype='multipart/form-data'>
          <table class='data__table' border='1'>
            <tr>
              <th>Действие</th>
              <th>Название</th>
              <th>Регион</th>
              <th>Почта</th>
              <th>Пароль</th>
              <th>Телефон</th>
            </tr>

            <?php foreach($employers as $key => $employer): ?>
              <tr>
								<td class='data__btns'>
                  <input class='btn' type='submit' name='employers' value='Редактировать'>
                  <a class='btn btn--del' href='delete.php?id=<?= $employer['id'] ?>'>Удалить</a>
                </td>

                <td><input name='name' type='text' placeholder='Введите текст' value='<?php echo $employer['name'] ?>'></td>
                <td><input name='region' type='text' placeholder='Введите текст' value='<?php echo $employer['region'] ?>'></td>
                <td><input name='email' type='email' placeholder='Введите почту' value='<?php echo $employer['email'] ?>'></td>
                <td><input name='password' type='password' placeholder='Введите пароль' value='<?php echo $employer['password'] ?>'></td>
                <td><input name='phone_number' type='tel' placeholder='Введите номер' value='<?php echo $employer['phone_number'] ?>'></td>
              </tr>
            <?php endforeach ?>

          </table>
        </form>
      </div>
    </section>

		<section>
			<h2>Создание вакансии</h2>

			<div class='data form'>
				<form action='vacancy/add.php' method='post' enctype='multipart/form-data'>
					<label for='price'>Зарплата:
						<input id='price' name='price' type='number' placeholder='Введите число *' required>
					</label>
					<label for='job'>Специальность:
						<input id='job' name='job' type='text' placeholder='Введите текст *' required>
					</label>
					<label for='experience'>Опыт:
						<input id='experience' name='experience' type='number' placeholder='Введите число *' required>
					</label>
					<label for='description'>Описание:
						<textarea id='description' name='description' placeholder='Введите текст *' required></textarea>
					</label>

					<br>

					<input type='submit' name='employers_job' value='Опубликовать'>
				</form>
			</div>
		</section>

		<section class='data'>
			<div class='job' id='job'>

				<?php if(!empty($employer['name']) && !empty($employer['region']) && !empty($employer['phone_number'])): ?>

					<?php foreach($employers_job as $job): ?>
						<div class='job__item'>
							<div class='demand'><?= $job['price'] ?> руб.</div>
							<h2><?= $employer['name'] ?></h2>
							<div class='demand'><?= $job['experience'] ?> год опыта</div>
							<div class='search'><?= $job['job'] ?> (<?= $employer['region'] ?>)</div>
							<p><?= $job['description'] ?></p>

							<div>
								<a class='btn' href='mailto:<?= $employer['email'] ?>'><?= $employer['email'] ?></a>
								<a class='btn' href='tel:<?= $employer['phone_number'] ?>'><?= $employer['phone_number'] ?></a>
							</div>

							<a class='btn btn__job btn--del' href='vacancy/delete.php?id=<?= $job['id'] ?>'>Удалить</a>
						</div>
					<?php endforeach ?>

				<?php else: ?>
					<span class="error"><?php echo 'Добавьте заполненные поля в таблице профиля' ?></span>

				<?php endif ?>

    	</div>
		</section>
	</main>

  <footer>© 2023 WORKFLOW. Все права защищены. Разработан <a href='https://thelabuzov.github.io'>THELABUZOV</a></footer>

	<script src='https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js'></script>
  <script src='../../assets/js/lightgallery.min.js'></script>
	<script src='../../dist/script.js'></script>
</body>
</html>