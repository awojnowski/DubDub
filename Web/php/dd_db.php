<?php

    class DD_DB {

        public static $path = '../db/dubdub';

        public static function load() {

            if (!file_exists(DD_DB::$path)) return array();

            $db = file_get_contents(DD_DB::$path);
            $result = json_decode($db, true);

            if (!is_array($result))
                $result = array();

            return $result;

        }

        public static function save($db) {

            if (!$db ||
                !is_array($db)) return false;

            $db = json_encode($db);
            file_put_contents(DD_DB::$path, $db);

            return true;

        }

    }