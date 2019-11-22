<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $form_name = htmlspecialchars($_REQUEST['uname']);
        $form_pass = htmlspecialchars($_REQUEST['pword']);

        require('dbconnection.php'); // db connection info - setup $conn

        if (empty($name) or empty($pass)) {
            $validuser = false;
        } else {
            $sql = "select * from users where username = '$form_name' limit 1;";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if($form_name == $row['username'] &&
                        password_verify($form_pass, $row['password'])) {
                            $validuser = true;
                        }
                }
            }
            $conn->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Welcome to The Thunderdome</h1>
            <?php if (!$validuser) { 
                if ($_SERVER["REQUEST_METHOD"] == "POST"){ ?>
                    <div class="alert alert-danger text-center" role="alert">
                    Invalid Login!
                    </div>
                <?php } ?>
                <div class="container bg-secondary text-white d-flex justify-content-center w-50 shadow rounded-pill pt-4 border">
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
                            <button type="submit" class="btn btn-primary btn-lg ml-0">Submit</button>
                        </div>
                    </form>
                </div>
        <?php } else { ?>
            <div class="container">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">Successful Login!</h1>
                        <h3 class="card-subtitle mb-2 text-muted">Username: <?= $name ?></h3>
                        <p class="lead">Bacon ipsum dolor amet rump ham brisket picanha,
                        t-bone pork loin turkey buffalo jowl shoulder. Pig sirloin kevin frankfurter
                        turducken t-bone meatball turkey.</p>
                        <a class="btn btn-primary btn-lg" href="" role="button">Log Out</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>
