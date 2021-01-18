<?php

session_start();

// print_r($_SESSION);

if(isset($_GET['action']) and $_GET['action'] == "logout") {
  session_destroy();
  header('Location: ?page=home');
} 

include './lib/users.php';

include './views/header.php';

//si le paramètre $_GET['page'] n'existe pas, on affiche la home
if( ! isset($_GET['page'])){ 
  include "./views/home.php";
}
//sinon
else { 
  $filename = './views/'.$_GET['page'].'.php';
  if (file_exists($filename)) { //on teste si le fichier demandé existe
      include $filename; //si oui on inclut
  } else {
      include "./views/404.php";  //sinon on inclut une 404
  }
}

include './views/footer.php'; 

?>