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
  $mysql -> query("INSERT INTO `account` (`email`, `password`) VALUES('$email', '$password')");
  $result = $mysql -> query("SELECT * FROM `account` WHERE `email` = '$email' AND `password` = '$password'");
  $account = $result -> fetch_assoc();

  setcookie('account', $account['email'], time() + 100000, "/course");

  if(isset($_POST['category'])) {
    $allowedValues = array(1, 2);
    $chosenValue = $_POST['category'];

    if(in_array($chosenValue, $allowedValues)){
      if(strcasecmp($chosenValue, 1) == 0){
        $mysql -> query("INSERT INTO `employer` (`name`, `description`, `vacancy`, `region`, `email`, `phone_number`, `category`) VALUES('', '', '', 0, '$email', 0, 1)");
        $mysql -> close();
        header('Location: ../admin/employer/index.php');
      } else {
        $mysql -> query("INSERT INTO `applicant` (`last_name`, `first_name`, `middle_name`, `experience`, `birthday`, `region`, `email`, `phone_number`, `category`) VALUES('', '', '', 0, '2000-01-01', 0, '$email', 0, 2)");
        $mysql -> close();
        header('Location: ../admin/applicant/index.php');
      }
    }
  }
?>