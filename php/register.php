<?php
//Start session and connect to the database used
 require_once('connect.php');
//Check that both inputs for username and password received
if (isset($_POST['username']) && isset($_POST['password']) ){

    $username = $_POST['username'];
    $password = $_POST['password'];

    //Assign password validation standard, more than 8 characters, at least 1 number, uppercase and lowercase letters
    $password_regex = "/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])\S{9,255}$/m";

    //Required password rules
    if (preg_match_all($password_regex, $password) === 1 && strlen($username ) > 0){

        $sql = "SELECT uid FROM users WHERE username='$username'";
        $result = $connect->query($sql);
        // Check if the username is already taken
        if (count($result->fetch_assoc()) > 0){
          echo "Username already taken";
          header("Location: registerPage.php");
        }

        else {
          //secure password with hash and mcrypt_create_iv salt
          $password_hash = password_hash($password, PASSWORD_BCRYPT, ['salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),]);
          $sql = "INSERT INTO users (username, pwhash) VALUES ('$username',  '$password_hash')";
          //Send account data to the database
          if ($connect->query($sql) === TRUE) {
            //Assign session username
            $_SESSION['username'] = $username;
            //Move back to main page with user account rights
            header("Location: index.php");
            exit();

          } else {
            //Show primitive sql errormessage
       		   echo "Error: " . $sql . "<br>" . $connect->error;
             header("Location: registerPage.php");
       	  }
        }
    } else {
      //Primitive handling without clear user notifying, try to change later!
      echo "Password doesn't have required characters!";
      header("Location: registerPage.php");
    }
} else {
  header("Location: registerPage.php");
}


?>
