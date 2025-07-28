$(document).ready(function () {
    // Empêcher les <a> de naviguer
    $('.button-group a').click(function (e) {
        e.preventDefault();
    });

    // Boutons reliés à leurs actions
    $('#btn-load, #btn-reload').click(loadConfig);
    $('#btn-save').click(saveConfig);

    // Chargement initial de la config
    loadConfig();
});

function loadConfig() {
    fetch('php/config.php')
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                $('#dhcp-config').val(data.config);
                setStatus("Configuration chargée.", "green");
            } else {
                setStatus(data.message, "red");
            }
        })
        .catch(err => {
            setStatus("Erreur de chargement.", "red");
            console.error(err);
        });
}

function saveConfig() {
    const newConfig = $('#dhcp-config').val();

    fetch('php/save_config.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ config: newConfig })
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                setStatus(data.message, "green");
            } else {
                setStatus(data.message, "red");
            }
        })
        .catch(err => {
            setStatus("Erreur lors de l'enregistrement.", "red");
            console.error(err);
        });
}

function setStatus(message, color) {
    $('#status').text(message).css('color', color);
}

