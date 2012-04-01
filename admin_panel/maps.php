<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="utf-8" />

    <title>Google Maps JavaScript API Example: Simple Polyline</title>

    <script src="//maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyAbpVa6_SBymmzy-jzcX1dVk6u3cjrkHCw"

            type="text/javascript"></script>

    <script type="text/javascript">

    function initialize() {

      if (GBrowserIsCompatible()) {

        var map = new GMap2(document.getElementById("map_canvas"));

        map.setCenter(new GLatLng(44.405836, 26.06608), 13);

        var polyline = new GPolyline([

  		  new GLatLng(44.4005, 26.06158),//min lat min long

  		  new GLatLng(44.4005, 26.07058),//min lat max long

		  new GLatLng(44.411172, 26.07058),//max lat max long

		  new GLatLng(44.411172, 26.06158),//max lat min long  		  

		  new GLatLng(44.4005, 26.06158)//min lat min long

		], "#ff0000", 10);

		map.addOverlay(polyline);

      }

    }  

    </script>

  </head>



  <body onload="initialize()" onunload="GUnload()">

    <div id="map_canvas" style="width: 500px; height: 300px"></div>

    <div id="message"></div>

  </body>

</html>

