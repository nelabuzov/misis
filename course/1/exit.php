<?php
  // Отключение таймера куки
  setcookie('account', $account['email'], time() - 100000, '/course');
  // Переход домой
  header('Location: index.php');
?>
