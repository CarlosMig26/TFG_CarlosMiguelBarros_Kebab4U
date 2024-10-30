function initialize() {
    $('form').on('keyup keypress', function(e) {
        let keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    const restaurantSelect = document.getElementById("restaurant-select");
    const geocoder = new google.maps.Geocoder;

    const latitudeField = document.getElementById("address-latitude");
    const longitudeField = document.getElementById("address-longitude");
    const restaurantUrlField = document.getElementById("restaurant-url");

    const map = new google.maps.Map(document.getElementById('address-map'), {
        center: { lat: 39.4731856, lng: -0.3378954 },
        zoom: 13
    });

    let marker;
    const infowindow = new google.maps.InfoWindow();

    restaurantSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const address = selectedOption.value;
        const name = selectedOption.text;
        const url = selectedOption.getAttribute('data-url');

        geocoder.geocode({ 'address': address }, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                const location = results[0].geometry.location;
                const lat = location.lat();
                const lng = location.lng();

                map.setCenter(location);
                map.setZoom(17);

                if (marker) {
                    marker.setMap(null);
                }

                marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    title: name
                });

                infowindow.setContent(`<div><strong>${name}</strong><br>${address}<br><a href="${url}">Ir al restaurante</a></div>`);
                infowindow.open(map, marker);

                setLocationCoordinates(lat, lng);
            } else {
                window.alert("Geocode was not successful for the following reason: " + status);
            }
        });
    });

    function setLocationCoordinates(lat, lng) {
        latitudeField.value = lat;
        longitudeField.value = lng;
        restaurantUrlField.value = url;
    }
}

window.initialize = initialize;

google.maps.event.addDomListener(window, 'load', initialize);
