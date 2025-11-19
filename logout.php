<?php
/**
 * Uitlog pagina - Session beëindigen
 * Les 5 - Uitloggen
 * Verwijdert sessie en logt gebruiker uit
 */

// Sessie starten (moet altijd eerst gebeuren)
session_start();

// Alle sessievariabelen verwijderen (zie Les 5 - Uitloggen)
session_unset();

// Sessie vernietigen
session_destroy();

// Doorsturen naar login pagina met melding
header("Location: login.php?logout=1");
exit();
?>
