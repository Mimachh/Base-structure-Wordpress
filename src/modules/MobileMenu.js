class MobileMenu {
  constructor() {
    this.overlay = document.querySelector('.overlay');
    this.menu = document.querySelector(".nav_mobile");
    // this.openButton = document.querySelector(".toggle-hamburger");

    this.openButton = document.querySelector('.toggle-hamburger-svg-open');
    this.closeButton = document.querySelector('.toggle-hamburger-svg-close');

    this.body = document.body;
    this.search = document.querySelector('.mobile-search');
    this.events();
  }

  events() {
    this.openButton.addEventListener("click", () => this.openMenu());
    this.closeButton.addEventListener("click", () => this.closeMenu());
    this.search.addEventListener('click', () => this.closeMenu());
  }

  openMenu() {
    // this.openButton.classList.toggle("fa-bars");
    // this.openButton.classList.toggle("fa-window-close");

    this.openButton.classList.add("hidden");
    this.closeButton.classList.add('visible');

    this.menu.classList.toggle("visible");
    this.overlay.classList.toggle('visible');
    this.body.classList.add('noscroll');
  }

  closeMenu() {
    this.menu.classList.toggle("visible");
    this.overlay.classList.toggle('visible');
    // this.openButton.classList.toggle("fa-bars");
    // this.openButton.classList.toggle("fa-window-close");
    this.openButton.classList.remove("hidden");
    this.closeButton.classList.remove('visible');
    this.body.classList.remove('noscroll');
  }
}

export default MobileMenu;