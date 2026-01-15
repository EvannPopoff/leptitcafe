const burger = document.querySelector(".burger-bouton");
const closeBtn = document.querySelector(".close-bouton");
const menu = document.querySelector(".mobile-menu");

const nav = document.querySelector(".main-nav");
const cta = document.querySelector(".bouton-reservation");

if (burger && closeBtn && menu && nav && cta) {

  const navHome = nav.parentNode;
  const ctaHome = cta.parentNode;

  function openMenu() {
    menu.classList.add("is-open");
    document.body.classList.add("no-scroll");

    menu.appendChild(nav);
    menu.appendChild(cta);
  }

  function closeMenu() {
    menu.classList.remove("is-open");
    document.body.classList.remove("no-scroll");

    navHome.appendChild(nav);
    ctaHome.appendChild(cta);
  }

  burger.addEventListener("click", openMenu);
  closeBtn.addEventListener("click", closeMenu);
}
