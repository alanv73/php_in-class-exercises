<?php
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['pass']);
  $hash = password_hash($password, PASSWORD_DEFAULT);
  // $existingPassword = "password";
  $existingUser = 'potatohead';
  $existingHash = '$2y$10$q.Ml1To0u3RIz7OsZHPrm.vS3.FZihvoq4JmclELq39mRcZWw3KSi';
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Landing Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <div class="container w-75 mt-4">
        <div class="jumbotron shadow">
          <?php if (strtoLower($username) === $existingUser && password_verify($password, $existingHash)){ ?>
            <h1 class="display-4">Welcome!</h1>
            <p class="lead">Your username is <span class="text-primary"><?php echo $username ?></span></p>
            <hr class="my-4">
            <p>Your password hash is <span class="text-danger"><?php echo $hash ?></span></p>
          <?php } else { ?>
            <p>You did not log in correctly</p>
          <?php } ?>
          <a class="btn btn-primary btn-lg" href="login.html" role="button">Go Back</a>
        </div>
      </div>
  </body>
</html>