<?php if (count($meals) > 0): ?>
    <table>
        <thead><tr>
            <th>Datum</th>
            <th>Deadline</th>
            <th>#</th>
            <th>Namen</th>
            <th>Checklist</th>
            <th>&nbsp;</th>
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