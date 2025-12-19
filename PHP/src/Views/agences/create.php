<div class="bg-[#f1f8fc]">
    <div class="flex flex-col items-center justify-center h-[calc(100vh-128px)]">
        <div class="bg-[#384050] text-white max-w-[600px] mx-auto w-full p-12 rounded-lg">
            <?php if (!empty($errors)): ?>
                <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                    <ul class="list-disc list-inside">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="/Devoir_Touche_Pas_Au_Klaxon/PHP/public/agences/create" class="flex flex-col gap-6">
                <div class="flex flex-col gap-6">
                    <h3 class="text-2xl font-bold text-center mb-4">Créer une agence</h3>

                    <!-- Ville -->
                    <div>
                        <label for="ville" class="block text-sm font-bold mb-2">
                            Ville de l'agence *
                        </label>
                        <input
                            type="text"
                            id="ville"
                            name="ville"
                            value="<?= htmlspecialchars($data['ville'] ?? '') ?>"
                            class="w-full p-3 rounded-lg border-2 border-[#0074c7] bg-white text-[#384050] focus:outline-none focus:border-[#00497c] transition-colors"
                            required
                            maxlength="100"
                            placeholder="Entrez le nom de la ville"
                        >
                        <p class="text-xs mt-2 opacity-75">Entre 2 et 100 caractères</p>
                    </div>
                </div>
                
                <div class="flex gap-4 justify-center mt-8">
                    <button type="submit" class="bg-[#82b864] text-white px-8 py-3 rounded-lg font-bold cursor-pointer hover:opacity-90 transition-opacity">Créer l'agence</button>
                    <a href="/Devoir_Touche_Pas_Au_Klaxon/PHP/public/agences" class="bg-[#cd2c2e] text-white px-8 py-3 rounded-lg font-bold hover:opacity-90 transition-opacity">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
