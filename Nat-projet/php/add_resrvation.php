<?php
$hostname = $_POST['hostname'] ?? '';
$mac = $_POST['mac'] ?? '';
$ip = $_POST['ip'] ?? '';

if ($hostname && $mac && $ip) {
    $line = "$hostname,$mac,$ip\n";
    file_put_contents('./reservations.txt', $line, FILE_APPEND);
}