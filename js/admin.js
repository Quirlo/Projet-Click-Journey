function updateRole(button, email, newRole) {
    fetch('update_ban.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: email, role: newRole })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // Mise à jour dynamique du bouton
            const isBanned = newRole === 'banni';
            button.innerText = isBanned ? 'Débannir' : 'Bannir';
            button.className = isBanned ? 'unban-btn' : 'ban-btn';
            button.setAttribute('onclick', `updateRole(this, '${email}', '${isBanned ? 'normal' : 'banni'}')`);

            // Mise à jour de la cellule "Rôle"
            const roleCell = button.closest('tr').querySelector('.user-role');
            roleCell.innerText = isBanned ? 'Banni' : 'Normal';
        } else {
            alert(data.error || "Erreur lors de la mise à jour.");
        }
    })
    .catch(err => {
        console.error(err);
        alert("Erreur réseau");
    });
}
