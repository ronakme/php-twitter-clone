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
   * Receives a database response and converts it into an array
   * @param response: mysql response object
   */
  function turnQueryToArray($response) {
    $rows = $response->num_rows;
    $result = [];
    for ($i = 0; $i < $rows; $i++) {
      array_push($result, $response->fetch_array(MYSQLI_NUM));
    }
    return $result;
  }

  function turnQueryToReverseArray($response) {
    $rows = $response->num_rows;
    $result = [];
    for ($i = 0; $i < $rows; $i++) {
      array_unshift($result, $response->fetch_array(MYSQLI_NUM));
    }
    return $result;
  }

  /**
   * Checks if a table already exists and if not create it
   * @param $name: String
   * @param $query: String
   */
  function createTable($db, $name, $query) {
    $db->query("CREATE TABLE $name($query)");
  }

  function createNewUser($db, $username, $password) {
    $db->query("INSERT INTO users(username, password) VALUES('$username', '$password');");
  }

  function checkUserAuth($db, $username, $password) {
    $response = $db->query("SELECT * FROM users WHERE username=$username AND password=$password;");
    return $response;
  }

  function postNewMessage($db, $author, $message) {
    $db->query("INSERT INTO messages(author, message) VALUES($author, '$message');");
  }

  function getAllMessages($db) {
    $response = $db->query("SELECT * FROM messages");
    return turnQueryToReverseArray($response);
  }

  /**
   * Returns all messages that includes the text passed in the filter
   * @param database: object
   * @param filter: string
   */
  function filterMessagesByContent($db, $filter) {
    $response = $db->query("SELECT * FROM messages WHERE message LIKE '%$filter%';");
    return turnQueryToReverseArray($response);
  }

  function filterMessagesByAuthor($db, $author) {
    $response = $db->query("SELECT * FROM messages WHERE author=$author ;");
    return turnQueryToReverseArray($response);
  }

  function getAuthorName($db, $author) {
    $response = $db->query("SELECT username FROM users WHERE id=$author;");
    return $response->fetch_array(MYSQLI_NUM)[0];
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
  //   'author int NOT NULL,
  //   message VARCHAR(144) NOT NULL,
  //   id int NOT NULL AUTO_INCREMENT,
  //   PRIMARY KEY (id)'
  // );

?>


