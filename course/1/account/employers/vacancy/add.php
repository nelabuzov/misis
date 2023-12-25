<?php
  require_once '../../../db.php';

  // Добавление элемента вакансии
  if (isset($_POST['employers_job'])) {
		$stmt = $pdo -> prepare("INSERT INTO employers_job(price, name, job, region, experience, description, email, phone_number, category) VALUES(?,?,?,?,?,?,?,?,1)");
    $stmt -> execute([
      $_POST['price'],
      $_POST['name'],
			$_POST['job'],
			$_POST['region'],
			$_POST['experience'],
      $_POST['description'],
			$_POST['email'],
			$_POST['phone_number']
    ]);

		header('Location: ../index.php');
  }
?>