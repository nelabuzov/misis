<?php
  require_once '../../../db.php';

  session_start();
  $mysql = mysqli_connect('localhost', 'root', '', 'workflow');
  if (!$mysql) {
    die('Connection failed: ' . mysqli_connect_error());
  }

  // Получаем значения из applicants
  $applicant = "SELECT * FROM applicants";
  $result = mysqli_query($mysql, $applicant);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $full_name = $row['full_name'];
    $region = $row['region'];
    $birthday = $row['birthday'];
    $nickname = $row['nickname'];
    $email = $row['email'];
    $password = $row['password'];
    $phone_number = $row['phone_number'];
  } else {
    echo 'Error: ' . $applicant . '<br>' . mysqli_error($mysql);
  }

  // Обработка данных формы редактирования
  if (isset($_POST['applicants'])) {
    $new_full_name = $_POST['full_name'];
    $new_region = $_POST['region'];
    $new_birthday = $_POST['birthday'];
    $new_nickname = $_POST['nickname'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];
    $new_phone_number = $_POST['phone_number'];

    // Запрос для обновления данных пользователя
    $applicant = "UPDATE applicants SET
    full_name = '$new_full_name',
    region = '$new_region',
    birthday = '$new_birthday',
    nickname = '$new_nickname',
    email = '$new_email',
    password = '$new_password',
    phone_number = '$new_phone_number'";

    if (mysqli_query($mysql, $applicant)) {
			header('Location: ../index.php');
    } else {
      echo 'Error: ' . $applicant . '<br>' . mysqli_error($mysql);
    }

    if (empty($cookie)) {
      echo 'Error: Account is empty';
      exit;
    }
  }
?>