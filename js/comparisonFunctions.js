"use strict";

$(document).ready(function() {
    //Materialized css functions
    $('.materialboxed').materialbox();
    $(".button-collapse").sideNav();

    updateWeatherInfo();

    //wrap tables for cleaner look
    $('table').wrap('<td></td>').parent().wrapAll('<table><tbody><tr></tr></tbody></table>');

});

function updateWeatherInfo () {
  //update the weather data block to webpage
  $('form.send').on('submit', function() {

        var that = $(this),
        url = that.attr('action'),
        type = that.attr('method'),
        firstData = {},
        secondData = {},
        data = {};

        firstData['text'] = $("#firstCity").val(),
        secondData['text'] = $("#secondCity").val();

    //Async updates with ajax
    //First city data fetch
    $.ajax({
        url: url,
        type: type,
        data: firstData,

        success: function(response) {

          var text =  response;
          var info = JSON.parse(text);

          // Convert temperature to celsius
          var temp = Math.round(info.data.main.temp - 273.15);
          // Gather weather icon from OWM
          var url = "https://openweathermap.org/img/w/" + info.data.weather[0].icon + ".png";
          // Convert date to right format
          var date = new Date(1000*info.data.dt).toUTCString();

          //Initializing google maps api
          initMap();
          //The actual visible adding of the weather data block
          $("#firstTable").html("<thead><tr><th>" + info.data.name +", " + info.data.sys.country + "</th></tr></thead><tbody><tr><td><img src='"+url+"' alt='icon'></td></tr><tr><td>" + temp + "°C</td></tr><tr><td>" + info.data.weather[0].description + "<tr><td>" + info.data.main.humidity + " %</td></tr></tr><tr><td>" + info.data.wind.speed + " m/s</td></tr><tr><td>"+date+"</td></tr><tr><td>OpenWeatherMap API</td></tr></tbody>");
        },
        error: function(request, errorType, errorMessage) {
          alert('Error: ' + errorType + ' with message' + errorMessage);
        }
      });
      //Second city data fetch
      $.ajax({
          url: url,
          type: type,
          data: secondData,

          success: function(response) {


            var text =  response;
            var info = JSON.parse(text);

            // Convert temperature to celsius
            var temp = Math.round(info.data.main.temp - 273.15);
            // Gather weather icon from OWM
            var url = "https://openweathermap.org/img/w/" + info.data.weather[0].icon + ".png";
            // Convert date to right format
            var date = new Date(1000*info.data.dt).toUTCString();

            //The actual visible adding of the weather data block
            $("#secondTable").html("<thead><tr><th>" + info.data.name +", " + info.data.sys.country + "</th></tr></thead><tbody><tr><td><img src='"+url+"' alt='icon'></td></tr><tr><td>" + temp + "°C</td></tr><tr><td>" + info.data.weather[0].description + "<tr><td>" + info.data.main.humidity + " %</td></tr></tr><tr><td>" + info.data.wind.speed + " m/s</td></tr><tr><td>"+date+"</td></tr><tr><td>OpenWeatherMap API</td></tr></tbody>");

          },
          error: function(request, errorType, errorMessage) {
            alert('Error: ' + errorType + ' with message' + errorMessage);
          }
        });

    return false;
  });
}


//Function for showing google map
function initMap() {
    // Map settings
    var settings = {
      zoom:2,
      center: {lat: 11, lng: -27}
    }
    // New map
    var map = new google.maps.Map(document.getElementById('map'), settings);

}
