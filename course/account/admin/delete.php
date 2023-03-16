<?php
  require_once '../../db.php';

  // Удаление админа
	if(isset($_GET['id'])) {
    $stmt = $pdo -> prepare('SELECT * FROM admin WHERE id = ?');
    $stmt -> execute([$_GET['id']]);
    $admin = $stmt -> fetch();

    if($admin) {
      $stmt = $pdo -> prepare('DELETE FROM admin WHERE id = ?');
      $stmt -> execute([$_GET['id']]);
    }

    header('Location: index.php');
  }
?>