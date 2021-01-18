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
      <li><a href="index.php?page=contact" <?php if ($_GET['page'] == "contact") echo 'class="active"'; ?>>Contact</a></li>
      <li><a href="index.php?page=login" <?php if ($_GET['page'] == "login") echo 'class="active"'; ?>><?php if(isset($_SESSION['logged_in'])) { echo "Bonjour ".$_SESSION['name']; } else echo "Login"; ?></a></li>
      <?php if(isset($_SESSION['logged_in'])) { echo '<li><a href="?action=logout">Logout</a></li>';  } ?>
    </ul>
  </header>