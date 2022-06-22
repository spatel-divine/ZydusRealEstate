
function initMap(lat,long) {

	

	if((lat == '' || long == '') || (lat == undefined || long == undefined))
	{
		var myLatLng = {lat: 23.022505, lng: 72.5713621};
	}
	else
	{
		var myLatLng = {lat: lat, lng: long};
	}
		
	
	

	var map = new google.maps.Map(document.getElementById('map'), {
	  zoom: 10,
	  center: myLatLng
	});

	var marker = new google.maps.Marker({
	  position: myLatLng,
	  map: map,
	  draggable: true,
	  title: 'Hello World!'
	});

	var lat = marker.getPosition().lat();
	var lng = marker.getPosition().lng();

	document.getElementById("lat").value = marker.getPosition().lat();
			document.getElementById("long").value = marker.getPosition().lng();

			google.maps.event.addListener(marker, 'dragend', function (event) {
    document.getElementById("lat").value = this.getPosition().lat();
	document.getElementById("long").value = this.getPosition().lng();
	coordinates_to_address(this.getPosition().lat(), this.getPosition().lng());
});


  }

  function coordinates_to_address(lat, lng) {
		debugger

		var geocoder = new google.maps.Geocoder();


    var latlng = new google.maps.LatLng(lat, lng);

    geocoder.geocode({'latLng': latlng}, function(results, status) {
		
        if(status == google.maps.GeocoderStatus.OK) {
            if(results[0]) {
				$('#my-address').val(results[0].formatted_address);
				var add= results[0].formatted_address ;
				var  value=add.split(",");

                    count=value.length;
                    country=value[count-1];
                    state=value[count-2];
					city=value[count-3];

					var pincode  = state.split(" ");
					var lastVar = pincode.pop();
					var restVar = pincode.join(" ");

					$('#state').val(restVar);
					$('#city').val(city);
					$('#pincode').val(lastVar);
					

            } else {
                alert('No results found');
            }
        } else {
            var error = {
                'ZERO_RESULTS': 'Kunde inte hitta adress'
            }

            // alert('Geocoder failed due to: ' + status);
            $('#my-address').html('<span class="color-red">' + error[status] + '</span>');
        }
    });
}

