<?php
  setcookie('account', $account['email'], time() - 100000, '/course');
  header('Location: index.php');
?>
