<?php
  require_once "../functions.php";

  if (isset($_POST["msgID"]) && isset($_POST["message"])) {
    $result = updateMessageContent($connect, $_POST["msgID"], $_POST["message"]);
    echo $result;
  }
?>