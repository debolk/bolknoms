<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>Checklist eters</title>
        <link rel="stylesheet" href="/stylesheets/checklist.css" type="text/css"/>
        
        <script type="text/javascript" src="/javascripts/jquery.js"></script>
        <script type="text/javascript" src="/javascripts/application.js"></script>
    </head>
    <body class="<?php echo Request::$current->controller(); ?> <?php echo Request::$current->action(); ?>">
        <h1>Checklist eters</h1>
        <table>
            <tr>
                <th>Datum</th>
                <td><?php echo $meal; ?></td>
            </tr>
            <tr>
                <th>Totaal eters</th>
                <td><?php echo $meal->registrations->count_all(); ?></td>
            </tr>
            <tr>
                <th>Ingevuld door</th>
                <td>............................</td>
            </tr>
        </table>
        <h2>Eters</h2>
        <ul>
            <?php foreach ($meal->registrations->find_all() as $r): ?>
                <li>
                    <input type="checkbox" /> <?php echo $r->name; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </body>
</html>
