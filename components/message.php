<div class="card mx-auto my-3 shadow position-relative" style="width:50%;">
  <div class="card-body">
    <h5 class="card-title"><a href=<?php echo 'profile.php?user=' . $userID ?>>@<?php echo $author ?></a></h5>
    <p class="card-text"><?php echo $message ?></p>
    <a href="#" class="btn btn-success">Like</a><span class="ml-3" id=<?php echo "like-" . $msgID ?>>0</span>
    <?php echo $delete == true ? '<a href="aux/delete_tweet.php?msg='. $msgID .'" class="btn btn-danger ml-auto position-absolute" style="right:20px;">Delete</a>' : ''; ?>
  </div>
</div>