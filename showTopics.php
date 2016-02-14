<?php
/**********************************************************
* File: viewScriptures.php
* Author: Br. Burton
* 
* Description: This file shows an example of how to query a
*   MySql database from PHP.
***********************************************************/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Scripture and Topic List</title>
</head>

<body>
<div>

<h1>Scripture and Topic List</h1>

<?php 
             try
    {
      $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');                                       //Get host from OpenShift
      $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');                                       //Get Port from OpenShift
      $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');                                   //Get UserName from OpenShift
      $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');                               //Get Password from OpenShift
	  $dbName = "recipes_db";                                                              //Assign a static Database name
	  $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);  //create a secure database variable
           

	// prepare the statement
	$statement = $db->prepare('SELECT ingredientname, recipetitle, recipedescription FROM link WHERE link.recipeID = recipe.recipeID AND link.ingredientID = ingredient.ingredientID');
	$statement->execute();

	// Go through each result
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
		echo '<p>';
		echo '<strong>' . $row['recipetitle'] . ' ' . $row['ingredientname'];
		echo '</p> <p>';
                echo $row['recipedescription'];
		echo '</p>';
	}

}
catch (PDOException $ex)
{
	echo "Error connecting to DB. Details: $ex";
	die();
}

?>

</div>

</body>
</html>