<?php
/**
 * Session controle bestand - Beveiligingschecks
 * Les 5 - Sessions
 * Dit bestand wordt ge-include op pagina's die beveiliging nodig hebben
 */

// Sessie moet al gestart zijn in config.php
// Controleren of gebruiker is ingelogd (zie Les 5 - Sessions)

if (!isset($_SESSION['username'])) {
    // Gebruiker is niet ingelogd - doorsturen naar loginpagina
    header("Location: login.php");
    exit();
}

// Als deze regel bereikt wordt, is gebruiker ingelogd
// Script gaat gewoon door
?>
