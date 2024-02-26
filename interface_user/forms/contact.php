<?php
session_start();

include_once('./../configuration/config.php');

$postData = $_POST;

if (!isset($postData['name']) || !isset($postData['email']) || !isset($postData['subject']) || !isset($postData['message']))
{
	echo('Il faut votre nom, un email , objet d email et un message pour soumettre le formulaire.');
    return;
}	

$name = $postData['name'];
$email = $postData['email'];
$subject = $postData['subject'];
$date = $postData['date'];
$message = $postData['message'];



$insertmessage = $conn->prepare('INSERT INTO MESSAGES(NOM_PRENOM, EMAIL, OBJET, DATE, MESSAGE) VALUES (:name, :email, :subject, :date, :message)');
$insertmessage->execute([
    'name' => $name,
    'email' => $email,
    'subject' => $subject,
    'date' => $date,
    'message' => $message,
]);
?>



<?php
  /**
  * Requires the "PHP Email Form" library
  *  $receiving_email_address = 'contact.com';
  *
  *if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
  *  include( $php_email_form );
  *} else { die( 'Unable to load the "PHP Email Form" Library!'); }
  *
  * $contact = new PHP_Email_Form;
  *$contact->ajax = true;
  *
  *$contact->to = $receiving_email_address;
  *$contact->from_name = $_POST['name'];
  *$contact->from_email = $_POST['email'];
  *$contact->subject = $_POST['subject'];
  *
  *
  *$contact->add_message( $_POST['name'], 'From');
  *$contact->add_message( $_POST['email'], 'Email');
  *$contact->add_message( $_POST['message'], 'Message', 10);
  *
  *echo $contact->send();
  */
  // Replace contact@example.com with your real receiving email address

?>

