/* Variables globales

let grid;
let btn;
let offset;
let limit;

2) Variables déclarées */

let grid = null;
let btn = null; //bouton btnLoadMore
let offset = 0; // nombre de cards déjà affichées
const limit = 2; // nombre de cards à charger par clic


/* Fonctions */

/* construire une URL API qui marche en local et en branche dev */

function getApiUrl(offsetValue, limitValue) {
    const basePath = window.location.pathname.replace(/index\.php$/, "");
    return `${basePath}api/events.php?offset=${offsetValue}&limit=${limitValue}`;
}

/* ajouter une card dans la frid */
function appendCard(item) {
    const card = document.createElement("article");
    card.className = "recent-card";
    card.innerHTML = `<img src="${item.image}" alt="${item.title}" loading="lazy">`;
    grid.appendChild(card);
}

/* appel Ajax et ajout des cards au clic sur le bouton - Chat GPT*/
async function handleLoadMoreClick() {
    btn.classList.add("is-loading");
    btn.textContent = "Chargement...";

    try {
        const url = getApiUrl(offset, limit);
        const res = await fetch(url);

        if (!res.ok) throw new Error("Erreur serveur");

        const data = await res.json();

        data.items.forEach(appendCard);

        offset += data.items.length;

        // quand il n'y a plus rien à charger, on supprime le bouton
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
}


/* Fonction init */
function initLoadMore() {
    // affectation des variables après chargement du DOM
    grid = document.getElementById("recentGrid");
    btn = document.getElementById("btnLoadMore");

    if (!grid || !btn) return;

    // offset = nombre de cards déjà présentes au départ
    offset = grid.querySelectorAll(".recent-card").length;


    btn.addEventListener("click", handleLoadMoreClick);
}


document.addEventListener("DOMContentLoaded", initLoadMore);
