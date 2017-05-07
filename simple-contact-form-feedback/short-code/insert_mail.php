<?php
$name    = $_POST['cformfullname'];
$email   = $_POST['cformemail'];
$phone   = $_POST['cformphone'];
$city    = $_POST['cformcity'];
$message = $_POST['cformmessage'];
if( isset($name) && isset($email) && isset($phone) && isset($city) && isset($message)){
  include_once( $_SERVER["DOCUMENT_ROOT"].'/wp-config.php' );

  global $wpdb;
  $contact_table = $wpdb->prefix . "simple_contact_form_feedback";
  $row           = "SELECT COUNT(*) FROM $contact_table WHERE cformemail='".$email."'";
  $results       = $wpdb->get_var( $row );  
  if($results>0){
  echo "<strong>You have alredy sent message.</strong>";
  exit; 
  }else{ 
  $sql = "INSERT into $contact_table SET cformfullname ='".$name."', cformemail = '".$email."', cformphone = '".$phone."', cformcity = '".$city."', cformmessage = '".$message."' ";  
  $result = $wpdb->query($sql);
  if ($result) {
    

      $to       = "sandeep@simayaa.com";
      $from     = $email;
      $headers  = "From: " . strip_tags($from) . "\r\n";
      $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
      $headers .= "CC: sandeep@simayaa.com\r\n";   
      $message  = $message;
      $rez = mail($to, "Contact Request", $message,$headers);
      if($rez){
          echo "<strong>Your message was sent succssfully! I will be in touch as soon as I can.</strong>";
      }
      else{
          echo "<strong>Your message was not sent.</strong>";
    }


  }
  else{
    echo "<strong>Something went wrong, try refreshing and submitting the form again.</strong>";
  }
 }
}

?>