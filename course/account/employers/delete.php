<?php
  require_once '../../db.php';

  // Удаление работодателя
	if(isset($_GET['id'])) {
    $stmt = $pdo -> prepare("SELECT * FROM employers WHERE id = ?");
    $stmt -> execute([$_GET['id']]);
    $employer = $stmt -> fetch();

    if($employer) {
      $stmt = $pdo -> prepare("DELETE FROM employers WHERE id = ?");
      $stmt -> execute([$_GET['id']]);
    }

    setcookie('account', $account['email'], time() - 100000, '/course');
    header('Location: ../../index.php');
  }
?>