<?php
  // Set the default timezone to Asia/Colombo
  date_default_timezone_set('Asia/Colombo');

  // Replace with your real receiving email address
  $receiving_email_address = 'mirissasnorkelingadventures@gmail.com';
  $current_date_time = date('d-M-y h:i:s A');

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_name = strip_tags(trim($_POST['name']));
    $from_email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST['subject']));
    $message = trim($_POST['message']);
    
    // Check that data was sent to the mailer.
    if (!empty($from_name) && !empty($from_email) && !empty($subject) && !empty($message) && filter_var($from_email, FILTER_VALIDATE_EMAIL)) {
        $to = $receiving_email_address;
        $email_subject = "$subject";
        $email_body = "<html><body style='font-family: poppins, sans-serif; color: #333;'>";
        $email_body .= "<div style='max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9;'>";
        $email_body .= "<h2 style='color: #0056b3;'><center>Mirissa Snorkeling Adventures</center></h2>";
        $email_body .= "<p style='font-size: 16px;'>This email received from your website</p>";
        $email_body .= "<p style='font-size: 16px;'><strong>Name:</strong> $from_name</p>";
        $email_body .= "<p style='font-size: 16px;'><strong>Email:</strong> $from_email</p>";
        $email_body .= "<p style='font-size: 16px;'><strong>Date & Time:</strong> $current_date_time</p>";
        $email_body .= "<p style='font-size: 16px;'><strong>Message:</strong></p>";
        $email_body .= "<p style='font-size: 16px; padding: 10px; border: 1px solid #ddd; border-radius: 4px; background-color: #fff;'>$message</p>";
        $email_body .= "</div>";
        $email_body .= "</body></html>";

        $headers = "From: $from_name <$from_email>\r\n";
        $headers .= "Reply-To: $from_email\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        // Send the email
        if (mail($to, $email_subject, $email_body, $headers)) {
            echo 'OK'; // This is the response JavaScript is looking for
        } else {
            echo 'Unable to send email. Please try again.';
        }
    } else {
        echo 'Please complete all fields and provide a valid email address.';
    }
  } else {
    echo 'There was an error with your submission. Please try again.';
  }
?>
