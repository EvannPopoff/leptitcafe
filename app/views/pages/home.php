<link rel="stylesheet" href="assets/css/home.css">

<body>
    <div class="hero-accueil">
        <img src="assets/images/page_home_evenements/img-hero.webp" alt="hero">

        <div class="hero-content">
            <h1>Le P’tit Café</h1>
            <p>
                Un café associatif au Puy-en-Velay, où chacun trouve sa place !<br>
                Seul, en famille, pour un atelier ou toute la journée.
            </p>

            <a href="index.php?page=apropos" class="btn-hero">En savoir plus</a>
        </div>
    </div>


    <!-- Section 2 Evenements - Je remet en page plus tard les affiches -->
    <section class="events">
        <div class="events-container container">

            <h2>Événements phares</h2>
            <p class="events-subtitle">
                Retrouvez les événements organisés par le P’tit Café.
            </p>

            <div class="events-list">

                <article class="event-card">
                    <img src="assets/images/page_home_evenements/event1.avif" alt="Calendrier de l’Après"> </a>
                    <h3>Calendrier de l’Après</h3>
                    <p>Une programmation culturelle et artistique, offerte pendant les 24 jours avant Noël.</p>
                </article>

                <article class="event-card">
                    <img src="assets/images/page_home_evenements/event2.avif" alt="Festin Nomade"> </a>
                    <h3>Festin Nomade</h3>
                    <p>Le Festin Nomade s’installe le samedi 15 octobre pour une journée festive, succulente et familiale.</p>
                </article>

                <article class="event-card">
                    <img src="assets/images/page_home_evenements/event5.webp" alt="Printemps de l'Education"> </a>
                    <h3>Printemps de l'Education</h3>
                    <p>Un véritable phénomène d'éclosion d'initiatives est en train de se mettre en place dans l'éducation.</p>
                </article>

            </div>

            <a href="index.php?page=evenement" class="btn-events">Découvrir plus</a>

        </div>
    </section>


    <!-- Section 3 Activites -->
    <section class="activities">
        <div class="activities-container container">

            <div class="activities-affiche">
                <img src="assets/images/page_home_evenements/affiche_activite.webp" alt="Programme"> </a>
            </div>

            <div class="activities-content">
                <h2>Activités proposées</h2>

                <p>
                    Le P’tit Café est un lieu à la disposition des habitants et des adhérents
                    de l’association Jeunes Pousses.
                </p>

                <p>
                    Vous pouvez participer à l’élaboration du programme en proposant d’animer
                    un atelier, une conférence… <br>En tout cas, quelque chose qui vous tient à cœur !
                    Ou faire des demandes de chose que vous aimeriez trouver.
                </p>

                <a href="https://drive.google.com/file/d/1ebVDKNcNawgnvQSmhQkfKweU5myhno5q/view" class="btn-events">Consulter le Programme</a>

            </div>

        </div>
    </section>

    <!-- Section 4 Réserver -->
    <section class="reserver">
        <div class="container reserver-container">

            <h2>Un projet, un Anniversaire ?</h2>

            <p class="reserver-intro">
            Pour un repas de famille, pour des retrouvailles entre amis, pour une réunion professionnelles,
            pour une table ronde, ou pour le plaisir tout simplement, nous mettons le P’tit Café à votre disposition.
            </p>

            <div class="reserver-visuel">
            <img src="assets/images/page_home_evenements/plante2.png" alt="plante">
            </div>

            <p class="reserver-info">
            C’est assez simple, prenez contact avec nous par téléphone, en ligne
            ou directement au P’tit Café.
            </p>

            <a href="index.php?page=contact" class="btn-events">Réserver le P'tit Café</a>


        </div>
    </section>

    <section class="agenda-accueil">
        <div class="container agenda-accueil">

        <?php include 'app/views/layouts/calendar.php'; ?>

        </div>
    </section>

</body>