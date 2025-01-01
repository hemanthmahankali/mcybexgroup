<?php
if(!$_POST) exit;
$email = $_POST['email'];
//$error[] = preg_match('/\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i', $_POST['email']) ? '' : 'INVALID EMAIL ADDRESS';
if(!eregi("^[a-z0-9]+([_\\.-][a-z0-9]+)*" ."@"."([a-z0-9]+([\.-][a-z0-9]+)*)+"."\\.[a-z]{2,}"."$",$email )){
	$error.="Invalid email address entered";
	$errors=1;
}
if($errors==1) echo $error;
else{
	$values = array ('name','email','message','drop_down');
	$required = array('name','email','message','drop_down');
	$your_email = 'info@cybexgroup.com';
	$email_subject = "Message From Cybex Group ".$_POST['subject'];
	/*$email_content = "new message:\n";*/
	$from_email = $_POST['name'].'<'.$_POST['email'].'>'.'<'.$_POST['drop_down'].'>';
	if(!empty($_POST['captcha'])) {
		echo 'PLEASE FILL IN REQUIRED FIELDS'; 
		exit;
	}
	foreach($values as $key => $value){
	  if(in_array($value,$required)){
		if ($key != 'subject' && $key != 'company') {
		  if( empty($_POST[$value]) ) { echo 'Please Fill in Required Fields'; exit; }
		}
		$email_content .= $value.': '.$_POST[$value]."\n";
	  }
	}
	if(@mail($your_email,$email_subject,$email_content, "From: $from_email\r\n")) {
		echo '<div class="success">Thank you! Your message sent successfully!</div>'; 
	} else {
		echo 'ERROR!';
	}
}
?>