<?php
/**
 * Toevoeg verwerkpagina - CREATE verwerking
 * Les 2.1 & 2.2 - Gegevens toevoegen en formuliercontrole
 * Verwerkt het toevoegformulier en schrijft naar database
 */

// Database verbinding includen
require_once 'config.php';

// Controleer of gebruiker is ingelogd
require_once 'session_check.php';

// Controleren of formulier is verstuurd via POST (zie Les 2.2 - Controleer Herkomst)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Controleren of alle verplichte velden aanwezig zijn (zie Les 2.2 - isset())
    if (isset($_POST['titel'], $_POST['beschrijving'], $_POST['categorie'], 
              $_POST['jaar_item'], $_POST['datum_toegevoegd'], $_POST['status'], $_POST['locatie'])) {
        
        // Gegevens uit formulier halen en opschonen (zie Les 2.2 - Speciale Tekens Filteren)
        $titel = trim($_POST['titel']);
        $beschrijving = trim($_POST['beschrijving']);
        $categorie = trim($_POST['categorie']);
        $jaar_item = trim($_POST['jaar_item']);
        $datum_toegevoegd = trim($_POST['datum_toegevoegd']);
        $status = trim($_POST['status']);
        $locatie = trim($_POST['locatie']);
        
        // Validatie: Controleren of velden niet leeg zijn (zie Les 2.2)
        if (empty($titel) || empty($beschrijving) || empty($categorie) || 
            empty($jaar_item) || empty($datum_toegevoegd) || empty($status) || empty($locatie)) {
            die("Fout: Alle velden zijn verplicht. <a href='item_toevoegen.php'>Ga terug</a>");
        }
        
        // Validatie: Controleren of jaar een getal is (zie Les 2.2 - is_numeric())
        if (!is_numeric($jaar_item)) {
            die("Fout: Jaar moet een geldig getal zijn. <a href='item_toevoegen.php'>Ga terug</a>");
        }
        
        // Validatie: Jaar moet tussen 1950 en 2025 liggen
        if ($jaar_item < 1950 || $jaar_item > 2025) {
            die("Fout: Jaar moet tussen 1950 en 2025 liggen. <a href='item_toevoegen.php'>Ga terug</a>");
        }
        
        // Validatie: Datum moet geldig zijn (zie Les 2.2 - datum controle)
        $datum_check = DateTime::createFromFormat('Y-m-d', $datum_toegevoegd);
        if (!$datum_check || $datum_check->format('Y-m-d') !== $datum_toegevoegd) {
            die("Fout: Ongeldige datum. <a href='item_toevoegen.php'>Ga terug</a>");
        }
        
        // Validatie: Status moet een geldige waarde zijn
        $geldige_statussen = ['te restaureren', 'gerestaureerd', 'beschadigd', 'compleet'];
        if (!in_array($status, $geldige_statussen)) {
            die("Fout: Ongeldige status. <a href='item_toevoegen.php'>Ga terug</a>");
        }
        
        // Data is veilig via prepared statements - geen htmlspecialchars nodig bij opslaan
        // htmlspecialchars wordt gebruikt bij OUTPUT in de view bestanden (zie Les 2.2)
        
        // INSERT query maken (zie Les 2.1 - Toevoegpagina Maken)
        $query = "INSERT INTO items (titel, beschrijving, categorie, jaar_item, datum_toegevoegd, status, locatie) VALUES (:titel, :beschrijving, :categorie, :jaar_item, :datum_toegevoegd, :status, :locatie)";
        
        try {
            // Prepared statement voor veiligheid tegen SQL injection
            $stmt = $pdo->prepare($query);
            
            // Parameters binden (zie reader - PDO prepared statements)
            $stmt->bindParam(':titel', $titel);
            $stmt->bindParam(':beschrijving', $beschrijving);
            $stmt->bindParam(':categorie', $categorie);
            $stmt->bindParam(':jaar_item', $jaar_item, PDO::PARAM_INT);
            $stmt->bindParam(':datum_toegevoegd', $datum_toegevoegd);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':locatie', $locatie);
            
            // Query uitvoeren
            $stmt->execute();
            
            // Succesvol toegevoegd - doorsturen naar overzicht (zie Les 2.1)
            header("Location: items_overzicht.php");
            exit();
            
        } catch (PDOException $e) {
            die("Fout bij toevoegen item: " . $e->getMessage());
        }
        
    } else {
        // Niet alle velden zijn ingevuld
        die("Fout: Niet alle verplichte velden zijn ingevuld. <a href='item_toevoegen.php'>Ga terug</a>");
    }
    
} else {
    // Pagina is niet via POST bereikt
    die("Ongeldige toegang. <a href='item_toevoegen.php'>Ga terug naar het formulier</a>");
}
?>
