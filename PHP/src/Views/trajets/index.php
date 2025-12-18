<div class="bg-[#f1f8fc]">
    <style>
        tbody tr:nth-child(even) {
            background-color: #f3f4f6;
        }
    </style>
    <div class="flex flex-col h-[calc(100vh-128px)] max-w-[1200px] mx-auto pt-12">
        <?php if (isset($_SESSION['user'])) : ?>
            <h2 class="text-2xl">Trajets proposés</h2>
            <?php else : ?>
                <h2 class="text-2xl">Pour obtenir plus d'information sur un trajet, veuillez vous connecter</h2>
        <?php endif; ?>

        <?php if (empty($trajets)) : ?>
            <p class="text-center">Aucun trajet proposé</p>
            <?php else : ?>
                <div class="overflow-x-auto rounded-lg mt-6">
                    <table class="min-w-full bg-gray-600 rounded-lg overflow-hidden border">
                        <thead class="bg-[#384050] text-white">
                            <tr class="divide-x divide-gray-600">
                                <th class="py-2 px-4">
                                    Départ
                                </th>
                                <th class="py-2 px-4">
                                    Date
                                </th>
                                <th class="py-2 px-4">
                                    Heure
                                </th>
                                <th class="py-2 px-4">
                                    Destination
                                </th>
                                <th class="py-2 px-4">
                                    Date
                                </th>
                                <th class="py-2 px-4">
                                    Heure
                                </th>
                                <th class="py-2 px-4">
                                    Places
                                </th>
                                <?php if (isset($_SESSION['user'])): ?>
                                    <th class="py-2 px-4">
                                        Actions
                                    </th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-600">
                            <?php foreach ($trajets as $trajet): ?>
                                <tr class="divide-x divide-gray-600 text-center bg-white">
                                    <td class="py-2 px-4">
                                        <?= htmlspecialchars($trajet['agence_depart']) ?>
                                    </td>

                                    <td>
                                        <?= date('d/m/Y', strtotime($trajet['date_heure_depart'])) ?>
                                    </td>

                                    <td>
                                        <?= date('H:i', strtotime($trajet['date_heure_depart'])) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($trajet['agence_arrivee']) ?>
                                    </td>

                                    <td>
                                        <?= date('d/m/Y', strtotime($trajet['date_heure_arrivee'])) ?>
                                    </td>

                                    <td>
                                        <?= date('H:i', strtotime($trajet['date_heure_arrivee'])) ?>
                                    </td>

                                    <td>
                                        <?= $trajet['places'] ?>
                                    </td>

                                    <?php if (isset($_SESSION['user'])): ?>
                                        <td class="whitespace-nowrap text-sm flex flex-col py-2 ">
                                            <button
                                                type="button"
                                                onclick="openModal(<?= $trajet['id'] ?>)"
                                                class="text-[#00497c] cursor-pointer"
                                            >
                                                Détails
                                            </button>

                                            <?php if ($_SESSION['user']['id'] == $trajet['user_id'] || $_SESSION['user']['role'] === 'admin'): ?>
                                                <a 
                                                    href="/trajets/<?= $trajet['id'] ?>/edit"
                                                    class="text-[#00497c] cursor-pointer"
                                                >
                                                    Modifier
                                                </a>

                                                <button
                                                    type="submit"
                                                    onclick="return confirm('Voulez-vous vraiment supprimer ce trajet ?')"
                                                    class="text-[#cd2c2e]"
                                                >
                                                    Supprimer
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>

                                <!-- Modal pour les détails -->
                                <?php if (isset($_SESSION['user'])): ?>
                                    <div 
                                        id="modal-<?= $trajet['id'] ?>"
                                        class="fixed inset-0 bg-gray-900/25 overflow-y-auto h-full w-full z-50 pt-[30vh] hidden"
                                    >
                                        <div class="relative max-w-[600px] mx-auto bg-white p-6 rounded-xl flex flex-col gap-12">
                                            <button
                                                type="button"
                                                onClick="closeModal(<?= $trajet['id'] ?>)"
                                                class="self-end px-2 cursor-pointer"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>

                                            <div class="flex flex-col gap-4">
                                                <p>Auteur : <?= htmlspecialchars($trajet['user_nom'] . ' ' . $trajet['user_prenom']) ?></p>
                                                <p>Téléphone : <?= htmlspecialchars($trajet['user_phone']) ?></p>
                                                <p>Email : <?= htmlspecialchars($trajet['user_email']) ?></p>
                                                <p>Nombre total de places : <?= htmlspecialchars($trajet['places']) ?></p>
                                            </div>

                                            <button 
                                                type="button"
                                                onClick="closeModal(<?= $trajet['id'] ?>)"
                                                class="text-white bg-[#0074c7] py-2 px-4 rounded-lg cursor-pointer self-end"
                                            >
                                                Fermer
                                            </button>                                            
                                        </div>

                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
        <?php endif; ?>
    </div>

    <?php if (isset($_SESSION['user'])): ?>
        <script>
            function openModal(id) {
                document.getElementById('modal-' + id).classList.remove('hidden');
            }

            function closeModal(id) {
                document.getElementById('modal-' + id).classList.add('hidden');
            }
        </script>
    <?php endif; ?>
</div>