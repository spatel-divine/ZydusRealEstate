function initialize() {
        var address = (document.getElementById('my-address'));
        var autocomplete = new google.maps.places.Autocomplete(address, { types: ['geocode','establishment'], componentRestrictions : { country: ['in'] }});
        autocomplete.setTypes(['geocode']);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
			}

			
			
			document.getElementById("lat").value = place.geometry.location.lat();
			document.getElementById("long").value = place.geometry.location.lng();
			
			initMap(place.geometry.location.lat(),place.geometry.location.lng());

			coordinates_to_address(place.geometry.location.lat(),place.geometry.location.lng());

        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
		}
		
		


      });
}

google.maps.event.addDomListener(window, 'load', initialize);