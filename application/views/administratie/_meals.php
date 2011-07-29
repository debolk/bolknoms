<?php if (count($meals) > 0): ?>
    <table>
        <thead><tr>
            <th>Datum</th>
            <th>&nbsp;</th>
            <th>Aantal</th>
            <th>Inschrijvingen</th>
        </tr></thead>
        <tbody>
            <?php foreach ($meals as $meal): ?>
                <tr>
                    <td class="date"><?php echo $meal; ?></td>
                    <td>
                        <a href="/administratie/verwijder/<?php echo $meal->id; ?>" class="confirmation-needed">
                            <img src="/images/cross.png" alt="Verwijderen"/>
                        </a>
                    </td>
                    <td class="number"><?php echo $meal->registrations->count_all(); ?></td>
                    <td>
                        <?php foreach ($meal->registrations->find_all() as $registration): ?>
                            <?php echo $registration; ?>
                            <a href="/administratie/afmelden/<?php echo $registration->id; ?>" class="confirmation-needed">
                                <img src="/images/cross.png" alt="Verwijderen"/>
                            </a>
                            <br />
                        <?php endforeach; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="zero">Geen maaltijden gevonden</p>
<?php endif; ?>