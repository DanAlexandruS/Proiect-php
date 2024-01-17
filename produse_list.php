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
    <title>Afișare Produse</title>
</head>
<body>

<h2>Produse</h2>

<?php
// Conectare la baza de date
$link = mysqli_connect("localhost", "hr", "123", "proiect");

// Verificare conexiune
if ($link->connect_error) {
    die("Conexiunea la baza de date a eșuat: " . $link->connect_error);
}

// Interogare pentru a obține toate produsele
$sql_categorii = "SELECT id,descriere from categorie_produse";
$result_categorii =$link->query($sql_categorii);
if($result_categorii->num_rows > 0){
    while($rowCategorie = $result_categorii->fetch_assoc()){
        echo "<h3>" . $rowCategorie["descriere"] . "</h3>";
        $idCategorie = $rowCategorie["id"];
        $sql = "SELECT id_produs, nume, descriere, pret, stoc FROM produse WHERE id_categorie = '$idCategorie'";
        $result = $link->query($sql);

        // Verificare dacă există rezultate
        if ($result->num_rows > 0) {
            // Afișare rezultate într-un tabel
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Nume</th><th>Descriere</th><th>Pret</th><th>Stoc</th></tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_produs"] . "</td>";
                echo "<td>" . $row["nume"] . "</td>";
                echo "<td>" . $row["descriere"] . "</td>";
                echo "<td>" . $row["pret"] . "</td>";
                echo "<td>" . $row["stoc"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Nu există produse în baza de date.";
        }
}
}
// Închidere conexiune
$link->close();
?>

</body>
</html>
