<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    // get uname form field and filter out
    // tags and encode special characters
    // stripping characters with ascii code below 32
    $username = filter_var($_POST['uname'], FILTER_SANITIZE_STRING);
    $password = $_POST['pword'];
    $confirm_password = $_POST['cpword'];
    $remote_address = $_SERVER['REMOTE_ADDR'];

    // if entered password and confirmation password match
    if($password === $confirm_password){
      // hash the password and add the user to the database
      $hash = password_hash($password, PASSWORD_BCRYPT);

      require('dbconnection.php'); // db connection info - setup $conn
      // $sql = "insert into users (username, password, location) " . 
      //     "values ('$username', '$hash', '$remote_address');";
      // $result = $conn->query($sql);

      $stmt = $conn->prepare(
        "INSERT INTO users (username, password, location) VALUES (?, ?, ?)"); // create prepared statement; ?=variable
      
      $stmt->bind_param("sss", $username, $hash, $remote_address); // bind values to the statement; s=string

      $result = $stmt->execute(); // run the prepared statement with variable values inserted
      $stmt->close(); // terminate the prepared statement
      $conn->close(); // close the db connection

      if($result){
        // success notification
        echo "<div class='alert alert-success text-center' role='alert'>User successfully added!</div>";
      } else {
        // failure notification
        echo "<div class='alert alert-danger text-center' role='alert'>New user was not added!</div>";
      }
    } else {
      // otherwise warn the user that their passwords don't match
      echo "<div class='alert alert-warning text-center' role='alert'>Passwords don't match!</div>";
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Registration Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    
    <form action="" method="post">
    <h1 class="text-center">Register a new account</h1>
      <div class="form-group w-25 mx-auto">
        <label for="uname">Username: </label>
        <input type="text" name="uname" class="form-control">
        <label for="pword">Password: </label>
        <input type="password" name="pword" class="form-control">
        <label for="cpword">Confirm Password: </label>
        <input type="password" name="cpword" class="form-control">
      </div>
      <div class="form-group w-25 mx-auto">
        <input type="reset" value="Reset" class="btn btn-outline-secondary">
        <input type="submit" value="SUBMIT" class="btn btn-primary">
      </div>
    </form>
    

    <!-- Optional JavaScript -->
    <?php 
      if($password != $confirm_password){
        echo "<script type='text/javascript'>document.forms[0].uname.value='$username';</script>";
      }
    ?>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>