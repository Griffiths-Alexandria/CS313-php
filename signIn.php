<?php
/**********************************************************
* File: signIn.php
* Author: Br. Burton
* 
* Description: This page has a form for the user to sign in.
*
* In this case, to show another approach, we will have this
* page have two purposes, it will have the form for signing
* in, but it will also have the logic to check a username
* and password and redirect the user to the home page if
* everything checks out. Thus it will post to itself.
***********************************************************/

require("password.php"); // used for password hashing.
session_start();

$badLogin = false;

// First check to see if we have post variables, if not, just
// continue on as always.

if (isset($_POST['txtUser']) && isset($_POST['txtPassword']))
{
	// they have submitted a username and password for us to check
	$username = $_POST['txtUser'];
	$password = $_POST['txtPassword'];

	// Get the hashed password from the DB
	// It would be better to store these in a different file
$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');                                       //Get host from OpenShift
$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');                                       //Get Port from OpenShift
$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');                                   //Get UserName from OpenShift
$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');                               //Get Password from OpenShift
$dbName = "recipes_db";

	try
	{
		// Create the PDO connection
		$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);

		// this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		$query = 'SELECT password FROM login WHERE username=:username';

		$statement = $db->prepare($query);
		$statement->bindParam(':username', $username);

		$result = $statement->execute();

		if ($result)
		{
			$row = $statement->fetch();
			$hashedPasswordFromDB = $row['password'];

			// now check to see if the hashed password matches
			if (password_verify($password, $hashedPasswordFromDB))
			{
				// password was correct, put the user on the session, and redirect to home
				$_SESSION['username'] = $username;
				header("Location: displayrecipes.php");
				die(); // we always include a die after redirects.
			}
			else
			{
				$badLogin = true;
			}

		}
		else
		{
			$badLogin = true;
		}
	}
	catch (Exception $ex)
	{
		// Please be aware that you don't want to output the Exception message in
		// a production environment
		echo "Error with DB. Details: $ex";
		die();
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign In</title>
                        <meta charset="UTF-8">
        <meta name="description" content="CS313 Web Engineering">
        <meta name="keywords" content="HTML,CSS,XML,JavaScript,php">
        <meta name="author" content="Alexandria Lenz">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <link type="text/css" rel="stylesheet" href="recipestylesheet.css" media="screen">
</head>

<body>
<div class="body">

<?php
if ($badLogin)
{
	echo "Incorrect username or password!<br /><br />\n";
}
?>

    
    
<h1>Our Recipe Database</h1>
<h3>PLEASE SIGN IN BELOW:</h3>

<form id="mainForm" action="signIn.php" method="POST">

	<input type="text" id="txtUser" name="txtUser">
	<label for="txtUser">Username</label>
	<br /><br />

	<input type="password" id="txtPassword" name="txtPassword">
	<label for="txtPassword">Password</label>
	<br /><br />

	<input type="submit" value="Sign In" />

</form>

<br /><br />

<p> Or <a href="signUp.php">Sign up</a> for a new account. </p>

</div>

</body>
</html>