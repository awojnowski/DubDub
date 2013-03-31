<?php
    
    require_once('php/dd_db.php');

    DD_DB::$path = 'db/dubdub';

    $db = DD_DB::load();
    $db = array_reverse($db);

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
                    <strong>Timestamp</strong>
                </td>
                <td style="padding-left:20px;">
                    <strong>Hash</strong>
                </td>
            </tr>
            <?php foreach ($db as $row): ?>
                 <tr>
                    <td><?php echo $row['timestamp']; ?></td>
                    <td style="padding-left:20px;"><?php echo $row['hash']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>