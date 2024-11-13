<?php
require_once __DIR__.'/../functions.php';
$ipAddress = getIp(); // Récupère l'adresse IP de l'utilisateur

// Si l'IP est 127.0.0.1, on la remplace par une IP publique
if ($ipAddress === '127.0.0.1') {
    $ipAddress = '77.127.176.67';  // Remplacer par l'IP publique
}

$ipLocation = ipLocate($ipAddress); // Localise l'adresse IP

// La localisation a réussi, récupère la latitude et la longitude
if (is_array($ipLocation)) {
    $latitude = $ipLocation['latitude'];
    $longitude = $ipLocation['longitude'];
} else {
    // Si la localisation échoue, définir la localisation par défaut à Paris
    $latitude = 48.8566;  // Latitude de Paris
    $longitude = 2.3522;  // Longitude de Paris
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localisation IP</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.css" rel="stylesheet"> 
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.js"></script> 
</head>
<body class="bg-white h-screen m-0 p-0">
    <div class="relative isolate overflow-hidden bg-gradient-to-b from-indigo-100/20 h-full flex items-center justify-center">
        <div class="flex items-start space-x-8 p-8 w-full max-w-6xl">
            <!-- Section de gauche avec l'adresse IP et le bouton -->
            <div class="flex flex-col justify-start items-start space-y-4 w-1/2">
                <h1 class="text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl mb-4">
                    Votre IP : <?php echo $ipAddress; ?>
                </h1>
                <!-- Bouton Recharger -->
                <a href="javascript:location.reload()" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Recharger
                </a>
            </div>

            <!-- Section de droite avec la carte Mapbox -->
            <div id="map" class="w-1/2 h-64 rounded-lg shadow-lg"></div> <!-- Conteneur de la carte Mapbox -->

            
                <script>
                    mapboxgl.accessToken = 'pk.eyJ1IjoieWFyb25lZSIsImEiOiJjbTNmbzFiam8wbGd3MmlzZXRocWw1cGRpIn0.pFF9ZEdce3_cbIJMCNeo2w';

                    // Créer une carte Mapbox 
                    var map = new mapboxgl.Map({
                        container: 'map', // L'ID de l'élément HTML où la carte sera affichée
                        style: 'mapbox://styles/mapbox/streets-v11', // Style de la carte
                        center: [<?php echo $longitude; ?>, <?php echo $latitude; ?>], // Longitude et latitude
                        zoom: 10 // Niveau de zoom
                    });

                    // Attendre que la carte soit bien chargée avant d'ajouter le marqueur
                    map.on('load', function() {
                        // Ajouter un marqueur à la carte
                        new mapboxgl.Marker()
                            .setLngLat([<?php echo $longitude; ?>, <?php echo $latitude; ?>]) // Position du marqueur
                            .addTo(map); // Ajout à la carte
                    });
                </script>
            
        </div>
    </div>
</body>
</html>