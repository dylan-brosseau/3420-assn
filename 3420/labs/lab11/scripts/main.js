"use strict";

/**
 * This function checks that an email address is valid. It is correct, don't mess with it. It is
 * identical to the function from last week's lab, but is written less verbosely.
 *
 * This function uses regular expressions, like those used with the `preg_*` family of functions in
 * PHP. @see https://regex101.com/r/5w9EYJ/1
 */
const checkEmail = str => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(str);

const voteForm = document.querySelector("#main-form");

if (voteForm) {
  // "Global" variable that we will update in the new event listener and check in the original
  // submit listener
  let emailIsValid = false;

  // Select all of the elements we'll need in order to perform validation.
  const emailInput = document.getElementById("email");
  const emailError = emailInput.nextElementSibling;

  const perspectiveButtons = Array.from(document.getElementsByName('perspective'));
  const perspectiveError = perspectiveButtons[0].closest('fieldset').nextElementSibling;

  const choiceSelect = document.getElementById('choice');
  const choiceError = choiceSelect.nextElementSibling;

  voteForm.addEventListener("submit", (ev) => {
    let errors = false;

    // check if email is valid and handle appropriately
    if (checkEmail(emailInput.value)) {
      emailError.classList.add('hidden');
    } else {
      emailError.classList.remove('hidden');
      errors = true;
    }

    // check if a radio button was selected and handle appropriately
    if (perspectiveButtons.some(button => button.checked)) {
      perspectiveError.classList.add('hidden');
    } else {
      perspectiveError.classList.remove('hidden');
      errors = true;
    }

    // check if there was nothing selected in the dropdown and handle appropriately
    if (choiceSelect.value != 0) {
      choiceError.classList.add('hidden');
    } else {
      choiceError.classList.remove('hidden');
      errors = true;
    }

    // IF THERE ARE ERRORS, PREVENT FORM SUBMISSION
    if (errors || !emailIsValid)
      ev.preventDefault();
  });

  // -------------------------------------------------------------------------------------------- //
  // Put your new event listener for Lab 11 down here
  // -------------------------------------------------------------------------------------------- //


  emailInput.addEventListener("blur", (ev) => {
    const emailErrorInvalid = emailInput.nextElementSibling;
    const emailErrorVoted = emailErrorInvalid.nextElementSibling;

    if (emailErrorInvalid) { emailErrorInvalid.remove(); }
    if (emailErrorVoted) { emailErrorVoted.remove(); }

    const xhr = new XMLHttpRequest();

    const emailValue = encodeURIComponent(emailInput.value);
    const url = `checkemail.php?email=${emailValue}`;

    xhr.open("GET", url);

    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          const response = xhr.responseText;
          if (response === 'error' || response === 'true') {
            emailIsValid = false;

            const errorSpan = document.createElement('span');
            errorSpan.classList.add('error');
            errorSpan.id = 'emailError';
            errorSpan.innerText = "Please use a valid email address that hasn't voted yet.";

            emailInput.insertAdjacentElement('afterend', errorSpan);
          }

          else { emailIsValid = true; }


        }
        else {
          console.error("Error in AJAX request");
        }
      }
    };

    // Send the request
    xhr.send();

  });




}
