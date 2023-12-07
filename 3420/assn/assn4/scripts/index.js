
//Getting elements
const page_link_button = document.querySelector('#copy-link-btn');
const page_link = document.querySelector('#page-link');
const page_copy_confirm = document.querySelector('#page-copy-msg');

//event listener
function Link_to_Clip() 
{

    the_link = page_link.href;

    //copy to clipboard

    //Selecting the text field
    //the_link.select(); 

    //Copy the link
    navigator.clipboard.writeText(the_link);

    page_copy_confirm.textContent = "Link copied!";

}


// creation of modal window on 
document.addEventListener('DOMContentLoaded', function() {
    // Open modal for 'View Details' links
    document.body.addEventListener('click', function(event) {
        if (event.target.classList.contains('view-details')) {
            event.preventDefault();
            const entryId = event.target.getAttribute('data-entry-id');
            showModal(entryId);
        }
    });

    // Close modal button
    const closeButton = document.querySelector('.close');
    closeButton.addEventListener('click', function() {
        document.getElementById('myModal').classList.add('hidden'); // Add 'hidden' class to hide the modal
    });

    // Close modal when clicking outside of it
    window.onclick = function(event) {
        const modal = document.getElementById('myModal');
        if (event.target === modal) {
            modal.classList.add('hidden'); // Add 'hidden' class to hide the modal
        }
    };
});

function showModal(entryId) {
    const modal = document.getElementById('myModal');
    const itemDetails = document.getElementById('itemDetails');

    // Make an AJAX request to view-item.php
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'view_item.php?id=' + entryId, true);
    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            // Insert the response into the modal
            itemDetails.innerHTML = this.responseText;
            // Show the modal
            modal.classList.remove('hidden');
        }
    };
    xhr.send();
}
