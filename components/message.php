<div class="card mx-auto my-3 shadow position-relative" style="width:50%;">
  <div class="card-body">
    <h5 class="card-title"><a href=<?php echo 'profile.php?user=' . $userID ?>>@<?php echo $author ?></a></h5>
    <p class="card-text"><?php echo $message ?></p>
    <button
      type="button"
      class="btn btn-success like-btn"
      data-msg=<?php echo $msgID ?>
      data-usr=<?php echo $_SESSION["userID"] ?>
      >Like</button>
      <span class="ml-3" data-msg=<?php echo $msgID ?> >0</span>
    <?php echo $delete == true ? '<a href="aux/delete_tweet.php?msg='. $msgID .'" class="btn btn-danger ml-auto position-absolute" style="right:20px;">Delete</a>' : ''; ?>
  </div>
</div>