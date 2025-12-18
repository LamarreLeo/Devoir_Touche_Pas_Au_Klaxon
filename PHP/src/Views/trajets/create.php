<div class="bg-[#f1f8fc]">
    <div class="flex flex-col items-center justify-center h-[calc(100vh-128px)]">
        <div class="bg-[#384050] text-white max-w-[1200px] mx-auto w-full p-12 rounded-lg">
            <?php if (!empty($errors)) : ?>
                <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                    <ul class="list-disc list-inside">
                        <?php foreach ($errors as $error) : ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="/trajets/create" method="post" class="flex flex-col gap-6">
                <div class="flex flex-col gap-6">
                    <h3 class="text-2xl font-bold text-center mb-4">Créer un trajet</h3>
                    <!-- Conducteur (pré-rempli et non modifiable si pas admin) -->
                    <div class="p-4 rounded-lg border border-[#0074c7]">
                        <label for="" class="block text-sm font-bold mb-2">Conducteur :</label>
                        <p class="text-lg">
                            <?= htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']) ?>
                            <span class="text-sm opacity-75 block mt-1"><?= htmlspecialchars($_SESSION['user']['email']) ?></span>
                        </p>
                    </div>

                    <!-- Départ -->
                    <div class="flex justify-center gap-12">
                        <!-- Agence de départ -->
                        <div class="flex-1">
                            <label for="agence_depart_id" class="block text-sm font-bold mb-2">
                                Agence de départ *
                            </label>
                            <select 
                                name="agence_depart_id" 
                                id="agence_depart_id" 
                                class="w-full p-3 rounded-lg border-2 border-[#0074c7] bg-white text-[#384050] focus:outline-none focus:border-[#00497c] transition-colors"
                                required
                            >
                                <option value="">-- Sélectionnez une agence --</option>
                                <?php foreach ($agences as $agence) : ?>
                                    <option 
                                        value="<?= $agence['id'] ?>"
                                        <?= (isset($data['agence_depart_id']) && $data['agence_depart_id'] == $agence['id']) ? 'selected' : '' ?>
                                    >
                                        <?= htmlspecialchars($agence['ville']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Date et Heure de départ -->
                        <div class="flex-1">
                            <label for="date_heure_depart" class="block text-sm font-bold mb-2">
                                Date et heure de départ *
                            </label>
                            <input 
                                type="datetime-local"
                                id="date_heure_depart"
                                name="date_heure_depart"
                                value="<?= $data['date_heure_depart'] ?? '' ?>"
                                required
                                class="w-full p-3 rounded-lg border-2 border-[#0074c7] bg-white text-[#384050] focus:outline-none focus:border-[#00497c] transition-colors"
                            >
                        </div>
                    </div>

                    <!-- Arrivée -->
                    <div class="flex justify-center gap-12">
                        <!-- Agence d'arrivée -->
                        <div class="flex-1">
                            <label for="agence_arrivee_id" class="block text-sm font-bold mb-2">
                                Agence d'arrivée *
                            </label>
                            <select 
                                name="agence_arrivee_id" 
                                id="agence_arrivee_id" 
                                class="w-full p-3 rounded-lg border-2 border-[#0074c7] bg-white text-[#384050] focus:outline-none focus:border-[#00497c] transition-colors"
                                required
                            >
                                <option value="">-- Sélectionnez une agence --</option>
                                <?php foreach ($agences as $agence) : ?>
                                    <option 
                                        value="<?= $agence['id'] ?>"
                                        <?= (isset($data['agence_arrivee_id']) && $data['agence_arrivee_id'] == $agence['id']) ? 'selected' : '' ?>
                                    >
                                        <?= htmlspecialchars($agence['ville']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Date et Heure d'arrivée -->
                        <div class="flex-1">
                            <label for="date_heure_arrivee" class="block text-sm font-bold mb-2">
                                Date et heure d'arrivée *
                            </label>
                            <input 
                                type="datetime-local"
                                id="date_heure_arrivee"
                                name="date_heure_arrivee"
                                value="<?= $data['date_heure_arrivee'] ?? '' ?>"
                                required
                                class="w-full p-3 rounded-lg border-2 border-[#0074c7] bg-white text-[#384050] focus:outline-none focus:border-[#00497c] transition-colors"
                            >
                        </div>
                    </div>

                    <!-- Nombre de places -->
                    <div>
                        <label for="places" class="block text-sm font-bold mb-2">Nombre de places disponibles *</label>
                        <input 
                            type="number"
                            id="places"
                            name="places"
                            min="1"
                            max="10"
                            value="<?= $data['places'] ?? '' ?>"
                            required
                            class="w-full p-3 rounded-lg border-2 border-[#0074c7] bg-white text-[#384050] focus:outline-none focus:border-[#00497c] transition-colors"
                        >
                        <p class="text-xs mt-2 opacity-75">Entre 1 et 10 places</p>
                    </div>
                </div>
                
                <div class="flex gap-4 justify-center mt-8">
                    <button type="submit" class="bg-[#82b864] text-white px-8 py-3 rounded-lg font-bold cursor-pointer hover:opacity-90 transition-opacity">Créer le trajet</button>
                    <a href="/" class="bg-[#cd2c2e] text-white px-8 py-3 rounded-lg font-bold hover:opacity-90 transition-opacity">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>