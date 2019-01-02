<div class="row my-4">
  <div class="container col-12 bg-light">
  <?php
  foreach($messages as $value) {
    $author = getAuthorName($connect, $value[0]);
    $message = $value[1];
    include "message.php";
  }

  // for ($i=0; $i < $messageNumber; $i++) {
  //   $data = $response->fetch_array(MYSQLI_NUM);
  //   $author = "@" . getAuthorName($connect, $data[0]);
  //   $message = $data[1];
  //   include "message.php";
  // }
  ?>
  </div>
</div>