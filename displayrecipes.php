<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Recipes</title>
        <meta charset="UTF-8">
        <meta name="description" content="CS313 Web Engineering">
        <meta name="keywords" content="HTML,CSS,XML,JavaScript,php">
        <meta name="author" content="Alexandria Lenz">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <link type="text/css" rel="stylesheet" href="recipestylesheet.css" media="screen">
    </head>

    <body>
        <?php include $_SERVER['DOCUMENT_ROOT']. '/secondnav.php'; ?>
        <div class="body">
            

            
            <h1>Our Recipes</h1>

<?php
try {
    $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');                                       //Get host from OpenShift
    $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');                                       //Get Port from OpenShift
    $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');                                   //Get UserName from OpenShift
    $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');                               //Get Password from OpenShift
    $dbName = "recipes_db";                                                              //Assign a static Database name
    $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);  //create a secure database variable
    // prepare the statement
    $statement = $db->prepare('SELECT recipe.recipeNAME, recipe.recipeDESC, ingredient.ingredientNAME, ingredient.ingredientMEAS
FROM recipe
INNER JOIN ingredient
ON recipe.recipeID=ingredient.recipeID 
GROUP BY recipe.recipeID');
    $statement->execute();

    // Go through each result
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        echo '<h2>';
        echo '<strong>' . $row['recipeNAME'];
        echo '</h2> <p>';
        echo '<strong>' . $row['ingredientMEAS'] . ' ' . $row['ingredientNAME'];
        echo '</p> <p>';
        echo $row['recipeDESC'];
        echo '</p>';
    }
} catch (PDOException $ex) {
    echo "Error connecting to DB. Details: $ex";
    die();
}
?>

        </div>

        <button value="ADD RECIPE"><a href="recipe.php">ADD RECIPE</a></button>
    </body>
</html>