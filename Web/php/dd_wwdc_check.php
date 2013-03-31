<?php

    class DD_WWDC_Check {

        public static function check_wwdc() {

            $contents = file_get_contents('http://developer.apple.com/wwdc');
            $hash = sha1($contents);
            $timestamp = time();

            return array(
                "hash" => $hash,
                "timestamp" => $timestamp
            );

        }

    }