<script src="assets/js/evenement.js"></script>

<link rel="stylesheet" href="assets/css/evenement.css">
<link rel="stylesheet" href="assets/css/style.css">


<body>
    <div class="hero-evenement">
        <img src="assets/images/evenement_hero.avif" alt="hero" class="hero-bg">
    </div>

    <!-- Section 2 Evenements / Lazy loading-->
    <section class="recent-events">
        <div class="container recent-events-container">

            <h2>Événements Récents</h2>
            <p class="recent-events-subtitle">Retrouvez nos événements les plus marquants</p>

            <div class="recent-events-grid" id="recentGrid">
            <article class="recent-card">
                <img src="assets/images/event1.avif" alt="Événement 1">
            </article>

            <article class="recent-card">
                <img src="assets/images/event2.avif" alt="Événement 2">
            </article>

            <article class="recent-card">
                <img src="assets/images/event3.avif" alt="Événement 3">
            </article>
            </div>

            <button class="btn-events" id="btnLoadMore" type="button">
                Charger plus
            </button>

        </div>
    </section>

    <!-- Section 3 Activités -->

    <section class="activities-info">
        <div class="container">

            <h2>Activités</h2>
            <p class="activities-info-subtitle">
            Retrouvez notre Programme d’Activités, de Septembre à Décembre 2025
            </p>

            <div class="activities-gallery" id="activitiesGallery">
            <button class="activities-thumb" type="button"
                data-full="assets/images/affiche_activite.webp">
                <img src="assets/images/affiche_activite.webp" alt="Programme1" loading="lazy">
            </button>

            <button class="activities-thumb" type="button"
                data-full="assets/images/affiche_activite.webp">
                <img src="assets/images/affiche_activite.webp" alt="Programme2" loading="lazy">
            </button>

            <button class="activities-thumb" type="button"
                data-full="assets/images/affiche_activite.webp">
                <img src="assets/images/affiche_activite.webp" alt="Programme3" loading="lazy">
            </button>
            </div>

            <p class="activities-info-text">
            Le P’tit Café est un lieu à la disposition des habitants et des adhérents de l’association Jeunes Pousses.
            </p>

            <p class="activities-info-text">
            Vous pouvez participer à l’élaboration du programme en proposant d’animer un atelier, une conférence…
            </p>

            <a href="index.php?page=contact" class="btn-events">Consulter l’agenda</a>

        </div>
    </section>
</body>
