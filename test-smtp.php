<?php

$mailHost = 'mailpit';
$mailPort = 1025;

$fp = fsockopen($mailHost, $mailPort, $errno, $errstr, 30);

if (!$fp) {
    echo "ERROR: $errno - $errstr\n";
} else {
    echo "Conexión exitosa a $mailHost en el puerto $mailPort\n";
    fclose($fp);
}
