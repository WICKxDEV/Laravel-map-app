<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map App</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>
<body>
    <h1>Add Location</h1>
    <form action="{{ route('locations.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <label for="latitude">Latitude:</label>
        <input type="text" name="latitude" id="latitude" required>
        <label for="longitude">Longitude:</label>
        <input type="text" name="longitude" id="longitude" required>
        <button type="submit">Add Location</button>
    </form>

    <h2>Map</h2>
    <div id="map" style="height: 500px;"></div>

    <script>
        const map = L.map('map').setView([7.8731, 80.7718], 7); // Center map on Sri Lanka

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add markers from the database
        const locations = @json($locations);
        locations.forEach(location => {
            L.marker([location.latitude, location.longitude])
                .addTo(map)
                .bindPopup(location.name);
        });
    </script>
</body>
</html>
