//Codigo sidebar 

// Sidebar y elementos visuales
const sidebar = document.querySelector(".sidebar");
const sidebarToggler = document.querySelector(".sidebar-toggler");
const menuToggler = document.querySelector(".menu-toggler");
const logo = document.querySelector(".sidebar-header .header-logo img");
const cards = document.querySelector(".cards");
let collapsedSidebarHeight = "56px";
let fullSidebarHeight = "calc(100vh - 32px)";

// Cambia tamaño del logo según el estado de la sidebar
const adjustLogoSize = (isCollapsed) => {
  if (!logo) return;
  logo.style.width = isCollapsed ? "60px" : "150px";
  logo.style.height = isCollapsed ? "60px" : "150px";
};


const setLeftOffset = (el, isCollapsed) => {
  if (Array.isArray(el) || el instanceof NodeList) {
    el.forEach(e => e.style.left = isCollapsed ? "-70px" : "10px");
  } else {
    el.style.left = isCollapsed ? "-70px" : "10px";
  }
};

// Alternar colapsado
sidebarToggler.addEventListener("click", () => {
  sidebar.classList.toggle("collapsed");
  const isCollapsed = sidebar.classList.contains("collapsed");

  adjustLogoSize(isCollapsed);
  setLeftOffset(cards, isCollapsed);
 
  // Alternar colapsado
  sidebarToggler.addEventListener("click", () => {
  sidebar.classList.toggle("collapsed");
  const isCollapsed = sidebar.classList.contains("collapsed");

  adjustLogoSize(isCollapsed);
  setLeftOffset(cards, isCollapsed);

  // 👉 Forzar redibujado de todas las gráficas Chart.js
  setTimeout(() => {
    window.dispatchEvent(new Event("resize"));
  }, 350); // Espera a que termine la animación (match con transition CSS)
});

});

// Alternar menú vertical en móviles
const toggleMenu = (isMenuActive) => {
  sidebar.style.height = isMenuActive ? `${sidebar.scrollHeight}px` : collapsedSidebarHeight;
  const icon = menuToggler.querySelector("span");
  if (icon) icon.innerText = isMenuActive ? "close" : "menu";
};

menuToggler.addEventListener("click", () => {
  toggleMenu(sidebar.classList.toggle("menu-active"));
});

// Responsive: ajustar barra según tamaño de ventana
window.addEventListener("resize", () => {
  if (window.innerWidth >= 1024) {
    sidebar.style.height = fullSidebarHeight;
    adjustLogoSize(sidebar.classList.contains("collapsed"));
  } else {
    sidebar.classList.remove("collapsed");
    sidebar.style.height = "auto";
    toggleMenu(sidebar.classList.contains("menu-active"));
    adjustLogoSize(sidebar.classList.contains("collapsed"));
  }
});

//Fin code sidebar 



//Agregar Orden abriri formulario

document.getElementById("NuevaOrden").addEventListener("click", function() {
  window.location.href = "formulario.php";
});