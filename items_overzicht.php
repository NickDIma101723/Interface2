<?php
/**
 * Overzichtspagina - READ functionaliteit
 * Les 1.2 - Gegevens uitlezen en tonen
 * Dit bestand haalt alle items op uit de database
 */

// Database verbinding includen
require_once 'config.php';

// Query om alle items op te halen (zie Les 1.2 - Gegevens Uitlezen)
$query = "SELECT * FROM items ORDER BY datum_toegevoegd DESC";

try {
    // Query voorbereiden en uitvoeren met PDO
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    // Alle resultaten ophalen in een array
    $items = $stmt->fetchAll();
    
} catch (PDOException $e) {
    // Foutafhandeling
    die("Fout bij ophalen items: " . $e->getMessage());
}

// View bestand includen voor de HTML (scheiding PHP en HTML zoals in reader)
require_once 'items_overzicht_view.php';
?>
