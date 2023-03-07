<?php
  require_once "../../db.php";

  if ( !empty($_POST['name']) ) {
    $apppath = dirname(dirname(__FILE__));
    $filepath = 'images/content/uploads/' . time() . basename($_FILES['file']['name']);
    $uploadfile = $apppath . '/' . $filepath;

    move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);

    $stmt = $pdo->prepare("insert into works(name, file_path) values(?,?)");
    $stmt->execute([
      $_POST['name'],
      $filepath
    ]);

    // header("Location: index.php");
  }

  if( !empty($_POST['last_name']) ) {
    $stmt = $pdo->prepare("update applicant set last_name = value(?)");
    $stmt->execute([$_POST['last_name']]);
  }

  if( !empty($_POST['first_name']) ) {
    $stmt = $pdo->prepare("update applicant set first_name = value(?)");
    $stmt->execute([$_POST['first_name']]);
  }

  if( !empty($_POST['middle_name']) ) {
    $stmt = $pdo->prepare("update applicant set middle_name = value(?)");
    $stmt->execute([$_POST['middle_name']]);
  }

  if( !empty($_POST['experience']) ) {
    $stmt = $pdo->prepare("update applicant set experience = value(?)");
    $stmt->execute([$_POST['experience']]);
  }

  if( !empty($_POST['birthday']) ) {
    $stmt = $pdo->prepare("update applicant set birthday = value(?)");
    $stmt->execute([$_POST['birthday']]);
  }

  if( !empty($_POST['phone_number']) ) {
    $stmt = $pdo->prepare("update applicant set phone_number = value(?)");
    $stmt->execute([$_POST['phone_number']]);
  }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Редактирование профиля</title>
</head>
<body>
  <form action="edit.php" method="post" enctype="multipart/form-data">
    <div>
      <label for="name">Аватар: <input id="name" name="name" type="text" placeholder="Название" required></label>
      <input name="file" type="file" required>
    </div>
    <div>
      <div><label for="last_name">Фамилия: <input id="last_Name" name="last_name" type="text" placeholder="Введите текст" required></label></div>
      <div><label for="first_name">Имя: <input id="first_Name" name="first_name" type="text" placeholder="Введите текст" required></label></div>
      <div><label for="middle_name">Отчество: <input id="middle_Name" name="middle_name" type="text" placeholder="Введите текст" required></label></div>
      <div><label for="experience">Опыт: <input id="experience" name="experience" type="text" placeholder="Введите число" required></label></div>
      <div><label for="birthday">Дата рождения: <input id="birthday" name="birthday" type="date" placeholder="Введите дату" required></label></div>
      <div><label for="phone_number">Номер телефона: <input id="phone_number" name="phone_number" type="number" placeholder="Введите номер" required></label></div>
    </div>

    <input type="submit" value="Создать">
  </form>
</body>
</html>