<!DOCTYPE html>
<?php
 require_once('php/connect.php');
?>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Weather Finder</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
  <!-- Check if user has JS enabled-->
      <noscript>
        <style type="text/css">
            .container {display:none;}
            .noscriptmsg {}
        </style>
        <p class="noscriptmsg">
          Enable JavaScript to proceed!
        </p>
    </noscript>
      <!-- Preloader to show pefore page loads -->
      <div class="load-screen" width="100%" height="100%" >
      <div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-red-only">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="gap-patch">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
      </div>
      <!-- Preloader scripts -->
      <script>
        window.addEventListener("load", function(){
            $(".preloader-wrapper").removeClass("active");
            $(".load-screen").remove();
        });
      </script>

      <!-- Container to manage the whole shown page-->
    	<div class="container">
      <!-- Actual showing html starts here -->
        <h1><i class="medium material-icons">cloud</i> Weather finder 1.0</h1>
        <!-- Navigation bar for reaching all intended pages -->
        <nav class="nav-extended">
          <div class="nav-wrapper blue-grey darken-3">
            <a href="#" data-activates="mobile-nav" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="middle hide-on-med-and-down">
              <li><a href="index.php">Search weather</a></li>
              <li class="active"><a href="comparisonPage.php">Compare locations</a></li>
              <!-- Different view depending on whether user has logged in -->
              <?php
                if (isset($_SESSION['username'])) {
                  echo "<li><a class='right' href='php/logout.php'>Logout</a></li>";
                }
                else {
                  echo "<li><a class='right' href='loginPage.php'>Login</a></li>";
                }
              ?>
            </ul>
            <ul class="side-nav blue-grey darken-3 white-text" id="mobile-nav">
              <li><a class="white-text"><i class="material-icons white-text">menu</i>Menu</a></li>
              <li><a href="index.php" class="waves-effect white-text">Search weather</a></li>
              <li class="active"><a href="comparisonPage.php" class="waves-effect white-text">Compare locations</a></li>
              <!-- Different view depending on whether user has logged in -->
              <?php
                if (isset($_SESSION['username'])) {
                  echo "<li><a class='waves-effect white-text' href='php/logout.php'>Logout</a></li>";
                }
                else {
                  echo "<li><a class='waves-effect white-text' href='loginPage.php'>Login</a></li>";
                }
              ?>
            </ul>
          </div>
        </nav>
          <!-- form used to send both location names to php file with that aqcuires weather data-->
        <form class="weatherSearch send col s12" action="php/weatherData.php" method="POST" >
          <br><br>
          <div class='input-field'>
            <i class="medium material-icons prefix">landscape</i>
            <input type="text" id="firstCity" name="city" placeholder="Enter first city">
            <label for="icon_landscape">City 1</label>
          </div>
          <div class='input-field'>
            <i class="medium material-icons prefix">landscape</i>
            <input type="text" id="secondCity" name="city" placeholder="Enter second city">
            <label for="icon_landscape">City 2</label>
          </div>
          <input name='action' class="btn blue-grey darken-3 waves-effect waves-light" type="submit" value="Compare locations">
        </form>
        <br><br>
        <!-- card element reserved for showing the google map -->
        <div id='map' class="card transparent z-depth-5" >
        </div>

        <!-- card element for showing the weather data received -->
        <div class="card blue-grey darken-3">
          <table class='bordered white-text' id="firstTable">
          </table>
          <table class='bordered white-text' id="secondTable">
          </table>
        </div>
      </div>

  <!-- javascript files used -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVzOjF9YEYcRncRbLqx95R0w350zV7uSI" async defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  <script src="js/pdfFromHTML.js"></script>
  <script src="js/comparisonFunctions.js"></script>
</body>
