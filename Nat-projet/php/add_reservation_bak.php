<?php
header('Content-Type: application/json');

$hostname = $_POST['hostname'] ?? '';
$mac = $_POST['mac'] ?? '';
$ip = $_POST['ip'] ?? '';

// Simulation d'une validation simple
if ($hostname && $mac && $ip) {
    // ICI : Ajouter au fichier /etc/dhcp/dhcpd.conf par exemple...
    echo json_encode(['success' => true, 'message' => 'Réservation ajoutée avec succès.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Champs manquants.']);
}
?>
