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
    <form action="check_page.php" method="post">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required>

      <button type="submit">Login</button>
    </form>

    <a href="signup.php" class="sign-up-link">Sign Up</a>
  </div>
</body>
</html>
