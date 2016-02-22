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
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/secondnav.php'; ?>
        <div class="body">

            <h1>Delicious Recipes</h1>

            <h2>Enter New Recipe:</h2>

            <form id="mainForm" action="recipedb.php" method="POST">


                <label for="recipeNAME">Recipe Name</label>
                <input type="text" id="recipeNAME" name="recipeNAME">
                <br /><br />


                <label for="ingredientMEAS">Ingredient Measurement:</label>
                <input type="text" id="ingredientMEAS" name="ingredientMEAS">
                <br /><br />


                <label for="ingredientNAME">Ingredient Name:</label>
                <input type="text" id="ingredientNAME" name="ingredientNAME">
                <br /><br/>  
                <label for="ingredientMEAS">Ingredient Measurement:</label>
                <input type="text" id="ingredientMEAS" name="ingredientMEAS">
                <br /><br />


                <label for="ingredientNAME">Ingredient Name:</label>
                <input type="text" id="ingredientNAME" name="ingredientNAME">
                <br /><br/>  
                <label for="ingredientMEAS">Ingredient Measurement:</label>
                <input type="text" id="ingredientMEAS" name="ingredientMEAS">
                <br /><br />


                <label for="ingredientNAME">Ingredient Name:</label>
                <input type="text" id="ingredientNAME" name="ingredientNAME">
                <br /><br/>  
                <label for="ingredientMEAS">Ingredient Measurement:</label>
                <input type="text" id="ingredientMEAS" name="ingredientMEAS">
                <br /><br />


                <label for="ingredientNAME">Ingredient Name:</label>
                <input type="text" id="ingredientNAME" name="ingredientNAME">
                <br /><br/>  

                <label for="recipeDESC">Recipe Description:</label><br />
                <textarea id="recipeDESC" name="recipeDESC" rows="4" cols="50"></textarea>
                <br /><br />

                <label>Meal Type:</label><br />

                <?php
// This section will now generate the available check boxes for topics
// based on what is in the database
// It would be better to store these in a different file
                $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');                                       //Get host from OpenShift
                $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');                                       //Get Port from OpenShift
                $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');                                   //Get UserName from OpenShift
                $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');                               //Get Password from OpenShift
                $dbName = "recipes_db";                                                              //Assign a static Database name
                // for my configuration, I need this rather than 'localhost'

                try {
                    // Create the PDO connection
                    $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);

                    // prepare the statement
                    $statement = $db->prepare('SELECT mealtypeID, mealtypeDESC FROM mealtype');
                    $statement->execute();

                    // Go through each result
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        echo '<input type="checkbox" name="chkMealType[]" value="' . $row['mealtypeID'] . '">';
                        echo $row['mealtypeDESC'];
                        echo '</input><br />';

                        // put a newline out there just to make our "view source" experience better
                        echo "\n";
                    }
                } catch (PDOException $ex) {
                    // Please be aware that you don't want to output the Exception message in
                    // a production environment
                    echo "Error connecting to DB. Details: $ex";
                    die();
                }
                ?>

                <br />

                <input type="submit" value="ADD RECIPE" />

            </form>
        </div>
    </body>
</html>