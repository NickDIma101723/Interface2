<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Bewerken - Aether</title>
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
        <h2 style="color: #00d4ff; text-align: center; margin-bottom: 30px;">Item Bewerken</h2>

        <!-- Bewerkformulier met bestaande waarden (zie Les 4 - Gegevens tonen in formulier) -->
        <form action="item_bewerken_verwerk.php" method="POST">
            
            <!-- Verborgen veld met ID (zie Les 4) -->
            <input type="hidden" name="id" value="<?= $item['id'] ?>">

            <label for="titel">Titel van de Item *</label>
            <input type="text" id="titel" name="titel" required 
                   value="<?= $item['titel'] ?>">

            <label for="beschrijving">Beschrijving *</label>
            <textarea id="beschrijving" name="beschrijving" required><?= $item['beschrijving'] ?></textarea>

            <label for="categorie">Categorie *</label>
            <select id="categorie" name="categorie" required>
                <option value="">-- Selecteer categorie --</option>
                <option value="Software" <?= $item['categorie'] == 'Software' ? 'selected' : '' ?>>Software</option>
                <option value="Gaming" <?= $item['categorie'] == 'Gaming' ? 'selected' : '' ?>>Gaming</option>
                <option value="Web" <?= $item['categorie'] == 'Web' ? 'selected' : '' ?>>Web</option>
                <option value="Mobile" <?= $item['categorie'] == 'Mobile' ? 'selected' : '' ?>>Mobile</option>
                <option value="Hardware" <?= $item['categorie'] == 'Hardware' ? 'selected' : '' ?>>Hardware</option>
                <option value="Multimedia" <?= $item['categorie'] == 'Multimedia' ? 'selected' : '' ?>>Multimedia</option>
                <option value="Overig" <?= $item['categorie'] == 'Overig' ? 'selected' : '' ?>>Overig</option>
            </select>

            <label for="jaar_item">Jaar van Item *</label>
            <input type="number" id="jaar_item" name="jaar_item" required 
                   min="1950" max="2025" 
                   value="<?= $item['jaar_item'] ?>">

            <label for="datum_toegevoegd">Datum Toegevoegd aan Archief *</label>
            <input type="date" id="datum_toegevoegd" name="datum_toegevoegd" required
                   value="<?= $item['datum_toegevoegd'] ?>">

            <label for="status">Status *</label>
            <select id="status" name="status" required>
                <option value="">-- Selecteer status --</option>
                <option value="te restaureren" <?= $item['status'] == 'te restaureren' ? 'selected' : '' ?>>Te Restaureren</option>
                <option value="gerestaureerd" <?= $item['status'] == 'gerestaureerd' ? 'selected' : '' ?>>Gerestaureerd</option>
                <option value="beschadigd" <?= $item['status'] == 'beschadigd' ? 'selected' : '' ?>>Beschadigd</option>
                <option value="compleet" <?= $item['status'] == 'compleet' ? 'selected' : '' ?>>Compleet</option>
            </select>

            <label for="locatie">Opslaglocatie *</label>
            <input type="text" id="locatie" name="locatie" required 
                   value="<?= $item['locatie'] ?>">

            <div style="text-align: center; margin-top: 30px;">
                <input type="submit" value="Wijzigingen Opslaan" class="btn">
                <a href="item_detail.php?id=<?= $item['id'] ?>" class="btn btn-secondary">Annuleren</a>
            </div>
        </form>
    </div>
</body>
</html>
