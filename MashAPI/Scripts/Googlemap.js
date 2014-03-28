var map;
var geocoder;


 function initialize() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);
        var mapOptions = {
          zoom: 8,
          center: latlng,
          mapTypeId: google.maps.MapTypeId.HYBRID
        }
        map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);

		if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(success, error);
} else {
  alert('geolocation not supported');
}
      }
	  
function success(position) {

   var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
   var myCenter=new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        var mapOptions = {
          zoom: 8,
          center: latlng,
          mapTypeId: google.maps.MapTypeId.HYBRID
        }
		
		
        map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
		
		marker=new google.maps.Marker({
  position:myCenter,
  animation:google.maps.Animation.BOUNCE
  });
		marker.setMap(map);
}

function error(msg) {
  alert('error: ' + msg);
}

   function geoLocation(location) {
        var address = location;

        geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
          } else {
            alert('Geocode cannot load : ' + status);
          }
        });
      }
	  