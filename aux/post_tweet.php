<?php
  require_once "../functions.php";
  session_start();

if (isset($_POST["message"]) && isset($_SESSION["userID"])) {
  $message = $_POST["message"];
  $author = $_SESSION["userID"];
  echo "hello";
  // Save the message into the database
  postNewMessage($connect, $author, $message);
}

redirect("/index.php");
?>