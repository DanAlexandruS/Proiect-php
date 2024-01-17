<?php
if(!(isset($_COOKIE['authentificate']))){
    header("Location: index.php");
}


session_start();

$link = mysqli_connect("localhost", "hr", "123", "proiect");

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];


   
    $sql = "SELECT adresa_livrare, adresa_facturare, telefon, data_inregistrare FROM clienti WHERE user_name = '$userID'";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
      } else {
        echo "User not found in the database.";
        exit();
    }

    
    $link->close();
} else {
    echo "Session not set. User not logged in.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .welcome-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            color: #3498db;
        }

        p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Welcome: <?php echo $userID; ?>!</h1>
        <p>Delivery Address: <?php echo $row['adresa_livrare']; ?></p>
        <p>Billing Address: <?php echo $row['adresa_facturare']; ?></p>
        <p>Phone: <?php echo $row['telefon']; ?></p>
        <p>Registration Date: <?php echo $row['data_inregistrare']; ?></p>

       
   
   </div>
   <a href="generate_pdf.php" download="generated_pdf.pdf">
        <button>Download PDF</button>
    </a>
</body>
</html>
