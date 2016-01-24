
<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT']. '/modules/meta.php'; ?>
        <title>About Me</title>

        <script>
            function getVote(int) {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {  // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("poll").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "phpsurvey.php?vote=" + int, true);
                xmlhttp.send();
            }
        </script>

    </head>
    <body>



        <?php include $_SERVER['DOCUMENT_ROOT']. '/modules/header.php'; ?>

        <div id="poll">
            <h3>It's not safe out there. Take one of these:</h3>
            <form>
                <input type="radio" name="vote" value="0" onclick="getVote(this.value)">Lightsaber <br>
                <input type="radio" name="vote" value="1" onclick="getVote(this.value)">Phaser <br>              
                <input type="radio" name="vote" value="2" onclick="getVote(this.value)">Sonic Screwdriver <br>
                <input type="radio" name="vote" value="3" onclick="getVote(this.value)">Identity Disk <br>
                <input type="radio" name="vote" value="4" onclick="getVote(this.value)">The Noisy Cricket <br>
                <input type="radio" name="vote" value="5" onclick="getVote(this.value)">Wookie <br>
                <input type="button" name="vote" value="vote" onclick="getVote()"/>
            </form>
            
        
        </div>

    </body>
</html>