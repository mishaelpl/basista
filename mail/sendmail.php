<?php
require_once 'config.php';

$json = array();
$email = isset( $_POST['email'] ) ? $_POST['email'] : '';
$name = isset( $_POST['name'] ) ? $_POST['name'] : '';
$message = isset( $_POST['message'] ) ? $_POST['message'] : '';

if( !$name ) {
    $json['error']['name'] = 'Podaj imię i nazwisko.';
}
if( !$message ) {
    $json['error']['message'] = 'Wpisz treść wiadomości.';
}
if( !$email || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $email ) ) {
    $json['error']['email'] = 'Wpisz adres e-mail.';
}

// If no errors
if( !isset( $json['error'] ) ) {
    // Email text
    $mail_message  = "-------- F O R M U L A R Z --------------" . "\r\n";
    $mail_message .= "|> www.basistadesign.pl" . "\r\n";
    $mail_message .= "----" . "\r\n";
    $mail_message .= "|> Nadawca: " . $name . "\r\n";
    $mail_message .= "----" . "\r\n";    
    $mail_message .= "|> E-mail: " . $email . "\r\n";
    $mail_message .= "----" . "\r\n";    
    $mail_message .= "|> Treść wiadomości:\r\n\r\n|  " . $message . "";
    // Email title
    $mail_headers  = "Content-type: text/plain; charset=utf-8\r\n";
    $mail_headers .= "Nadawca: {$mail_sender}\r\n";
    // Sending email
    mail( $to_email, $mail_subject, $mail_message, $mail_headers );
    $json['success'] = 'Twoja wiadomość została przesłana!';
}

echo json_encode( $json );
?>