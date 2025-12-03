// Gestión de eventos con datos de la base de datos
document.addEventListener('DOMContentLoaded', function() {
    // Redireccionar al hacer click en "Ver detalles"
    document.querySelectorAll('[data-evento-id]').forEach(btn => {
        btn.addEventListener('click', function() {
            const eventoId = this.dataset.eventoId;
            window.location.href = `/estudiante/eventos/${eventoId}`;
        });
    });
});
