"use strict";

$(document).ready(function() {

  $(".dropdown-button").dropdown();
  $('.materialboxed').materialbox();
  $(".button-collapse").sideNav();

    //Selecting favorite from the dropdown menu
    $('#dropdown').on('click', '.favoriteButton', function() {
      var city = $(this).text();
      $('#cityname').val(city);
    });


    updateWeatherInfo();
    addFavorite();
    deleteFavorite(); // Not working yet!!

});

function updateWeatherInfo () {
  //update the weather data block to webpage
  $('form.send').on('submit', function() {

        var that = $(this),
        url = that.attr('action'),
        type = that.attr('method'),
        data = {};

        data['text'] = $("#cityname").val();

    //Async updates with ajax
    $.ajax({
        url: url,
        type: type,
        data: data,

        success: function(response) {

          var text =  response;
          var info = JSON.parse(text);

          // Convert temperature to celsius
          var temp = Math.round(info.data.main.temp - 273.15);
          // Gather weather icon from OWM
          var url = "https://openweathermap.org/img/w/" + info.data.weather[0].icon + ".png";
          // Convert date to right format
          var date = new Date(1000*info.data.dt).toUTCString();

          // Define information for google map
          var center = {
            lat: info.data.coord.lat,
            lng: info.data.coord.lon
          };
          var markerInfo = {
            city:info.data.name,
            country:info.data.sys.country
          };

          //Initializing google maps api
          initMap(7, center, markerInfo)
          //The actual visible adding of the weather data block <td></td>
          $("#weatherCard").html("<table class='responsive-table centered bordered white-text'><thead><tr><th>Location</th><th>" + info.data.name +", " + info.data.sys.country + "</th></tr></thead><tbody><tr><td>Icon</td><td><img src='"+url+"' alt='icon'></td></tr><tr><td>Temperature</td><td>" + temp + "°C</td></tr><tr><td>Description</td><td>" + info.data.weather[0].description + "<tr><td>Humidity</td><td>" + info.data.main.humidity + " %</td></tr></tr><tr><td>Wind speed</td><td>" + info.data.wind.speed + " m/s</td></tr><tr><td>Date</td><td>"+date+"</td></tr><tr><td>Source</td><td>OpenWeatherMap API</td></tr></tbody></table>");

        },
        error: function(request, errorType, errorMessage) {
          console.log(request);
        }
      });

    return false;
  });
}

function deleteFavorite() {

  //Event delegation to find wanted favorites
  $('#extraButtons').on('click', '.deleteFavorite', function() {

     var url = "deleteFavorite.php",
     type = "GET",
     data = {};

     data['text'] = $("#cityname").val()

     //Update favoritelist asynchronously
    $.ajax({
        url: url,
        type: type,
        data: data,
        success: function(response) {
          $("#dropdown").html(response);
        },
        error: function(request, errorType, errorMessage) {
          console.log(request);
        }
      });

    return false;
  });

}

function addFavorite (object) {

  //Event delegation to find addFavorite
  $('#extraButtons').on('click', '.addFavorite',  function() {

        var url = "addFavorite.php",
         type = "POST",
         data = {};

        data['text'] = $("#cityname").val();

    //Update favoritelist asynchronously
    $.ajax({
        url: url,
        type: type,
        data: data,

        success: function(response) {
          $("#dropdown").html(response);
        },
        error: function(request, errorType, errorMessage) {
          console.log(request);
        }
      });

    return false;
  });
}

//Function for showing google map
function initMap(zoom, center, markerInfo) {

  if (markerInfo) {
    // Map settings
    var settings = {
      zoom:zoom,
      center:center
    }
    // New map
    var map = new google.maps.Map(document.getElementById('map'), settings);

    // Add marker
    var marker = new google.maps.Marker({
      position:center,
      map:map
    });

    var infoWindow = new google.maps.InfoWindow({
      content:'<p>'+markerInfo.city+', '+markerInfo.country+'<p>'
    });

    marker.addListener('click', function(){
      infoWindow.open(map, marker);
    });
  }
}
