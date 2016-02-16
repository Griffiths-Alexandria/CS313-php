<?php
session_start(); 
if(session_destroy())
{
echo"<h2>you have logged out successfully</h2>";
echo "<h3><a href='index.php'>back to main page</a></h3>";
}
?>