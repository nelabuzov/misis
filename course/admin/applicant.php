<?php
  require_once "../db.php";

  $stmt = $pdo -> query("select * from applicant");
  $applicant = $stmt -> fetchAll();

  $stmt = $pdo -> query("select * from works");
  $works = $stmt -> fetchAll();

  session_start();
  $acc = $_COOKIE['account'];
  $mysql = mysqli_connect('localhost', 'root', '', 'workflow');
  if (!$mysql) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Получаем текущие значения полей из базы данных applicant
  $applicant = "SELECT * FROM `applicant` WHERE email = '$acc'";
  $result = mysqli_query($mysql, $applicant);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $last_name = $row["last_name"];
    $first_name = $row["first_name"];
    $middle_name = $row["middle_name"];
    $experience = $row["experience"];
    $birthday = $row["birthday"];
    $region = $row["region"];
    $email = $row["email"];
    $password = $row["password"];
    $phone_number = $row["phone_number"];
  } else {
    echo "Error: " . $applicant . "<br>" . mysqli_error($mysql);
  }

  // Обработка данных из формы редактирования applicant
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $new_last_name = $_POST["last_name"];
    $new_first_name = $_POST["first_name"];
    $new_middle_name = $_POST["middle_name"];
    $new_experience = $_POST["experience"];
    $new_birthday = $_POST["birthday"];
    $new_region = $_POST["region"];
    $new_email = $_POST["email"];
    $new_password = $_POST["password"];
    $new_phone_number = $_POST["phone_number"];

    // Запрос к базе данных для обновления данных пользователя
    $applicant = "UPDATE `applicant` SET
    last_name = '$new_last_name',
    first_name = '$new_first_name',
    middle_name = '$new_middle_name',
    experience = '$new_experience',
    birthday = '$new_birthday',
    region = '$new_region',
    email = '$new_email',
    password = '$new_password',
    phone_number = '$new_phone_number'
    WHERE email = '$acc'";

    if (mysqli_query($mysql, $applicant)) {
      if ($email != $new_email || $password != $new_password) {
				setcookie('account', $account['email'], time() - 100000, "/course");
				header('Location: ../');
			} else {
				header('Location: #');
			}
    } else {
      echo "Error: " . $applicant . "<br>" . mysqli_error($mysql);
    }

    if (empty($acc)) {
      echo "Error: Account is empty";
      exit;
    }
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

  <link rel="shortcut icon" href="../images/tools/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="../assets/css/lightgallery.css">
	<link rel="stylesheet" href="../assets/css/lg-transitions.css">
	<link rel="stylesheet" href="../dist/style.css">
	<style>
    .edit > label {
	    display: block;
    }
	</style>

	<script defer src="../dist/script.js"></script>
  <script defer src="../assets/js/lightgallery.min.js"></script>
  <title>Страница Пользователя</title>
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

				<?php if ($employer): ?>
					<a href="employer.php">Профиль</a>

				<?php elseif ($applicant): ?>
					<a href="#">Профиль</a>

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
		<section class="form">
			<!-- <form class="edit" action="applicant.php" method="post" enctype="multipart/form-data">
				<div>
					<label for="name">Аватар: <input id="name" name="name" type="text" placeholder="Название" required></label>
					<input name="file" type="file" required>
				</div>
				<label for="email">Почта: <input id="email" name="email" type="email" placeholder="Введите почту" value="<?php echo $email?>" required></label>
				<label for="password">Пароль: <input id="password" name="password" type="password" placeholder="Введите пароль" value="<?php echo $password?>" required></label>

				<br>

				<input type="submit" id="account" name="account" value="Данные аккаунта">
			</form>

			<br> -->

			<form class="edit" action="applicant.php" method="post" enctype="multipart/form-data">
				<label for="email">Почта:
					<input id="email" name="email" type="email" placeholder="Введите почту" value="<?php echo $email ?>">
				</label>
				<label for="password">Пароль:
					<input id="password" name="password" type="password" placeholder="Введите пароль" value="<?php echo $password ?>">
				</label>

				<br>

				<label for="last_name">Фамилия:
					<input id="last_name" name="last_name" type="text" placeholder="Введите текст" value="<?php echo $last_name ?>">
				</label>
				<label for="first_name">Имя:
					<input id="first_name" name="first_name" type="text" placeholder="Введите текст" value="<?php echo $first_name ?>">
				</label>
				<label for="middle_name">Отчество:
					<input id="middle_name" name="middle_name" type="text" placeholder="Введите текст" value="<?php echo $middle_name ?>">
				</label>

				<br>

				<label for="experience">Опыт:
					<input id="experience" name="experience" type="text" placeholder="Введите число" value="<?php echo $experience ?>">
				</label>
				<label for="birthday">Дата рождения:
					<input id="birthday" name="birthday" type="date" placeholder="Введите дату" value="<?php echo $birthday ?>">
				</label>
				<label for="region">Регион:
					<input id="region" name="region" type="text" placeholder="Введите число" value="<?php echo $region ?>">
				</label>
				<label for="phone_number">Номер телефона:
					<input id="phone_number" name="phone_number" type="number" placeholder="Введите номер" value="<?php echo $phone_number ?>">
				</label>

				<br>

				<input type="submit" id="submit" name="submit" value="Редактировать">
			</form>
		</section>

  	<section class="portfolio">
    	<div id="lightgallery" class="gallery">
        <?php foreach ($works as $work) : ?>
          <a class="img-wrapper" data-sub-html="<?= $work['name'] ?>" href="http://misis/course/<?= $work['file_path'] ?>">
            <img src="http://misis/course/<?= $work['file_path'] ?>" alt="<?= $work['name'] ?>">
          </a>
        <?php endforeach; ?>
    	</div>

    	<div class="portfolio__content">
      	<h2>Портфолио</h2>

      	<div>
        	<a class="btn" href="add.php">Добавить</a>
        	<a class="btn" href="remove.php?id=<?= $work['id'] ?>">Удалить</a>
      	</div>
    	</div>
  	</section>
  </main>

  <footer>© 2023 WORKFLOW. Все права защищены. Разработан <a href="https://thelabuzov.github.io">THELABUZOV</a></footer>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js"></script>
</body>
</html>