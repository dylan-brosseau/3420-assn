
//gettign text area
const text_ar = document.querySelector('textarea');
const char_disp = document.querySelector('#char-display');

//Character counter
text_ar.addEventListener('input', function () {

    //Getting the real time character count
    let text_count = text_ar.value.length;
    const max = text_ar.maxLength;
    let chars_left = max - text_count;

    //display charaters left
    char_disp.textContent = chars_left + " characters left";

    if (text_count > max){

        char_disp.textContent = "Limit reached!";
    } 

});


// Character counter
textArea.addEventListener('input', function () {

    // Set the maximum character limit
    const maxCount = 2500;

    // Calculate characters left
    const charactersLeft = maxCount - currentCount;

    charCountDisplay.textContent = charactersLeft >= 0 ? `${charactersLeft} characters left` : 'Character limit exceeded!';
});


// form validation

document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('edit-form');

    if (editForm) {
        const titleInput = document.getElementById('title');
        const titleError = document.getElementById('title-error');
        const descriptionInput = document.getElementById('description');
        const descriptionError = document.getElementById('description-error');

        editForm.addEventListener('submit', function(event) {
            let errors = false;

            // Validate title
            if (!titleInput.value) {
                titleError.classList.remove('hidden');
                errors = true;
            } else {
                titleError.classList.add('hidden');
            }

            // Validate description
            if (!descriptionInput.value) {
                descriptionError.classList.remove('hidden');
                errors = true;
            } else {
                descriptionError.classList.add('hidden');
            }

            if (errors) {
                event.preventDefault(); // Prevent form submission
            }
        });
    }
});
