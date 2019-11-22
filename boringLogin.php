<?php
    $location_message = "";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST"  && 
            !empty($_REQUEST['uname'])) {
        // POST variables
        $form_username = $_REQUEST['uname'];
        $form_password = $_REQUEST['pword'];
        
        // get current login location
        $current_location = $_SERVER['REMOTE_ADDR'];

        // database connection - $conn variable
        require('dbconnection.php');

        // query database
        $sql = "select * from users where username = '$form_username' limit 1;";
        $result = $conn->query($sql);
        $stored_username;
        $stored_hash;
        $stored_location;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $stored_username = $row['username'];
                $stored_hash = $row['password'];
                // get last login location from database
                $stored_location = $row['location'];
            }
        } else {
            echo "0 rows returned<br>";
        }

        if (password_verify($form_password, $stored_hash)) {
            $_SESSION['username'] = $form_username;

            // check stored (last) login location against current login location
            if ($current_location != $stored_location){
                $location_message = "Logging in from a different location<br>";

                // update location stored in database to current location
                $sql = "update users set location = '$current_location' where username = '$stored_username';";
                $result = $conn->query($sql);
            }
        }


        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Login Page</title>
</head>
<body>
    <?php
        if(isset($_POST["submit"]) && $_SESSION['username'] != null){
            echo "Hello " . $_SESSION['username'];
            echo "<br />";
            echo $location_message;
        }
    ?>
    <a href="welcome.php">Welcome Page</a><br>
    <form action="" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="uname" placeholder="username">
    </div>
    <div class="form-group">
        <label for="pass">Password</label>
        <input type="password" class="form-control" name="pword" placeholder="password">
    </div>
    <div class="form-group d-flex justify-content-center">
        <button type="reset" class="btn btn-secondary btn-lg mr-1">Reset</button>
        <button type="submit" name="submit" class="btn btn-primary btn-lg ml-0">Submit</button>
    </div>
</form>
</body>
</html>
