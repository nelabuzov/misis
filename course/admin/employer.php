<?php
  require_once "../db.php";

  $stmt = $pdo -> query("select * from employer");
  $employers = $stmt -> fetchAll();

  session_start();
  $acc = $_COOKIE['account'];
  $mysql = mysqli_connect('localhost', 'root', '', 'workflow');
  if (!$mysql) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Получаем текущие значения полей из базы данных employer
  $employer = "SELECT * FROM `employer` WHERE email = '$acc'";
  $result = mysqli_query($mysql, $employer);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row["name"];
    $description = $row["description"];
    $region = $row["region"];
    $vacancy = $row["vacancy"];
    $email = $row["email"];
    $password = $row["password"];
    $phone_number = $row["phone_number"];
  } else {
    echo "Error: " . $employer . "<br>" . mysqli_error($mysql);
  }

  // Обработка данных из формы редактирования employer
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $new_name = $_POST["name"];
    $new_description = $_POST["description"];
    $new_region = $_POST["region"];
    $new_vacancy = $_POST["vacancy"];
    $new_email = $_POST["email"];
    $new_password = $_POST["password"];
    $new_phone_number = $_POST["phone_number"];

    // Запрос к базе данных для обновления данных пользователя
    $employer = "UPDATE `employer` SET
    name = '$new_name',
    description = '$new_description',
    region = '$new_region',
    vacancy = '$new_vacancy',
    email = '$new_email',
    password = '$new_password',
    phone_number = '$new_phone_number'
    WHERE email = '$acc'";

    if (mysqli_query($mysql, $employer)) {
      if ($email != $new_email || $password != $new_password) {
				setcookie('account', $account['email'], time() - 100000, "/course");
				header('Location: ../index.php');
			} else {
				header('Location: employer.php');
			}
    } else {
      echo "Error: " . $employer . "<br>" . mysqli_error($mysql);
    }

    if (empty($acc)) {
      echo "Error: Account is empty";
      exit;
    }
  }

	// Удаление работодателя
	if(isset($_GET['id'])) {
    $stmt = $pdo->prepare('select * from employer where id = ?');
    $stmt->execute([$_GET['id']]);
    $emp = $stmt->fetch();

    if($emp) {
      $stmt = $pdo->prepare('delete from employer where id = ?');
      $stmt->execute([$_GET['id']]);
    }

    header('Location: employer.php');
  }

  // Закрытие соединения с базой данных
  mysqli_close($mysql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Страница Пользователя</title>

  <link rel="shortcut icon" href="../images/tools/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="../assets/css/lightgallery.css">
	<link rel="stylesheet" href="../assets/css/lg-transitions.css">
	<link rel="stylesheet" href="../dist/style.css">
</head>
<body>
	<!-- <div id="popup" class="overlay">
		<a class="cancel" href="#"></a>
		<div class="popup">
			<a class="close" href="#">&times;</a>

			<div class="popup__inner">
				<h2>Добавление работы</h2>
				<form action="add.php" method="post" enctype="multipart/form-data">
          <input name="name" type="text" placeholder="Название" required>
          <input name="file" type="file" required>
          <input type="submit" value="Создать">
        </form>
			</div>
		</div>
	</div> -->

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

		<div class="account" onclick="showHide()">
			<img src="../images/tools/user.svg" alt="user">
			<?=$_COOKIE['account']?>

			<div class="account__menu hidden" id="menu">

				<?php if ($employers): ?>
					<a href="#">Профиль</a>

				<?php elseif ($applicants): ?>
					<a href="applicant.php">Профиль</a>

				<?php else: ?>
					<a href="index.php">Профиль</a>

				<?php endif ?>

				<a href="../exit.php">Выход</a>
			</div>
		</div>
	<?php endif ?>

	<header class="header">
		<div class="header__inner container">
			<a class="logo" href="../">Work<span>Flow</span></a>

			<nav class="menu">
				<ul>
					<li><a href="../#about">О сервисе</a></li>
					<li><a href="../#feedback">Помощь</a></li>
					<li>
						<a href="../employer.php">Вакансии</a>
					</li>
					<li>
						<a href="../applicant.php">Соискатели</a>
					</li>
					<li>
						<a class="btn btn__account" href="#popup">Аккаунт
							<img src="../images/tools/account.svg" alt="account">
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>

  <main class="container">
		<section>
      <h2>Работодатель</h2>

      <div class="data">
        <form class="edit" action="employer.php" method="post" enctype="multipart/form-data">
          <table class="data__table" border="1">
            <tr>
              <th>#</th>
              <th>Название</th>
              <th>Описание</th>
              <th>Вакансии</th>
              <th>Регион</th>
              <th>Почта</th>
              <th>Пароль</th>
              <th>Телефон</th>
              <th>Действие</th>
            </tr>

            <?php foreach ($employers as $key => $emp) : ?>
              <tr>
                <td><?= $key + 1 ?></td>
                <td><input name="name" type="text" placeholder="Введите текст" value="<?php echo $emp["name"] ?>"></td>
                <td><input name="description" type="text" placeholder="Введите текст" value="<?php echo $emp["description"] ?>"></td>
                <td><input name="vacancy" type="text" placeholder="Введите текст" value="<?php echo $emp["vacancy"] ?>"></td>
                <td><input name="region" type="text" placeholder="Введите текст" value="<?php echo $emp["region"] ?>"></td>
                <td><input name="email" type="email" placeholder="Введите почту" value="<?php echo $emp["email"] ?>"></td>
                <td><input name="password" type="password" placeholder="Введите пароль" value="<?php echo $emp["password"] ?>"></td>
                <td><input name="phone_number" type="tel" placeholder="Введите номер" value="<?php echo $emp["phone_number"] ?>"></td>

                <td class="data__btns">
                  <input class="btn" type="submit" name="submit" value="Редактировать">
                  <a class="btn btn--del" href="employer.php?id=<?= $emp['id'] ?>">Удалить</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </form>
      </div>
    </section>
	</main>

  <footer>© 2023 WORKFLOW. Все права защищены. Разработан <a href="https://thelabuzov.github.io">THELABUZOV</a></footer>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js"></script>
  <script src="../assets/js/lightgallery.min.js"></script>
	<script src="../dist/script.js"></script>
</body>
</html>