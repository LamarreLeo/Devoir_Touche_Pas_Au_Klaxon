<div class="bg-[#f1f8fc]">
    <style>
        tbody tr:nth-child(even) {
            background-color: #f3f4f6;
        }
    </style>
    <div class="flex flex-col h-[calc(100vh-128px)] max-w-[1200px] mx-auto pt-12">
        <h2 class="text-2xl mb-6">Liste des utilisateurs</h2>

        <?php if (empty($users)) : ?>
            <p class="text-center">Aucun utilisateur trouvé</p>
        <?php else : ?>
            <div class="overflow-x-auto rounded-lg mb-6">
                <table class="min-w-full bg-gray-600 rounded-lg overflow-hidden border">
                    <thead class="bg-[#384050] text-white">
                        <tr class="divide-x divide-gray-600">
                            <th class="py-2 px-4 text-left">
                                Nom
                            </th>
                            <th class="py-2 px-4 text-left">
                                Prénom
                            </th>
                            <th class="py-2 px-4 text-left">
                                Email
                            </th>
                            <th class="py-2 px-4 text-left">
                                Téléphone
                            </th>
                            <th class="py-2 px-4 text-center">
                                Rôle
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-600">
                        <?php foreach ($users as $user): ?>
                            <tr class="divide-x divide-gray-600 text-center bg-white">
                                <td class="py-2 px-4 text-left">
                                    <?= htmlspecialchars($user['nom']) ?>
                                </td>
                                <td class="py-2 px-4 text-left">
                                    <?= htmlspecialchars($user['prenom']) ?>
                                </td>
                                <td class="py-2 px-4 text-left">
                                    <?= htmlspecialchars($user['email']) ?>
                                </td>
                                <td class="py-2 px-4 text-left">
                                    <?= htmlspecialchars($user['phone'] ?? 'Non renseigné') ?>
                                </td>
                                <td class="py-2 px-4">
                                    <span class="inline-block px-2 py-1 text-xs rounded-full 
                                        <?php if ($user['role'] === 'admin'): ?>
                                            bg-red-100 text-red-800
                                        <?php else: ?>
                                            bg-blue-100 text-blue-800
                                        <?php endif; ?>">
                                        <?= htmlspecialchars($user['role']) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
