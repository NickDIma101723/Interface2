<?php
/**
 * Bewerkpagina - UPDATE functionaliteit
 * Les 4 - Gegevens aanpassen
 * Toont formulier met bestaande gegevens om aan te passen
 */

// Database verbinding includen
require_once 'config.php';

// Controleer of gebruiker is ingelogd
require_once 'session_check.php';

// ID ophalen uit URL (zie Les 4 - Link naar bewerkpagina)
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query om bestaande item op te halen (zie Les 4 - Gegevens tonen op bewerkpagina)
    $query = "SELECT * FROM items WHERE id = :id";
    
    try {
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $item = $stmt->fetch();
        
        // Controleren of item bestaat
        if (!$item) {
            die("Item niet gevonden. <a href='items_overzicht.php'>Terug naar overzicht</a>");
        }
        
    } catch (PDOException $e) {
        die("Fout bij ophalen item: " . $e->getMessage());
    }
    
} else {
    die("Geen geldig ID opgegeven. <a href='items_overzicht.php'>Terug naar overzicht</a>");
}

// View bestand includen met formulier
require_once 'item_bewerken_view.php';
?>
