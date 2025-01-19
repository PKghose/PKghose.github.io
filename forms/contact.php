<?php
  // Set your receiving email address
  $receiving_email_address = 'partho.ghose@tamu.edu';

  // Check if the PHP Email Form library exists
  $php_email_form = '../assets/vendor/php-email-form/php-email-form.php';
  if (!file_exists($php_email_form)) {
      die('Error: Unable to load the "PHP Email Form" Library!');
  }
  
  include($php_email_form);

  // Initialize the PHP_Email_Form class
  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  // Set email recipient and sender information
  $contact->to = $receiving_email_address;
  
  if (isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
      $contact->from_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
      $contact->from_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      $contact->subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
  
      // Add email content
      $contact->add_message($_POST['name'], 'From');
      $contact->add_message($_POST['email'], 'Email');
      $contact->add_message($_POST['message'], 'Message', 10);
  
      // Uncomment and configure SMTP settings if needed
      /*
      $contact->smtp = array(
          'host' => 'smtp.tamu.edu',  // Replace with your SMTP server
          'username' => 'your_tamu_email@tamu.edu', 
          'password' => 'your_password',
          'port' => '587'
      );
      */

      // Send email and handle response
      if ($contact->send()) {
          echo 'Your message has been sent successfully!';
      } else {
          echo 'Error: Message could not be sent.';
      }
  } else {
      echo 'Error: Missing form fields.';
  }
?>
