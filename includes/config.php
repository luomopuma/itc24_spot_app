<?php
/*
config.php

Provides a place to put all configuration info for our application.

*/

/* Include for db log-in information */
include ("credentials.php");
/* Uncomment to echo the current DB 
echo DB_NAME;
die; */

define('DEBUG',TRUE); #we want to see all errors
//THIS_PAGE is the name of the current page
define('THIS_PAGE',basename($_SERVER['PHP_SELF']));


$nav1['index.php'] = "Home";
$nav1['template.php'] = "Template";
$nav1['contact.php'] = "Contact Us";
$nav1['customer_list.php'] = "Customers";

//echo THIS_PAGE;
// Next line halts execution of the page. JUST the page name nad nothing else.
//die;

ob_start();// Prevents header errors.

switch(THIS_PAGE)
{
	case "index.php":
		$title = "Home page title";
		break;	
	case "template.php":
		$title = "Template page title";
		break;
	default:
		$title = THIS_PAGE;
		break;
}

function makeLinks($ar)
{
	$myReturn = '';
	
	return $myReturn;	
}

/*
<ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="index.html">HOME</a></li>
            <li><a href="about.html">ABOUT</a></li>
            <li><a href="services.html">SERVICES</a></li>
            <li><a href="works.html">WORKS</a></li>
            <li><a data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-envelope-o"></i></a></li>
          </ul>
*/

function myerror($myFile, $myLine, $errorMsg)
{
    if(defined('DEBUG') && DEBUG)
    {
       echo "Error in file: <b>" . $myFile . "</b> on line: <b>" . $myLine . "</b><br />";
       echo "Error Message: <b>" . $errorMsg . "</b><br />";
       die();
    }else{
		echo "I'm sorry, we have encountered an error.  Would you like to buy some socks?";
		die();
    }
}

// The last parameter is always the OPTIONAL parameters, their defaults are set with an assignment-- '='
function safeEmail($to, $subject, $message, $replyTo = '',$contentType='text')
{
	// Creates a noreply address for the server running the script.
    $fromAddress = "Automated Email <noreply@" . $_SERVER["SERVER_NAME"] . ">";

    if(strtolower($contentType)=='html')
    {//change to html format--this gives information to the HEADER
        $contentType = 'Content-type: text/html; charset=iso-8859-1';
    }else{//default is text
        $contentType = 'Content-type: text/plain; charset=iso-8859-1';
    }
    
    $headers[] = "MIME-Version: 1.0";//optional but more correct
    //$headers[] = "Content-type: text/plain; charset=iso-8859-1";
    $headers[] = $contentType;
    //$headers[] = "From: Sender Name <sender@domain.com>";
    $headers[] = 'From: ' . $fromAddress;
    //$headers[] = "Bcc: JJ Chong <bcc@domain2.com>";
    
    if($replyTo !=''){//only add replyTo if passed
        //$headers[] = "Reply-To: Recipient Name <receiver@domain3.com>";
        $headers[] = 'Reply-To: ' . $replyTo;   
    }
    
    $headers[] = "Subject: {$subject}";
    $headers[] = "X-Mailer: PHP/". phpversion();
    
    //collapse all header data into a string with operating system safe
    //carriage returns - PHP_EOL
    $headers = implode(PHP_EOL,$headers);

    //use mail() command internally and pass back the feedback
    return mail($to, $subject, $message, $headers);

}//end safeEmail()


/*
    The function below loops through the entire POST data and creating a single string of name/value pairs to send.  When we do this, we can now add elements and not need to address them in the formhandler!

    There is also a bit of code that replaces any underscores with spaces.  This is useful because we can name our POST variables in such a way that makes it easier for the client to view our emails.

    $to = 'xxx@example.com';
    $message = process_post();
    $replyTo = $_POST['Email'];
    $subject = 'Test from contact form';
    
    safeEmail($to, $subject, $message, $replyTo);

*/

function process_post()
{//loop through POST vars and return a single string
    $myReturn = ''; //set to initial empty value

    foreach($_POST as $varName=> $value)
    {#loop POST vars to create JS array on the current page - include email
         $strippedVarName = str_replace("_"," ",$varName);#remove underscores
        if(is_array($_POST[$varName]))
         {#checkboxes are arrays, and we need to collapse the array to comma separated string!
             $myReturn .= $strippedVarName . ": " . implode(",",$_POST[$varName]) . PHP_EOL;
         }else{//not an array, create line
             $myReturn .= $strippedVarName . ": " . $value . PHP_EOL;
         }
    }
    return $myReturn;
}
?>