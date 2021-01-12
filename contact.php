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
      <li><a href="index.htm">Accueil</a></li>
      <li><a href="apropos.htm">À propos</a></li>
      <li><a href="contact.htm">Contact</a></li>
    </ul>
  </header>

  <section>

    <h1>Contact</h1>
    <hr>
    <h3>Formulaire envoyé en méthode post</h3>
    <form action="contact.htm" method="post">
      <label for="name">
        Nom :
        <input type="text">
      </label>
      <input type="submit" value="Envoyer">
    </form>
    <hr>
    <h3>Formulaire envoyé en méthode get</h3>
    <form action="contact.htm" method="get">
      <label for="name">
        Nom :
        <input type="text">
      </label>
      <input type="submit" value="Envoyer">
    </form>
  </section>

  <footer>
    Copyright (c) Handigital
  </footer>

  <script type="text/javascript" src="assets/js/app.js"></script>

</body>

</html>