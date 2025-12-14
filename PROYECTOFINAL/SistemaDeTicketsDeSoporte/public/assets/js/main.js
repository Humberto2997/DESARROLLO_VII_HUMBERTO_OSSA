

console.log("Sistema de Tickets cargado correctamente.");

document.addEventListener("DOMContentLoaded", () => {
    // efecto hover suave en botones
    document.querySelectorAll("button").forEach(btn => {
        btn.addEventListener("mouseenter", () => btn.style.opacity = "0.8");
        btn.addEventListener("mouseleave", () => btn.style.opacity = "1");
    });
});
