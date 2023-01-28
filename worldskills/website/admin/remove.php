<?php
  require_once "../db.php";

  if(isset($_GET['id']))
  {
    $stmt = $pdo->prepare('select * from works where id = ?');
    $stmt->execute([$_GET['id']]);
    $work = $stmt->fetch();

    if($work) {
      $stmt = $pdo->prepare('delete from works where id = ?');
      $stmt->execute([$_GET['id']]);

      unlink( dirname(dirname(__FILE__)).'/'.$work['file_path'] );
    }
  }

  header('Location: index.php');
?>