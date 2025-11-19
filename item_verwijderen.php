<?php
/**
 * Verwijderpagina - DELETE functionaliteit (bevestiging)
 * Les 3 - Gegevens verwijderen
 * Toont bevestigingspagina voor het verwijderen van een item
 */

// Database verbinding includen
require_once 'config.php';

// Controleer of gebruiker is ingelogd
require_once 'session_check.php';

// ID ophalen uit URL (zie Les 3 - Link maken naar verwijderpagina)
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query om de item op te halen die verwijderd gaat worden
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

// View bestand includen met bevestigingsvraag
require_once 'item_verwijderen_view.php';
?>
