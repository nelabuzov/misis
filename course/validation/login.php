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

  $employer = $mysql -> query("SELECT * FROM `employer` WHERE `email` = '$email'");
  $emp = $employer -> fetch_assoc();

  $applicant = $mysql -> query("SELECT * FROM `applicant` WHERE `email` = '$email'");
  $app = $applicant -> fetch_assoc();

  if(mysqli_num_rows($employer)) {
    header('Location: ../admin/employer.php');
  } elseif(mysqli_num_rows($applicant)) {
    header('Location: ../admin/applicant.php');
  } else {
    header('Location: ../admin/index.php');
  }
?>