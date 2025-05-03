document.addEventListener("DOMContentLoaded", function () {
    const btnSoumettre = document.getElementById('btn-soumettre');
    const inputs = document.querySelectorAll("input.editable-field");
    let modifications = {};

    inputs.forEach(input => {
        const row = input.closest("tr");
        const field = row.dataset.field;
        const btnEdit = row.querySelector(".edit-btn");
        const btnSave = row.querySelector(".save-btn");
        const btnCancel = row.querySelector(".cancel-btn");
        const originalValue = input.value;

        btnEdit.addEventListener("click", () => {
            input.disabled = false;
            btnEdit.style.display = "none";
            btnSave.style.display = "inline-block";
            btnCancel.style.display = "inline-block";
        });

        btnCancel.addEventListener("click", () => {
            input.value = originalValue;
            input.disabled = true;
            btnEdit.style.display = "inline-block";
            btnSave.style.display = "none";
            btnCancel.style.display = "none";
        });

        btnSave.addEventListener("click", () => {
            const newValue = input.value.trim();
            input.disabled = true;
            btnEdit.style.display = "inline-block";
            btnSave.style.display = "none";
            btnCancel.style.display = "none";

            
            modifications[field] = newValue;
            btnSoumettre.style.display = "inline-block";
            
        });
    });

    btnSoumettre.addEventListener("click", () => {
        if (Object.keys(modifications).length === 0) return;
        // Validation de base
        if (modifications.email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(modifications.email)) {
            showNotif("❌ Email invalide", false);
            return;
        }


        fetch('update_user.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(modifications)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotif("✅ Modifications enregistrées !");
                btnSoumettre.style.display = "none";
                modifications = {};
            } else {
                showNotif("❌ Erreur : " + (data.error || "Erreur inconnue"), false);
            }
        })
        .catch(() => showNotif("❌ Erreur réseau", false));
    });

    function showNotif(message, success = true) {
        const notif = document.getElementById("notif");
        notif.innerText = message;
        notif.style.backgroundColor = success ? "#4caf50" : "#f44336";
        notif.style.color = "#fff";
        notif.style.display = "block";
        notif.style.padding = "10px 20px";
        notif.style.borderRadius = "8px";
        notif.style.fontWeight = "bold";
        notif.style.position = "fixed";
        notif.style.bottom = "20px";
        notif.style.left = "50%";
        notif.style.transform = "translateX(-50%)";
        notif.style.zIndex = "1000";

        setTimeout(() => {
            notif.style.display = "none";
        }, 3000);
    }
});
