document.addEventListener("DOMContentLoaded", function () {
    const grid = document.getElementById("recentGrid");
    const btn = document.getElementById("btnLoadMore");

    if (!grid || !btn) return;

    let offset = grid.querySelectorAll(".recent-card").length; // 3 cards
    const limit = 2;

    btn.addEventListener("click", async function () {
        btn.classList.add("is-loading");
        btn.textContent = "Chargement...";

        try {
            const basePath = window.location.pathname.replace(/index\.php$/, "");
            const url = `${basePath}api/events.php?offset=${offset}&limit=${limit}`;

            const res = await fetch(url, {
                headers: { "X-Requested-With": "fetch" }
            });




            if (!res.ok) throw new Error("Erreur serveur");

            const data = await res.json();

            // ajoute les nouvelles cards supp
            data.items.forEach((item) => {
                const card = document.createElement("article");
                card.className = "recent-card";

                card.innerHTML = `
            <img src="${item.image}" alt="${item.title}" loading="lazy">
          `;

                grid.appendChild(card);
            });

            offset += data.items.length;

            // S'il n'y a plus rien à charger, on supprime le bouton 
            if (!data.hasMore) {
                btn.remove();
                return;
            }

            btn.classList.remove("is-loading");
            btn.textContent = "Charger plus";
        } catch (err) {
            btn.classList.remove("is-loading");
            btn.textContent = "Charger plus";
            console.error(err);
            alert("Impossible de charger plus d'événements.");
        }
    });
});
