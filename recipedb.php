<?php
                                                 
  if(isset($_POST['submit'])){
  if(isset($_GET['go'])){
  if(preg_match("/^[  a-zA-Z]+/", $_POST['ingredientname'])){
  $name=$_POST['ingredientname'];
  //connect  to the database
  $db=mysql_connect  ($dbHost, $dbUser,  $dbPassword) or die ('I cannot connect to the database  because: ' . mysql_error());
  //-select  the database to use
  $mydb=mysql_select_db($dbName);
  //-query  the database table
  $sql="SELECT ingredientname, recipeID FROM recipe WHERE ingredientname LIKE '%" . $name;
  //-run  the query against the mysql query function
  $result=mysql_query($sql);
  //-create  while loop and loop through result set
  while($row=mysql_fetch_array($result)){
          $ingredientname  =$row['ingredientname'];
          $recipeID = $row['recipeID'];
  //-display the result of the array
  echo "<ul>\n";
  echo "<li>" . "<a  href=\"search.php?id=$recipeID\">"   .$ingredientname. "</a></li>\n";
  echo "</ul>";
  }
  }
  else{
  echo  "<p>Please enter a search query</p>";
  }
  }
  }