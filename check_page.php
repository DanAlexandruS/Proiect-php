<?php


$link = mysqli_connect("fdb1031.runhosting.com", "4396875_proiect", "myDatabse1", "4396875_proiect");

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = test_input($_POST['email']);
$password = test_input($_POST['password']);



$check_query = "SELECT user_name , parola ,tip FROM clienti WHERE email = '$email'";
$check_result = $link->query($check_query);

if ($check_result) {
    
    if ($check_result->num_rows > 0) {
       
        $row = $check_result->fetch_assoc();

      
        $foundId = $row['user_name'];

       
        if (password_verify($password, $row['parola'])) {
            $tip = $row['tip'];
            if($tip == 'client')
                header("Location: home.php");
            else{
                header("Location: admin.php");
            }
        } else {
           
            echo "Invalid password.";
        }
       
    } else {
        echo "Email does not exist in the database.";
    }
    
} else {
    echo "Error: " . $link->error;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

mysqli_close($link);
?>
