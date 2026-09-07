const header = document.querySelector("[data-header]");
const menuButton = document.querySelector(".menu-toggle");
const menu = document.querySelector(".site-nav");
const year = document.querySelector("[data-year]");

const updateHeader = () => {
  header?.classList.toggle("scrolled", window.scrollY > 24);
};

const closeMenu = () => {
  menuButton?.setAttribute("aria-expanded", "false");
  menu?.classList.remove("open");
  document.body.classList.remove("menu-open");
};

menuButton?.addEventListener("click", () => {
  const isOpen = menuButton.getAttribute("aria-expanded") === "true";
  menuButton.setAttribute("aria-expanded", String(!isOpen));
  menu?.classList.toggle("open", !isOpen);
  document.body.classList.toggle("menu-open", !isOpen);
});

menu?.querySelectorAll("a").forEach((link) => link.addEventListener("click", closeMenu));
window.addEventListener("scroll", updateHeader, { passive: true });
window.addEventListener("resize", () => {
  if (window.innerWidth > 720) closeMenu();
});

if (year) year.textContent = new Date().getFullYear();
updateHeader();

document.querySelectorAll("[data-slider]").forEach((slider) => {
  const slides = [...slider.querySelectorAll("[data-slide]")];
  const dots = [...slider.querySelectorAll("[data-slider-dot]")];
  const previous = slider.querySelector("[data-slider-prev]");
  const next = slider.querySelector("[data-slider-next]");
  const status = slider.querySelector("[data-slider-status]");
  const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)");
  let activeIndex = 0;
  let autoplay;

  const showSlide = (index, announce = true) => {
    activeIndex = (index + slides.length) % slides.length;
    slides.forEach((slide, slideIndex) => {
      const isActive = slideIndex === activeIndex;
      slide.classList.toggle("is-active", isActive);
      slide.setAttribute("aria-hidden", String(!isActive));
    });
    dots.forEach((dot, dotIndex) => {
      const isActive = dotIndex === activeIndex;
      dot.classList.toggle("is-active", isActive);
      if (isActive) dot.setAttribute("aria-current", "true");
      else dot.removeAttribute("aria-current");
    });
    if (status && announce) status.textContent = `Fotografía ${activeIndex + 1} de ${slides.length}`;
  };

  const stopAutoplay = () => window.clearInterval(autoplay);
  const startAutoplay = () => {
    stopAutoplay();
    if (!reducedMotion.matches) autoplay = window.setInterval(() => showSlide(activeIndex + 1, false), 6500);
  };

  previous?.addEventListener("click", () => { showSlide(activeIndex - 1); startAutoplay(); });
  next?.addEventListener("click", () => { showSlide(activeIndex + 1); startAutoplay(); });
  dots.forEach((dot, index) => dot.addEventListener("click", () => { showSlide(index); startAutoplay(); }));
  slider.addEventListener("mouseenter", stopAutoplay);
  slider.addEventListener("mouseleave", startAutoplay);
  slider.addEventListener("focusin", stopAutoplay);
  slider.addEventListener("focusout", startAutoplay);
  reducedMotion.addEventListener?.("change", startAutoplay);
  document.addEventListener("visibilitychange", () => document.hidden ? stopAutoplay() : startAutoplay());
  startAutoplay();
});
