<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $item['titel'] ?> - Aether</title>
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
        <p style="margin-bottom: 20px;">
            <a href="items_overzicht.php">← Terug naar overzicht</a>
        </p>

        <!-- Detail card met alle informatie (zie Les 1.2 - Detailpagina) -->
        <div class="detail-card">
            <h2><?= $item['titel'] ?></h2>
            
            <p><strong>ID:</strong> <?= $item['id'] ?></p>
            
            <p><strong>Beschrijving:</strong><br>
            <?= nl2br($item['beschrijving']) ?></p>
            
            <p><strong>Categorie:</strong> <?= $item['categorie'] ?></p>
            
            <p><strong>Jaar van Item:</strong> <?= $item['jaar_item'] ?></p>
            
            <p><strong>Datum Toegevoegd:</strong> 
            <?php 
            // Nederlandse datum formatting
            $datum = new DateTime($item['datum_toegevoegd']);
            echo $datum->format('d-m-Y'); 
            ?>
            </p>
            
            <p><strong>Status:</strong> 
            <span class="status status-<?= strtolower(str_replace(' ', '-', $item['status'])) ?>">
                <?= $item['status'] ?>
            </span>
            </p>
            
            <p><strong>Opslaglocatie:</strong> <?= $item['locatie'] ?></p>
            
            <!-- Acties alleen voor ingelogde gebruikers -->
            <?php if (isset($_SESSION['username'])): ?>
                <div class="mt-20">
                    <a href="item_bewerken.php?id=<?= $item['id'] ?>" class="btn">✏️ Bewerken</a>
                    <a href="item_verwijderen.php?id=<?= $item['id'] ?>" class="btn btn-delete">🗑️ Verwijderen</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Aether Project - Digitale Archeologie Systeem</p>
    </footer>
</body>
</html>
