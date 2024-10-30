<?php
header('Content-Type: application/json');

// Incluye el archivo de conexión
require 'connect.php';

$table = $_GET['table'] ?? null;
$search = $_GET['search'] ?? null;

try {
    if ($search) {
        // Búsqueda de un país por nombre y sus ciudades e idiomas asociados
        $stmtCountry = $conn->prepare("SELECT * FROM country WHERE Name LIKE :name");
        $stmtCountry->execute([':name' => "%$search%"]);
        $recordsCountry = $stmtCountry->fetchAll(PDO::FETCH_ASSOC);

        $stmtCity = $conn->prepare("SELECT * FROM city WHERE CountryCode IN (SELECT Code FROM country WHERE Name LIKE :name)");
        $stmtCity->execute([':name' => "%$search%"]);
        $recordsCity = $stmtCity->fetchAll(PDO::FETCH_ASSOC);

        $stmtCountryLanguage = $conn->prepare("SELECT * FROM countrylanguage WHERE CountryCode IN (SELECT Code FROM country WHERE Name LIKE :name)");
        $stmtCountryLanguage->execute([':name' => "%$search%"]);
        $recordsCountryLanguage = $stmtCountryLanguage->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'country' => $recordsCountry,
            'city' => $recordsCity,
            'countrylanguage' => $recordsCountryLanguage
        ]);
    } elseif ($table) {
        // Consulta para obtener todos los registros de una tabla
        $stmt = $conn->query("SELECT * FROM $table");
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($records);
    } else {
        echo json_encode(['error' => 'No table or search parameter provided.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>