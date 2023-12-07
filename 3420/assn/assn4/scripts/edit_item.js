
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