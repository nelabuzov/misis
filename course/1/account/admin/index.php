<?php
  require_once '../../db.php';

	// Вывод админа
	$stmt = $pdo -> query('SELECT * FROM admin');
  $admins = $stmt -> fetchAll();

	// Вывод работодателей
  $stmt = $pdo -> query('SELECT * FROM employers');
  $employers = $stmt -> fetchAll();

	// Вывод соискателей
  $stmt = $pdo -> query('SELECT * FROM applicants');
  $applicants = $stmt -> fetchAll();

	// Вывод вакансий работодателей
	$stmt = $pdo -> query('SELECT * FROM employers_job');
	$employers_job = $stmt -> fetchAll();

	// Вывод вакансий соискателей
  $stmt = $pdo -> query('SELECT * FROM applicants_job');
	$applicants_job = $stmt -> fetchAll();
?>

<!DOCTYPE html>
<html lang='ru'>
<head>
	<meta charset='UTF-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>WORKFLOW - страница администратора</title>

	<!-- SEO -->
	<meta name='description' content='Работа со всей России'>
	<meta name='keywords' content='Работа, Персонал, Вакансии, Профессия, Деньги'>
	<meta name='author' content='thelabuzov'>
	<meta name='copyright' content='Дмитрий Лабузов'>
	<meta property='og:title' content='WORKFLOW - поиск персонала и публикация вакансий'>
	<meta property='og:description' content='Работа со всей России'>
	<meta property='og:image' content='../../images/content/promo.png'>
	<meta property='og:site_name' content='WORKFLOW - поиск персонала и публикация вакансий'>
	<meta name='twitter:site' content='thelabuzov'>
	<meta name='twitter:title' content='WORKFLOW - поиск персонала и публикация вакансий'>
	<meta name='twitter:description' content='Работа со всей России'>
	<meta name='twitter:image' content='../../images/content/promo.png'>

	<!-- Подключение внешних объектов -->
  <link rel='shortcut icon' href='../../images/tools/favicon.ico' type='image/x-icon'>
	<link rel='stylesheet' href='../../dist/style.css'>
