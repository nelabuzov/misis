<?php
  require_once '../../../db.php';

  // Добавление элемента вакансии
  if (isset($_POST['applicants_job'])) {
		$stmt = $pdo -> prepare("INSERT INTO applicants_job(price, full_name, job, region, experience, description, email, phone_number, category) VALUES(?,?,?,?,?,?,?,?,2)");
    $stmt -> execute([
      $_POST['price'],
      $_POST['full_name'],
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