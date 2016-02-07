<!DOCTYPE html>
<html>
    <head>
        <title>Scripture List</title>
    </head>

    <body>
        <div>

            <h1>Delicous Recipes</h1>

            <?php
            $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');                                       //Get host from OpenShift
            $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');                                       //Get Port from OpenShift
            $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');                                   //Get UserName from OpenShift
            $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');                               //Get Password from OpenShift
            $dbName = "recipe_db";                                                              //Assign a static Database name
            $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);  //create a secure database variable
            try {
                // Create the PDO connection
                $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);

                // prepare the statement
                $statement = $db->prepare('SELECT authorID, recipeID, meal_typeID, ingredientID FROM food_recipe');
                $statement->execute();

                // Go through each result
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    echo '<p>';
                    echo '<strong>' . $row['recipeID'] . ' ' . $row['authorID'] . ':';
                    echo $row['indredientID'] . '</strong>' . ' - ' . $row['meal_typeID'];
                    echo '</p>';
                }
            } catch (PDOException $ex) {
                echo "Error connecting to DB. Details: $ex";
                die();
            }
            ?>

        </div>

    </body>
</html>