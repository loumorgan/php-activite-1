<?php

function displayForms()
{
?>
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
  <?php
}

// return db connection
function db()
{
  try {

    // return new PDO('mysql:host=localhost;dbname=test', 'username', 'password'); //pour MySQL
    return new PDO("sqlite:./database.sqlite"); //pour SQLite

  } catch (PDOException $e) {
    print "Erreur fatale de connexion à la base de données : " . $e->getMessage() . "<br/>";
    die();
  }
}

//try to login user against database
function login($username, $password)
{
  $query = "SELECT * FROM users WHERE username='" . $username . "'";
  $result = db()->query($query); //exécuter la requête
  $user = $result->fetch();
  if ($user and $user["password"] == $password) {
    echo "Identification réussie";
    $_SESSION['logged_in'] = true;
    $_SESSION['name'] = $user["prenom"];
    header('Location: ?action=login'); //redirect
  } else {
    echo "username ou mdp erroné";
  }
}

//register
function register($data)
{
  $requete_insert = "INSERT INTO `users` (`nom`, `prenom`, `email`, `username`, `password`) VALUES ('" . $data['nom'] . "', '" . $data['prenom'] . "', '" . $data['email'] . "', '" . $data['username'] . "', '" . $data['password'] . "');
  ";
  $result = db()->query($requete_insert); //exécuter la requête
  if ($result) {
    echo "Enregistrement réussi";
  } else {
    echo "Enregistrement raté...";
  }
}

function editForm($id)
{
  $query = "SELECT * FROM users WHERE id=" . $id;
  $user = db()->query($query)->fetch();
  if ($user) {
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
  <?php
  } else {
    echo "Utilisateur non trouvé";
  }
}

function edit($data)
{
  $query = "
  UPDATE `users` SET
  `nom` = '" . $data['nom'] . "', 
  `prenom` = '" . $data['prenom'] . "',
  `email` = '" . $data['email'] . "',
  `username`= '" . $data['username'] . "',
  `password`= '" . $data['password'] . "'
  WHERE id=" . $data['id'] . ";";

  $result = db()->query($query); //exécuter la requête

  if ($result) {
    echo "Utilisateur mis à jour";
  } else {
    print_r(db()->errorInfo());
  }
}


function delete($id)
{
  $query = "DELETE FROM users WHERE id='" . $id . "'";
  $result = db()->query($query); //exécuter la requête

  if ($result) {
    echo "Utilisateur " . $id . " supprimé !";
  } else {
    echo "utilsateur non trouvé";
  }
}

function displayUsers()
{
  echo '<hr/><br/>liste utilisateurs<br/>';
  echo '<table>';
  echo '<tr><td>ID</td><td>prenom</td><td>nom</td><td>email</td><td>username</td><td>Controls</td></tr>';
  foreach (db()->query('SELECT * from users') as $row) {
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
