<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 24.7136, lng: 46.6753}, // Coordinates for Riyadh, KSA
            zoom: 6
        });

        var input = document.getElementById('searchInput');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
            draggable: true
        });

        // Default marker position
        marker.setPosition({lat: 24.7136, lng: 46.6753});

        // Add a click listener to the map to set the marker position
        google.maps.event.addListener(map, 'click', function (event) {
            marker.setPosition(event.latLng);
            updateLocationFields(marker.getPosition());
        });

        // Function to update location fields
        function updateLocationFields(latLng) {
            document.getElementById('lat').value = latLng.lat();
            document.getElementById('lng').value = latLng.lng();

            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({'location': latLng}, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        document.getElementById('location').value = results[0].formatted_address;
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                    }
                }
            });
        }

        // Listener for marker position change
        marker.addListener('position_changed', function() {
            updateLocationFields(marker.getPosition());
        });

        // Listener for place changed event
        autocomplete.addListener('place_changed', function () {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);

            document.getElementById('location').value = place.formatted_address;
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyDWZCkmkzES9K2-Ci3AhwEmoOdrth04zKs" async defer></script>
