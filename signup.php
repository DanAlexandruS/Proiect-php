<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Login Form</title>
</head>
<body>
  <div class="form-container">
    <form action="register_user.php" method="post">
    <?php
        
        if (isset($_GET["error"]) && $_GET["error"] === "email_in_use") {
            echo '<div class="error-message">Email sau user este deja folosit. Please choose another one.</div>';
        }
        ?>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="Introduce email" required>

      <label for="username">Username:</label>
      <input type="username" id="username" name="username" placeholder="Introduce username" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Introduce parola" required>

      <label for="adresaL">Adresa livrare:</label>
      <input type="adresaL" id="adresaL" name="adresaL" placeholder="Introduce adresa livrare" required>

      <label for="adresaF">Adresa facturare:</label>
      <input type="adresaF" id="adresaF" name="adresaF" placeholder="Introduce adresa facturare" required>
      
      <label for="telephone">Telephone Number:</label>
    <input type="tel" id="telephone" name="telephone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
    <small>Format: 123-456-7890</small>

    <br>
      <button type="submit">Sign up</button>
    </form>

    
  </div>
</body>
</html>
