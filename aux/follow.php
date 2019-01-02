<?php
  require_once "../functions.php";

  followUser($connect, $_GET["from"], $_GET["to"]);
  redirect("/profile.php?user=" . $_GET["to"]);
?>