function chargerReservations() {
  fetch('php/get_reservations.php')
    .then(res => res.json())
    .then(data => {
      const tbody = document.querySelector("#reservation-table tbody");
      tbody.innerHTML = '';
      data.forEach(r => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${r.hostname}</td>
          <td>${r.mac}</td>
          <td>${r.ip}</td>
          <td>
            <button class="btn-two red rounded" onclick="supprimerReservation('${r.mac}')">Supprimer</button>
          </td>
        `;
        tbody.appendChild(row);
      });
    });
}

function supprimerReservation(mac) {
  fetch('php/delete_reservation.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ mac })
  }).then(() => chargerReservations());
}

document.getElementById("add-form").addEventListener("submit", function (e) {
  e.preventDefault();
  const formData = new FormData(this);

  fetch('php/add_reservation.php', {
    method: 'POST',
    body: formData
  }).then(() => {
    this.reset();
    chargerReservations();
  });
});

window.onload = chargerReservations;
