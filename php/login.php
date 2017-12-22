<?php
//Start session and connect to the database used

 require_once('connect.php');

  //Check that both inputs for username and password received
  if (isset($_POST['username']) && isset($_POST['password']) ) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    //acquire password hash that matches the username from DB
    $sql = "SELECT pwhash FROM users WHERE username='$username'";

    if ($connect->query($sql)) {

      $result = $connect->query($sql);
      $row = $result->fetch_assoc();
      $password_hash = $row["pwhash"];

      //If password hash is match to the password login with the username
      if (password_verify($password, $password_hash)) {
        $_SESSION['username'] = $username;
        header("Location: index.php"); //Move back to main page
        exit();
      } else {
        echo "No password match!";
        header("Location: loginPage.php");
      }

  	} else {
      //If matching username or password hash is not found show sql error text
  		echo "Error: " . $sql . "<br>" . $connect->error;
      header("Location: loginPage.php");
  	}
  } else {
    header("Location: registerPage.php");
  }

?>
