document.addEventListener('DOMContentLoaded', function () {
    // Get the delete form
    const deleteForm = document.getElementById('deleteForm');

    // Check if the delete form exists
    if (deleteForm) {
        // Attach an event listener to the form submission
        deleteForm.addEventListener('submit', function (event) {
            // Display a confirmation dialog
            const isConfirmed = confirm('Are you sure you want to delete your account? This action cannot be undone.');

            // If not confirmed, prevent form submission
            if (!isConfirmed) {
                event.preventDefault();
            }
        });
    }

    // Handle list item deletion confirmation
    document.querySelectorAll('.delete-item').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault();
            const entryId = this.getAttribute('data-entry-id');
            if (confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                window.location.href = 'delete_item.php?param=' + entryId;
            }
        });
    });
});
