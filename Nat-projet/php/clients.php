<?php
$leaseFile = '/var/lib/dhcp/dhcpd.leases';

if (!file_exists($leaseFile)) {
    die("Fichier de lease introuvable.");
}

$leases = file_get_contents($leaseFile);

// Extraire les blocs de lease
preg_match_all('/lease\s+([\d\.]+)\s+\{(.*?)\}/s', $leases, $matches, PREG_SET_ORDER);

$clients = [];

foreach ($matches as $match) {
    $ip = $match[1];
    $block = $match[2];

    $mac = '';
    $hostname = '';
    $start = '';
    $end = '';

    if (preg_match('/hardware ethernet ([\w:]+);/', $block, $m)) {
        $mac = $m[1];
    }
    if (preg_match('/client-hostname "([^"]+)";/', $block, $m)) {
        $hostname = $m[1];
    }
    if (preg_match('/starts \d+ ([\d\/]+ [\d:]+);/', $block, $m)) {
        $start = $m[1];
    }
    if (preg_match('/ends \d+ ([\d\/]+ [\d:]+);/', $block, $m)) {
        $end = $m[1];
    }

    $clients[] = [
        'ip' => $ip,
        'mac' => $mac,
        'hostname' => $hostname,
        'start' => $start,
        'end' => $end
    ];
}

// En-tête JSON
header('Content-Type: application/json');
echo json_encode($clients, JSON_PRETTY_PRINT);
?>