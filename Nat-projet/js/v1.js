$(document).ready(function () {
    // Intercepter tous les liens avec class .btn-two
    $('a.btn-two').click(function (event) {
        event.preventDefault(); // Évite navigation par défaut
    });

    $('#restart-dhcp').click(function () {
        if (!confirm("Redémarrer le serveur DHCP ?")) return;

        fetch('php/restart_dhcp.php')
            .then(res => res.json())
            .then(data => showStatus(data))
            .catch(() => showStatus({ success: false, message: "Erreur réseau." }));
    });

    $('#stop-dhcp').click(function () {
        if (!confirm("Arrêter le serveur DHCP ?")) return;

        fetch('php/stop_dhcp.php')
            .then(res => res.json())
            .then(data => showStatus(data))
            .catch(() => showStatus({ success: false, message: "Erreur réseau." }));
    });

    function showStatus(data) {
        $('#status-message').text(data.message).css('color', data.success ? 'green' : 'red');
    }
});
