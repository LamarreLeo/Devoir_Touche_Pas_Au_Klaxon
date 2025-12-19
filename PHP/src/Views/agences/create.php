<div class="bg-[#f1f8fc]">
    <div class="flex flex-col h-[calc(100vh-128px)] max-w-[600px] mx-auto pt-12">
        <h2 class="text-2xl mb-6">Créer une agence</h2>

        <form method="POST" action="/Devoir_Touche_Pas_Au_Klaxon/PHP/public/agences/create" class="space-y-4">
            <?php if (!empty($errors)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <?php foreach ($errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div>
                <label for="ville" class="block text-sm font-medium text-gray-700 mb-1">
                    Ville <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="ville"
                    name="ville"
                    value="<?= htmlspecialchars($data['ville'] ?? '') ?>"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0074C7] focus:border-transparent"
                    required
                    maxlength="100"
                    placeholder="Nom de la ville"
                >
            </div>

            <div class="flex gap-4 pt-4">
                <button
                    type="submit"
                    class="bg-[#0074C7] text-white py-2 px-6 rounded-lg hover:bg-[#0056b3] transition-colors"
                >
                    Créer l'agence
                </button>
                
                <a
                    href="/Devoir_Touche_Pas_Au_Klaxon/PHP/public/agences"
                    class="bg-gray-500 text-white py-2 px-6 rounded-lg hover:bg-gray-600 transition-colors"
                >
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
