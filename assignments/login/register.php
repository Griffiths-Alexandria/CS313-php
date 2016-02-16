<?php
 session_start();session_destroy();
 session_start();
 if ($_POST["regname"] && $_POST["regemail"] && $_POST["regpass1"] && $_POST["regpass2"]) {
    if ($_POST["regpass1"] == $_POST["regpass2"]) {

$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');                                       //Get host from OpenShift
$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');                                       //Get Port from OpenShift
$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');                                   //Get UserName from OpenShift
$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');                               //Get Password from OpenShift
$dbName = "users";

try {
    
$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "insert into users (name,email,password)values('$_POST[regname]','$_POST[regemail]','$_POST[regpass1]')";
        $result = mysql_query($sql, $conn) or die(mysql_error());
        echo "<h1>you have registered sucessfully</h1>";

        echo "<a href='index.php'>go to login page</a>";
} catch (Exception $ex) {
    // Please be aware that you don't want to output the Exception message in
    // a production environment
    echo "Error with DB. Details: $ex";
    die();
} 

    }else {
        echo "passwords doesnt match";
    }
} else {
    echo"invaild input data";
}

     
