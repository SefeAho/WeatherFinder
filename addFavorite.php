<?php
//Start session and connect to the database used

 require_once('connect.php');


//Check if user is logged in meaning session username exists
if (isset($_SESSION['username'])) {

  $location = $_SESSION['city'];
  $username = $_SESSION['username'];

  // send user searched location to database table favorites with current username
  $sql = "INSERT INTO favorites (username, location) VALUES ('$username', '$location')";
  if ($connect->query($sql) === TRUE) {

      // if there are existing favorites with matching current username send them to html for user view
      $sql = "SELECT * FROM favorites WHERE username='$username'";
      $result = $connect->query($sql);
      if ($result != NULL){
        while($row = $result->fetch_assoc()) {
          echo "<li class='blue-grey darken-3 waves-effect waves-light'><a class='favoriteButton'>" . $row["location"] . "</a> </li>";
          echo "<li class='divider'></li>";
        }
      }
    }

  else {
		echo "Error: " . $sql . "<br>" . $connect->error;
	}
}
