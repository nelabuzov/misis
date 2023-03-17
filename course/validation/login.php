<?php
  $email = filter_var(trim($_POST['email']));
  $password = filter_var(trim($_POST['password']));

  $password = md5($password.'fa32tro8');

  $mysql = new mysqli('localhost', 'root', '', 'workflow');

  $admin = $mysql -> query("SELECT * FROM admin WHERE email = '$email' AND password = '$password'");
  $account0 = $admin -> fetch_assoc();

  $employer = $mysql -> query("SELECT * FROM employers WHERE email = '$email' AND password = '$password'");
  $account1 = $employer -> fetch_assoc();

  $applicant = $mysql -> query("SELECT * FROM applicants WHERE email = '$email' AND password = '$password'");
  $account2 = $applicant -> fetch_assoc();

  if(mysqli_num_rows($admin)) {
    setcookie('account', $account0['email'], time() + 100000, '/course');
    header('Location: ../account/admin/index.php');
  } elseif(mysqli_num_rows($employer)) {
    setcookie('account', $account1['email'], time() + 100000, '/course');
    header('Location: ../account/employers/index.php');
  } elseif(mysqli_num_rows($applicant)) {
    setcookie('account', $account2['email'], time() + 100000, '/course');
    header('Location: ../account/applicants/index.php');
  } else {
    header('Location: ../index.php')
  }
?>