<?php

if(!(isset($_POST['email']))){
    header("Location: index.php");
}

$link = mysqli_connect("localhost", "hr", "123", "proiect");
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = test_input($_POST['email']);
$password =test_input($_POST['password']);
$username= test_input($_POST['username']);
$adresaL=test_input($_POST['adresaL']);
$adresaF=test_input($_POST['adresaF']);
$telephone=test_input($_POST['telephone']);
print_r ($_POST);

$check_query = "SELECT email , user_name FROM CLIENTI WHERE EMAIL = '$email' OR USER_NAME='$username'";
$check_result = $link->query($check_query);

if($check_result && $check_result->num_rows>0){
    header("Location: signup.php?error=email_in_use");
}else {

    $Newpassword = password_hash($password, PASSWORD_DEFAULT);
   
    $insert_query = "INSERT INTO CLIENTI (email, parola, user_name, adresa_livrare, adresa_facturare, telefon, data_inregistrare , tip) 
                     VALUES (?, ?, ?, ?, ?, ?, NOW(), 'client')";

    $stmt = mysqli_prepare($link, $insert_query);

   
    mysqli_stmt_bind_param($stmt, "ssssss", $email, $Newpassword, $username, $adresaL, $adresaF, $telephone);

    
    if (mysqli_stmt_execute($stmt)) {
        echo "Registration successful!";
       
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

   
    mysqli_stmt_close($stmt);
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


?>