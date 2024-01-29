<!DOCTYPE html>
<html>
<head>
    <title>Live Vehicle Location</title>
    <!-- Replace YOUR_GOOGLE_MAPS_API_KEY with your actual API key -->
    <script src="https://maps.googleapis.com/maps/api/js?key=yourAPIKey&libraries=places"></script>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <script>
        function initMap() {
            // Initialize the map
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: { lat: 37.7749, lng: -122.4194 }  // Default center
            });

            // Function to update the marker position
            function updateMarkerPosition(position,locationname) {
                var marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: locationname,
                    label: locationname,

                });

                // Center the map on the marker
                map.setCenter(position);
            }

            // Function to fetch and update the live location
            function updateLiveLocation() {
                // Make an AJAX request to your PHP script
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Parse the JSON response
                            var location = JSON.parse(xhr.responseText);

                            // Update the marker position
                            updateMarkerPosition({
                                lat: parseFloat(location.latitude),
                                lng: parseFloat(location.longitude)
                            },location.locationname);
                        }
                    }
                };

                // Replace 'get_live_location.php' with the actual path to your PHP script
                xhr.open('GET', 'get_live_location.php', true);
                xhr.send();
            }
            // Update live location every 5 seconds (adjust as needed)
            setInterval(updateLiveLocation, 5000);
        }

        // Initialize the map when the page loads
        initMap();
    </script>
</body>
</html>
