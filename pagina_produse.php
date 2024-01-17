<?php
if(!(isset($_COOKIE['authentificate']))){
    header("Location: index.php");
}
$link = mysqli_connect("localhost", "hr", "123", "proiect");
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$numeProdus = test_input($_POST["numeProdus"]);
$descriereProdus = test_input($_POST["descriereProdus"]);
$pretProdus = test_input($_POST["pretProdus"]);
$stocProdus = test_input($_POST["stocProdus"]);
$idCategorieProdus = test_input($_POST["idCategorieProdus"]);

$check_query = "SELECT id FROM categorie_produse WHERE id = ?";
$check_stmt = mysqli_prepare($link, $check_query);
mysqli_stmt_bind_param($check_stmt, "i", $idCategorieProdus);
mysqli_stmt_execute($check_stmt);
mysqli_stmt_store_result($check_stmt);

if($check_stmt || $check_stmt->num_rows >0){ 
    header("Location: admin.php?error=categorie_not_used");
}

$insert_query = "INSERT INTO produse (nume, descriere, pret, stoc, id_categorie, data_adaugare) VALUES (?, ?, ?, ?, ?, NOW())";
$insert_stmt = mysqli_prepare($link, $insert_query);
mysqli_stmt_bind_param($insert_stmt, "ssddi", $numeProdus, $descriereProdus, $pretProdus, $stocProdus, $idCategorieProdus);

if (mysqli_stmt_execute($insert_stmt)) {
    echo "Produs inserat cu succes!";
} else {
    echo "Error: " . $insert_query . "<br>" . mysqli_error($link);
}

mysqli_stmt_close($insert_stmt);
mysqli_close($link);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
