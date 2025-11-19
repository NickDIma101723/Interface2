<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht Vondsten - Aether</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4">
            <h1 class="text-3xl font-bold text-gray-900">Aether - Digitale Vondsten Archief</h1>
        </div>
    </header>

    <nav class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex space-x-8 h-16">
                <a href="index.php" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Home</a>
                <a href="vondsten_overzicht.php" class="inline-flex items-center px-1 pt-1 border-b-2 border-blue-500 text-sm font-medium text-gray-900">Alle Vondsten</a>
                <a href="vondst_toevoegen.php" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Nieuwe Vondst</a>
                <?php if (isset($_SESSION['username'])): ?>
                    <a href="logout.php" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Uitloggen (<?= $_SESSION['username'] ?>)</a>
                <?php else: ?>
                    <a href="login.php" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">Inloggen</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 px-4">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Alle Digitale Vondsten</h2>
        
        <?php if (isset($_SESSION['username'])): ?>
            <div class="mb-6">
                <a href="vondst_toevoegen.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Nieuwe Vondst Toevoegen</a>
            </div>
        <?php endif; ?>

        <?php if (count($vondsten) > 0): ?>
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titel</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categorie</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jaar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Locatie</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($vondsten as $vondst): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $vondst['id'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="vondst_detail.php?id=<?= $vondst['id'] ?>" class="text-blue-600 hover:text-blue-900 font-medium">
                                        <?= $vondst['titel'] ?>
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $vondst['categorie'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $vondst['jaar_vondst'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?php if($vondst['status'] == 'gerestaureerd'): ?>bg-green-100 text-green-800
                                        <?php elseif($vondst['status'] == 'compleet'): ?>bg-blue-100 text-blue-800
                                        <?php elseif($vondst['status'] == 'beschadigd'): ?>bg-yellow-100 text-yellow-800
                                        <?php else: ?>bg-red-100 text-red-800<?php endif; ?>">
                                        <?= $vondst['status'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $vondst['locatie'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="vondst_detail.php?id=<?= $vondst['id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3">Bekijk</a>
                                    <?php if (isset($_SESSION['username'])): ?>
                                        <a href="vondst_bewerken.php?id=<?= $vondst['id'] ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Bewerk</a>
                                        <a href="vondst_verwijderen.php?id=<?= $vondst['id'] ?>" class="text-red-600 hover:text-red-900">Verwijder</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <p class="mt-4 text-sm text-gray-500">
                Totaal aantal vondsten: <strong class="text-gray-900"><?= count($vondsten) ?></strong>
            </p>
        <?php else: ?>
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <p class="text-yellow-700">
                    Er zijn nog geen vondsten in het systeem. 
                    <a href="vondst_toevoegen.php" class="font-medium underline">Voeg de eerste vondst toe!</a>
                </p>
            </div>
        <?php endif; ?>
    </main>

    <footer class="max-w-7xl mx-auto py-6 px-4 mt-8 border-t">
        <p class="text-center text-gray-500 text-sm">&copy; 2025 Aether Project</p>
    </footer>
</body>
</html>
<body>
    <header>
        <h1>⚡ AETHER ⚡</h1>
        <p>Digitale Vondsten Archief & Reconstructie Systeem</p>
    </header>

    <nav>
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="vondsten_overzicht.php">Alle Vondsten</a></li>
                <li><a href="vondst_toevoegen.php">Nieuwe Vondst</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="logout.php">Uitloggen (<?= $_SESSION['username'] ?>)</a></li>
                <?php else: ?>
                    <li><a href="login.php">Inloggen</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2 style="color: #00d4ff; margin-bottom: 20px;">Alle Digitale Vondsten</h2>
        
        <?php if (isset($_SESSION['username'])): ?>
            <p style="margin-bottom: 20px;">
                <a href="vondst_toevoegen.php" class="btn">➕ Nieuwe Vondst Toevoegen</a>
            </p>
        <?php endif; ?>

        <!-- Tabel met alle vondsten (zie Les 1.2 - Overzichtspagina) -->
        <?php if (count($vondsten) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titel</th>
                        <th>Categorie</th>
                        <th>Jaar Vondst</th>
                        <th>Status</th>
                        <th>Locatie</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vondsten as $vondst): ?>
                        <tr>
                            <td><?= $vondst['id'] ?></td>
                            <td>
                                <a href="vondst_detail.php?id=<?= $vondst['id'] ?>">
                                    <?= $vondst['titel'] ?>
                                </a>
                            </td>
                            <td><?= $vondst['categorie'] ?></td>
                            <td><?= $vondst['jaar_vondst'] ?></td>
                            <td>
                                <span class="status status-<?= strtolower(str_replace(' ', '-', $vondst['status'])) ?>">
                                    <?= $vondst['status'] ?>
                                </span>
                            </td>
                            <td><?= $vondst['locatie'] ?></td>
                            <td>
                                <a href="vondst_detail.php?id=<?= $vondst['id'] ?>">Bekijk</a>
                                <?php if (isset($_SESSION['username'])): ?>
                                    | <a href="vondst_bewerken.php?id=<?= $vondst['id'] ?>">Bewerk</a>
                                    | <a href="vondst_verwijderen.php?id=<?= $vondst['id'] ?>" style="color: #ff4444;">Verwijder</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <p style="margin-top: 20px; color: #a0a0a0;">
                Totaal aantal vondsten: <strong style="color: #00d4ff;"><?php echo count($vondsten); ?></strong>
            </p>
        <?php else: ?>
            <div class="message message-warning">
                Er zijn nog geen vondsten in het systeem. 
                <a href="vondst_toevoegen.php" style="color: #0a0e27; font-weight: bold;">Voeg de eerste vondst toe!</a>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2025 Aether Project - Digitale Archeologie Systeem</p>
    </footer>
</body>
</html>
