<?php
  $nickname = filter_var(trim($_POST['nickname']));
  $email = filter_var(trim($_POST['email']));
  $password = filter_var(trim($_POST['password']));
  $cpassword = filter_var(trim($_POST['cpassword']));
  $category = filter_var(trim($_POST['category']));

  if(mb_strlen($nickname) < 4 || mb_strlen($nickname) > 20) {
    echo
    '<script>
      alert("Недопустимая длина логина (от 4 до 20 символов)");
      window.location="../index.php";
    </script>';
    exit();
  } elseif(mb_strlen($email) < 12 || mb_strlen($email) > 40) {
    echo
    '<script>
      alert("Недопустимая длина почты (от 12 до 40 символов)");
      window.location="../index.php";
    </script>';
    exit();
  } elseif(mb_strlen($password) < 6 || mb_strlen($password) > 40) {
    echo
    '<script>
      alert("Недопустимая длина пароля (от 6 до 40 символов)");
      window.location="../index.php";
    </script>';
    exit();
  } elseif($password != $cpassword) {
    echo
    '<script>
      alert("Пароли не совпадают");
      window.location="../index.php";
    </script>';
    exit();
  }

  $mysql = new mysqli('localhost', 'root', '', 'workflow');

  if(isset($_POST['category'])) {
    $allowedValues = array(1, 2);
    $chosenValue = $_POST['category'];

    if(in_array($chosenValue, $allowedValues)){
      if(strcasecmp($chosenValue, 1) == 0){
        $mysql -> query("INSERT INTO employers(name, region, nickname, email, password, phone_number, category) VALUES('', '', '$nickname', '$email', '$password', 0, 1)");
        $result = $mysql -> query("SELECT * FROM employers WHERE email = '$email'");
        $account = $result -> fetch_assoc();
        $mysql -> close();
        header('Location: ../account/employers/index.php');
      } else {
        $mysql -> query("INSERT INTO applicants(full_name, region, birthday, nickname, email, password, phone_number, category) VALUES('', '', '2000-01-01', '$nickname', '$email', '$password', 0, 2)");
        $result = $mysql -> query("SELECT * FROM applicants WHERE email = '$email'");
        $account = $result -> fetch_assoc();
        $mysql -> close();
        header('Location: ../account/applicants/index.php');
      }
    }
  }

  setcookie('account', $account['email'], time() + 100000, '/course');
?>
