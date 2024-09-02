<?php

class BaseModel
{
    private $apiUrl = 'https://apipromocionales.marpico.co/api/inventarios';
    private $apiKey = 'eyJhbGciOiJIUzI1NiJ9.UFVCTElNQVJLRVIgU0FT.AJBYRRIuLeW5ETd8yA4jXFLgRU-p1VBMZ-lBEz8IhnA';
    private $cacheDir = __DIR__ . '/cache/';
    private $cacheTime = 3600 * 12; // 3600 segundos = 1 hora

    protected function makeRequest($method, $endpoint, $data = null, $useCache = true)
    {
        $cacheFile = $this->cacheDir . md5($endpoint . json_encode($data, JSON_UNESCAPED_UNICODE)) . '.json';

        if ($useCache && $this->isCacheValid($cacheFile)) {
            return json_decode(file_get_contents($cacheFile), true);
        }

        $url = $this->apiUrl . $endpoint;
        $ch = curl_init();

        // Configurar el método HTTP
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
        } else {
            curl_setopt($ch, CURLOPT_HTTPGET, true);
        }

        // Configurar la URL
        curl_setopt($ch, CURLOPT_URL, $url);

        // Configurar los headers
        $headers = [
            'Content-Type: application/json',
            'Authorization: Api-Key ' . $this->apiKey,
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Configurar para recibir la respuesta como string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Ejecutar la petición
        $response = curl_exec($ch);

        if ($response === false) {
            throw new Exception('Error al realizar la solicitud a la API: ' . curl_error($ch));
        }

        curl_close($ch);

        // Decodificar la respuesta JSON
        $data = json_decode($response, true);

        if ($data === null) {
            throw new Exception('Error al decodificar la respuesta JSON');
        }

        if ($useCache) {
            file_put_contents($cacheFile, json_encode($data, JSON_UNESCAPED_UNICODE));
        }

        // Retornar la respuesta decodificada
        return $data;
    }

    private function isCacheValid($cacheFile)
    {
        if (file_exists($cacheFile)) {
            $fileTime = filemtime($cacheFile);
            if ((time() - $fileTime) < $this->cacheTime) {
                return true;
            }
        }
        return false;
    }
}
