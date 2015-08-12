<?php 
//////////////////////////
//Specify default values//
//////////////////////////

//Your E-mail
//TODO change the below ID once official is available
$your_email = 'monarksinghyede@gmail.com';

//Default Subject if 'subject' field not specified
$default_subject = 'New customer has requested a site visit';

//Message if 'name' field not specified
$name_not_specified = 'Please type a valid name';

//Message if 'message' field not specified
$phoneNumber_not_specified = 'Please type a vaild phone number';

//Message if e-mail sent successfully
$email_was_sent = 'Thanks, your message successfully sent';

//Message if e-mail not sent (server not configured)
$server_not_configured = 'Sorry, mail server not configured';


///////////////////////////
//Contact Form Processing//
///////////////////////////
$errors = array();
if(isset($_POST['phone']) and isset($_POST['name'])) {
	if(!empty($_POST['name']))
		$sender_name  = stripslashes(strip_tags(trim($_POST['name'])));
	
	if(!empty($_POST['phone']))
		$phone      = stripslashes(strip_tags(trim($_POST['phone'])));
	
	if(!empty($_POST['email']))
		$sender_email = stripslashes(strip_tags(trim($_POST['email'])));

	if(!empty($_POST['address']))
    		$address = stripslashes(strip_tags(trim($_POST['address'])));
	
	if(!empty($_POST['date']))
		$date      = stripslashes(strip_tags(trim($_POST['date'])));


	//Message if no sender name was specified
	if(empty($sender_name)) {
		$errors[] = $name_not_specified;
	}

	//Message if no phone number was specified
	if(empty($phone)) {
		$errors[] = $phoneNumber_not_specified;
	}

	$from = (!empty($sender_email)) ? 'From: '.$sender_email : '';

	$subject = (!empty($subject)) ? $subject : $default_subject;

	$message = "Name :".$sender_name;
	$message .= "\nPhone Number :".$phone;
	$message .= "\nEmail ID :".$sender_email;
	$message .= "\nAddress :".$address;
	$message .= "\nDate for visit :".$date;



	//sending message if no errors
	if(empty($errors)) {
		if (mail($your_email, $subject, nl2br($message), $from)) {
			echo $email_was_sent;
		} else {
			$errors[] = $server_not_configured;
			echo implode('<br>', $errors );
		}
	} else {
		echo implode('<br>', $errors );
	}
} else {
	// if "name" or "message" vars not send ('name' attribute of contact form input fields was changed)
	echo '"name" and "phone number" variables were not received by server. Please check "name" attributes for your input fields';
}
?>