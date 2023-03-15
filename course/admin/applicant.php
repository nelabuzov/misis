<?php
  require_once "../db.php";

  $stmt = $pdo -> query("select * from applicant");
  $applicant = $stmt -> fetchAll();

	$stmt = $pdo -> query("select * from applicant_jobs");
  $applicant_jobs = $stmt -> fetchAll();

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
    $full_name = $row["full_name"];
    $region = $row["region"];
    $experience = $row["experience"];
    $birthday = $row["birthday"];
    $email = $row["email"];
    $password = $row["password"];
    $phone_number = $row["phone_number"];
  } else {
    echo "Error: " . $applicant . "<br>" . mysqli_error($mysql);
  }

  // Обработка данных из формы редактирования applicant
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['account'])) {
    $new_full_name = $_POST["full_name"];
    $new_region = $_POST["region"];
    $new_experience = $_POST["experience"];
    $new_birthday = $_POST["birthday"];
    $new_email = $_POST["email"];
    $new_password = $_POST["password"];
    $new_phone_number = $_POST["phone_number"];

    // Запрос к базе данных для обновления данных пользователя
    $applicant = "UPDATE `applicant` SET
    full_name = '$new_full_name',
    region = '$new_region',
    experience = '$new_experience',
    birthday = '$new_birthday',
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

	// Создание вакансии
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['applicant_jobs'])) {
		$stmt = $pdo->prepare("insert into applicant_jobs(price, job, description, category) values(?,?,?,2)");
    $stmt->execute([
      $_POST['price'],
			$_POST['job'],
      $_POST['description']
    ]);

		header("Location: #");
  }

	// Удаление вакансии
	if(isset($_GET['id'])) {
    $stmt = $pdo->prepare('select * from applicant_jobs where id = ?');
    $stmt->execute([$_GET['id']]);
    $job = $stmt->fetch();

    if($job) {
      $stmt = $pdo->prepare('delete from applicant_jobs where id = ?');
      $stmt->execute([$_GET['id']]);
    }

    header('Location: applicant.php');
  }

	// Добавление элемента портфолио
	if (!empty($_POST['name'])) {
    $apppath = dirname(dirname(__FILE__));
    $filepath = 'images/content/uploads/' . time() . basename($_FILES['file_path']['name']);
    $uploadfile = $apppath . '/' . $filepath;

    move_uploaded_file($_FILES['file_path']['tmp_name'], $uploadfile);

    $stmt = $pdo->prepare("insert into works(name, file_path) values(?,?)");
    $stmt->execute([
      $_POST['name'],
      $filepath
    ]);

    header("Location: #");
  }

	// Удаление элемента портфолио
	if(isset($_GET['id'])) {
    $stmt = $pdo->prepare('select * from works where id = ?');
    $stmt->execute([$_GET['id']]);
    $work = $stmt->fetch();

    if($work) {
      $stmt = $pdo->prepare('delete from works where id = ?');
      $stmt->execute([$_GET['id']]);

      unlink( dirname(dirname(__FILE__)).'/'.$work['file_path'] );
    }

    header('Location: applicant.php');
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
	<link rel="stylesheet" href="../assets/css/lightgallery.min.css">
	<link rel="stylesheet" href="../assets/css/lg-transitions.min.css">
	<link rel="stylesheet" href="../dist/style.css">
</head>

<body>
	<div id="popup" class="overlay">
		<a class="cancel" href="#"></a>
		<div class="popup">
			<a class="close" href="#">&times;</a>

			<div class="popup__inner form">
				<form action="applicant.php" method="post" enctype="multipart/form-data">
					<h2>Добавление работы</h2>

					<label for="name">Название:
						<input id="name" name="name" type="text" placeholder="Название" required>
					</label>
					<label for="file_path">Путь:
						<input id="file_path" name="file_path" type="file" required>
					</label>

					<br>

					<input type="submit" value="Добавить">
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

		<div class="account" onclick="showHide()">
			<img src="../images/tools/user.svg" alt="user">
			<?=$_COOKIE['account']?>

			<div class="account__menu hidden" id="menu">

				<?php if ($applicant): ?>
					<a href="#">Профиль</a>

				<?php elseif ($employer): ?>
					<a href="employer.php">Профиль</a>

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
			<form action="applicant.php" method="post" enctype="multipart/form-data">
				<h2>Изменение данных</h2>

				<label for="email">Почта:
					<input id="email" name="email" type="email" placeholder="Введите почту" value="<?php echo $email ?>">
				</label>
				<label for="password">Пароль:
					<input id="password" name="password" type="password" placeholder="Введите пароль" value="<?php echo $password ?>">
				</label>

				<br>

				<label for="full_name">Полное имя:
					<input id="full_name" name="full_name" type="text" placeholder="Введите текст" value="<?php echo $full_name ?>">
				</label>
				<label for="region">Город:
					<input id="region" name="region" type="text" placeholder="Введите текст" value="<?php echo $region ?>">
				</label>

				<br>

				<label for="experience">Опыт:
					<input id="experience" name="experience" type="text" placeholder="Введите число" value="<?php echo $experience ?>">
				</label>
				<label for="birthday">Дата рождения:
					<input id="birthday" name="birthday" type="date" placeholder="Введите дату" value="<?php echo $birthday ?>">
				</label>
				<label for="phone_number">Номер телефона:
					<input id="phone_number" name="phone_number" type="tel" placeholder="Введите номер" value="<?php echo $phone_number ?>">
				</label>

				<br>

				<input type="submit" id="account" name="account" value="Редактировать">
			</form>

			<form action="applicant.php" method="post" enctype="multipart/form-data">
				<h2>Создание вакансии</h2>

				<label for="price">Зарплата:
        	<input id="price" name="price" type="number" placeholder="Введите число">
				</label>
				<label for="job">Специальность:
					<input id="job" name="job" type="text" placeholder="Введите текст">
				</label>
				<label for="description">Описание:
					<textarea id="description" name="description" placeholder="Введите текст"></textarea>
				</label>

				<br>

        <input type="submit" id="applicant_jobs" name="applicant_jobs" value="Опубликовать">
      </form>
		</section>

		<section class="data">
			<div class="job">
        <?php foreach ($applicant_jobs as $job) : ?>
          <div class="job__item">
						<div class="price"><?= $job['price'] ?> руб.</div>
						<h2><?= $row['full_name'] ?></h2>
						<div class="search"><?= $job['job'] ?> (<?= $row['region'] ?>)</div>
						<p><?= $job['description'] ?></p>

						<div>
							<a class="btn" href="mailto:<?= $row['email'] ?>"><?= $row['email'] ?></a>
							<a class="btn" href="tel:<?= $row['phone_number'] ?>"><?= $row['phone_number'] ?></a>
						</div>

						<a class="btn btn--del" href="applicant.php?id=<?= $job['id'] ?>">Удалить</a>
          </div>
        <?php endforeach; ?>
    	</div>
		</section>

  	<section class="data portfolio">
    	<div id="lightgallery" class="gallery">
        <?php foreach ($works as $work) : ?>
          <div>
						<a class="img-wrapper" data-sub-html="<?= $work['name'] ?>" href="http://misis/course/<?= $work['file_path'] ?>">
            	<img src="http://misis/course/<?= $work['file_path'] ?>" alt="<?= $work['name'] ?>">
          	</a>
						<a class="btn btn--del" href="applicant.php?id=<?= $work['id'] ?>">Удалить</a>
					</div>
        <?php endforeach; ?>
    	</div>

    	<div class="portfolio__content">
      	<h2>Портфолио</h2>

      	<div>
					<a class="btn" href="#popup">Добавить</a>
      	</div>
    	</div>
  	</section>
  </main>

  <footer>© 2023 WORKFLOW. Все права защищены. Разработан <a href="https://thelabuzov.github.io">THELABUZOV</a></footer>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js"></script>
  <script src="../assets/js/lightgallery.min.js"></script>
	<script src="../dist/script.js"></script>
</body>
</html>