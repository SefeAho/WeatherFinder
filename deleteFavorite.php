<?php
//Start session and connect to the database used

 require_once('connect.php');

//check if user logged in
if (isset($_SESSION['username'])) {

	$username = $_SESSION['username'];
  $location = $_SESSION['city'];

	// find all the locations from database with match to username
  $sql = "DELETE FROM favorites WHERE username='". $username ."' AND location='".$location."'";
  if ($connect->query($sql) === TRUE) {

      $sql = "SELECT * FROM favorites WHERE username='$username'";
      $result = $connect->query($sql);
			// if matching locations found in favorites send them to be used in user html view
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
