document.addEventListener("DOMContentLoaded", () => {
    const btnPanier = document.getElementById("btn-ajouter-panier");
    if (!btnPanier) return;

    btnPanier.addEventListener("click", () => {
        const steps = document.querySelectorAll("li");
        const customOptions = [];

        steps.forEach((step, index) => {
            const title = step.querySelector("h3")?.innerText || `Étape ${index + 1}`;
            const hebergement = step.querySelector("select[name='hebergement[]']")?.value || "";
            const restauration = step.querySelector("select[name='restauration[]']")?.value || "";
            const activite = step.querySelector("select[name='activite[]']")?.value || "";
            const transport = step.querySelector("select[name='transport[]']")?.value || "";
            const participants = step.querySelector("input[name='participants[]']")?.value || "1";

            customOptions.push({
                step: title,
                hebergement,
                restauration,
                activite,
                transport,
                participants
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const prixFinal = document.getElementById("prix-voyage-final");
            const prixInput = document.getElementById("prix_total_input");
        
            if (prixFinal && prixInput) {
                prixInput.value = prixFinal.textContent.trim();
            }
        });
        

        const data = {
            trip_id: tripId,
            custom_options: customOptions
        };

        fetch("ajouter_panier.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(result => {
            alert(result.success ? "✅ Ajouté au panier !" : "❌ " + result.message);
        })
        .catch(() => alert("❌ Erreur lors de l'envoi au panier"));
    });
});
