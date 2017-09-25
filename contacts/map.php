<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
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
	
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

	<script src="/contacts/mymap.js"></script>

  </head>
  <body>
  <button id="novosibirsk">Новосибирск</button>
  <button id="krasnoyarsk">Красноярск</button>
    <div id="map"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZ89bnDqfw0KY1vhhbKemt4ixTtZGp2qU&callback=initialize"
    async defer></script>
  </body>
</html>