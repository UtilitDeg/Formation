<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);
$file = '/etc/dhcp/dhcpd.conf';

if (is_writable($file)) {
    file_put_contents($file, $data['config']);
    echo json_encode(['success' => true, 'message' => 'Configuration enregistrée.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Fichier non modifiable.']);
}
