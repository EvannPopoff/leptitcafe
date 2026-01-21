// LAZY LOADING

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
    card.dataset.id = item.id;
  
    card.innerHTML = '<img src="' + item.image + '" alt="' + item.title + '" loading="lazy">';
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



// FENETRES POPUP

/* lancement du script quand la page est chargee - me semble mieux que le mettre à la fin*/
document.addEventListener("DOMContentLoaded", function () {

    /* récupération des éléments */
    let grid = document.getElementById("recentGrid");
    let modal = document.getElementById("eventModal");
    let modalMedia = document.getElementById("modalMedia");
    let modalTitle = document.getElementById("modalTitle");
    let closeBtn = document.getElementById("closeModal");


    /* click card */
    grid.addEventListener("click", function (e) {

        let card = e.target.closest(".recent-card");
        if (!card) return;

        let id = card.dataset.id;
        if (!id) return;

        /* appel API pour récupérer les infos */
        fetch("api/events.php?id=" + id)
            .then(function (response) {
                return response.json();
            })
        fetch("api/events.php?id=" + id)
            .then(function (response) {
                if (!response.ok) {
                    throw new Error("API erreur : " + response.status);
                }
                return response.json();
            })

            //debug
            .then(function (data) {
                modalTitle.textContent = data.title || "Événement";
                if (data.image) {
                    modalMedia.innerHTML = '<img src="' + data.image + '" alt="' + (data.title || "") + '">';
                } else {
                    modalMedia.innerHTML = "<p>Image indisponible</p>";
                }

                if (data.text) {
                    document.getElementById("modalText").textContent = data.text;
                } else {
                    document.getElementById("modalText").textContent = "";
                }

                modal.classList.add("is-open");
                document.body.style.overflow = "hidden";
            })

            .catch(function (err) {
                console.error(err);
                alert("Impossible de charger l'événement (API).");
            });

    });


    /* fermet la popup */
    closeBtn.addEventListener("click", function () {
        modal.classList.remove("is-open");
        document.body.style.overflow = "";
    });

    /* possibilité de fermer en cliquant sur le fond */
    modal.addEventListener("click", function (e) {
        if (e.target === modal) {
            modal.classList.remove("is-open");
            document.body.style.overflow = "";
        }
    });

});
