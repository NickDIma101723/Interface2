<?php
/**
 * Detailpagina - READ één specifiek item
 * Les 1.2 - Detailpagina maken
 * Toont alle informatie van één specifieke item
 */

// Database verbinding includen
require_once 'config.php';

// ID ophalen uit de URL (zie Les 1.2 - Detailpagina)
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query om specifieke item op te halen
    $query = "SELECT * FROM items WHERE id = :id";
    
    try {
        // Prepared statement gebruiken voor veiligheid (zie reader)
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Resultaat ophalen
        $item = $stmt->fetch();
        
        // Controleren of item bestaat
        if (!$item) {
            die("Item niet gevonden.");
        }
        
    } catch (PDOException $e) {
        die("Fout bij ophalen item: " . $e->getMessage());
    }
    
} else {
    // Geen geldig ID opgegeven
    die("Geen geldig ID opgegeven.");
}

// View bestand includen
require_once 'item_detail_view.php';
?>
