<?php
if(!(isset($_COOKIE['authentificate']))){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Administrator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: space-around;
            width: 600px;
        }

        .square {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        input, select {
            margin-bottom: 10px;
            padding: 8px;
            width: 300px;
        }
        .error-message {
            color: #ff0000; 
            margin-top: 10px;
        }

    </style>
</head>

<body>
        
    <div class="container">
        
        <div class="square">
            <p>Introdu categorii de produse!</p>
            <form action="pagina_categorii.php" method="post">
               
                <label for="descriereCategorie">Descriere Categorie:</label>
                <input type="text" id="descriereCategorie" name="descriereCategorie" required>
                <?php
                    if (isset($_GET["error"]) && $_GET["error"] === "descriere_used") {
                        echo '<div class="error-message">Descriere deja folosita la alta categorie , foloseste alta</div>';
                    }
                ?>

                <button type="submit">Introducere Categorie</button>
            </form>
        </div>

        
        <div class="square">
            <p>Introdu produse!</p>
            <form action="pagina_produse.php" method="post">
               
                <label for="numeProdus">Nume Produs:</label>
                <input type="text" id="numeProdus" name="numeProdus" required>

                <label for="descriereProdus">Descriere Produs:</label>
                <input type="text" id="descriereProdus" name="descriereProdus" required>

                <label for="pretProdus">Pret Produs:</label>
                <input type="text" id="pretProdus" name="pretProdus" required>

                <label for="stocProdus">Stoc Produs:</label>
                <input type="text" id="stocProdus" name="stocProdus" required>

                <label for="idCategorieProdus">ID Categorie Produs:</label>
                <input type="text" id="idCategorieProdus" name="idCategorieProdus" required>

                <?php
                    if (isset($_GET["error"]) && $_GET["error"] === "categorie_not_used") {
                        echo '<div class="error-message">Categoria nu exista</div>';
                    }
                ?>

                
                <button type="submit">Introducere Produs</button>
            </form>
        </div>
    </div>

</body>
</html>