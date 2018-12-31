<?php
  // Print navbar on screen
  echo '<nav class="navbar navbar-light bg-light">' .
  '<a class="navbar-brand" href="index.php">Twitter</a>';
  if ($showSearchBar) {
    echo '<form class="form-inline" action="index.php" >
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <a href="./aux/logout.php" class="btn btn-danger">Log out</a>';
  }
  echo '</nav>';
?>