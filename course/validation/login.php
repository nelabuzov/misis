<?php
  // Переменные вводимых данных
  $text = filter_var(trim($_POST['text']));
  $password = filter_var(trim($_POST['password']));

  // Данные для доступа к БД
  $mysql = new mysqli('localhost', 'root', '', 'workflow');

  // Проверка совпадения админа
  $admin = $mysql -> query("SELECT * FROM admin WHERE (nickname = '$text' OR email = '$text') AND password = '$password'");
  $account0 = $admin -> fetch_assoc();

  // Проверка совпадения работодателя
  $employers = $mysql -> query("SELECT * FROM employers WHERE (nickname = '$text' OR email = '$text') AND password = '$password'");
  $account1 = $employers -> fetch_assoc();

  // Проверка совпадения соискателя
  $applicants = $mysql -> query("SELECT * FROM applicants WHERE (nickname = '$text' OR email = '$text') AND password = '$password'");
  $account2 = $applicants -> fetch_assoc();

  // Вход в админа
  if(mysqli_num_rows($admin)) {
    setcookie('account', $account0['email'], time() + 100000, '/course');
    header('Location: ../account/admin/index.php');
    // Вход в работодателя
  } elseif(mysqli_num_rows($employers)) {
    setcookie('account', $account1['email'], time() + 100000, '/course');
    header('Location: ../account/employers/index.php');
    // Вход в соискателя
  } elseif(mysqli_num_rows($applicants)) {
    setcookie('account', $account2['email'], time() + 100000, '/course');
    header('Location: ../account/applicants/index.php');
    // Когда нет пользователя
  } else {
    echo
    '<script>
      alert("Пользователь не найден");
      window.location="../index.php";
    </script>';
    exit();
  }
?>
