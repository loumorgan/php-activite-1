<?php

print_r($_GET);

include './header.php';

$filename = $_GET['page'].'.php';

if (file_exists($filename)) {
    include $filename;
} else {
    include "404.php";
}


include './footer.php'; 

?>