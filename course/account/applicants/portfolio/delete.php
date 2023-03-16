<?php
  require_once '../../../db.php';

  // Удаление элемента портфолио
	if(isset($_GET['id'])) {
		$stmt = $pdo -> prepare("SELECT * FROM works WHERE id = ?");
		$stmt -> execute([$_GET['id']]);
		$work = $stmt -> fetch();

		if($work) {
			$stmt = $pdo -> prepare("DELETE FROM works WHERE id = ?");
			$stmt -> execute([$_GET['id']]);

			unlink(dirname(dirname(__FILE__)) . '/' . $work['file_path']);
		}

		header('Location: ../index.php');
  }
?>