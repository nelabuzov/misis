<?php
  $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
  $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

  if(mb_strlen($email) < 5 || mb_strlen($email) > 50) {
    echo "Недопустимая длина почты";
    exit();
  } else if(mb_strlen($password) < 5 || mb_strlen($password) > 50) {
    echo "Недопустимая длина пароля (от 5 до 50 символов)";
    exit();
  }

  $password = md5($password."fa32tro8");

  $mysql = new mysqli('localhost', 'root', '', 'workflow');
  $mysql -> query("INSERT INTO `account` (`email`, `password`) VALUES('$email', '$password')");

  $mysql -> close();

  header('Location: /course');
?>