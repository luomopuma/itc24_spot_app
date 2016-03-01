<?php
/* template.php

Use this file as a model for making application pages.

*/
?>
<?php include 'includes/config.php';?>
<?php include 'includes/header.php';?>

<h3>Contact Us</h3>
<?php
	// Here we build a FORM HANDLER
	if(isset($_POST['email']))
		{// data sent - send email
		/* echo '<pre>';
		var_dump($_POST);
		echo '</pre>'; */
		
		$to = 'luomopuma@gmail.com';
		$subject = 'test';
		$content = '
		<p><strong>Comments: </strong></p>
		<p>'.$_POST['comments'].'</p>
		
		';
		$replyTo = $_POST['email'];
		
		$response = safeEmail($to, $subject, $content, $replyTo, 'html');

		if($response)
		{
			echo '<p>Get back to you shortly!</p>';
		}else{
		   echo 'Trouble with HTML email!<br />'; 
		}
	}else
	{// show form
		echo '
		<form action="contact.php" method="post">
		<p>Name: <input type="text" name="name" /></p>
		<p>Email: <input type="email" name="email"/></p>
		<p>Comments: <textarea name="comments"></textarea></p>
		<p><input type="submit" value="Contact Us" /></p>
		</form>
		';
		
	}

?>
<?php include 'includes/footer.php';?>
