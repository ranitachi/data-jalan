<div id="map"></div>
<script type="text/javascript">
    
      var map;
      function showMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }

      showMap();
</script>

<style>
      #map {
        height: 500px;
      }
</style>