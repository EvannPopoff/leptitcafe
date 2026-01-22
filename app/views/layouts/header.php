<header>
  <div class="in-header container">

    <a class="logo" href="index.php">
      <img src="assets/images/footer_header/logo.webp" alt="logo">
    </a>

    <!-- Emplacement NAV en desktop -->
    <div class="nav-slot" id="navSlot"></div>

    <button class="burger-bouton" type="button" aria-label="Ouvrir le menu">
      <img src="assets/images/footer_header/Burger.png" alt="menu-burger">
    </button>
  </div>

  <!-- NAV UNIQUE (on la place dans navSlot en JS au chargement) -->
  <nav class="main-nav" id="mainNav">
    <ul>
      <li><a href="index.php?page=apropos">À propos</a></li>
      <li><a href="index.php?page=evenement">Activités et Évènements</a></li>
      <li><a href="index.php?page=membership">Adhérer</a></li>
    </ul>
    <a href="index.php?page=contact" class="bouton-contact">Contact</a>
  </nav>

  <!-- OVERLAY MOBILE -->
  <div class="mobile-menu" id="mobileMenu" aria-hidden="true">
    <button class="close-bouton" type="button" aria-label="Fermer le menu">
      <img src="assets/images/footer_header/Close-Burger.png" alt="close-burger">
    </button>

    <!-- Emplacement NAV dans le menu mobile -->
    <div class="menu-slot" id="menuSlot"></div>
  </div>
</header>
