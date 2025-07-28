<?php
header('Content-Type: application/json');
exec('sudo systemctl stop isc-dhcp-server', $out, $ret);
echo json_encode([
    'success' => $ret === 0,
    'message' => $ret === 0 ? 'DHCP arrêté.' : 'Erreur à l’arrêt.'
]);
