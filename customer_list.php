<?php
/* customer_list.php

Use this file as a model for making application pages.

*/
?>
<?php include 'includes/config.php';?>
<?php include 'includes/header.php';?>

<?php

/* Query variable */
$sql = "select * from test_Customers";

/* Creates a variable-stored instance of a MySQL connection */
/* The OR DIE uses the GLOBAL MAGIC CONSTANTS contained in the __ tags */
/* An error here likely means a log-in issue in CREDENTIALS.PHP */
$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die(myerror(__FILE__,__LINE__,mysqli_connect_error()));

/* Stores the result table of a function, mysqli_query, as a MYSQLI_RESULT object (failure returns FALSE) which uses the connection and query variables. */
$result = mysqli_query($iConn,$sql) or die(myerror(__FILE__,__LINE__,mysqli_error($iConn)));
if (mysqli_num_rows($result) > 0)//at least one record!
{//show results
	// This function takes a RESULT row and converts it to an ASSOCIATIVE ARRAY
	while ($row = mysqli_fetch_assoc($result))
    {
	   echo "<p>";
	   echo "FirstName: ";
	   echo '<a href="customer_view.php?id=' . $row['CustomerID'] . '">'. $row['FirstName'] .'</a><br />';
	   echo "LastName: <b>" . $row['LastName'] . "</b><br />";
	   echo "Email: <b>" . $row['Email'] . "</b><br />";
	
	   echo "</p>";
    }
}else{//no records
	echo '<div align="center">What! No customers?  There must be a mistake!!</div>';
}

@mysqli_free_result($result); #releases web server memory
@mysqli_close($iConn); #close connection to database
?>
	
<?php include 'includes/footer.php';?>
