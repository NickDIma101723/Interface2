<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aether - Digitale Items Archief</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4">
            <h1 class="text-3xl font-bold text-gray-900">Aether - Digitale Items Archief</h1>
        </div>
    </header>

    <nav class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex space-x-8 h-16">
                <a href="index.php" class="inline-flex items-center px-1 pt-1 border-b-2 border-blue-500 text-sm font-medium text-gray-900">Home</a>
                <a href="items_overzicht.php" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Alle Items</a>
                <a href="item_toevoegen.php" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Nieuw Item</a>
                <?php if (isset($_SESSION['username'])): ?>
                    <a href="logout.php" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Uitloggen (<?= $_SESSION['username'] ?>)</a>
                <?php else: ?>
                    <a href="login.php" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Inloggen</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 px-4">
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Welkom bij het Aether Project</h2>
            <p class="text-gray-600 mb-4">Dit systeem beheert digitale archeologische items - oude software, games, websites en andere digitale artefacten uit het verleden.</p>
            <div class="flex gap-4 mt-6">
                <a href="items_overzicht.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Bekijk Alle Items</a>
                <a href="item_toevoegen.php" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Nieuw Item Toevoegen</a>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Systeemfunctionaliteit</h2>
            <ul class="space-y-2 text-gray-600">
                <li>✓ Volledig CRUD systeem (Create, Read, Update, Delete)</li>
                <li>✓ Beveiligde inlog met sessies</li>
                <li>✓ Formuliervalidatie en datacontrole</li>
                <li>✓ MySQL database met PDO</li>
                <li>✓ PHP/HTML view scheiding volgens reader</li>
            </ul>
        </div>
    </main>
</body>
</html>
