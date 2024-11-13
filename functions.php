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
function ipLocate(string $ipAddress): ?array
{
    $url = "http://ip-api.com/json/$ipAddress";

    $response = file_get_contents($url);
    $jsonData = json_decode($response, true);
    var_dump($jsonData);

    if ($jsonData && $jsonData['status'] === 'success') {
        return [
            'latitude' => $jsonData['lat'],
            'longitude' => $jsonData['lon'],
        ];
    }

    // Retourne null en cas d'erreur, car la fonction doit retourner un ?array
    return null;
}

// Si l'IP n'est pas valide ou la réponse a échoué, retourne un message d'erreur
return null;
