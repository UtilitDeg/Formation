<?php
header('Content-Type: application/json');

// Chemin vers ton fichier de configuration DHCP
$configFile = '/etc/dhcp/dhcpd.conf';

// Vérifier l'existence
if (!file_exists($configFile)) {
    echo json_encode([
        'success' => false,
        'message' => 'Fichier de configuration introuvable.'
    ]);
    exit;
}

// Lire le contenu
$configContent = file_get_contents($configFile);

if ($configContent === false) {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur lors de la lecture du fichier.'
    ]);
} else {
    echo json_encode([
        'success' => true,
        'config' => $configContent
    ]);
}
?>
