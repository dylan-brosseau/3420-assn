// js/confirm_deleteitem.js
document.addEventListener('DOMContentLoaded', function () {
    // Get the delete form
    const deleteForm = document.getElementById('deleteForm');

    // Attach an event listener to the form submission
    deleteForm.addEventListener('submit', function (event) {
        // Display a confirmation dialog
        const isConfirmed = confirm('Are you sure you want to delete this item? This action cannot be undone.');

        // If not confirmed, prevent form submission
        if (!isConfirmed) {
            event.preventDefault();
        }
    });
});
