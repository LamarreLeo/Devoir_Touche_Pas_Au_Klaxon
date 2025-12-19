<div class="bg-[#f1f8fc]">
    <style>
        tbody tr:nth-child(even) {
            background-color: #f3f4f6;
        }
    </style>
    <div class="flex flex-col h-[calc(100vh-128px)] max-w-[1200px] mx-auto pt-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl">Liste des agences</h2>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <a href="/Devoir_Touche_Pas_Au_Klaxon/PHP/public/agences/create" 
                    class="bg-[#0074C7] py-2 px-4 rounded-lg text-white">
                    Créer une agence
                </a>
            <?php endif; ?>
        </div>

        <?php if (empty($agences)) : ?>
            <p class="text-center">Aucune agence trouvée</p>
        <?php else : ?>
            <div class="overflow-x-auto rounded-lg mb-6">
                <table class="min-w-full bg-gray-600 rounded-lg overflow-hidden border">
                    <thead class="bg-[#384050] text-white">
                        <tr class="divide-x divide-gray-600">
                            <th class="py-2 px-4 text-center">
                                Ville
                            </th>
                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                                <th class="py-2 px-4 text-center">
                                    Actions
                                </th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-600">
                        <?php foreach ($agences as $agence): ?>
                            <tr class="divide-x divide-gray-600 bg-white">
                                <td class="py-2 px-4 text-center">
                                    <?= htmlspecialchars($agence['ville']) ?>
                                </td>
                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                                    <td class="whitespace-nowrap text-sm flex flex-col py-2 items-center">
                                        <a 
                                            href="/Devoir_Touche_Pas_Au_Klaxon/PHP/public/agences/edit?id=<?= $agence['id'] ?>"
                                            class="text-[#00497c] cursor-pointer"
                                        >
                                            Modifier
                                        </a>

                                        <form method="POST" action="/Devoir_Touche_Pas_Au_Klaxon/PHP/public/agences/delete" class="mt-1">
                                            <input type="hidden" name="id" value="<?= $agence['id'] ?>">
                                            <button
                                                type="submit"
                                                onclick="return confirm('Voulez-vous vraiment supprimer cette agence ?')"
                                                class="text-[#cd2c2e]"
                                            >
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
