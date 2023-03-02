<?php
  $email = filter_var(trim($_POST['email']));
  $password = filter_var(trim($_POST['password']));

  $password = md5($password."fa32tro8");

  $mysql = new mysqli('localhost', 'root', '', 'workflow');

  $result = $mysql -> query("SELECT * FROM `account` WHERE `email` = '$email' AND `password` = '$password'");
  $account = $result -> fetch_assoc();
  if(count($account) == 0) {
    echo "Пользователь не найден";
    exit();
  }

  setcookie('account', $account['email'], time() + 100000, "/course");

  $mysql -> close();

  header('Location: ../admin/index.php');

  print_r($account);
  exit();
?>