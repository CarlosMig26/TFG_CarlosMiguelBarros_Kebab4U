let map;
let directionsService;
let directionsRenderer;
let autocompleteStart;
let autocompleteEnd;

function initMap() {
    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer();
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: {lat: 39.4731856, lng: -0.3378954},
    });
    directionsRenderer.setMap(map);

    autocompleteStart = new google.maps.places.Autocomplete(document.getElementById('start'));

    autocompleteEnd = new google.maps.places.Autocomplete(document.getElementById('end'));
}

function calculateAndDisplayRoute() {
    let start = document.getElementById('start').value;
    let end = document.getElementById('end').value;

    directionsService.route({
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.DRIVING,
    }, function(response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsRenderer.setDirections(response);
            // Extraer la distancia y el tiempo estimado de la respuesta
            let distanceInMeters = 0;
            let durationText = '';
            if (response.routes[0].legs[0]) {
                distanceInMeters = response.routes[0].legs[0].distance.value;
                durationText = response.routes[0].legs[0].duration.text;
            }
            let distanceInKilometers = distanceInMeters / 1000;
            let durationInMinutes = extractNumericValue(durationText);

            let earnings = distanceInKilometers * 5;

            document.getElementById('routeInfo').style.display = "flex";
            document.getElementById('distance').innerText = "Distancia: " + distanceInKilometers.toFixed(3) + " Km";
            document.getElementById('time').innerText = "Tiempo estimado: " + durationInMinutes.toFixed(0) + " min";
            document.getElementById('earnings').innerText = "Ingreso estimado: " + earnings.toFixed(2) + "€";
        } else {
            window.alert('La solicitud de ruta falló debido a ' + status);
        }
    });
}

function extractNumericValue(text) {
    return Number(text.match(/\d+/)[0]);
}

window.onload = initMap;
