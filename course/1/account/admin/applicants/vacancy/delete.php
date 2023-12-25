<?php
  require_once '../../../../db.php';

  // Удаление элемента вакансии
	if(isset($_GET['id'])) {
		$stmt = $pdo -> prepare("SELECT * FROM applicants_job WHERE id = ?");
		$stmt -> execute([$_GET['id']]);
		$job = $stmt -> fetch();

		if($job) {
			$stmt = $pdo -> prepare("DELETE FROM applicants_job WHERE id = ?");
			$stmt -> execute([$_GET['id']]);
		}

		header('Location: ../../index.php');
  }
?>