</head>
<body>
	<!-- Загрузка страницы -->
	<div class='loader'>
		<svg width='200' height='200' viewBox='0 0 100 100'>
			<polyline class='line' points='0,0 100,0 100,100' stroke-width='10' fill='none'></polyline>
			<polyline class='line' points='0,0 0,100 100,100' stroke-width='10' fill='none'></polyline>
			<polyline class='line line__animation' points='0,0 100,0 100,100' stroke-width='10' fill='none'></polyline>
			<polyline class='line line__animation' points='0,0 0,100 100,100' stroke-width='10' fill='none'></polyline>
		</svg>
	</div>

	<!-- Условие для гостя -->
	<?php
		if(($_COOKIE['account'] ?? '') === ''):
	?>

	<!-- Условие для пользователя -->
	<?php else: ?>
		<!-- Выравнивание кнопки пользователя -->
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

		<!-- Кнопка пользователя -->
		<div class='account__outer container'>
			<div class='account' onclick='showHide()'>
				<img src='../../images/tools/user.svg' alt='user' loading='lazy'>

				<!-- Ссылка типа профиля -->
				<div class='account__menu hidden' id='menu'>
					<a href='#'>Профиль</a>
					<a href='../../exit.php'>Выход</a>
				</div>
			</div>
		</div>
	<?php endif ?>

	<!-- Шапка -->
	<header class='header'>
		<div class="menu__top">
			<div class='header__inner container'>
				<a class='logo' href='../../index.php'>Work<span>Flow</span></a>

				<!-- Гамбургер -->
				<div class='menu__outer'>
					<a href="#" class="menu__toggle">☰</a>

					<!-- Меню гамбургера -->
					<nav class="menu__box">
						<ul>
							<li>
								<a href='../../index.php#about'>О сервисе</a>
								<a href='../../index.php#feedback'>Обратная связь</a>
							</li>
							<li>
								<a href='../../employer.php'>Работодатели</a>
								<a href='../../applicant.php'>Соискатели</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>

		<!-- Нижнее меню шапки -->
		<div class='menu'>
			<nav class='header__inner container'>
				<ul>
					<li>
						<a href='../../index.php#about'>О сервисе</a>
					</li>
					<li>
						<a href='../../index.php#feedback'>Обратная связь</a>
					</li>
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

  <main class='data__outer container'>
		<!-- Данные админа -->
    <section>
      <h2>Администратор</h2>

      <div class='data'>
        <form action='edit.php' method='post' enctype='multipart/form-data'>
          <table class='data__table' border='1'>
            <tr>
              <th>Действие</th>
              <th>Псевдоним</th>
              <th>Почта</th>
              <th>Пароль</th>
            </tr>

            <?php foreach($admins as $key => $admin): ?>
              <tr>
                <td class='data__btns'>
                  <input class='btn' type='submit' name='admins' value='Редактировать'>
                  <a class='btn btn--del' href='delete.php?id=<?= $admin['id'] ?>'>Удалить</a>
                </td>

                <td><input name='nickname' type='text' placeholder='Введите псевдоним *' value='<?php echo $admin['nickname'] ?>' required></td>
                <td><input name='email' type='email' placeholder='Введите почту *' value='<?php echo $admin['email'] ?>' required></td>
                <td><input name='password' type='password' placeholder='Введите пароль *' value='<?php echo $admin['password'] ?>' required></td>
              </tr>
            <?php endforeach ?>

          </table>
        </form>
      </div>
    </section>

		<!-- Данные работодателей -->
    <section>
      <h2>Работодатели</h2>

      <div class='data'>
        <form action='employers/edit.php' method='post' enctype='multipart/form-data'>
          <table class='data__table' border='1'>
            <tr>
              <th>Действие</th>
              <th>#</th>
              <th>Название</th>
              <th>Регион</th>
              <th>Псевдоним</th>
              <th>Почта</th>
              <th>Пароль</th>
              <th>Телефон</th>
            </tr>

            <?php foreach($employers as $key => $employer): ?>
              <tr>
                <td class='data__btns'>
                  <input class='btn' type='submit' name='employers' value='Редактировать'>
                  <a class='btn btn--del' href='employers/delete.php?id=<?= $employer['id'] ?>'>Удалить</a>
                </td>

                <td><?= $key + 1 ?></td>
                <td><input name='name' type='text' placeholder='Введите текст' value='<?php echo $employer['name'] ?>'></td>
                <td><input name='region' type='text' placeholder='Введите текст' value='<?php echo $employer['region'] ?>'></td>
                <td><input name='nickname' type='text' placeholder='Введите псевдоним *' value='<?php echo $employer['nickname'] ?>' required></td>
                <td><input name='email' type='email' placeholder='Введите почту *' value='<?php echo $employer['email'] ?>' required></td>
                <td><input name='password' type='password' placeholder='Введите пароль *' value='<?php echo $employer['password'] ?>' required></td>
                <td><input name='phone_number' type='tel' placeholder='Введите номер *' value='<?php echo $employer['phone_number'] ?>' required></td>
              </tr>
            <?php endforeach ?>

          </table>
        </form>
      </div>
    </section>

		<!-- Данные соискателей -->
    <section>
      <h2>Соискатели</h2>

      <div class='data'>
        <form action='applicants/edit.php' method='post' enctype='multipart/form-data'>
          <table class='data__table' border='1'>
            <tr>
              <th>Действие</th>
              <th>#</th>
              <th>Полное имя</th>
              <th>Регион</th>
              <th>Дата рождения</th>
              <th>Псевдоним</th>
              <th>Почта</th>
              <th>Пароль</th>
              <th>Телефон</th>
            </tr>

            <?php foreach($applicants as $key => $applicant): ?>
              <tr>
                <td class='data__btns'>
                  <input class='btn' type='submit' name='applicants' value='Редактировать'>
                  <a class='btn btn--del' href='applicants/delete.php?id=<?= $applicant['id'] ?>'>Удалить</a>
                </td>

                <td><?= $key + 1 ?></td>
                <td><input name='full_name' type='text' placeholder='Введите текст' value='<?php echo $applicant['full_name'] ?>'></td>
								<td><input name='region' type='text' placeholder='Введите текст' value='<?php echo $applicant['region'] ?>'></td>
								<td><input name='birthday' type='date' value='<?php echo $applicant['birthday'] ?>' required></td>
								<td><input name='nickname' type='text' placeholder='Введите псевдоним *' value='<?php echo $applicant['nickname'] ?>' required></td>
								<td><input name='email' type='email' placeholder='Введите почту *' value='<?php echo $applicant['email'] ?>' required></td>
								<td><input name='password' type='password' placeholder='Введите пароль *' value='<?php echo $applicant['password'] ?>' required></td>
								<td><input name='phone_number' type='tel' placeholder='Введите номер *' value='<?php echo $applicant['phone_number'] ?>' required></td>
              </tr>
            <?php endforeach ?>

          </table>
        </form>
      </div>
    </section>

		<!-- Вакансии работодателей -->
		<section>
      <h2>Вакансии работодателей</h2>

			<div class='data'>
				<div class='job' id='job'>

					<?php foreach($employers_job as $job): ?>
						<div class='job__item'>
							<div class='demand'><?= $job['price'] ?> руб.</div>
							<h3><?= $job['name'] ?></h3>
							<div class='demand'><?= $job['experience'] ?> год опыта</div>
							<div class='search'><?= $job['job'] ?> (<?= $job['region'] ?>)</div>
							<p><?= $job['description'] ?></p>

							<div>
								<a class='btn' href='mailto:<?= $job['email'] ?>'><?= $job['email'] ?></a>
								<a class='btn' href='tel:<?= $job['phone_number'] ?>'><?= $job['phone_number'] ?></a>
							</div>

							<a class='btn btn__job btn--del' href='employers/vacancy/delete.php?id=<?= $job['id'] ?>'>Удалить</a>
						</div>
					<?php endforeach ?>

				</div>
			</div>
		</section>

		<!-- Вакансии соискателей -->
		<section>
      <h2>Вакансии соискателей</h2>

			<div class='data'>
				<div class='job' id='job'>

					<?php foreach($applicants_job as $job): ?>
						<div class='job__item'>
							<div class='demand'><?= $job['price'] ?> руб.</div>
							<h3><?= $job['full_name'] ?></h3>
							<div class='demand'><?= $job['experience'] ?> год опыта</div>
							<div class='search'><?= $job['job'] ?> (<?= $job['region'] ?>)</div>
							<p><?= $job['description'] ?></p>

							<div>
								<a class='btn' href='mailto:<?= $job['email'] ?>'><?= $job['email'] ?></a>
								<a class='btn' href='tel:<?= $job['phone_number'] ?>'><?= $job['phone_number'] ?></a>
							</div>

							<a class='btn btn__job btn--del' href='applicants/vacancy/delete.php?id=<?= $job['id'] ?>'>Удалить</a>
						</div>
					<?php endforeach ?>

				</div>
			</div>
		</section>
  </main>

	<!-- Подвал -->
  <footer>© 2023 WORKFLOW. Все права защищены. Разработан <a href='https://thelabuzov.github.io'>THELABUZOV</a></footer>

	<!-- Скрипты -->
	<script src='https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js'></script>
  <script src='../../dist/script.js'></script>
</body>
</html>