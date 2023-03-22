<?php
  require_once '../../../../db.php';

  // Добавление элемента вакансии
  if (isset($_POST['employers_job'])) {
		$stmt = $pdo -> prepare("INSERT INTO employers_job(price, job, experience, description, category) VALUES(?,?,?,?,1)");
    $stmt -> execute([
      $_POST['price'],
			$_POST['job'],
			$_POST['experience'],
      $_POST['description']
    ]);

		header('Location: ../../index.php');
  }
?>