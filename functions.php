<?php
  // Database configuration
  require_once 'dblogin.php';
  $appname = 'Twitter clone';

  /**
   * Connects to MySQL and creates an object to access it
   * @param host
   * @param username
   * @param password
   * @param database
   */
  $connect = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if ($connect->connect_error) die($connect->connect_error);

  /**
   * Checks if a table already exists and if not create it
   * @param $name: String
   * @param $query: String
   */
  function createTable($db, $name, $query) {
    $db->query("CREATE TABLE $name($query)");
  }

  function createNewUser($db, $username, $password) {
    $db->query("insert into users(username, password) values($username, $password);");
  }

  function checkUserAuth($db, $username, $password) {
    $response = $db->query("select * from users where username=$username and password=$password");
    return $response;
  }

  function redirect($url) {
    header('Location: ' . $url);
  }

  // Create users table
  // createTable(
  //   $connect,
  //   'Users',
  //   'username VARCHAR(20) UNIQUE NOT NULL,
  //   password VARCHAR(20) NOT NULL,
  //   id int NOT NULL AUTO_INCREMENT,
  //   PRIMARY KEY (id)'
  // );

  // // Create messages table
  // createTable(
  //   $connect,
  //   'Messages',
  //   'author VARCHAR(20),
  //   message VARCHAR(20),
  //   id int NOT NULL AUTO_INCREMENT,
  //   PRIMARY KEY (id)'
  // );

?>


