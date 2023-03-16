<?php
  require_once '../../../db.php';

  // Удаление соискателя
	if(isset($_GET['id'])) {
		$stmt = $pdo -> prepare("SELECT * FROM applicants WHERE id = ?");
		$stmt -> execute([$_GET['id']]);
		$applicant = $stmt -> fetch();

		if($applicant) {
			$stmt = $pdo -> prepare("DELETE FROM applicants WHERE id = ?");
			$stmt -> execute([$_GET['id']]);
		}

		header('Location: ../index.php');
  }
?>