<?php
  $email = filter_var(trim($_POST['email']));
  $password = filter_var(trim($_POST['password']));

  $password = md5($password."fa32tro8");

  $mysql = new mysqli('localhost', 'root', '', 'workflow');

  $admin = $mysql -> query("SELECT * FROM `admin` WHERE `email` = '$email'");
  $account0 = $admin -> fetch_assoc();

  $employer = $mysql -> query("SELECT * FROM `employer` WHERE `email` = '$email'");
  $account1 = $employer -> fetch_assoc();

  $applicant = $mysql -> query("SELECT * FROM `applicant` WHERE `email` = '$email'");
  $account2 = $applicant -> fetch_assoc();

  // if(count($account0, $account1, $account2) == 0) {
  //   echo "Пользователь не найден";
  //   exit();
  // }

  if(mysqli_num_rows($employer)) {
    setcookie('account', $account1['email'], time() + 100000, "/course");
    header('Location: ../admin/employer/index.php');
  } elseif(mysqli_num_rows($applicant)) {
    setcookie('account', $account2['email'], time() + 100000, "/course");
    header('Location: ../admin/applicant/index.php');
  } else {
    setcookie('account', $account0['email'], time() + 100000, "/course");
    header('Location: ../admin/index.php');
  }
?>