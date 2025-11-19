<?php
/**
 * Login verwerkpagina - Inlog verwerken
 * Les 5 - Inlog met database en sessions
 * Controleert inloggegevens en start sessie
 */

// Database verbinding includen (sessie wordt hierin al gestart)
require_once 'config.php';

// Controleren of formulier via POST is verstuurd (zie Les 5 - Inlog Verwerken)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Controleren of username en password zijn ingevuld
    if (isset($_POST['username']) && isset($_POST['password'])) {
        
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        // Validatie: Controleren of velden niet leeg zijn
        if (empty($username) || empty($password)) {
            header("Location: login.php?error=empty");
            exit();
        }
        
        // Wachtwoord hashen met SHA1 zoals in database (zie Les 5)
        // LET OP: In productie zou je bcrypt moeten gebruiken, maar de reader gebruikt SHA1
        $password_hash = sha1($password);
        
        // Query om gebruiker op te halen (zie Les 5 - Inlog Verwerken)
        $query = "SELECT * FROM users WHERE username = :username AND password = :password";
        
        try {
            // Prepared statement voor veiligheid
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password_hash);
            $stmt->execute();
            
            // Resultaat ophalen
            $user = $stmt->fetch();
            
            // Controleren of gebruiker bestaat
            if ($user) {
                // Inloggen gelukt - sessie aanmaken (zie Les 5 - Sessions)
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['id'];
                
                // Doorsturen naar overzichtspagina
                header("Location: items_overzicht.php");
                exit();
                
            } else {
                // Inloggen mislukt - ongeldige gegevens
                header("Location: login.php?error=invalid");
                exit();
            }
            
        } catch (PDOException $e) {
            die("Fout bij inloggen: " . $e->getMessage());
        }
        
    } else {
        // Niet alle velden ingevuld
        header("Location: login.php?error=empty");
        exit();
    }
    
} else {
    // Pagina is niet via POST bereikt
    header("Location: login.php");
    exit();
}
?>
