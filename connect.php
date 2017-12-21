<?php
  session_start();
  $connect = mysqli_connect ("","",""); //PERSONAL WEBPAGE INFO REMOVED

  if(mysqli_connect_errno()) {
      die("Connection Failed!" . mysqli_connect_error());
  }
?>
