<?php


// get the data from the POST
$name = $_POST['recipeNAME'];
//$ingmeas = $_POST['ingredientMEAS'];
//$ingname = $_POST['ingredientNAME'];
$content = $_POST['recipeDESC'];
$mealtypeIDs = $_POST['chkMealType'];

echo "recipeNAME=$name\n";
//echo "ingredientMEAS=$ingmeas\n";
//echo "ingredientNAME=$ingname\n";
echo "recipeDESC=$content\n";

// we could put additional checks here to verify that all this data is actually provided
// It would be better to store these in a different file
$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');                                       //Get host from OpenShift
$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');                                       //Get Port from OpenShift
$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');                                   //Get UserName from OpenShift
$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');                               //Get Password from OpenShift
$dbName = "recipes_db";

try {
    // Create the PDO connection
    $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);

    // this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // First Add the recipe
    $query = 'INSERT INTO recipe(recipeNAME, recipeDESC) VALUES( :recipeNAME, :recipeDESC)';
           

    $statement = $db->prepare($query);


    
    $statement->bindParam(':recipeNAME', $name);
    $statement->bindParam(':recipeDESC', $content);

    $statement->execute();

        
    // get the new id
    
    $recipeID = $db->lastInsertId();

    // Now go through each topic id in the list from the user's checkboxes
    foreach ($mealtypeIDs as $mealtypeID) {
        $statement = $db->prepare('INSERT INTO recipelink(recipeID, mealtypeID) VALUES(:recipeID, :mealtypeID)');

        $statement->bindParam(':recipeID', $recipeID);
        $statement->bindParam(':mealtypeID', $mealtypeID);

        $statement->execute();
    }
} catch (Exception $ex) {
    // Please be aware that you don't want to output the Exception message in
    // a production environment
    echo "Error with DB. Details: $ex";
    die();
}

// finally, redirect them to a new page to actually show the topics
header("Location: displayrecipes.php");
die(); // we always include a die after redirects. In this case, there would be no
// harm if the user got the rest of the page, because there is nothing else
// but in general, there could be things after here that we don't want them
// to see.


