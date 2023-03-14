<?php
  require_once "db.php";

  if( !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['description']) )
  {
    $stmt = $pdo->prepare("insert into messages(name, email, description) values(?,?,?)");   
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['description']
    ]);
  }

  header("Location: index.php");
?>