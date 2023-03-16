<?php
  require_once '../../db.php';

  session_start();
  $mysql = mysqli_connect('localhost', 'root', '', 'workflow');
  if (!$mysql) {
    die('Connection failed: ' . mysqli_connect_error());
  }

  // Получаем значения из admin
  $admin = "SELECT * FROM admin";
  $result = mysqli_query($mysql, $admin);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $password = $row['password'];
  } else {
    echo 'Error: ' . $admin . '<br>' . mysqli_error($mysql);
  }

  // Обработка данных из формы редактирования
  if (isset($_POST['admins'])) {
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    // Запрос для обновления данных пользователя
    $admin = "UPDATE admin SET
    email = '$new_email',
    password = '$new_password'";

    if (mysqli_query($mysql, $admin)) {
      if ($email != $new_email || $password != $new_password) {
				setcookie('account', $account['email'], time() - 100000, '/course');
				header('Location: ../index.php');
			} else {
				header('Location: index.php');
			}
    } else {
      echo 'Error: ' . $admin . '<br>' . mysqli_error($mysql);
    }
  }
?>