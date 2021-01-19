<?php
//Version 1 - sans fonctions

//If we edit the user, we do not want to display these forms
if (!isset($_SESSION['logged_in']) and (!isset($_GET['action']) or $_GET['action'] != "edit")) { ?>
  <h2 class="w3-wide">S'identifier</h2>
  <form action="?page=login&action=login" method="post">
    <label for="">Username: </label>
    <input type="text" name="username"><br />
    <label for="">Password: </label>
    <input type="password" name="password"><br />
    <input type="submit" name="register" value="Valider">
  </form>
  <hr>
  <h2 class="w3-wide">Créer un compte</h2>
  <form action="?page=login&action=register" method="post">
    <label for="">Nom: </label>
    <input type="text" name="nom"><br />
    <label for="">Prénom: </label>
    <input type="text" name="prenom"><br />
    <label for="">Email: </label>
    <input type="text" name="email"><br />
    <label for="">Username: </label>
    <input type="text" name="username"><br />
    <label for="">Password: </label>
    <input type="password" name="password"><br />
    <input type="submit" name="register" value="Valider">
  </form>
  <hr>
<?php } ?>

<?php
////////////////////////////////// CREATE CONNECTION DATABASE //////////////////////////////////
try {
  $dbh = new PDO("sqlite:./database.sqlite");
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}
////////////////////////////////// END CREATECONNECTION DATABASE //////////////////////////////////

////////////////////////////////// LOGIN USER //////////////////////////////////
if (isset($_GET['action']) and $_GET['action'] === 'login') {

  $query = "SELECT * FROM users WHERE username='" . $_POST['username'] . "'";
  // echo $query."<br/>";
  $result = $dbh->query($query); //exécuter la requête

  $user = $result->fetch();

  if ($user and $user["password"] == $_POST['password']) {
    echo "Identification réussie";
    $_SESSION['logged_in'] = true;
    $_SESSION['name'] = $user["prenom"];
    header('Location: ?action=login'); //redirect
  } else {
    echo "username ou mdp erroné";
  }
}
////////////////////////////////// END LOGIN USER //////////////////////////////////

////////////////////////////////// REGISTER USER //////////////////////////////////
if (isset($_GET['action']) and $_GET['action'] === 'register') {
  $requete_insert = "
    INSERT INTO `users`
    (`nom`, `prenom`, `email`, `username`, `password`)
    VALUES ('" . $_POST['nom'] . "', '" . $_POST['prenom'] . "', '" . $_POST['email'] . "', '" . $_POST['username'] . "', '" . $_POST['password'] . "');
    ";
  $result = $dbh->query($requete_insert); //exécuter la requête
  // print_r($result);

  if ($result) {
    echo "Enregistrement réussi";
  }
}
////////////////////////////////// END REGISTER USER //////////////////////////////////

////////////////////////////////// EDIT USER //////////////////////////////////
if (isset($_GET['id']) and isset($_GET['action']) and $_GET['action'] == "edit") {
  $query = "SELECT * FROM users WHERE id=" . $_GET['id'];
  $user = $dbh->query($query)->fetch();
?>
  <h2 class="w3-wide">Editer un compte</h2>
  <form action="?page=login&action=edit" method="post">
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>"> <!-- add a hidden form input with the user ID -->
    <label for="">Nom: </label>
    <input type="text" name="nom" value="<?php echo $user['nom']; ?>"><br />
    <label for="">Prénom: </label>
    <input type="text" name="prenom" value="<?php echo $user['prenom']; ?>"><br />
    <label for="">Email: </label>
    <input type="text" name="email" value="<?php echo $user['email']; ?>"><br />
    <label for="">Username: </label>
    <input type="text" name="username" value="<?php echo $user['username']; ?>"><br />
    <label for="">Password: </label>
    <input type="password" name="password" value="<?php echo $user['password']; ?>"><br />
    <input type="submit" name="edit" value="Valider">
  </form>
  <hr>
  <?php }
if (isset($_GET['action']) and $_GET['action'] == "edit" and isset($_POST['id'])) {
  $query = "
    UPDATE `users` SET
    `nom` = '" . $_POST['nom'] . "', 
    `prenom` = '" . $_POST['prenom'] . "',
    `email` = '" . $_POST['email'] . "',
    `username`= '" . $_POST['username'] . "',
    `password`= '" . $_POST['password'] . "'
    WHERE id=" . $_POST['id'] . ";";
  // echo $query;
  $result = $dbh->query($query); //exécuter la requête
  if ($result) {
    echo "Utilisateur mis à jour";
  } else {
    print_r($dbh->errorInfo());
  }
}
////////////////////////////////// END EDIT USER //////////////////////////////////

////////////////////////////////// DELETE USER //////////////////////////////////
if (isset($_GET['action']) and $_GET['action'] === 'delete') {

  $query = "DELETE FROM users WHERE id='" . $_GET['id'] . "'";
  // echo $query."<br/>";
  $result = $dbh->query($query); //exécuter la requête
  print_r($result);

  if ($result) {
    echo "Utilisateur " . $_GET['id'] . " supprimé !";
  } else {
    echo "utilsateur non trouvé";
  }
}
////////////////////////////////// END DELETE USER //////////////////////////////////

////////////////////////////////// LIST USERS //////////////////////////////////
if ($_SESSION['logged_in']) {
  echo '<hr/><br/>liste utilisateurs<br/>';
  echo '<table>';
  echo '<tr><td>ID</td><td>prenom</td><td>nom</td><td>email</td><td>username</td><td>Controls</td></tr>';
  foreach ($dbh->query('SELECT * from users') as $row) {
    // print_r($row);
  ?>
    <tr>
      <td><?php echo $row['id'] ?></td>
      <td><?php echo $row['prenom'] ?></td>
      <td><?php echo $row['nom'] ?></td>
      <td><?php echo $row['email'] ?></td>
      <td><?php echo $row['username'] ?></td>
      <td><a href="?page=login&action=edit&id=<?php echo $row['id'] ?>">Editer</a> | <a href="?page=login&action=delete&id=<?php echo $row['id'] ?>">Supprimer</a></td>
    </tr>
<?php
  }
  echo '<table>';
}
////////////////////////////////// END LIST USERS //////////////////////////////////
?>