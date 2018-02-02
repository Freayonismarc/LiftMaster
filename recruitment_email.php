<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "jacinto.marc@gmail.com";
    $email_subject = "Feedback";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['firstname']) ||
        !isset($_POST['degree']) ||
        !isset($_POST['lastname']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['email']) ||
        !isset($_POST['college']) ||
        !isset($_POST['info'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $firstname = $_POST['firstname']; // required
    $degree = $_POST['degree']; // required
    $college = $_POST['college']; // required
    $lastname = $_POST['lastname'];
    $telephone = $_POST['telephone']; // not required
    $email_from = $_POST['email'];
    $info = $_POST['info']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($string_exp,$degree)) {
    $error_message .= 'The Degree you entered does not appear to be valid.<br />';
  }

if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$firstname)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }

  if(!preg_match($string_exp,$lastname)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }

  if(!preg_match($string_exp,$college)) {
    $error_message .= 'The College you entered does not appear to be valid.<br />';
  }
 
  if(strlen($info) < 2) {
    $error_message .= 'The Information you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Name: ".clean_string($firstname) + ($lastname)."\n";
    $email_message .= "College/Company: ".clean_string($college)."\n";
    $email_message .= "Degree: ".clean_string($degree)."\n";
    $email_message .= "Email Address: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Information: "."\n".clean_string($info)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
You'll hear from us as soon as your information has been reviewed. <a href="https://liftmaster.000webhostapp.com/">BACK TO HOME PAGE</a>
 
<?php
 
}
?>