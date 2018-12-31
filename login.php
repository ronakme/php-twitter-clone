<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Twitter clone | Login </title>
  <!-- Bootstrap styles cdn -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <?php require_once 'header.php'; ?>

  <div class="row my-5">
    <div class="container col-3"></div>
    <div class="container col-6">
      <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Log in</button>
      </form>
      <p class="mt-4">Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
    <div class="container col-3"></div>
  </div>

  <?php

    if (isset($_POST["username"]) && isset($_POST["password"])) {
      // Grab login values
      $username = $_POST["username"];
      $password = $_POST["password"];


      // Query the database with the login values
      $authQuery = "select * from users where username='$username' and password='$password'";
      $response = $connect->query($authQuery);
      if (!$response) die("Database acces failed: " . $connection->error);

      // Returns 0 or 1 to show if the user has authenticated correctly
      $validUser = $response->num_rows;

      // If user is found set the session variables with the user id so new messages can make use of it
      if ($validUser == 1) {
        $userData = $response->fetch_array(MYSQLI_NUM);

        $_SESSION["username"] = $userData[0];
        $_SESSION["userID"] = $userData[2];

      } else {
        // If user is not found send an error message
        echo '<div class="alert alert-danger" role="alert">' .
             'Invalid username or password' .
             '</div>';
      }

      // Redirect to homepage
      redirect("./index.php");
    }

  ?>

  <!-- Bootstrap scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>