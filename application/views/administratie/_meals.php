<?php if (count($meals) > 0): ?>
    <table>
        <thead><tr>
            <th>&nbsp;</th>
            <th>Datum</th>
            <th>Promotie</th>
            <th>Deadline</th>
            <th>#</th>
            <th>Checklist</th>
            <th>&nbsp;</th>
        </tr></thead>
        <?php foreach ($meals as $meal): ?>
            <?php echo View::factory('administratie/_meal',array('meal' => $meal)); ?>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p class="zero">Geen maaltijden gevonden</p>
<?php endif; ?>