<?php
//If we edit the user, we do not want to display the forms
if (!isset($_SESSION['logged_in']) and (!isset($_GET['action']) or $_GET['action'] != "edit")) {
  displayForms();
}

// LOGIN USER
if (isset($_GET['action']) and $_GET['action'] === 'login' and $_POST['username'] != '') {
 login($_POST['username'],$_POST['password']);
}

// REGISTER USER
if (isset($_GET['action']) and $_GET['action'] === 'register') {
 register($_POST);
}

// EDIT USER
if (isset($_GET['id']) and isset($_GET['action']) and $_GET['action'] == "edit") {
  editForm($_GET['id']);
}

if (isset($_GET['action']) and $_GET['action'] == "edit" and isset($_POST['id'])) {
  edit($_POST);
}

// DELETE USER
if (isset($_GET['action']) and $_GET['action'] === 'delete') {
    delete($_GET['id']);
}

// LIST USERS
if ($_SESSION['logged_in']) {
  displayUsers();
}

?>