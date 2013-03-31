<?php

    require_once('dd_db.php');
    require_once('dd_push.php');
    require_once('dd_wwdc_check.php');

    $db = DD_DB::load();

    $check_result = DD_WWDC_Check::check_wwdc();
    $last_result = end($db);
    $db[] = $check_result;
    DD_DB::save($db);

    if ($last_result) {

        $hash1 = $check_result['hash'];
        $hash2 = $last_result['hash'];

        if ($hash1 !== $hash2) {

            // the hashes are different,
            // we should now send a push

            DD_Push::send();

        } else {

            echo 'WWDC page hash has not changed.  It is still "' . $hash1 . '".';

        }

    }