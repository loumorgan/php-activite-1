<!DOCTYPE HTML>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Introduction au PHP</title>
  <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

  <header>
    <ul>
      <li><a href="index.php?page=home" <?php if ($_GET['page'] == "home") echo 'class="active"'; ?>>Accueil</a></li>
      <li><a href="index.php?page=apropos" <?php if ($_GET['page'] == "apropos") echo 'class="active"'; ?>>À propos</a></li>
      <li><a href="index.php?page=menuxml" <?php if ($_GET['page'] == "menuxml") echo 'class="active"'; ?>>MenuXML</a></li>
      <li><a href="index.php?page=contact" <?php if ($_GET['page'] == "contact") echo 'class="active"'; ?>>Contact</a></li>
    </ul>
  </header>