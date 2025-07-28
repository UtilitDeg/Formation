<?php
$data = json_decode(file_get_contents('php://input'), true);
$macToDelete = $data['mac'] ?? '';

$file = '/etc/dhcp/reservations.txt';
$temp = '';

if (file_exists($file)) {
    $lines = file($file);
    foreach ($lines as $line) {
        if (strpos($line, $macToDelete) === false) {
            $temp .= $line;
        }
    }
    file_put_contents($file, $temp);
}
