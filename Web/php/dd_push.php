<?php

    class DD_Push {

        private static $certificate = '../certs/apns-dev.pem';

        public static $tokens = array(
            '7fedd8ba4bcbe19a393640ead43fdb8bf523850925a3407aad03aff7624d3c64'
        );

        public static function send() {

            $ctx = stream_context_create();
            stream_context_set_option($ctx, 'ssl', 'local_cert', DD_Push::$certificate);

            $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $error, $error_string, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

            if (!$fp) {

                echo 'Connecting to APNS failed.' . PHP_EOL;

                return false;

            }

            echo 'Connected to APNS.' . PHP_EOL;

            $body['aps'] = array(
                'alert' => 'WWDC TICKETS ARE ON SALE!',
                'sound' => 'default',
                'badge' => 1
            );

            // Encode the payload as JSON
            $payload = json_encode($body);

            foreach (DD_Push::$tokens as $token) {

                $token = str_replace(' ', '', $token);
                $token = str_replace('<', '', $token);
                $token = str_replace('>', '', $token);

                // Build the binary notification
                $msg = chr(0) . pack('n', 32) . pack('H*', $token) . pack('n', strlen($payload)) . $payload;

                // Send it to the server
                $result = fwrite($fp, $msg, strlen($msg));

                if (!$result)
                    echo 'Push notification to ' . $token . ' was not delivered.' . PHP_EOL;
                else
                    echo 'Push notification to ' . $token . ' was successful.' . PHP_EOL;

            }

            fclose($fp);

            return true;

        }

    }