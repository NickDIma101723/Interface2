<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe Item Toevoegen - Aether</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>⚡ AETHER ⚡</h1>
        <p>Digitale Items Archief & Reconstructie Systeem</p>
    </header>

    <nav>
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="items_overzicht.php">Alle Items</a></li>
                <li><a href="item_toevoegen.php">Nieuwe Item</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="logout.php">Uitloggen (<?= $_SESSION['username'] ?>)</a></li>
                <?php else: ?>
                    <li><a href="login.php">Inloggen</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2 style="color: #00d4ff; text-align: center; margin-bottom: 30px;">Nieuwe Digitale Item Toevoegen</h2>

        <!-- Toevoegformulier (zie Les 2.1 - Toevoegformulier) -->
        <form action="item_toevoegen_verwerk.php" method="POST">
            
            <label for="titel">Titel van de Item *</label>
            <input type="text" id="titel" name="titel" required 
                   placeholder="Bijv. Windows 95 CD-ROM">

            <label for="beschrijving">Beschrijving *</label>
            <textarea id="beschrijving" name="beschrijving" required 
                      placeholder="Gedetailleerde beschrijving van de item..."></textarea>

            <label for="categorie">Categorie *</label>
            <select id="categorie" name="categorie" required>
                <option value="">-- Selecteer categorie --</option>
                <option value="Software">Software</option>
                <option value="Gaming">Gaming</option>
                <option value="Web">Web</option>
                <option value="Mobile">Mobile</option>
                <option value="Hardware">Hardware</option>
                <option value="Multimedia">Multimedia</option>
                <option value="Overig">Overig</option>
            </select>

            <label for="jaar_item">Jaar van Item *</label>
            <input type="number" id="jaar_item" name="jaar_item" required 
                   min="1950" max="2025" placeholder="1995">

            <label for="datum_toegevoegd">Datum Toegevoegd aan Archief *</label>
            <input type="date" id="datum_toegevoegd" name="datum_toegevoegd" required>

            <label for="status">Status *</label>
            <select id="status" name="status" required>
                <option value="">-- Selecteer status --</option>
                <option value="te restaureren">Te Restaureren</option>
                <option value="gerestaureerd">Gerestaureerd</option>
                <option value="beschadigd">Beschadigd</option>
                <option value="compleet">Compleet</option>
            </select>

            <label for="locatie">Opslaglocatie *</label>
            <input type="text" id="locatie" name="locatie" required 
                   placeholder="Bijv. Archief A-12 of Server S-05">

            <div style="text-align: center; margin-top: 30px;">
                <input type="submit" value="Item Toevoegen" class="btn">
                <a href="items_overzicht.php" class="btn btn-secondary">Annuleren</a>
            </div>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Aether Project - Digitale Archeologie Systeem</p>
    </footer>
</body>
</html>
