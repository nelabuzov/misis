<?php
  require_once "../db.php";

  if ( !empty($_POST['name']) ) {
    $apppath = dirname(dirname(__FILE__));
    $filepath = 'uploads/' . time() . basename($_FILES['file']['name']);
    $uploadfile = $apppath . '/' . $filepath;

    move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);

    $stmt = $pdo->prepare("insert into works(name, file_path) values(?,?)");
    $stmt->execute([
      $_POST['name'],
      $filepath
    ]);

    header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Добавление работы в портфолио</title>
</head>
<body>
  <form action="add.php" method="post" enctype="multipart/form-data">
    <input name="name" type="text" placeholder="Название" required>
    <input name="file" type="file" required>
    <input type="submit" value="Создать">
  </form>
</body>
</html>