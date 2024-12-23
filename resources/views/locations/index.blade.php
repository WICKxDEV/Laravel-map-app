<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-center mb-6">Add Location</h1>

        <!-- Form and Map Row -->
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Form -->
            <form action="{{ route('locations.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg flex-1 space-y-6">
                @csrf
                <h2 class="text-xl font-semibold text-teal-500">Location Details</h2>

                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Location Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Enter location name"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500"
                        required
                    >
                </div>

                <div class="space-y-2">
                    <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                    <input
                        type="text"
                        name="latitude"
                        id="latitude"
                        placeholder="Enter latitude"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500"
                        required
                    >
                </div>

                <div class="space-y-2">
                    <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                    <input
                        type="text"
                        name="longitude"
                        id="longitude"
                        placeholder="Enter longitude"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500"
                        required
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-blue-500 to-purple-500 text-white py-3 rounded-lg shadow-md hover:from-blue-600 hover:to-purple-600 focus:outline-none focus:ring-4 focus:ring-blue-300 font-semibold transition-transform transform hover:scale-105 active:scale-95"
                >
                    Add Location
                </button>


            </form>

            <!-- Map -->
            <div class="flex-1">
                <h2 class="text-xl font-semibold text-teal-500 mb-4">Map</h2>
                <div id="map" class="h-96 rounded-lg shadow-lg"></div>
            </div>
        </div>

        <!-- Location List -->
        <div class="mt-8 bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-teal-500 mb-6">Added Locations</h2>
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-teal-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 border-b">Name</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 border-b">Latitude</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 border-b">Longitude</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locations as $location)
                        <tr class="border-t">
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $location->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $location->latitude }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $location->longitude }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


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
                .bindPopup(`<strong>${location.name}</strong><br>Lat: ${location.latitude}<br>Long: ${location.longitude}`);
        });
    </script>
</body>
</html>
