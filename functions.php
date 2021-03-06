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
  global $connect;
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

  function extractValuesFromNestedArray($array) {
    $newArray = [];
    foreach ($array as $value) {
      array_push($newArray, $value[0]);
    }
    return $newArray;
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

  function deleteMessage($db, $messageID) {
    $db->query("DELETE FROM messages WHERE id=$messageID ;");
  }

  function getAllMessages($db) {
    $response = $db->query("SELECT * FROM messages");
    return turnQueryToReverseArray($response);
  }

  function getMessagesByActiveUser($db, $user) {
    $response = $db->query("SELECT * FROM messages WHERE author IN (SELECT followed FROM followers WHERE follower=$user) ORDER BY id DESC;");
    return turnQueryToArray($response);
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

  function updateMessageContent($db, $msg, $text) {
    $response = $db->query("UPDATE messages SET message='$text' WHERE id=$msg ;");
    return $response;
  }

  // FOLLOW TABLE FUNCTIONS
  /**
   * Add a follow relation into the followers table
   * @param db: Database connection object
   * @param follower: Number (user's id)
   * @param followed: Number (user's id)
   */
  function followUser($db, $follower, $followed) {
    $db->query("INSERT INTO followers(follower, followed) VALUES('$follower', '$followed');");
  }

  /**
   * Removes a follow relation from the followers table
   * @param db: Database connection object
   * @param follower: Number (user's id)
   * @param followed: Number (user's id)
   */
  function unfollowUser($db, $follower, $followed) {
    $db->query("DELETE FROM followers WHERE follower=$follower AND followed=$followed ;");
  }

  function getNumOfFollowers($db, $user) {
    $response = $db->query("SELECT * FROM followers WHERE followed=$user ;");
    return $response->num_rows;
  }

  /**
   * Returns an array with the id's of the users the current user follows
   */
  function checkCurrentUserFollows($db, $user) {
    $response = $db->query("SELECT followed FROM followers WHERE follower=$user ;");
    return turnQueryToArray($response);
  }

  function getUserFollowers($db, $user) {
    $response = $db->query("SELECT follower FROM followers WHERE followed=$user ;");
    return turnQueryToArray($response);
  }

  function checkIfUserFollowsUser($db, $user1, $user2) {
    $response = $db->query("SELECT * FROM followers WHERE follower=$user1 AND followed=$user2 ;");
    return $response->num_rows;
  }

  // LIKES TABLE FUNCTIONS

  /**
   *
   */
  function likeMessage($db, $user, $msg) {
    $response = $db->query("INSERT INTO likes(user, message) VALUES('$user', '$msg');");
    // $arrayResponse = turnQueryToArray($response);
    // $jsonResponse = json_encode($arrayResponse);
    echo $response;
  }

  function unlikeMessage($db, $user, $msg) {
    $response = $db->query("DELETE FROM likes WHERE user=$user AND message=$msg ;");
    echo $response;
  }

  function checkIfMessageHasLike($db, $user, $msg) {
    $response = $db->query("SELECT * FROM likes WHERE user=$user AND message=$msg ;");
    return $response->num_rows;
  }

  function getMessageLikes($db, $msg) {
    $response = $db->query("SELECT * FROM likes WHERE message=$msg");
    return $response->num_rows;
  }

  function getUserLikes($db, $user) {
    $response = $db->query("SELECT message FROM likes WHERE user=$user ;");
    $arrayResponse = turnQueryToArray($response);
    return extractValuesFromNestedArray($arrayResponse);
  }

  function turnLikesArrayToMessages($db, $likes) {
    $response = [];
    foreach($likes as $like) {
      $content = $db->query("SELECT * FROM messages WHERE id=$like");
      array_push($response, $content->fetch_array(MYSQLI_NUM));
    }
    return $response;
  }

  //  OTHER FUNCTIONS

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

  // Create followers table
  // createTable(
  //   $connect,
  //   'followers',
  //   'follower int NOT NULL,
  //   followed int NOT NULL,
  //   id int NOT NULL AUTO_INCREMENT,
  //   PRIMARY KEY (id)'
  // );

  // Create likes table
  // createTable(
  //   $connect,
  //   'likes',
  //   'user int NOT NULL,
  //   message int NOT NULL,
  //   id int NOT NULL AUTO_INCREMENT,
  //   PRIMARY KEY (id)'
  // );

?>


