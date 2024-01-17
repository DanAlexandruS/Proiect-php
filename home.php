<?php

if(!(isset($_COOKIE['authentificate']))){
    header("Location: index.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
</head>
<body>

    <header>
        <a href="cont.php">Cont</a>
        <a href="produse_list.php">Produse</a>
        <a href="comanda.php">Comenzi</a>
        <a href="contact.php">Contact</a>
    </header>

    <!-- Your page content goes here -->

</body>
</html>
