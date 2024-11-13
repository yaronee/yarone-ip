<?php

function getIp(): mixed
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

/**
 * @return mixed Retourne le résultat de la requête en JSON ou null si erreur
 */
function ipLocate(string $ipAddress): ?array // Retourne un tableau ou null
{
    $url = "http://ip-api.com/json/$ipAddress";

    $response = file_get_contents($url); // Récupère le contenu de l'URL
    $jsonData = json_decode($response, true); // Convertit la réponse en tableau associatif

    if ($jsonData && $jsonData['status'] === 'success') {
        return [ // Retourne un tableau avec les clés 'latitude' et 'longitude'
            'latitude' => $jsonData['lat'],
            'longitude' => $jsonData['lon'],
        ];
    }

    // Retourne null en cas d'erreur, car la fonction doit retourner un ?array
    return null;
}
