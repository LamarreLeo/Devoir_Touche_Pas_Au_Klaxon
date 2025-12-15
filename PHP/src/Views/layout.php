<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Touche pas au klaxon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <!-- HEADER -->
    <header class="flex text-white justify-center bg-[#384050] py-4">
        <div class="flex justify-between items-center max-w-[1200px] w-full">
            <a href="/Devoir_Touche_Pas_Au_Klaxon/PHP/public" class="text-xl">Touche pas au klaxon</a>
            <div class="flex items-center gap-6">
                <?php if (isset($_SESSION['user'])): ?>
                    <!-- Utilisateur connecté -->
                    <a href="/Devoir_Touche_Pas_Au_Klaxon/PHP/public/trajets/create" 
                        class="bg-[#0074C7] py-2 px-4 rounded-lg">
                        Créer un trajet
                    </a>

                    <p class="text-lg">
                        Bonjour <span class="font-bold"><?= $_SESSION['user']['nom'] . ' ' . $_SESSION['user']['prenom'] ?></span>
                    </p>

                    <a href="/Devoir_Touche_Pas_Au_Klaxon/PHP/public/logout" class="bg-[#CD2C2E] py-2 px-4 rounded-lg">
                        Se deconnecter
                    </a>
                <?php else: ?>
                    <!-- Utilisateur non connecté -->
                    <a href="/Devoir_Touche_Pas_Au_Klaxon/PHP/public/login" class="bg-[#82b864] py-2 px-4 rounded-lg">
                        Se connecter
                    </a>
                <?php endif ?>
            </div>
        </div>
    </header>

    <!-- MAIN -->
    <main>
        <?= $content ?>
    </main>
    
    <!-- FOOTER -->
    <footer class="flex justify-center py-4 bg-[#384050] text-white">
        <p>&copy; 2025 - CENEF - MVC PHP</p>
    </footer>
</body>
</html