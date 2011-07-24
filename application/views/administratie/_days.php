<table>
    <thead><tr>
        <th>Datum</th>
        <th>Aantal</th>
        <th>Inschrijvingen</th>
    </tr></thead>
    <tbody>
        <?php foreach ($days as $day): ?>
            <tr>
                <td><?php echo $day; ?></td>
                <td class="number"><?php echo $day->registrations->count_all(); ?></td>
                <td><?php echo $day->registrations->as_list(); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>