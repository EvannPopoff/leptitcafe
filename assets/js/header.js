const burger = document.querySelector(".burger-bouton");
const closeBtn = document.querySelector(".close-bouton");
const menu = document.querySelector("#mobileMenu");

const nav = document.querySelector("#mainNav");
const navSlot = document.querySelector("#navSlot");
const menuSlot = document.querySelector("#menuSlot");


function moveNavToDesktop(){
  if (nav && navSlot && nav.parentElement !== navSlot) {
    navSlot.appendChild(nav);
  }
}

function moveNavToMobile(){
  if (nav && menuSlot && nav.parentElement !== menuSlot) {
    menuSlot.appendChild(nav);
  }
}

function openMenu(){
  menu.classList.add("is-open");
  menu.setAttribute("aria-hidden", "false");
  document.body.classList.add("no-scroll");
  moveNavToMobile();
}

function closeMenu(){
  menu.classList.remove("is-open");
  menu.setAttribute("aria-hidden", "true");
  document.body.classList.remove("no-scroll");
  moveNavToDesktop();
}

if (burger && closeBtn && menu && nav && navSlot && menuSlot) {

  // au chargement, on met la nav au bon endroit selon la taille
  if (window.innerWidth <= 768) moveNavToDesktop(); // cachée via CSS
  else moveNavToDesktop();

  burger.addEventListener("click", openMenu);
  closeBtn.addEventListener("click", closeMenu);

  // fermer quand on clique un lien
  menu.addEventListener("click", (e) => {
    if (e.target.closest("a")) closeMenu();
  });


  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") closeMenu();
  });

  // si on resize : on ferme et on remet la nav en desktop
  window.addEventListener("resize", () => {
    if (window.innerWidth > 768) closeMenu();
  });
}
