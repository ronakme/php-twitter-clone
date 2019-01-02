<?php
  require_once 'functions.php';

  session_start();

  if (isset($_SESSION["username"])) require_once'components/navbar.php';
?>