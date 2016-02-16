<html>
<head>
<title>login page</title>
</head>
<body>
<form action="index.php" method=get>
<h1 align="center"  >Welcome to our site</h1>
<?php
session_start(); 
if( $_SESSION["logging"]&& $_SESSION["logged"])
{
     print_secure_content();
}
else {
    if(!$_SESSION["logging"])
    {  
    $_SESSION["logging"]=true;
    loginform();
    }
       else if($_SESSION["logging"])
       {
         $number_of_rows=checkpass();
         if($number_of_rows==1)
            {	
	         $_SESSION[user]=$_POST[userlogin];
	         $_SESSION[logged]=true;
	         echo"<h1>you have loged in successfully</h1>";
	         print_secure_content();
            }
            else{
               	echo "wrong pawssword or username, please try again";	
                loginform();
            }
        }
     }
     
function loginform()
{
echo "please enter your login information to proceed with our site";
echo ("<table border='2'><tr><td>username</td><td><input type='text' name='userlogin' size'20'></td></tr><tr><td>password</td><td><input type='password' name='password' size'20'></td></tr></table>");
echo "<input type='submit' >";	
echo "<h3><a href='registerform.php'>register now!</a></h3>";	
}

function checkpass()
{
$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');                                       //Get host from OpenShift
$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');                                       //Get Port from OpenShift
$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');                                   //Get UserName from OpenShift
$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');                               //Get Password from OpenShift
$dbName = "users";

try {
    
$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql="SELECT * from users where name='$_POST[userlogin]' and password='$_POST[password]'";

$result=mysql_query($sql,$conn) or die(mysql_error());

return  mysql_num_rows($result);
}
catch (Exception $ex) {
    // Please be aware that you don't want to output the Exception message in
    // a production environment
    echo "Error with DB. Details: $ex";
    die();
}


function print_secure_content()
{
	echo("<b><h1>hi mr.$_SESSION[user]</h1>");
    echo "<br><h2>only a logged in user can see this</h2><br><a href='logout.php'>Logout</a><br>";	
	
}
}
?>

</form>
</body>
</html>