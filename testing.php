<?php
require 'con.php';

$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$query = "UPDATE ambulances SET Ambulance_latitude = latitude, Ambulance_longitude = longitude WHERE id_ambulance = '001'";

mysqli_query($conn,$query)

$conn->close();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <form class="myForm" action = "" method = "post">
        <input type = "text" name="latitude">
        <input type = "text" name="longitude"><br>
    </form>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 23.708824, lng: 90.364691},
          zoom: 7
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
            map.setZoom(15);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }

      function showPosition(position){
         document.querySelector('.myForm input[name = "latitude"]').value = position.coords.latitude;
         document.querySelector('.myForm input[name = "longitude"]').value = position.coords.longitude;
      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcK2Fk4blUOsBUsb1jhJ1jv-hYVaTBqZ0&callback=initMap">
    </script>
  </body>
</html>
