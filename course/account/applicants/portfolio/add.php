<?php
  require_once '../../../db.php';

  // Добавление элемента портфолио
  if (!empty($_POST['name'])) {
    $apppath = dirname(dirname(__FILE__));
    $filepath = '../../images/content/uploads/' . time() . basename($_FILES['file_path']['name']);
    $uploadfile = $apppath . '/' . $filepath;

    move_uploaded_file($_FILES['file_path']['tmp_name'], $uploadfile);

    $path = 'images/content/uploads/' . time() . basename($_FILES['file_path']['name']);
    $stmt = $pdo -> prepare("INSERT INTO works(name, file_path) VALUES(?,?)");
    $stmt -> execute([
      $_POST['name'],
      $path
    ]);

    header('Location: ../index.php');
  }
?>