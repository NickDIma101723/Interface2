<?php
/**
 * Bewerk verwerkpagina - UPDATE verwerking
 * Les 4 - Gegevens aanpassen (verwerkpagina)
 * Verwerkt het bewerkformulier en update de database
 */

// Database verbinding includen
require_once 'config.php';

// Controleer of gebruiker is ingelogd
require_once 'session_check.php';

// Controleren of formulier via POST is verstuurd (zie Les 4 - Bewerk-verwerkpagina)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Controleren of alle velden aanwezig zijn inclusief ID
    if (isset($_POST['id'], $_POST['titel'], $_POST['beschrijving'], $_POST['categorie'], 
              $_POST['jaar_item'], $_POST['datum_toegevoegd'], $_POST['status'], $_POST['locatie'])) {
        
        // ID en gegevens uit formulier halen
        $id = $_POST['id'];
        $titel = trim($_POST['titel']);
        $beschrijving = trim($_POST['beschrijving']);
        $categorie = trim($_POST['categorie']);
        $jaar_item = trim($_POST['jaar_item']);
        $datum_toegevoegd = trim($_POST['datum_toegevoegd']);
        $status = trim($_POST['status']);
        $locatie = trim($_POST['locatie']);
        
        // Validatie: ID moet numeriek zijn
        if (!is_numeric($id)) {
            die("Fout: Ongeldig ID. <a href='items_overzicht.php'>Terug naar overzicht</a>");
        }
        
        // Validatie: Controleren of velden niet leeg zijn
        if (empty($titel) || empty($beschrijving) || empty($categorie) || 
            empty($jaar_item) || empty($datum_toegevoegd) || empty($status) || empty($locatie)) {
            die("Fout: Alle velden zijn verplicht. <a href='item_bewerken.php?id=$id'>Ga terug</a>");
        }
        
        // Validatie: Jaar moet een getal zijn
        if (!is_numeric($jaar_item)) {
            die("Fout: Jaar moet een geldig getal zijn. <a href='item_bewerken.php?id=$id'>Ga terug</a>");
        }
        
        // Validatie: Jaar moet tussen 1950 en 2025 liggen
        if ($jaar_item < 1950 || $jaar_item > 2025) {
            die("Fout: Jaar moet tussen 1950 en 2025 liggen. <a href='item_bewerken.php?id=$id'>Ga terug</a>");
        }
        
        // Validatie: Datum moet geldig zijn
        $datum_check = DateTime::createFromFormat('Y-m-d', $datum_toegevoegd);
        if (!$datum_check || $datum_check->format('Y-m-d') !== $datum_toegevoegd) {
            die("Fout: Ongeldige datum. <a href='item_bewerken.php?id=$id'>Ga terug</a>");
        }
        
        // Validatie: Status moet geldig zijn
        $geldige_statussen = ['te restaureren', 'gerestaureerd', 'beschadigd', 'compleet'];
        if (!in_array($status, $geldige_statussen)) {
            die("Fout: Ongeldige status. <a href='item_bewerken.php?id=$id'>Ga terug</a>");
        }
        
        // Data is veilig via prepared statements - geen htmlspecialchars nodig bij opslaan
        // htmlspecialchars wordt gebruikt bij OUTPUT in de view bestanden
        
        // UPDATE query maken (zie Les 4 - Gegevens Aanpassen)
        $query = "UPDATE items SET titel = :titel, beschrijving = :beschrijving, categorie = :categorie, jaar_item = :jaar_item, datum_toegevoegd = :datum_toegevoegd, status = :status, locatie = :locatie WHERE id = :id";
        
        try {
            // Prepared statement voor veiligheid
            $stmt = $pdo->prepare($query);
            
            // Parameters binden
            $stmt->bindParam(':titel', $titel);
            $stmt->bindParam(':beschrijving', $beschrijving);
            $stmt->bindParam(':categorie', $categorie);
            $stmt->bindParam(':jaar_item', $jaar_item, PDO::PARAM_INT);
            $stmt->bindParam(':datum_toegevoegd', $datum_toegevoegd);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':locatie', $locatie);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            // Query uitvoeren
            $stmt->execute();
            
            // Succesvol aangepast - doorsturen naar detailpagina
            header("Location: item_detail.php?id=$id");
            exit();
            
        } catch (PDOException $e) {
            die("Fout bij aanpassen item: " . $e->getMessage());
        }
        
    } else {
        die("Fout: Niet alle verplichte velden zijn ingevuld. <a href='items_overzicht.php'>Terug naar overzicht</a>");
    }
    
} else {
    // Pagina is niet via POST bereikt
    die("Ongeldige toegang. <a href='items_overzicht.php'>Terug naar overzicht</a>");
}
?>
