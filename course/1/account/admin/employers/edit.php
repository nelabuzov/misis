<?php
  require_once '../../../db.php';

  session_start();
  $cookie = $_POST['email'];
  $mysql = mysqli_connect('localhost', 'root', '', 'workflow');
  if (!$mysql) {
    die('Ошибка подключения: ' . mysqli_connect_error());
  }

  // Получаем значения из employers
  $employer = "SELECT * FROM employers WHERE email = '$cookie'";
  $result = mysqli_query($mysql, $employer);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $region = $row['region'];
    $nickname = $row['nickname'];
    $email = $row['email'];
    $password = $row['password'];
    $phone_number = $row['phone_number'];
  } else {
    echo 'Ошибка: ' . $employer . '<br>' . mysqli_error($mysql);
  }

  // Обработка данных формы редактирования
  if (isset($_POST['employers'])) {
    $new_name = $_POST['name'];
    $new_region = $_POST['region'];
    $new_nickname = $_POST['nickname'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];
    $new_phone_number = $_POST['phone_number'];

    // Запрос для обновления данных пользователя
    $employer = "UPDATE employers SET
    name = '$new_name',
    region = '$new_region',
    nickname = '$new_nickname',
    email = '$new_email',
    password = '$new_password',
    phone_number = '$new_phone_number'
    WHERE email = '$cookie'";

    if (mysqli_query($mysql, $employer)) {
			header('Location: ../index.php');
    } else {
      echo 'Ошибка: ' . $employer . '<br>' . mysqli_error($mysql);
    }

    if (empty($cookie)) {
      echo 'Ошибка: Пустой аккаунт';
      exit;
    }
  }
?>