<?php
  require_once 'functions.php';

  session_start();

  $showSearchBar = isset($_SESSION["username"]) ? true : false;
  require_once'components/navbar.php';
?>