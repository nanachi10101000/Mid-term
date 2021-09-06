<?php if(isset($_SESSION["success_msg"])):?>
  <div class="alert alert-success" role="alert">
    <?= $_SESSION["success_msg"] ?>
  </div>
<?php
  unset($_SESSION["success_msg"]);
  endif;
?>


<?php if(isset($_SESSION["error_msg"])):?>
  <div class="alert alert-danger" role="alert">
    <?= $_SESSION["error_msg"] ?>
  </div>
<?php
  unset($_SESSION["error_msg"]);
  endif;
?>
