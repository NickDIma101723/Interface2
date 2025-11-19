<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Verwijderen - Aether</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>AETHER </h1>
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
        <!-- Bevestigingsdialoog (zie Les 3 - Verwijderpagina maken) -->
        <div class="confirmation">
            <h2>⚠️ Item Verwijderen</h2>
            
            <p style="margin: 20px 0; line-height: 1.8;">
                Weet je zeker dat je de volgende item wilt verwijderen?<br>
                <strong style="color: #00d4ff; font-size: 1.2em;">
                    <?= $item['titel'] ?>
                </strong>
            </p>
            
            <div style="background: #0a0e27; padding: 15px; border-radius: 5px; margin: 20px 0; text-align: left;">
                <p><strong>Categorie:</strong> <?= $item['categorie'] ?></p>
                <p><strong>Jaar:</strong> <?= $item['jaar_item'] ?></p>
                <p><strong>Locatie:</strong> <?= $item['locatie'] ?></p>
            </div>
            
            <p style="color: #ff9900; font-weight: bold;">
                Deze actie kan niet ongedaan worden gemaakt!
            </p>
            
            <!-- Knoppen voor bevestigen of annuleren (zie Les 3) -->
            <div class="btn-group">
                <form action="item_verwijderen_verwerk.php" method="POST" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <input type="submit" value="Ja, Verwijderen" class="btn btn-delete">
                </form>
                <a href="items_overzicht.php" class="btn btn-secondary">Nee, Annuleren</a>
            </div>
        </div>
    </div>
</body>
</html>
