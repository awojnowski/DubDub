<?php
    
    require_once('php/dd_db.php');

    DD_DB::$path = 'db/dubdub';

    $db = DD_DB::load();
    $db = array_reverse($db);

    print_r($db);

?>
<!doctype html>
<html lang="en">
    <head>
        <title>DubDub</title>
    </head>
    <body>
        <table>
            <tr>
                <td>
                    <strong>Date</strong>
                </td>
                <td>
                    <strong>Hash</strong>
                </td>
            </tr>
            <?php foreach ($db as $row): ?>
                 <tr>
                    <td><?php echo $row['timestamp']; ?></td>
                    <td><?php echo $row['hash']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>