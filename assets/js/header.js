// On récupère les éléments de base du menu
const burger = document.querySelector(".burger-bouton");
const closeBtn = document.querySelector(".close-bouton");
const menu = document.querySelector(".mobile-menu");

// On récupère les éléments qu'on veut déplacer
const nav = document.querySelector(".main-nav");
const cta = document.querySelector(".bouton-reservation");

// On vérifie UNIQUEMENT si les 3 éléments vitaux du burger sont là
if (burger && closeBtn && menu) {

  function openMenu() {
    menu.classList.add("is-open");
    document.body.classList.add("no-scroll");

    if (nav) menu.appendChild(nav);
    if (cta) menu.appendChild(cta);
  }

  function closeMenu() {
    menu.classList.remove("is-open");
    document.body.classList.remove("no-scroll");

    if (nav && navHome) navHome.appendChild(nav);
    if (cta && ctaHome) ctaHome.appendChild(cta);
  }

  burger.addEventListener("click", openMenu);
  closeBtn.addEventListener("click", closeMenu);
} 