<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen - Aether</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>⚡ AETHER ⚡</h1>
        <p>Digitale Items Archief & Reconstructie Systeem</p>
    </header>

    <div class="login-container">
        <h2>🔐 Inloggen</h2>

        <?php
        // Foutmelding tonen als die is meegegeven via URL
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 'invalid') {
                echo '<div class="message message-error">Ongeldige gebruikersnaam of wachtwoord.</div>';
            } elseif ($_GET['error'] == 'empty') {
                echo '<div class="message message-warning">Vul alle velden in.</div>';
            }
        }
        
        // Melding als gebruiker is uitgelogd
        if (isset($_GET['logout'])) {
            echo '<div class="message message-success">Je bent succesvol uitgelogd.</div>';
        }
        ?>

        <!-- Inlogformulier (zie Les 5 - Inlogformulier) -->
        <form action="login_verwerk.php" method="POST">
            <label for="username">Gebruikersnaam</label>
            <input type="text" id="username" name="username" required 
                   placeholder="Voer gebruikersnaam in">

            <label for="password">Wachtwoord</label>
            <input type="password" id="password" name="password" required 
                   placeholder="Voer wachtwoord in">

            <div style="text-align: center; margin-top: 20px;">
                <input type="submit" value="Inloggen" class="btn">
            </div>
        </form>

        <p style="text-align: center; margin-top: 20px; color: #a0a0a0; font-size: 0.9em;">
            Nog geen account? Neem contact op met de beheerder.
        </p>

        <p style="text-align: center; margin-top: 30px;">
            <a href="index.php" style="color: #00d4ff;">← Terug naar home</a>
        </p>
    </div>

    <footer>
        <p>&copy; 2025 Aether Project - Digitale Archeologie Systeem</p>
    </footer>
</body>
</html>
