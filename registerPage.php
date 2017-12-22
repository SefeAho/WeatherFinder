<!DOCTYPE html>
<?php
 require_once('php/connect.php');
?>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>Register</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
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
    <!-- Actual showing html starts here-->
    <h1><i class="medium material-icons">cloud</i> Weather finder 1.0</h1>
    <!-- Navigation bar for reaching all intended pages -->
    <nav class="nav-extended">
      <div class="nav-wrapper blue-grey darken-3">
        <a href="#" data-activates="mobile-nav" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="middle hide-on-med-and-down">
          <li><a href="index.php">Search weather</a></li>
          <li ><a href="comparisonPage.php">Compare locations</a></li>
          <li class='active'><a href='loginPage.php'>Login</a></li>
        </ul>
        <!-- side navigation bar for mobile/small screen use -->
        <ul class="side-nav blue-grey darken-3 white-text" id="mobile-nav">
          <li><a class="white-text"><i class="material-icons white-text">menu</i>Menu</a></li>
          <li class="active"><a href="index.php" class="waves-effect white-text">Search weather</a></li>
          <li ><a href="comparisonPage.php" class="waves-effect white-text">Compare locations</a></li>
          <li class='active'><a href='loginPage.php' class="waves-effect white-text">Login</a></li>
        </ul>
      </div>
    </nav>
    <!-- form for sending data to registering php function-->
    <section class="createform">
    <form name="register" action="php/register.php" method="post" accept-charset="utf-8">
      <div>
        <div><label>New Username</label>
          <input  type="text" name="username" placeholder="username" required>
        </div>
        <div><label for="password">Account Password</label>
          <input type="password" name="password" placeholder="password" required>
        </div>
        <div>
          <input action="php/register.php" class="btn blue-grey darken-3 waves-effect waves-light create" type="submit" value="Create Account">
        </div>
      </div>
    </form>
    </section>
  </div>
  <!-- javascript files used -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  <!-- script to enable mobile sidebar-->
  <script> $(document).ready(function() {  $(".button-collapse").sideNav(); }); </script>
</body>
