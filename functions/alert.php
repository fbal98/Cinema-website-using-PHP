<?php
function showAlert($alertType, $msg) {
  echo '<div class="alert alert-'.$alertType.'" role="alert">' . $msg . '</div>';
}
?>
