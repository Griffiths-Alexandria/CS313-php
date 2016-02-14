<?php

?>
<!DOCTYPE html>
<html>
<head>
	<title>Recipes</title>
</head>

<body>
<div>

<h1>Our Recipes</h1>

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
	$statement = $db->prepare("SELECT DISTINCT recipe.recipeNAME, recipe.recipeDESC, ingredient.ingredientNAME, ingredient.ingredientMEAS\n"
    . "FROM ingredient\n"
    . "INNER JOIN recipe\n"
    . "ON ingredient.recipeID=recipe.recipeID LIMIT 0, 30 ");
	$statement->execute();

	// Go through each result
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
		echo '<p>';
		echo '<strong>' . $row['recipeName'];
		echo '</p> <p>';
                echo '<strong>' . $row['ingredientMEAS'] . ' ' . $row['ingredientNAME'];
		echo '</p> <p>';
                echo $row['recipeDESC'];
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