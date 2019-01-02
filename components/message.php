<div class="card mx-auto my-3 shadow" style="width:50%;">
  <div class="card-body">
    <h5 class="card-title"><a href=<?php echo 'profile.php?user=' . $userID ?>>@<?php echo $author ?></a></h5>
    <p class="card-text"><?php echo $message ?></p>
    <a href="#" class="btn btn-success">Like</a>
    <?php echo $delete == true ? '<a href="aux/delete_tweet.php?msg='. $msgID .'" class="btn btn-danger">Delete</a>' : ''; ?>
  </div>
</div>