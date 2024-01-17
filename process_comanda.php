<?php

if(!(isset($_COOKIE['authentificate']))){
    header("Location: index.php");
}

$link = mysqli_connect("localhost", "hr", "123", "proiect");

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
$userID = $_SESSION['user_id'];
$sql = "SELECT id FROM clienti WHERE user_name = '$userID'";

$result = $link->query($sql);

// Check if the query was successful
if ($result) {
    // Check if there is at least one row in the result set
    if ($result->num_rows > 0) {
        // Fetch the user_id from the first row
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        $id_produs = isset($_POST['product_id']) ? $_POST['product_id'] : null;
       
        $sqlPret = "SELECT pret FROM produse WHERE id_produs = $id_produs";
        $resultPret = $link->query($sqlPret);
        if($resultPret->num_rows>0){
            $pret = ($resultPret->fetch_assoc())['pret'];
        }
        else{
            header("Location:comanda.php");
        }
        $sql = "INSERT INTO comenzi (data_comenzii, status, total, id_client) VALUES (NOW(), 'Pe drum', $pret, $user_id)";
        if ($link->query($sql) === TRUE) {
           $id_comanda = $link ->insert_id;

           // Retrieve id_produs from the POST request
           
           if ($id_produs !== null) {
               // Insert into produs_comanda table
               $cantitate_produs = 1;
       
               $sqlProdusComanda = "INSERT INTO produs_comanda (id_produs, id_comanda, cantitate_produs) VALUES ($id_produs, $id_comanda, $cantitate_produs)";
       
               if ($link->query($sqlProdusComanda) === TRUE) {
                   echo "Records inserted successfully";
               } else {
                   echo "Error inserting into produs_comanda: " . $conn->error;
               }
           } else {
               echo "Error: id_produs not provided in the POST request.";
           }
       } else {
           echo "Error inserting into comenzi: " . $conn->error;
       }
       
       // Close the database connection
       $link->close();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
       
    } else {
        echo "No user found with the name $name";
    }
 











?>