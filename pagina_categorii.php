<?php
if(!(isset($_COOKIE['authentificate']))){
    header("Location: index.php");
}
$link = mysqli_connect("localhost", "hr", "123", "proiect");

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$categorie = test_input($_POST["descriereCategorie"]);


$select_query = "SELECT DESCRIERE FROM categorie_produse WHERE DESCRIERE = ?";
$select_stmt = mysqli_prepare($link, $select_query);
mysqli_stmt_bind_param($select_stmt, "s", $categorie);
mysqli_stmt_execute($select_stmt);
mysqli_stmt_store_result($select_stmt);


if (mysqli_stmt_num_rows($select_stmt) > 0) {
    header("Location: admin.php?error=descriere_used");
} else {

    $insert_query = "INSERT INTO categorie_produse (descriere) VALUES (?)";
    $insert_stmt = mysqli_prepare($link, $insert_query);
    mysqli_stmt_bind_param($insert_stmt, "s", $categorie);

    if (mysqli_stmt_execute($insert_stmt)) {
        echo "Categorie inserata cu succes!";
    } else {
        echo "Error: " . $insert_query . "<br>" . mysqli_error($link);
    }

    mysqli_stmt_close($insert_stmt);
}

mysqli_stmt_close($select_stmt);
mysqli_close($link);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
