<?php

namespace App\Services;

use GuzzleHttp\Client;

class eCallSMS
{
    protected $client;
    protected $baseUri;

    public function __construct()
    {
        // Basis-URL aus der Config holen
        $this->baseUri = config('services.ecallSMS.base_url');

        // Guzzle Client konfigurieren
        $this->client = new Client([
            'base_uri' => $this->baseUri, // API-Base-URL
            'timeout'  => 5.0, // Timeout in Sekunden
        ]);
    }

    public function fetchData(string $endpoint = '')
    {
        // Benutzername und Passwort aus der Config holen
        $username = config('services.ecallSMS.username');
        $password = config('services.ecallSMS.password');

        // Basic Auth Header erstellen
        $authHeader = 'Basic ' . base64_encode("{$username}:{$password}");

        try {
            // Anfrage ausführen
            $response = $this->client->get($endpoint, [
                'headers' => [
                    'Accept'        => 'application/json',
                    'Authorization' => $authHeader,
                ],
            ]);

            return json_decode($response->getBody(), true); // JSON-Daten zurückgeben
        } catch (\Exception $e) {
            // Fehlerbehandlung mit vollständiger URL
            $fullUrl = rtrim($this->baseUri, '/') . '/' . ltrim($endpoint, '/');
            return 'Fehler beim Abrufen von: ' . $fullUrl . ' - ' . $e->getMessage();
        }
    }
}
