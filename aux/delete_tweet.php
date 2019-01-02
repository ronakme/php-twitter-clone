<?php
  require_once "../functions.php";
  session_start();

  deleteMessage($connect, $_GET["msg"]);
  redirect("/profile.php?user=" . $_SESSION["userID"]);
?>