<?php if(isset($_SESSION["success_msg"])):?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong><?= $_SESSION["success_msg"] ?></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php
  unset($_SESSION["success_msg"]);
  endif;
?>


<?php if(isset($_SESSION["error_msg"])):?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong><?= $_SESSION["error_msg"] ?></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php
  unset($_SESSION["error_msg"]);
  endif;
?>
