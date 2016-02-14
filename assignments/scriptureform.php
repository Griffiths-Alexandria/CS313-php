<html>
    <head>
        <title>Week 06 Project</title>


    </head>
    <body>
        <h1>Scripture References</h1>

        <?php
        $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');                                       //Get host from OpenShift
        $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');                                       //Get Port from OpenShift
        $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');                                   //Get UserName from OpenShift
        $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');                               //Get Password from OpenShift
        $dbName = "homepage";                                                              //Assign a static Database name
        $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);
        try {

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO scriptures (book, chapter, verse, content)
    VALUES ('" . $_POST["book"] . "', '" . $_POST["chapter"] . "', '" . $_POST["verse"] . "', '" . $_POST["content"] . "')";
            // use exec() because no results are returned
            $conn->exec($sql);
            echo "New record created successfully";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

        $conn = null;
        ?>


        <form action="insert.php" method="post">

            <p>

                <label for="book">Book Name:</label>

                <input type="text" name="book" id="book">

            </p>

            <p>

                <label for="chapter">Chapter:</label>

                <input type="text" name="chapter" id="chapter">

            </p>

            <p>

                <label for="verse">Verse:</label>

                <input type="text" name="verse" id="verse">

            </p>

            <p>

                <label for="content">Content:</label>

                <input type="text" name="content" id="content">

            </p>

            <?php
            $sql = 'SELECT name FROM topics';
            while ($row = mysqli_fetch_array($result)) {
                echo"<input type='checkbox' value='$row[name]}'>" . $row['name'];
            }
            ?>

            <input type="submit" value="Submit">

        </form>

    </body>

</html>