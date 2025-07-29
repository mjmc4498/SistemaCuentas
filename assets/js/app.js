// Placeholder for custom JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Manejo del modal de eliminación de cuentas
    var deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var accountId = button.getAttribute('data-id');
            var deleteConfirmBtn = document.getElementById('delete-confirm-btn');
            deleteConfirmBtn.href = `../controllers/AccountController.php?action=delete&id=${accountId}`;
        });
    }

    // Simulación de autocompletado para la búsqueda
    var searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            var query = this.value;
            if (query.length > 2) {
                console.log(`Buscando: ${query}`);
                // Aquí se haría una petición AJAX para obtener sugerencias
            }
        });
    }
});
