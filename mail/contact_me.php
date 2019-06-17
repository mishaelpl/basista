<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "Nie wpisano danych !";
	return false;
   }
	
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$message = strip_tags(htmlspecialchars($_POST['message']));
	
// Create the email and send the message
$to = 'szczecinpogotowiekomputerowe@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "- Formularz -";
$email_body = "Wiadomość ze strony.\n\n"."Szczegóły wiadomości:\n\nNadawca: $name\n\nEmail: $email_address\n\nTreść:\n$message";
$headers = "From: basista@basistadesign.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
// $headers .= "Reply-To: $email_address";	
$mail=mail($to, "Nadawca: $email_subject",$email_body );
if($mail){
echo "Wiadomość została przesłana";
}else{
echo "Błąd - nie przesłano wiadomości";
}
return true;			
?>
