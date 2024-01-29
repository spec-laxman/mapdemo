<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleet Tracking</title>
    <!-- Replace YOUR_GOOGLE_MAPS_API_KEY with your actual API key -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdDpqzUuoctPawAqeIi1uCsOJwrgo5m78&libraries=places&callback=initMap" async defer></script>
    
</head>
<body>
    <div id="map" style="height: 400px;"></div>
    <script>
        let map;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 0, lng: 0},
                zoom: 2
            });

            // Poll the PHP API every 15 seconds to update vehicle locations
            setInterval(updateVehicleLocations, 15000);
        }

        function updateVehicleLocations() {
            // Make an AJAX request to get vehicle locations from the PHP API
            fetch('get_locations.php')
                .then(response => response.json())
                .then(data => {
                    // Remove existing markers
                    markers.forEach(marker => marker.setMap(null));
                    markers = [];

                    // Add markers for each vehicle
                    data.forEach(vehicle => {
                        const marker = new google.maps.Marker({
                            position: {lat: parseFloat(vehicle.lat), lng: parseFloat(vehicle.lon)},
                            map: map,
                            title: `Vehicle ${vehicle.vehical_id}`
                        });
                        markers.push(marker);
                    });
                })
                .catch(error => console.error('Error fetching vehicle locations:', error));
        }

        let markers = [];
    </script>
</body>
</html>
