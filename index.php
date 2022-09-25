<?php
echo "<pre>";

print_r($_POST);

$message_sent = false; 
if(isset($_POST['email']) && $_POST['email'] != ''){
   
   if(filter_var($_POST['email'], FILTER_INVALID_EMAIL) ){

 
$userName = $_POST['name']; //
$userEmail = $_POST['email']; //
$userComment = $_POST['Comment']; //
$subject = $_POST['Email from Contact Form'];

$to = "contact@johnmcafeefoundation.org";
$body = "";

$body .= "From:" .$userName. "\r\n";
$body .= "Email:" .$userEmail. "\r\n";
$body .= "Comment:" .$comment. "\r\n";

mail($to,$comment,$body);
$contact->honeypot = $_POST['first_name'];
$contact->recaptcha_secret_key = 'Your_reCAPTCHA_secret_key';
$message_sent = true;

   }
   else {
    $invalid_class_name = "form-invalid";
   }
}


?>
<?php
if($message_sent):
?>

<?php
endif;  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-U-Compatible" content="IT-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  
  <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="http://fonts.cdnfonts.com/css/lucida-console" rel="stylesheet">
  <link rel="stylesheet" href="/sass/style.css">
  <title>John McAfee Foundation </title>
</head>

<?php

function isValid(){
    if(
        $_POST['name'] != '' &&
        $_POST['email'] != '' &&
        $_POST['message'] != ''
    ) {

        return true;
    }
    return false;
}

$success_output = '';
$error_output = '';

if (isValid()) {
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6Lc92REiAAAAAFnWKaNTSmfo4pTj6ASDNVlgraUr'
    $recaptcha_response = $_POST ['recaptchaResponse'];
    $recaptcha = file_get_contents($recaptcha_url.'?secret='.
    $recaptcha_secret.'&response='.$recaptcha_response);
    $recaptcha = json_decode($recaptcha);
    if($recaptcha-> sucess == true && $recaptcha->score >= 0.5 &&
    $recaptcha->action = 'contact'){
        // run email send routine 
        $success_output = 'Your message was sent successfully!';
    }else{
        $error_output = 'Something went wrong please try again later'
    }
}else{
    $error_output = 'Please, fill out the form fields'
}

$output = [
    'error' => $error_output,
    'sucess' => $success_output
];

echo json_encode($output);

<script src="https://www.google.com/recaptcha/api.js"></script>

<div class="header">
    <img src="/imgs/mcafeekey.jpg" alt="">
</div>

<h2> John McAfee Foundation</h2>

<div class = "box">
<img src="/imgs/background.jpg" alt = "background">
</div>
<body>

<div class = "comment-box">
    <h2>Comments</h2>
    <br>  
    <form method = "post" id = "contact" class = "contact">
        <input type="hidden" name = "recaptchaResponse" id = "recaptchaResponse">
        <div class = "formfields"></div>
            <div class="row">
                <div class = "col-md-6">
                    <input type = "text" name ="name" id = "name" 
                    class="form-control form-control-lg"
                    placeholder="Name">
                    <div class="form-element">
                        <input type = "text" name ="email" id = "email" 
                        class="form-control form-control-lg"
                        placeholder="Email Address">
                    </div>
                </div>
                        <div class = "form-element">
                        <textarea name="message" id="message" cols="30" rows="10" 
                        class = "form-control form-control-lg" placeholder="Submit a comment..."></textarea>
                        <button type = "submit" class="btn btn-lg btn-primary"
                        id = "button">Submit</button>
                        <br>
                        <br>
                        <br>
                        <p class = "text-center">
                            <small>This site is proetected by reCAPTCHA and the Google <br> <a href = "https://policies.google.com/privacy">Privacy Policy</a> and
                            <a href = "https://policies.google.com/terms">Terms of Service</a> apply.</small>
                        </p>
                    </div>
                </div>
            </div>
         </div> 
    </div>
    <div id = "alert"></div>
    </form>
</div>

<div class = "footer">
    <h1> © John McAfee Foundation All Rights Reserved 2022</h1>
</div>

</body>

<?php

//check if form was sent
if($_POST){

	$to = 'some@email.com';
	$subject = 'Testing HoneyPot';
	$header = "From: $name <$name>";

	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	//honey pot field
	$honeypot = $_POST['firstname'];

	//check if the honeypot field is filled out. If not, send a mail.
	if( ! empty( $honeypot ) ){
		return; //you may add code here to echo an error etc.
	}else{
		mail( $to, $subject, $message, $header );
	}
}

?>

<script src="https://www.google.com/recaptcha/api.js?
render=6Lc92REiAAAAAHT0cifOKoXj343OCPt0jahls7GR"></script>
<script src="/jmf/validation.js"></script>
</html>