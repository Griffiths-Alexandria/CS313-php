<!DOCTYPE html>
<html>
    <head>
        <title>Recipes</title>
    </head>

    <body>
        <div>

            <h1>Delicious Recipes</h1>


            <?php include '/recipedb.php'; 
            
            
          
try
{
 $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword); 

	// prepare the statement
	$statement = $db->prepare('SELECT * FROM food_recipe');
	$statement->execute();

	// Go through each result
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
		echo '<p>';
		echo '<strong>' . $row['recipeID'] . ' ' . $row['ingredientID'] . ':';
		echo $row['meal_typeID'] . '</strong>' . ' - ' . $row['authorID'];
		echo '</p>';
	}

}
catch (PDOException $ex)
{
	echo "Error connecting to DB. Details: $ex";
	die();
}

?>

                <h3>Search  Recipes</h3>
    <p>Search by Ingredient</p>
    <form  method="post" action="recipedb.php"  id="searchform">
      <input  type="text" name="name">
      <input  type="submit" name="submit" value="Search">
    </form>



        </div>

    </body>
</html>