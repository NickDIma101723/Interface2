<?php
/**
 * Verwijder verwerkpagina - DELETE verwerking
 * Les 3 - Gegevens verwijderen (verwerkpagina)
 * Voert daadwerkelijk het verwijderen uit
 */

// Database verbinding includen
require_once 'config.php';

// Controleer of gebruiker is ingelogd
require_once 'session_check.php';

// Controleren of formulier via POST is verstuurd (zie Les 3 - Verwijder-verwerkpagina)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // ID ophalen uit POST en controleren
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = $_POST['id'];
        
        // DELETE query (zie Les 3 - Gegevens Verwijderen)
        $query = "DELETE FROM items WHERE id = :id";
        
        try {
            // Prepared statement voor veiligheid
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            // Controleren of er daadwerkelijk iets verwijderd is
            if ($stmt->rowCount() > 0) {
                // Succesvol verwijderd - doorsturen naar overzicht
                header("Location: items_overzicht.php");
                exit();
            } else {
                die("Item niet gevonden of al verwijderd. <a href='items_overzicht.php'>Terug naar overzicht</a>");
            }
            
        } catch (PDOException $e) {
            die("Fout bij verwijderen item: " . $e->getMessage());
        }
        
    } else {
        die("Geen geldig ID opgegeven. <a href='items_overzicht.php'>Terug naar overzicht</a>");
    }
    
} else {
    // Pagina is niet via POST bereikt
    die("Ongeldige toegang. <a href='items_overzicht.php'>Terug naar overzicht</a>");
}
?>
