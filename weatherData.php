<?php
session_start();
//initialize memcached
  if(isset($_POST['text'])) {
      $city = $_POST['text'];
  }
  else {
      $city = null;
  }
  //define new session city (used in favoriting)
  $_SESSION['city'] = $city;

  if ($city) {
        //acquire weather data from OWM site in JSON format
        $url = "https://api.openweathermap.org/data/2.5/weather?q=". $city . "&APPID="; //API KEY REMOVED
        $json = file_get_contents($url);

        $send = array(
          "cached" => false,
          "data" => json_decode($json, TRUE)
        );
        echo json_encode($send);
  }
