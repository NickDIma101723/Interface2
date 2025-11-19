<?php
/**
 * Database configuratie bestand
 * Dit bestand bevat de verbinding met de MySQL database
 * Gebaseerd op PDO (PHP Data Objects) zoals gebruikt in de reader
 */

// Error reporting aanzetten voor development (zie Les 1.1 - Connection Script: Errors Tonen)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database configuratie variabelen
// BELANGRIJK: Pas deze gegevens aan met jouw eigen database informatie!
$host = 'localhost';              // Of het hostadres van SD-Lab
$dbname = 'jouw_studentnummer_aether';  // Vervang met jouw database naam
$username = 'jouw_username';      // Jouw MySQL gebruikersnaam
$password = 'jouw_wachtwoord';    // Jouw MySQL wachtwoord

// PDO connectie opzetten (zie Les 1.1 - Connection Script)
try {
    // DSN (Data Source Name) samenstellen voor MySQL
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    
    // PDO opties voor veiligheid en error handling
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // Exceptions bij fouten
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // Associatieve arrays
        PDO::ATTR_EMULATE_PREPARES   => false,                   // Echte prepared statements
    ];
    
    // PDO object aanmaken - dit is onze database verbinding
    $pdo = new PDO($dsn, $username, $password, $options);
    
    // Connectie gelukt - geen melding tonen (zie reader)
    // echo "Connected successfully"; // VERWIJDERD zoals gevraagd in de reader
    
} catch (PDOException $e) {
    // Bij fout: toon foutmelding en stop script
    die("Database connectie mislukt: " . $e->getMessage());
}

// Session starten voor inlog functionaliteit (wordt later gebruikt)
// Dit moet in config.php zodat het op elke pagina beschikbaar is
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
