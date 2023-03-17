<?php
  require_once '../../db.php';

	$stmt = $pdo -> query("SELECT * FROM admin");
  $admins = $stmt -> fetchAll();

  $stmt = $pdo -> query("SELECT * FROM employers");
  $employers = $stmt -> fetchAll();

  $stmt = $pdo -> query("SELECT * FROM applicants");
  $applicants = $stmt -> fetchAll();
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
      <h2>Администратор</h2>

      <div class='data'>
        <form action='edit.php' method='post' enctype='multipart/form-data'>
          <table class='data__table' border='1'>
            <tr>
              <th>Действие</th>
              <th>Почта</th>
              <th>Пароль</th>
            </tr>

            <?php foreach($admins as $key => $admin): ?>
              <tr>
                <td class='data__btns'>
                  <input class='btn' type='submit' name='admins' value='Редактировать'>
                  <a class='btn btn--del' href='delete.php?id=<?= $admin['id'] ?>'>Удалить</a>
                </td>

                <td><input name='email' type='email' placeholder='Введите почту' value='<?php echo $admin['email'] ?>'></td>
                <td><input name='password' type='password' placeholder='Введите пароль' value='<?php echo $admin['password'] ?>'></td>
              </tr>
            <?php endforeach ?>

          </table>
        </form>
      </div>
    </section>

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
                <td><input name='birthday' type='date' placeholder='Введите дату' value='<?php echo $applicant['birthday'] ?>'></td>
                <td><input name='email' type='email' placeholder='Введите почту' value='<?php echo $applicant['email'] ?>'></td>
                <td><input name='password' type='password' placeholder='Введите пароль' value='<?php echo $applicant['password'] ?>'></td>
                <td><input name='phone_number' type='tel' placeholder='Введите номер' value='<?php echo $applicant['phone_number'] ?>'></td>
              </tr>
            <?php endforeach ?>

          </table>
        </form>
      </div>
    </section>
  </main>

  <footer>© 2023 WORKFLOW. Все права защищены. Разработан <a href='https://thelabuzov.github.io'>THELABUZOV</a></footer>

	<script src='https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js'></script>
  <script src='../../assets/js/lightgallery.min.js'></script>
  <script src='../../dist/script.js'></script>
</body>
</html>