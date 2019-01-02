<div class="jumbotron">
  <h1 class="display-4"><?php echo getAuthorName($connect, $_GET["user"]) ?></h1>
  <p class="lead"><?php echo count(filterMessagesByAuthor($connect, $_GET["user"])) . " tweets"; ?></p>
  <p class="lead"><?php echo "0 followers"; ?></p>
  <hr class="my-4">
  <a class="btn btn-primary btn-md mr-4" href="./login.php" role="button">Follow</a>
</div>