<?php if (count($meals) > 0): ?>
    <table>
        <thead><tr>
            <th>Datum</th>
            <th>Inschrijving sluit</th>
            <th>Bewerken</th>
            <th>Aantal</th>
            <th>Inschrijvingen</th>
        </tr></thead>
        <tbody>
            <?php foreach ($meals as $meal): ?>
                <?php echo View::factory('administratie/_meal',array('meal' => $meal)); ?>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="zero">Geen maaltijden gevonden</p>
<?php endif; ?>