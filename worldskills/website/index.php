<?php
  require_once "db.php";

  $stmt = $pdo->query("select * from works");
  $works = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <title>Мой сайт</title>
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/lightgallery.min.css">
  <link rel="stylesheet" href="assets/css/lg-transitions.min.css">
</head>

<body>
  <section class="first-screen section-bg">
    <div class="container">
      <div>
        <h1>Веб-разработчик <br> к вашим услугам</h1>
      </div>
      <div>
        <a class="btn btn-bg" onclick="smoothScroll('#about')" href="#">Узнать больше</a>
        <a class="btn btn-outline" onclick="smoothScroll('#portfolio')" href="#">Нанять меня</a>
      </div>
    </div>

    <a class="chevron" href="#">
      <img src="assets/img/chevron.svg" alt="scroll">
    </a>
  </section>

  <section>
    <div class="container">
      <h2 id="about">Обо мне</h2>
      <p>
        С другой стороны, повышение уровня гражданского сознания обеспечивает широкому кругу специалистов участие в
        формировании существующих финансовых и административных условий!
      </p>
      <p>
        Соображения высшего порядка, а также постоянное информационно-техническое обеспечение нашей деятельности, в
        значительной степени обуславливает создание системы масштабного изменения ряда параметров.
      </p>
    </div>
  </section>

  <section>
    <div class="container">
      <h2 id="portfolio">Портфолио</h2>
      <div id="lightgallery" class="gallery">
          <?php foreach($works as $work): ?>
          <a class="img-wrapper" data-sub-html="<?= $work['name'] ?>" href="<?= $work['file_path'] ?>">
            <img src="<?= $work['file_path'] ?>" alt="image">
          </a>
          <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="section-bg">
    <div class="container">
      <div class="d-flex">
        <div class="w-60 pr-4">
          <h2>Давайте работать вместе</h2>
          <p>
            Практический опыт показывает, что новая модель организационной деятельности способствует повышению
            актуальности системы масштабного изменения ряда параметров!
          </p>
        </div>
        <div class="w-40">
          <form action="feedback.php" method="POST">
            <input name="name" required type="text" placeholder="Как к вам обращаться">
            <input name="email" required type="email" placeholder="Ваш email">
            <textarea name="text" required rows="4" placeholder="Сообщение"></textarea>
            <input class="btn btn-bg" type="submit" value="Отправить">
          </form>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      Copyright &copy; 2020. Все права защищены.
    </div>
  </footer>

  <script src="assets/js/lightgallery.min.js"></script>
  <script>
    lightGallery(document.getElementById('lightgallery'));

    function smoothScroll(selector) {
      event.preventDefault();

      document.querySelector(selector).scrollIntoView({
        behavior: 'smooth'
      });
    }
  </script>
</body>

</html>