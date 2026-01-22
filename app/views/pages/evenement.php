<script src="assets/js/evenement.js" defer></script>

<link rel="stylesheet" href="assets/css/evenement.css">


    <div class="hero-evenement">
        <img
        src="assets/images/page_home_evenements/evenement_hero.avif"
        alt="hero"
        class="hero-bg">
        <div class="hero-content">
            <h1>Vivre des moments ensemble</h1>
            <p>
                Revivez en images la magie de vos soirées et nos plus beaux partages
            </p>
        </div>
    </div>

    <!-- Section 2 - Evenements / Lazy loading -->
    <section class="recent-events">
      <div class="container recent-events-container">
        <h2>Évènements Récents</h2>
        <p class="recent-events-subtitle">
          Retrouvez nos évènements les plus marquants
        </p>

        <div class="recent-events-grid" id="recentGrid">
          <article class="recent-card" data-id="1">
            <img src="assets/images/page_home_evenements/event1.avif" alt="Calendrier de L'Après">
          </article>

          <article class="recent-card" data-id="2">
            <img src="assets/images/page_home_evenements/event2.avif" alt="Festin Nomade">
          </article>

          <article class="recent-card" data-id="3">
            <img src="assets/images/page_home_evenements/event3.webp" alt="Quinzaine des Droits de l'Enfant">
          </article>

        <button class="btn-events" id="btnLoadMore" type="button">
          Charger plus
        </button>
      </div>
    </section>

    <!-- Section 3 - Activités -->
    <section class="activities-info">
      <div class="container">
        <h2>Activités</h2>
        <p class="activities-info-subtitle">
          Retrouvez notre Programme d’Activités, de Septembre à Décembre 2025
        </p>

        <div class="activities-gallery" id="activitiesGallery">
          <button
            class="activities-thumb"
            type="button"
            data-full="assets/images/page_home_evenements/programme2.png">
            <a href="https://drive.google.com/file/d/1ebVDKNcNawgnvQSmhQkfKweU5myhno5q/view"><img
              src="assets/images/page_home_evenements/programme2.png"
              alt="Programme1"
              loading="lazy"> </a>
          </button>

          <button
            class="activities-thumb"
            type="button"
            data-full="assets/images/page_home_evenements/affiche_activite.webp">
            <a href="https://drive.google.com/file/d/1ebVDKNcNawgnvQSmhQkfKweU5myhno5q/view"><img
              src="assets/images/page_home_evenements/affiche_activite.webp"
              alt="Programme2"
              loading="lazy"> </a>
          </button>

          <button
            class="activities-thumb"
            type="button"
            data-full="assets/images/page_home_evenements/programme3.png">
            <a href="https://drive.google.com/file/d/1ebVDKNcNawgnvQSmhQkfKweU5myhno5q/view"><img
              src="assets/images/page_home_evenements/programme3.png"
              alt="Programme3"
              loading="lazy"> </a>
          </button>
        </div>

        <p class="activities-info-text">
          Le P’tit Café est un lieu à la disposition des habitants et des adhérents
          de l’association Jeunes Pousses.
        </p>

        <p class="activities-info-text">
          Vous pouvez participer à l’élaboration du programme en proposant d’animer
          un atelier, une conférence… </br>
          A partir de novembre et ce jusqu’à la fin de l’hiver, le p’tit Café vous ouvre ses
          portes les samedis après-midi : nous vous proposons soit un atelier parents/enfants, soit un atelier tout public où le café est ouvert en même temps. </br>
          Afin que les week-ends, vous puissiez aussi profiter de ce lieu d’accueil chaleureux pour les
          familles. </br>
          On espère que cette proposition répondra à vos besoins et envies !
        </p>

        <a href="index.php?page=contact" class="btn-events">
          Consulter l’agenda
        </a>
      </div>
    </section>

    <!-- Popups -->

    <div class="event-modal" id="eventModal">
      <div class="event-modal-content">
        <button class="event-modal-close" id="closeModal" type="button">✕</button>

        <div class="event-modal-media" id="modalMedia"></div>

        <div class="event-modal-body">
          <h2 id="modalTitle"></h2>
          <div class="event-modal-text" id="modalText"></div>
        </div>
      </div>
    </div>


