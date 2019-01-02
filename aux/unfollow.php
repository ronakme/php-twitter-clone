<?php
  require_once "../functions.php";

  unfollowUser($connect, $_GET["from"], $_GET["to"]);
  redirect("/profile.php?user=" . $_GET["to"]);
?>