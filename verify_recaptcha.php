<?php 
if(!(isset($_COOKIE['authentificate']))){
    header("Location: index.php");
}
$returnMsg = ''; 
 
if(isset($_POST['submit'])){ 
    
	// Form fields validation check
    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone'])){ 
         
        // reCAPTCHA checkbox validation
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
            // Google reCAPTCHA API secret key 
            $secret_key = '6LcoOVMpAAAAAJ6tbK-fRV_3yneLNnj0HjULDoCX'; 
             
            // reCAPTCHA response verification
            $verify_captcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']); 
            
            // Decode reCAPTCHA response 
            $verify_response = json_decode($verify_captcha); 
             
            // Check if reCAPTCHA response returns success 
            if($verify_response->success){ 
                
                $name = $_POST['name']; 
                $email = $_POST['email']; 
                $phone = $_POST['phone'];
				$message = $_POST['content'];
             
                #email Gmail
				require_once('class.phpmailer.php');
				require_once('mail_config.php');
				

				$mailBody = "User Name: " . $name . "\n";
				$mailBody .= "User Email: " . $email . "\n";
				$mailBody .= "Phone: " . $phone . "\n";
				$mailBody .= "Message: " . $message . "\n";
				
				$mail = new PHPMailer(true); 

				$mail->IsSMTP();

				try {
				 
				  $mail->SMTPDebug  = 0;                     
				  $mail->SMTPAuth   = true; 

				  $toEmail='alexdawphp@gmail.com';
				  $nume='contact';

				  $mail->SMTPSecure = "ssl";                 
				  $mail->Host       = "smtp.gmail.com";      
				  $mail->Port       = 465;                   
				  $mail->Username   = $username;  			// GMAIL username
				  $mail->Password   = $password;            // GMAIL password
				  $mail->AddReplyTo('alexdawphp@gmail.com', 'DAW - project');
				  $mail->AddAddress($toEmail, $nume);
				  $mail->addCustomHeader("BCC: ".$email);
				 
				  $mail->SetFrom($email, $name);
				  $mail->Subject = 'Formular contact';
				  $mail->AltBody = 'To view this post you need a compatible HTML viewer!'; 
				  $mail->MsgHTML($mailBody);
                  
				  $mail->Send();
				  
                  $returnMsg = 'Your message has been submitted successfully.'; 
				  
                }
                 catch (phpmailerException $e) {
												  echo $e->errorMessage(); //error from PHPMailer
												}
				 
            } 
        }
		  else{ 
            
			$returnMsg = 'Please check the CAPTCHA box.'; 
        } 
    }
	 else
			{ 
				$returnMsg = 'Please fill all the required fields.'; 
			} 
} 
echo $returnMsg;
header("Location: home.php");
?>