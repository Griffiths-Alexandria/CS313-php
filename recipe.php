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
 //create a secure database variable
	  echo '<p>';
	  
	  //Loop for each row in the selected table, writing the contents of the book, chapter, verse, and content columns
	  foreach ($db->query('SELECT * FROM food_recipe') as $row) {
        echo '<b>'.$row['recipeID'].' '.$row['ingredientID'].':'.$row['meal_typeID'].'</b> - '.$row['authorID'].'<br />';
      }
	  echo '</p>';
    }

    catch (PDOException $ex) //If database cannot be reliably accessed, abort.
    {
      echo 'Error!: ' . $ex->getMessage();
      die(); 
    }
  ?>


        </div>

    </body>
</html>