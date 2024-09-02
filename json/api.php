<?php
// Función para obtener los datos de la API con caché
function fetchDataWithCache($url, $apiKey, $cacheFile, $cacheDuration = 3600)
{
    if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheDuration) {
        // Leer datos del archivo de caché
        $response = file_get_contents($cacheFile);
    } else {
        // Hacer solicitud a la API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Api-Key $apiKey",
        ));
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            die("Error al realizar la solicitud a la API");
        }

        // Guardar respuesta en el archivo de caché
        file_put_contents($cacheFile, $response);
    }

    // Decodificar la respuesta JSON
    $data = json_decode($response, true);

    if ($data === null) {
        die("Error al decodificar la respuesta JSON");
    }

    return $data;
}

// URL de la API
$url = "https://apipromocionales.marpico.co/api/inventarios/materialesAPI";

// Clave de autorización
$apiKey = "eyJhbGciOiJIUzI1NiJ9.UFVCTElNQVJLRVIgU0FT.AJBYRRIuLeW5ETd8yA4jXFLgRU-p1VBMZ-lBEz8IhnA";

// Archivo de caché
$cacheFile = 'api_cache.json';

// Obtener los datos de la API con caché
$data = fetchDataWithCache($url, $apiKey, $cacheFile);

// Filtrar los datos
$searchCategory = "30006"; // Reemplaza esto con la categoría que estás buscando

$filteredData = array_filter($data['results'], function ($item) use ($searchCategory) {
    return isset($item['subcategoria_1']['categoria']) && $item['subcategoria_1']['categoria'] === $searchCategory;
});

// Contar los resultados filtrados
$resultCount = count($filteredData);

// Mostrar el número de resultados filtrados
echo "Número de resultados encontrados: " . $resultCount . "<br><br>";

// Mostrar los datos filtrados
foreach ($filteredData as $item) {
    echo "Familia: " . $item['familia'] . "<br>";
    echo "Descripción Comercial: " . $item['descripcion_comercial'] . "<br>";
    echo "Categoría: " . $item['subcategoria_1']['categoria'] . "<br>";
    echo "Nombre de Categoría: " . $item['subcategoria_1']['nombre_categoria'] . "<br>";
    echo "Imagen: " . $item['imagen'] . "<br>";

    echo "<img style='width: 200px; height: 200px;' src='" . $item['imagen'] . "' alt='" . $item['descripcion_comercial'] . "'><br>";
}
