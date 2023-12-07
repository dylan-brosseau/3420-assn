"use strict";

/**
 * This function checks that an email address is valid.
 *
 * This function is correct, don't mess with it. Right now, it's written pretty verbosely to make
 * what's happening clearer. In reality, I would have written this functions as:
 *
 * ```js
 * const checkEmail = str => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(str);
 * ```
 *
 * It uses a regular expression, like those used with the `preg_*` family of functions in PHP.
 * @see https://regex101.com/r/5w9EYJ/1
 */
function checkEmail(string) {
  if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(string))
    return true;
  else
    return false;
}


// ---------------------------------------------------------------------------------------------- //
// Start below this line
// ---------------------------------------------------------------------------------------------- //


// replace ??? within the selector to get the required element. Keep in mind that this file will
// be included on other pages as well, so don't select the 'form' tag directly.
const voteForm = document.querySelector("#main-form");

if (voteForm) {
  // replace ??? with correct event
  voteForm.addEventListener("submit", (ev) => {
    // declare a boolean flag named errors here
    let errors = false;


    // replace ??? with the selector to get the email input, and traverse to get error message
    const emailInput = document.getElementById("email");
    const emailError = emailInput.nextElementSibling;


    // check if email is valid and handle appropriately
    if (!checkEmail(emailInput.value)) {
      emailError.classList.remove("hidden");
      errors = true;
    }
    else {
      // If email is valid, hide error message
      emailError.classList.add("hidden");
    }

    // select/traverse to get the element(s) needed to validate the radio buttons and to display the
    // relevant error message
    const radioButtons = document.querySelectorAll("[name='perspective']");
    const radioError = document.querySelector('fieldset').nextElementSibling;
    // check if a radio button was selected and handle appropriately
    let isAnyChecked = false;

    for (let radioButton of radioButtons) {
      if (radioButton.checked) {
        isAnyChecked = true;
        break;
      }
    }

    // Display or hide the error message based on radio button selection
    if (!isAnyChecked) {
      radioError.classList.remove("hidden");
      errors = true;
    }
    else {
      radioError.classList.add("hidden");
    }

    // select/traverse to get the element(s) needed to validate the dropdown and to display the
    // relevant error message
    const choice = document.getElementById("choice");
    const choiceError = choice.nextElementSibling;
    // check if there was nothing selected in the dropdown and handle appropriately
    if (choice.value === "0") {
      choiceError.classList.remove("hidden");
      errors = true;
    }
    else {
      choiceError.classList.add("hidden");
    }

    // IF THERE ARE ERRORS, PREVENT FORM SUBMISSION
    if (errors) {
      ev.preventDefault();
    }
  });
}
