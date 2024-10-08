<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Map Negara</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>

	<style>
		html, body {
			height: 100%;
			margin: 0;
		}
		.leaflet-container {
			height: 400px;
			width: 600px;
			max-width: 100%;
			max-height: 100%;
		}
	</style>

<style>body { padding: 0; margin: 0; } #map { height: 100%; width: 100vw; }</style>
</head>
<body>

<div id="map"></div>
<script>
	var map = L.map('map').setView([0, 0], 2);
    var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18, 
        minZoom: 2,  
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var geojsonData = JSON.parse(@json($geojsonData));

    function style(feature) {
        return {
            fillColor: feature.properties.color,
            weight: 1,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7
        };
    }

    var geojson = L.geoJSON(geojsonData, {
        style: style,
        onEachFeature: function (feature, layer) {
            console.log('<img src="https://flagcdn.com/48x36/' + feature.id.toLowerCase() + '.png" alt="' + feature.properties.name + ' Image" />');
            layer.bindTooltip(
                '<h3>' + feature.properties.name + '</h3>' +
                '<img src="https://flagcdn.com/48x36/' + feature.id.toLowerCase() + '.png" alt="' + feature.properties.name + ' Image" />' +
                '<p>Kawasan: ' + feature.properties.kawasan + '</p>' +
                '<p>Direktorat: ' + feature.properties.direktorat + '</p>'
            , {
            permanent: false,
            direction: 'auto'
            });

            // Open tooltip on click
            layer.on('click', function() {
                this.openTooltip();
            });
    }
    }).addTo(map);
</script>
</body>
</html>