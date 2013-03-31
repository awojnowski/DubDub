<?php

    class DD_Push {

        public static $aps = array(
            "alert" => "WWDC TICKETS ARE ON SALE!!@#!#!",
            "badge" => 1,
            "sound" => "default"
        );

        private static $certificate = '../certs/apns-dev.pem';

        public static $tokens = array(
            ''
        );

        public static function send() {

            $payload = array(
                "aps" => DD_Push::$aps
            );

            $output = json_encode($payload);

            $apns_host = 'gateway.sandbox.push.apple.com';
            $apns_port = 2195;

            $stream_context = stream_context_create();
            stream_context_set_option($stream_context, 'ssl', 'local_cert', DD_Push::$certificate);

            $apns = stream_socket_client('ssl://' . $apns_host . ':' . $apns_port, $error, $errorString, 2, STREAM_CLIENT_CONNECT, $stream_context);

            foreach (DD_Push::$tokens as $token) {

                $token = str_replace(' ', '', $token);

                $apns_message = chr(0) . chr(0) . chr(32) . pack('H*', $token) . chr(0) . chr(strlen($output) . $output);
                fwrite($apns, $apns_message);

            }

            return true;

        }

    }