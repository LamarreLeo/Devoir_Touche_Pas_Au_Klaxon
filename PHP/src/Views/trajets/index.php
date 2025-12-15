<h2>Trajets proposés</h2>

<?php if (empty($trajets)) : ?>
    <p>Aucun trajet disponible.</p>
<?php else : ?>
    <ul>
        <?php foreach ($trajets as $trajet) : ?>
            <li>
                Départ : <?= htmlspecialchars($trajet['date_heure_depart']) ?>
                - Places : <?= (int) $trajet['places'] ?>
                - <a href="/trajets/<?= (int) $trajet['id'] ?>">Détails</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>