<?php
  $email = filter_var(trim($_POST['email']));
  $password = filter_var(trim($_POST['password']));
  $category = filter_var(trim($_POST['category']));

  if(mb_strlen($email) < 5 || mb_strlen($email) > 50) {
    echo "Недопустимая длина почты";
    exit();
  } else if(mb_strlen($password) < 5 || mb_strlen($password) > 50) {
    echo "Недопустимая длина пароля (от 5 до 50 символов)";
    exit();
  }

  $password = md5($password."fa32tro8");
  $mysql = new mysqli('localhost', 'root', '', 'workflow');

  if(isset($_POST['category'])) {
    $allowedValues = array(1, 2);
    $chosenValue = $_POST['category'];

    if(in_array($chosenValue, $allowedValues)){
      if(strcasecmp($chosenValue, 1) == 0){
        $mysql -> query("INSERT INTO `employer` (`name`, `description`, `region`, `vacancy`, `email`, `password`, `phone_number`, `category`) VALUES('', '', '', '', '$email', '$password', 0, 1)");
        $result = $mysql -> query("SELECT * FROM `employer` WHERE `email` = '$email'");
        $account = $result -> fetch_assoc();
        $mysql -> close();
        header('Location: ../admin/employer.php');
      } else {
        $mysql -> query("INSERT INTO `applicant` (`full_name`, `region`, `experience`, `birthday`, `email`, `password`, `phone_number`, `category`) VALUES('', '', 0, '2000-01-01', '$email', '$password', 0, 2)");
        $result = $mysql -> query("SELECT * FROM `applicant` WHERE `email` = '$email'");
        $account = $result -> fetch_assoc();
        $mysql -> close();
        header('Location: ../admin/applicant.php');
      }
    }
  }

  setcookie('account', $account['email'], time() + 100000, "/course");
?>