<!DOCTYPE html>
<html>
    <head>
        <title>Scripture List</title>
    </head>

    <body>
        <div>

            <h1>Delicious Recipes</h1>

            <?php include '/recipedb.php'; 
          
try
{
	// Create the PDO connection
	$db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

	// prepare the statement
	$statement = $db->prepare('SELECT authorID, recipeID, meal_typeID, ingredientID FROM food_recipe');
	$statement->execute();

	// Go through each result
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
		echo '<p>';
		echo '<strong>' . $row['authorID'] . ' ' . $row['recipeID'] . ':';
		echo $row['ingredientID'] . '</strong>' . ' - ' . $row['meal_typeID'];
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